@extends('2021-orsai-template')

@section('title', 'Donar | Comunidad Orsai')
@section('description', 'Donar')

@section('content')
    <style>
        .pesitos {
            display: none;
        }

        #paypal-button-container {
            display: none;
        }
        .opt_mercadopago,
        .opt_paypal {
            text-align:center;
            display: none;
        }
        .otras_opciones{
            display: none;
            font-size: 13px; 
            margin: 25px 0;
            text-decoration:underline;
        } 
    </style>
    <script
        src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}&currency=USD"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>
    <section class="resaltado_amarillo pd_tp_bt">
        <article class="contenedor">
            <div class="cuerpo_card_perfil_publico ps_pago_02">
                <div class="cuerpo_interna ">
                    <div class="">
                        <div class="titulo">
                            <h1 class="text_regular _barlow_text">ESTÁS A PUNTO
                                DE CONSEGUIR TUS FICHAS</h1>
                        </div>
                        <table class="border_tp_bt_table">
                            <tbody class=""> 
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
                                        <tr class="_total pesitos">
                                            <td><br>Total en Pesos Argentinos
                                            </td>
                                            <td class="text_bold"><br>ARS {{$producto->getPriceInArs()}}</td>
                                        </tr>
                                        <tr class="pesitos">
                                            <td colspan="2" class="pie_tabla color_gris_claro">
                                                <a href="https://www.dolarsi.com/cotizacion-dolar-mep-bolsa/" target="_blank" class="color_gris_claro link_underline">Conversión Dolar Bolsa</a>: USD 1 = ARS {{$producto->getCotizacion()}}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="forma_pago">
                            <span class="titulo text_bold">Seleccioná como querés abonar tu donación:</span>
                            <div class="opt_mercadopago">
                                <span class="desc">Vas a realizar tu donación con <img src="{{url('recursos/mercadopago.svg')}}" width="100" alt="Mercado Pago"></span><br/>
                            </div>
                            <div class="opt_paypal">
                                <span class="desc">Vas a realizar tu donación con <strong>Paypal</strong>.<br/>También podes hacerlo con cualquier tarjeta de débito o crédito internacional. </span><br/>
                            </div>
                            <div class="grilla_form">
                                <div class="form_ctrl col_3"> 
                                    <div class="align_center">
                                        <div class="boton_redondeado btn_gris width_100 mercadopago_"
                                             data-processor_type="mercadopago">
                                            <img src="{{url('recursos/mercadopago.svg')}}" alt="Mercado Pago">
                                        </div>
                                        <span class="color_gris text_medium">Argentina</span>
                                    </div>
                                </div>
                                <div class="form_ctrl col_3">
                                    <div class="align_center">
                                        <div class="boton_redondeado btn_gris width_100 paypal_">
                                            <img src="{{url('recursos/paypal.svg')}}" alt="">
                                        </div>
                                        <span class="color_gris text_medium">Mundo</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_ctrl input_  ">
                            <div class="align_center">
                                <span id="donar" class="boton_redondeado resaltado_amarillo text_bold width_100 hide">Donar</span>
                                <div id="paypal-button-container"></div>
                                <a href="#" class="otras_opciones">Volver a otras opciones de donación</a>
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

    {{-- <div class="modal_paypal">
        <div class="contenedor">
            <div class="cont_modal_blanco">
                <div class="intro_modal">
                    <img src="{{url('recursos/modal_paypal.svg')}}" alt="">
                    <span>Te redireccionaremos al sitio de <strong>PayPal</strong>.</span>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal_mercadopago">
        <div class="contenedor">
            <div class="cont_modal_blanco">
                <div class="intro_modal">
                    <img src="{{url('recursos/modal_mercadolibre.svg')}}" alt="">
                    <span>Te redireccionaremos al sitio de <strong>Mercado Pago</strong>.</span>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')


    <script>
        $('.otras_opciones').on("click", function(e){
            e.preventDefault();
            $(".forma_pago .titulo").show();
            $('.grilla_form').show();
            $('.opt_mercadopago').hide();
            $('.opt_paypal').hide();
            $(".pesitos").hide(); 
            $("#paypal-button-container").hide(); 
            $('#donar').addClass('hide').attr('disabled', 'disabled'); 
            $('.boton_redondeado').removeClass("active");
            $(this).hide();
        });
        $(".forma_pago .boton_redondeado").on("click", function () {
                $(".forma_pago .titulo").hide();
                $('.grilla_form').hide();
                $('.otras_opciones').css('display','block');
            if ($(this).data('processor_type') == "mercadopago") {
                $(".pesitos").show();
                $('#donar').removeClass('hide').removeAttr('disabled');
                $("#paypal-button-container").hide();
                $('.opt_mercadopago').show();
            } else {
                $(".pesitos").hide();
                $('#donar').addClass('hide').attr('disabled', 'disabled');
                $("#paypal-button-container").show();
                $('.opt_paypal').show();
            }
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $('#donar').addClass('hide').attr('disabled', 'disabled');
                $("#paypal-button-container").hide();
            } else {
                if ($(".forma_pago .boton_redondeado").hasClass("active")) {
                    $(".forma_pago .boton_redondeado.active").removeClass("active");
                }
                $(this).addClass("active");
            }
        });

        $(".cerrar").on("click", function () {
            $(".modal_paypal").fadeOut();
            $(".modal_mercadopago").fadeOut();
            $('html, body').css('overflowY', 'auto');
            if ($(".paypal_").hasClass("active")) {
            } else {
                const url = '{{url('donar/create-compra')}}';
                axios.post(url, {
                    producto_id: {{$producto->id}},
                    payment_processor: 'mercadopago'
                }).then(function (response) {
                    console.log(response);
                    window.location = response.data.preferenceInit;
                }).catch(function (error) {
                    console.log(error);
                    alert('Ha habido un error, intenten más tarde');
                });
            }
        })


        $("#donar").on("click", function () {
            if ($(".paypal_").hasClass("active")) {
                $('html, body').css('overflowY', 'hidden');
            }
            if ($(".mercadopago_").hasClass("active")) {
                $('html, body').css('overflowY', 'hidden');
                $(".modal_mercadopago").fadeIn().delay(1000).fadeOut('fast', function () {
                    const url = '{{url('donar/create-compra')}}';
                    axios.post(url, {
                        producto_id: {{$producto->id}},
                        payment_processor: 'mercadopago'
                    }).then(function (response) {
                        console.log(response);
                        window.location = response.data.preferenceInit;
                    }).catch(function (error) {
                        console.log(error);
                        alert('Ha habido un error, intenten más tarde');
                    });
                });
            }
        })

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
