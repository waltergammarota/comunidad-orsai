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
                                <span class="">¿Todavía querés tener <strong>{{$producto->fichas}}</strong> fichas en tu cuenta? </span>
                                <span
                                    class="">Asegurate de completar tus datos correctamente para hacer tu donación.</span>

                            </div>
                        </div>
                        <div class="form_ctrl input_  pd_20_tp">
                            <div class="align_center">
                                <a href="{{url('donar')}}" class="color_gris subrayado block_item">Ahora no</a>
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