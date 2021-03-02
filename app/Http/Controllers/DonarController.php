<?php

namespace App\Http\Controllers;

use App\Databases\CompraModel;
use App\Databases\DolarModel;
use App\Databases\ProductoModel;
use App\Databases\Transaction;
use App\Utils\Mailer;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;
use MercadoPago\SDK;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;

class DonarController extends Controller
{
    public function index()
    {
        $data = $this->getUserData();
        $cantidadMaximaProductos = 6;
        $data['productos'] = ProductoModel::where('visible', 1)->orderBy('fichas', 'asc')->take($cantidadMaximaProductos)->get();
        $data['socios_donantes_qty'] = CompraModel::groupBy('user_id')->count();
        return view("donar.donar", $data);
    }

    public function checkout(Request $request)
    {
        $data = $this->getUserData();
        $productId = $request->query('producto');
        if ($productId == null) {
            abort(404);
        }
        $producto = ProductoModel::find($productId);
        $cotizacionDolarMEP = $this->getDolarPrice();
        $producto->setCotizacion($cotizacionDolarMEP);
        $data['producto'] = $producto;
        $data['user_email'] = Auth::user()->email;
        return view("donar.donar_checkout", $data);
    }


    private function getDolarPrice()
    {
        $cotizacion = DolarModel::latest()->first();
        $minutes = 60 * 12;
        if ($cotizacion && $cotizacion->fecha->diffInMinutes(Carbon::now()) < $minutes) {
            return $cotizacion->precio;
        }
        try {
            $client = new Client();
            $url = "https://www.dolarsi.com/api/api.php?type=valoresprincipales";
            $response = $client->get($url);
            $cotizaciones = json_decode($response->getBody());
            $cotizacion = array_filter($cotizaciones, function ($cotizacion) {
                return $cotizacion->casa->nombre == 'Dolar Contado con Liqui';
            });
            if (count($cotizacion) > 0) {
                $precio = str_replace(',', '.', reset($cotizacion)->casa->venta);
                $dolarMep = new DolarModel([
                    "precio" => $precio,
                    "fecha" => Carbon::now()
                ]);
                $dolarMep->save();
                return $precio;
            }
        } catch (\Exception $error) {
            if ($cotizacion) {
                return $cotizacion->precio;
            }
            return 150;
        }
    }


    private function mercado_pago($producto, $internalId, $user)
    {
        $accessToken = env('MERCADO_PAGO_ACCESS_TOKEN');
        SDK::setAccessToken($accessToken);
        $preference = new Preference();
        $item = new Item();
        $item->title = $producto->name;
        $item->quantity = 1;
        $item->unit_price = $producto->getPriceInArs();
        $item->currency_id = 'ARS';
        $item->category = "donations";
        $preference->items = array($item);
        $preference->back_urls = array(
            "success" => url('donar/successful'),
            "failure" => url('donar/rejected'),
            "pending" => url('donar/pending')
        );
        $preference->auto_return = "approved";
        $preference->external_reference = $internalId;
        $payer = new Payer();
        $payer->name = $user->name;
        $payer->surname = $user->lastName;
        $payer->email = $user->email;
        if ($user->phone_verified_at != null) {
            $payer->phone = array(
                "area_code" => $user->prefijo,
                "number" => $user->whatsapp
            );
        }
        $preference->payer = $payer;
        $preference->save();
        return $preference;
    }

    private function generateUuid()
    {
        $uuid = DB::select(DB::raw('SELECT UUID() as id'));
        return count($uuid) > 0 ? $uuid[0]->id : "";
    }

    public function create_compra(request $request)
    {
        $user = Auth::user();
        $productoId = $request->producto_id;
        $producto = ProductoModel::find($productoId);
        $medio = $request->payment_processor;
        return $this->prepare_compra($producto, $medio, $user);
    }

