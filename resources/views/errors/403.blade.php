@extends('2021-orsai-template')

@section('title', 'No autorizado | Comunidad Orsai')
@section('description', 'No autorizado')


@section('content')

<section class="resaltado_gris pd_20_tp_bt"> 
    <article class="cuerpo_card_perfil_publico">
        <div class="cuerpo_interna"> 
            <div class="perfil_publico">  
            <div class="titulo">
                <span class="codigo_error_light">¡Epa!</span>
                <h1 class="texto_italica span_h2">403</h1>
                <span class="span_h1_extra_sizetexto_italica span_h2">No tienes permiso para estar aquí</span><br/>
            </div>   
        </div>
    </article>
    <div class="contenedor cuerpo_card_perfil_publico">
        <div class="perfil_publico_btn">
    <div class="form_ctrl input_ ">
        <div class="grilla_form align_center">
            <div class="col_5">
                <div class="align_center">
                    <a class="boton_redondeado resaltado_amarillo pd_50_lf_rg width_100" href="{{url('/')}}">Volver al Inicio</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section> 
@endsection

@section('footer')

@endsection

