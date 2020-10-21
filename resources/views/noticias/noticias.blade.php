@extends('orsai-template')

@section('title', 'Novedades | Comunidad Orsai')
@section('description', 'Entrá a descubrir lo que la Fundación Orsai tiene entre manos.')

@section('content')
    <section id="intro" class="contenedor intro_gral noticias ">

        <div class="cont_noticias">
            @foreach($noticias['noticias'] as $key => $noticia)

                @php
                    $image = $noticia->images()->first();
                    $imageUrl = "";
                    if($image) {
                        $imageUrl = 'storage/images/'.$image->name.".".$image->extension;
                    }
                @endphp

                <article class="noticia @if($imageUrl) noticia_image @endif noticia_first" >
                    <a href="{{url('novedades/'.$noticia->slug)}}">
                        @if($imageUrl)
                            <div class="img_noticia">
                                <img src="{{url($imageUrl)}}" alt="Imagen Noticia">
                            </div>
                        @endif
                        <div class="cuerpo_texto">
                                <h2 class="titulo_noticias">{{$noticia->title}}</h2>
                                <p>{!! $noticia->copete !!}</p>
                                <span class="date_noticia">{{$noticia->fecha_publicacion->format("d/m/Y")}}</span>
                        </div>
                    </a>
                </article>
            @endforeach

            <div id="controladores_participantes">
                @if($noticias['previous'] > 0)
                    <div id="bt_left" class="desactivado">
                        <a href="{{url('noticias/?pagina='.($noticias['previous']))}}"><span
                                class="icon-left"></span></a>
                    </div>
                @endif
                @if($noticias['next'] > $noticias['current_page'])
                    <div id="bt_right">
                        <a href="{{url('noticias/?pagina='.($noticias['next']))}}"><span class="icon-right"></span></a>
                    </div>
                    <div id="paginas">
                        <span>{{$noticias['next']}}</span>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection
