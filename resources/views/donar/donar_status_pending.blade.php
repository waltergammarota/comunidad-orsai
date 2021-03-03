@extends('2021-orsai-template')

@section('title', 'Donar | Comunidad Orsai')
@section('description', 'Donar')

@section('content')

    <section class="resaltado_amarillo pd_tp_bt">
        <article class="contenedor">
            <div class="cuerpo_card_perfil_publico ps_pago_02 ps_pago_03 ps_pago_04">
                <div class="cuerpo_interna ">
                    <div class="">
                        <div class="titulo">
                            <h1 class="text_regular _barlow_text">TU DONACIÓN
                                <strong>{{$details['payment_id']}}</strong> ESTÁ PENDIENTE.</h1>
                            <div>
                                <span class="">Todavía no recibimos tu donación de <strong>{{$producto->fichas}}</strong> fichas. Podés consultar el estado de tu operación en la plataforma de pago donde hiciste tu donación.</span>
                            </div>
                        </div>
                        <div class="form_ctrl input_  pd_20_tp">
                            <div class="align_center"> 
                                <a href="{{url('panel')}}" class="boton_redondeado resaltado_amarillo text_bold width_100">Entendido</a>
                                <span class="form_footer_term text_center color_gris">¿Necesitás ayuda? <a href="{{url("contacto")}}" class="subrayado">Escribinos</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection


@section('footer')
@endsection
