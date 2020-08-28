@extends('orsai-template')

@section('title', ucfirst($noticia->title))
@section('description', $noticia->copete)

@section('content')
<section id="intro" class="contenedor intro_gral ">
    <div class="info_per_breadcrumb">
        <div class="breadcrumbs">
            <div id="links_back">
                <a href="{{url('novedades')}}">Novedades</a>
                <span>General</span>
            </div>
        </div>
    </div>
    <div class="cuerpo_texto texto_noticia">
        <div class="titulo">
            <h1 class="span_h1">{{$noticia->title}}</h1>
            <span class="autor gris span_block">{{$noticia->autor}} <span
                    class="fecha_nota">{{$noticia->fecha_publicacion->format("d/m/Y")}}</span></span>
        </div>
        @php
        $image = $noticia->images()->first();
        $imageUrl = "";
        if($image) {
        $imageUrl = 'storage/images/'.$image->name.".".$image->extension;
        }
        @endphp
        <div class="img_noticia">
            @if($imageUrl)title
            <img src="{{url($imageUrl)}}" alt="{{$noticia->title}}">
            @endif
        </div>
        <h2 class="subtitulo">{{$noticia->copete}}</h2>
        <div class="texto">{!! $noticia->texto !!}</div>
    </div> 
</section>

<div class="contenedor mg_100 number_page">
    <span>1</span>
</div>
@endsection

@section('footer')

@endsection