    private function prepare_compra($producto, $medio, $user)
    {
        $preferenceInit = "";
        $internalId = $this->generateUuid();
        $paypalId = "";
        $priceInArs = 0;
        if ($medio == "mercadopago") {
            $priceInArs = $this->getDolarPrice();
            $producto->setCotizacion($priceInArs);
            $preference = $this->mercado_pago($producto, $internalId, $user);
            $preferenceInit = $preference->init_point;
        } else {
            $paypalResponse = $this->createOrder($producto, $internalId);
            $paypalId = $paypalResponse->result->id;
        }
        $preCompra = new CompraModel([
            'user_id' => $user->id,
            'producto_id' => $producto->id,
            'amount' => $producto->getPriceInUsd(),
            'payment_processor' => $medio,
            'internal_id' => $internalId,
            'status' => 'prepared',
            'external_reference' => $paypalId,
            'price_ars' => $priceInArs
        ]);
        $preCompra->save();
        return response()->json(["status" => "success", "preferenceInit" => $preferenceInit, "paypal_id" => $paypalId]);
    }

    public function pending(Request $request)
    {
        $data = $this->getUserData();
        $params = $request->all();
        $external_reference = $params['external_reference'];
        if ($this->compraExists($external_reference)) {
            $compra = CompraModel::where('internal_id', $external_reference)->first();
            if ($compra) {
                $producto = ProductoModel::find($compra->producto_id);
                $data['producto'] = $producto;
                if ($params['status'] == "in_process") {
                    $data = $this->updateCompra($compra, $params, $data, 0, 0);
                    return view("donar.donar_status_pending", $data);
                }
            }
        }
        abort(404);
    }

    public function rejected(Request $request)
    {
        $data = $this->getUserData();
        $params = $request->all();
        $external_reference = $params['external_reference'];
        if ($this->compraExists($external_reference)) {
            $compra = CompraModel::where('internal_id', $external_reference)->first();
            if ($compra) {
                $producto = ProductoModel::find($compra->producto_id);
                $data['producto'] = $producto;
                $user = Auth::user();
                if ($params['status'] == "rejected" && $compra->processed == 0) {
                    $data = $this->updateCompra($compra, $params, $data, 1, 0);
                    return view("donar.donar_status_rejected", $data);
                }
            }
        }
        abort(404);
    }

    public function successful(Request $request)
    {
        $data = $this->getUserData();
        $params = $request->all();
        $external_reference = $params['external_reference'];
        if ($this->compraExists($external_reference)) {
            $compra = CompraModel::where('internal_id', $external_reference)->first();
            if ($compra) {
                $productId = $compra->producto_id;
                $userId = $compra->user_id;
                $producto = ProductoModel::find($productId);
                $data['producto'] = $producto;
                $user = Auth::user();
                if ($params['status'] == "approved" && $compra->processed == 0) {
                    $data = $this->updateCompra($compra, $params, $data, 1, 0);
                    $tx = Transaction::createTransaction(1, $userId, $producto->fichas, "Compra de fichas ID {$params['payment_id']}");
                    $compra->delivered = $tx->id;
                    $compra->save();
                    $this->sendPaymentMail($user, $producto, $compra);
                    $data['donante'] = $user->name . " " . $user->lastName;
                    return view("donar.donar_status_successful", $data);
                }
            }
        }
        abort(404);
    }

    private function compraExists($internalId)
    {
        $compra = CompraModel::where('internal_id', $internalId)->count() > 0;
        return $compra;
    }

    private function updateCompra($compra, array $params, array $data, $processed, $delivered): array
    {
        $data['details'] = [
            'status' => $params['status'],
            'payment_id' => $params['payment_id'],
            'payment_type' => $params['payment_type'],
            'order_id' => $params['merchant_order_id'],
            'external_reference' => $params['external_reference'],
            'datos' => json_encode($params),
            'fecha' => Carbon::now()->format('d-m-Y H:i'),
            'processed' => $processed,
            'delivered' => $delivered
        ];
        $compra->fill($data['details']);
        $compra->save();
        return $data;
    }

    public function paypal(Request $request)
    {
        $data = $this->getUserData();
        $productId = $request->query('producto');
        if ($productId == null) {
            abort(404);
        }
        $data['producto'] = ProductoModel::find($productId);
        $data['user_email'] = Auth::user()->email;
        return view('donar.paypal-checkout', $data);
    }

