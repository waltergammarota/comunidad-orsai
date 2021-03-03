@extends('2021-orsai-template')

@section('title', 'Donar | Comunidad Orsai')
@section('description', 'Donar')

@section('content')
    <script
        src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}&currency=USD"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>
    <section class="resaltado_amarillo pd_tp_bt">
        <article class="contenedor">
            <div class="cuerpo_card_perfil_publico ps_pago_02">
                <div class="cuerpo_interna ">
                    <div class="">
                        <div class="titulo">
                            <h1 class="text_regular _barlow_text">COMPLETA TUS DATOS PARA CONSEGUIR TUS FICHAS</h1>
                        </div>
                        <table class="border_tp_bt_table">
                            <tbody class="">
                            <tr>
                                <td colspan="2">Detalle de tu donación:</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="items_detalle">
                                        <tr>
                                            <td>Paquete</td>
                                            <td>{{$producto->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad de fichas</td>
                                            <td>{{$producto->fichas}} </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="items_detalle">
                                        <tr class="_total">
                                            <td>Total
                                            </td>
                                            <td class="text_bold">USD {{$producto->getPriceInUsd()}}</td>
                                        </tr>
                                        <tr class="">
                                            <td colspan="2" class="pie_tabla color_gris_claro">Es posible que se
                                                apliquen tarifas extra por tasas de cambio según país.
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form_ctrl input_">
                        <div class="align_center">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                    <div class="align_center compra_protegida">
                        <img src="{{url('recursos/compra_protegida.svg')}}" alt="">
                        <span class=" text_bold">Compra 100% protegida</span>
                    </div>
                </div>
            </div>
            <div class="mg_50"></div>
            </div>
        </article>
        <div class="contenedor">
            <div class="form_ctrl input_  ">
                <div class="align_center">
                    <a href="{{url('donar')}}" class="boton_redondeado btn_transparente_negro text_bold pd_50_lf_rg ">Volver</a>
                </div>
            </div>
        </div>
    </section>


    <script>
        const product = {{$producto->id}};
        const amount = {{$producto->getPriceInUsd()}};
        let internal_id = "";
        const email = '{{$user_email}}';

        async function createCompra() {
            const url = '{{url('donar/create-compra')}}';
            return axios.post(url, {
                producto_id: {{$producto->id}},
                payment_processor: 'paypal'
            });
        }

        paypal.Buttons({
            createOrder: function (data, actions) {
                return createCompra().then(function (response) {
                    return response.data.paypal_id;
                })
            },
            onApprove: function (details, actions) {
                const url = '{{url("donar/paypal/capture")}}';
                return axios.post(url, {
                        orderID: details.orderID
                    }
                ).then(function (response) {
                    if (response.data.details && response.data.details[0].issue === 'INSTRUMENT_DECLINED') {
                        alert("Su tarjeta ha sido rechazada, por favor intente más tarde");
                    } else {
                        window.location = `{{url("donar/paypal/successful")}}?id=${response.data.id}`;
                    }
                });
            },
            onError: (err) => {
                console.error('error from the onError callback', err);
            }
        }).render('#paypal-button-container');

    </script>
@endsection


@section('footer')
@endsection
