@extends('2021-orsai-template')

@section('title', 'Página no encontrada | Comunidad Orsai')
@section('description', 'No encontramos la página que estas buscando.')


@section('content')

<section class="resaltado_gris pd_20_tp_bt"> 
    <article class="cuerpo_card_perfil_publico">
        <div class="cuerpo_interna"> 
            <div class="perfil_publico">  
            <div class="titulo">
                <span class="codigo_error_light">¡Uh!</span>
                <h1 class="texto_italica span_h2">404</h1>
                <span class="span_h1_extra_sizetexto_italica span_h2">No encontramos la página que estás
                    buscando.</span><br/>
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