    public function mercado_pago_webhook(Request $request)
    {
        $params = $request->all();
        Log::info($params['token']);
        if (strtolower($params['token']) == strtolower(env('MP_WEBHOOK_TOKEN'))) {
            Log::info(json_encode($params));
            if (array_key_exists('data', $params)) {
                $compra = CompraModel::where('payment_id', $params['data']['id'])->first();
                if ($compra) {
                    if ($compra->status == 'in_process' && $compra->processed == 0) {
                        if ($params['action'] == 'payment.created') {
                            $compra->status = 'approved';
                            $compra->datos = json_encode($params);
                            $compra->processed = 1;
                            $compra->save();
                            $producto = ProductoModel::find($compra->producto_id);
                            $tx = Transaction::createTransaction(1, $compra->user_id, $producto->fichas, "Compra de fichas ID {$compra->payment_id}");
                            $compra->delivered = $tx->id;
                            $compra->save();
                        }
                    }
                }
            }
        }
        return response()->json(['status' => 'success', 'data' => $params]);
    }

    public function paypal_capture(Request $request)
    {
        $orderId = $request->orderID;
        $apiCall = new OrdersCaptureRequest($orderId);
        $client = $this->getPaypalClient();
        try {
            $response = $client->execute($apiCall);
        } catch (HttpException $error) {
            return response()->json(json_decode($error->getMessage()));
        }
        foreach ($response->result->purchase_units as $purchase_unit) {
            $internal_id = $purchase_unit->reference_id;
        }
        $compra = CompraModel::where('internal_id', $internal_id)->where('external_reference', $orderId)->first();
        if ($compra) {
            $params = [
                'status' => $response->result->status,
                'payment_id' => $orderId,
                'payment_type' => 'credit_card',
                'order_id' => $orderId,
                'external_reference' => $orderId,
                'merchant_order_id' => ""
            ];
            $data = [];
            $producto = ProductoModel::find($compra->producto_id);
            $this->updateCompra($compra, $params, $data, 1, 0);
            $tx = Transaction::createTransaction(1, $compra->user_id, $producto->fichas, "Compra de fichas ID {$params['payment_id']}");
            $user = Auth::user();
            $this->sendPaymentMail($user, $producto, $compra);
            $compra->delivered = $tx->id;
            $compra->save();
        }
        return response()->json($response->result);
    }

    private function getPaypalClient()
    {
        return new PayPalHttpClient($this->getPaypalEnvironment());
    }


    private function createOrder($producto, $internalId)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = $this->buildRequestBody($producto->getPriceInUsd(), $internalId);
        $client = $this->getPaypalClient();
        return $client->execute($request);
    }

    private function buildRequestBody($amount, $internalId)
    {
        return array(
            'intent' => 'CAPTURE',
            'application_context' =>
                array(
                    'return_url' => url('paypal/successful'),
                    'cancel_url' => url('paypal/canceled')
                ),
            'purchase_units' =>
                array(
                    0 =>
                        array(
                            'amount' =>
                                array(
                                    'currency_code' => 'USD',
                                    'value' => $amount,
                                    ''
                                ),
                            'reference_id' => $internalId
                        )
                )
        );
    }

    private function getPaypalEnvironment()
    {
        $clientId = env("PAYPAL_CLIENT_ID");
        $clientSecret = env("PAYPAL_CLIENT_SECRET");
        if (env('APP_ENV') == "production") {
            return new ProductionEnvironment($clientId, $clientSecret);
        }
        return new SandboxEnvironment($clientId, $clientSecret);
    }

    public function paypal_successful(Request $request)
    {
        $data = $this->getUserData();
        $orderId = $request->query('id');
        $compra = CompraModel::where('external_reference', $orderId)->first();
        if ($compra) {
            $user = Auth::user();
            $data['producto'] = ProductoModel::find($compra->producto_id);
            $data['donante'] = $user->name . " " . $user->lastName;
            $data['details']['fecha'] = Carbon::now()->format('d-m-Y H:i');
            $data['details']['payment_id'] = $orderId;
            return view("donar.donar_status_successful", $data);
        }
        abort(404);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param $producto
     * @param $compra
     */
    private function sendPaymentMail(\Illuminate\Contracts\Auth\Authenticatable $user, $producto, $compra)
    {
        $emailData = [
            "email" => $user->email,
            "fichas" => $producto->fichas,
            "paymentId" => $compra->internal_id,
            "fecha" => Carbon::now()->format("d-m-Y H:i"),
            "productName" => $producto->name,
            "amount" => $producto->getPriceInUsd(),
            "donante" => $user->name . " " . $user->lastName
        ];
        $mailer = new Mailer();
        $mailer->sendDonationEmail($emailData);
    }
}
