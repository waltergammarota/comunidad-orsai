@extends('2021-orsai-template')

@section('title', 'Donar | Comunidad Orsai')
@section('description', 'Donar')

@section('content')

    <section class="resaltado_amarillo pd_tp_bt pd_20">
        <div class="contenedor  cs6_titulo_seccion_sm">
            <h2>Grandes proyectos, <strong>buenas apuestas</strong></h2>
            <p>Elegí cómo querés jugar, hacé tu donación y recibí fichas a cambio para apostar a los grandiosos
                proyectos de la Comunidad Orsai.</p>
        </div>
        <div class="center_div">
            <div class="contenedor mg_0 dis_flex ">
                @foreach($productos as $producto)
                    @if($producto->getPriceInUsd() >= 100)
                        <article class="card_style_6 card_style_6_black coins_10000">
                            <a href="{{url('donar/checkout?producto='.$producto->id)}}">
                                <p class="color_amarillo">{{$producto->name}}</p>
                                <h2 class="color_amarillo"><strong>{{$producto->fichas}}</strong> Fichas</h2>
                                <span class="icono color_amarillo">Usd {{$producto->getPriceInUsd()}}</span>
                                <div class="align_right">
                                    <span class="boton_redondeado resaltado_amarillo pd_35_lf_rg">Donar</span>
                                </div>
                            </a>
                        </article>
                    @else
                        {{--TODO VER CUANDO SE PONE NEGRA LA COSA--}}
                        <article class="card_style_6 coins_500">
                            <a href="{{url('donar/checkout?producto='.$producto->id)}}">
                                <p>{{$producto->name}}</p>
                                <h2><strong>{{$producto->fichas}}</strong> Fichas</h2>
                                <span class="icono">Usd {{$producto->getPriceInUsd()}}</span>
                                <div class="align_right">
                                    <span class="boton_redondeado resaltado_amarillo pd_35_lf_rg">Donar</span>
                                </div>
                            </a>
                        </article>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="contenedor pie_section">
            <p class="">Si querés saber más sobre la transparencia, apuestas y el sistema de fichas, <a href="#"
                                                                                                        class="subrayado ">leé
                    esta nota.</a></p>
        </div>
    </section>
    <section class="resaltado_gris pd_tp_bt">
        <div class="">
            <article class="card_style_1 ps_pago_01">
                <img src="{{url('recursos/donantes.svg')}}" class="icono" alt="boleteria">
                <span>Hacé tu donación y sumate a los</span>
                <div class="cant_soc_donantes ">
                    <span class="_barlow_text text_bold"> <span
                            class="_barlow_text text_bold num_donantes">{{$socios_donantes_qty}}</span> socios donantes</span>
                </div>
                <span>que apostamos a la <strong>Comunidad Orsai.</strong></span>
            </article>
        </div>
    </section>
@endsection


@section('footer')
@endsection
