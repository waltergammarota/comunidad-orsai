@extends('orsai-template')

@section('title', 'Noticias')

@section('content')
    <section id="intro" class="contenedor intro_gral noticias ">
        <div class="titulo">
            <h1 class="span_h1">Novedades</h1>
        </div>

        <div class="cont_noticias">
            @foreach($noticias['noticias'] as $key => $noticia)
                @if($key % 2 == 0 && $key > 0)
                    <div class="publicidad_noticias">
                        <div></div>
                    </div>
                    <div class="line_dashed"></div>
                @endif
                <article>
                    <a href="{{url('novedades/'.$noticia->slug)}}">
                        <div class="cuerpo_texto">
                            <div>
                                <h2 class="titulo_noticias">{{$noticia->title}}</h2>
                                <p>{{Str::limit($noticia->copete, 100)}}</p>
                                <span class="text_bold subrayado resaltado_amarillo">Ver más</span>
                            </div>
                            @php
                                $image = $noticia->images()->first();
                                $imageUrl = "";
                                if($image) {
                                $imageUrl = 'storage/images/'.$image->name.".".$image->extension;
                                }
                            @endphp
                            @if($imageUrl)
                                <div class="img_noticia">
                                    <img src="{{url($imageUrl)}}" alt="Imagen Noticia">
                                </div>
                            @endif
                        </div>
                    </a>
                </article>
                <div class="line_dashed"></div>

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
