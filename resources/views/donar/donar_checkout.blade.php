@extends('2021-orsai-template')

@section('title', 'Donar | Comunidad Orsai')
@section('description', 'Donar') 

@section('content') 

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
                    <tr >
                        <td colspan="2">Detalle de tu donación:</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="items_detalle">
                                    <tr>
                                        <td>Paquete</td>
                                        <td>Juego tímido</td>
                                    </tr>
                                    <tr>
                                        <td>Cantidad de fichas</td>
                                        <td>500 </td>
                                    </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="items_detalle">
                                <tr class="_total">
                                    <td >Total
                                    </td>
                                    <td  class="text_bold">USD 10</td>
                                </tr>
                                <tr class="">
                                    <td  colspan="2" class="pie_tabla color_gris_claro">Es posible que se apliquen tarifas extra por tasas de cambio según país.</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="forma_pago">
                <span class="titulo text_bold">Seleccioná como querés abonar</span>
                <div class="grilla_form">
                    <div class="form_ctrl col_3">
                            <div class="align_center">
                                <div class="boton_redondeado btn_gris width_100 mercadopago_">
                                    <img src="{{url('recursos/mercadopago.svg')}}" alt="">
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
                        <span id="donar" class="boton_redondeado resaltado_amarillo text_bold width_100">Donar</span>
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
                <a href="#" class="boton_redondeado btn_transparente_negro text_bold pd_50_lf_rg ">Volver</a>
            </div>
        </div>
    </div>
</section>

<div class="modal_paypal">
    <div class="contenedor">
        <div class="cont_modal_blanco">
            <div class="cerrar">
                <span>X</span>
            </div>
            <div class="intro_modal">
                <img src="{{url('recursos/modal_paypal.svg')}}" alt="">
                <span>Te redireccionaremos al sitio de <strong>PayPal</strong> donde podrás elegir uno de los medios de pago debajo.</span>
            </div> 
        </div>
    </div>
</div>

<div class="modal_mercadopago">
    <div class="contenedor">
        <div class="cont_modal_blanco">
            <div class="cerrar">
                <span>X</span>
            </div>
            <div class="intro_modal">
                <img src="{{url('recursos/modal_mercadolibre.svg')}}" alt="">
                <span>Te redireccionaremos al sitio de <strong>PayPal</strong> donde podrás elegir uno de los medios de pago debajo.</span>
            </div> 
        </div>
    </div>
</div>
@endsection


@section('footer') 

<script>
    $(".forma_pago .boton_redondeado").on("click", function(){
        if ($(this).hasClass("active")){
            $(this).removeClass("active");
        }else{
            if ($(".forma_pago .boton_redondeado").hasClass("active")){
                $(".forma_pago .boton_redondeado.active").removeClass("active");
            }
            $(this).addClass("active");
        }
    })
    
    $(".cerrar").on("click", function(){
        $(".modal_paypal").fadeOut();
        $(".modal_mercadopago").fadeOut();
        $('html, body').css('overflowY', 'auto'); 
    })
    $("#donar").on("click", function(){
        if($(".paypal_").hasClass("active")){
            $('html, body').css('overflowY', 'hidden'); 
            $(".modal_paypal").fadeIn();
        }
        if($(".mercadopago_").hasClass("active")){
            $('html, body').css('overflowY', 'hidden'); 
            $(".modal_mercadopago").fadeIn();
        }
    })
    
    </script>
@endsection
