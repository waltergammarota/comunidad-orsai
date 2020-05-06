@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral ">
        <div class="info_per_left">
            <div class="breadcrumbs">
                <div id="links_back">
                    <a href="{{url('noticias')}}">Noticias</a>
                    <span>General</span>
                </div> 
            </div>
        </div>
        <div class="titulo">
            <h1 class="span_h1">{{$noticia->title}}</h1>
            <span class="autor gris span_block">{{$noticia->autor}} <span class="fecha_nota">{{$noticia->fecha_publicacion->format("d/m/Y")}}</span></span>
        </div>
        <div class="cuerpo_texto texto_noticia">
            <div class="img_noticia">
                @php
                    $image = $noticia->images()->first();
                    $imageUrl = 'storage/images/'.$image->name.".".$image->extension;
                @endphp
                <img src="{{url($imageUrl)}}" alt="{{$noticia->title}}">
            </div>
            <h2 class="subtitulo">{{$noticia->copete}}</h2>
            <div class="texto">{{$noticia->texto}}</div>
        </div>
        <div class="publicidad_noticia">
            <div></div>
        </div>
    </section>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection

