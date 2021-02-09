@extends('2021-orsai-template')

@section('title', 'Donar | Comunidad Orsai')
@section('description', 'Donar') 

@section('content') 

<section class="resaltado_amarillo pd_tp_bt pd_20">
    <div class="contenedor  cs6_titulo_seccion_sm">
        <h2>Grandes proyectos, <strong>buenas apuestas</strong></h2>
        <p>Elegí cómo querés jugar, hacé tu donación y recibí fichas a cambio para apostar a los grandiosos proyectos de la Comunidad Orsai.</p>
    </div>
	<div class="center_div">
        <div class="contenedor mg_0 dis_flex ">
            <article class="card_style_6 coins_500">
                <a href="#">
                    <p>Juego tímido</p>
                    <h2><strong>500</strong> Fichas</h2>
                    <span class="icono">Usd 10</span>
                    <div class="align_right">
                        <span class="boton_redondeado resaltado_amarillo pd_35_lf_rg">Donar</span>
                    </div>
                </a>
            </article>
            <article class="card_style_6 coins_1200">
                <a href="#">
                    <p>Juego atrevido</p>
                    <h2><strong>1200</strong> Fichas</h2>
                    <span class="icono">Usd 20</span>
                <div class="align_right">
                    <span class="boton_redondeado resaltado_amarillo pd_35_lf_rg">Donar</span>
                </div>
                </a>
            </article>
            <article class="card_style_6 coins_2000">
                <a href="#">
                    <p>Juego arriesgado</p>
                    <h2><strong>2000</strong> Fichas</h2>
                    <span class="icono">Usd 30</span>
                    <div class="align_right">
                        <span class="boton_redondeado resaltado_amarillo pd_35_lf_rg">Donar</span>
                    </div>
                </a>
            </article>
            <article class="card_style_6 coins_3500">
                <a href="#">
                    <p>Juego valiente</p>
                    <h2><strong>3500</strong> Fichas</h2>
                    <span class="icono">Usd 50</span>
                    <div class="align_right">
                        <span class="boton_redondeado resaltado_amarillo pd_35_lf_rg">Donar</span>
                    </div>
                </a>
            </article>
            <article class="card_style_6 coins_6500">
                <a href="#">
                    <p>Juego corajudo</p>
                    <h2><strong>6500</strong> Fichas</h2>
                    <span class="icono">Usd 75</span>
                    <div class="align_right">
                        <span class="boton_redondeado resaltado_amarillo pd_35_lf_rg">Donar</span>
                    </div>
                </a>
            </article>
            <article class="card_style_6 card_style_6_black coins_10000">
                <a href="#">
                    <p class="color_amarillo">Juego compulsivo</p>
                    <h2 class="color_amarillo"><strong>10000</strong> Fichas</h2>
                    <span class="icono color_amarillo">Usd 100</span>
                    <div class="align_right">
                        <span class="boton_redondeado resaltado_amarillo pd_35_lf_rg">Donar</span>
                    </div>
                </a>
            </article>
	    </div>
    </div>
    <div class="contenedor pie_section">
        <p class="">Si querés saber más sobre la transparencia, apuestas y el sistema de fichas, <a href="#" class="subrayado ">leé esta nota.</a></p>
    </div>
</section>
<section class="resaltado_gris pd_tp_bt">
    <div class="">
        <article class="card_style_1 ps_pago_01">
            <img src="{{url('recursos/donantes.svg')}}" class="icono" alt="boleteria">
            <span>Hacé tu donación y sumate a los</span>
            <div class="cant_soc_donantes ">
                <span class="_barlow_text text_bold"> <span class="_barlow_text text_bold num_donantes">2.446</span> socios donantes</span>
            </div>
            <span>que apostamos a la <strong>Comunidad Orsai.</strong></span>
        </article>
    </div>
</section>
@endsection


@section('footer') 
@endsection
