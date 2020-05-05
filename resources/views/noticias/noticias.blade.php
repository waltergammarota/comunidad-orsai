@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral noticias ">
        <div class="titulo">
            <h1 class="span_h1">Noticias</h1>
        </div>

        <div class="cont_noticias">
            @foreach($noticias['noticias'] as $key => $noticia)
                <article>
                    <div class="cuerpo_texto">
                        <div>
                            <h2 class="titulo_noticias">{{$noticia->title}}</h2>
                            <span class="autor gris span_block">{{$noticia->autor}} <span
                                    class="fecha_nota">{{$noticia->fecha_publicacion}}</span></span>
                            <p>{{Str::limit($noticia->copete, 100)}}</p>
                            <a class="text_bold subrayado resaltado_amarillo"
                               href="{{url('noticias/'.$noticia->slug)}}">Leer
                                noticia</a>
                        </div>
                        <div class="img_noticia">
                            @php
                                $image = $noticia->images()->first();
                                $imageUrl = 'storage/images/'.$image->name.".".$image->extension;
                            @endphp
                            <img src="{{url($imageUrl)}}" alt="Imagen Noticia">
                        </div>
                    </div>
                </article>
                <div class="line_dashed"></div>
                @if($key % 2 == 0 && $key > 0)
                    <div class="publicidad_noticias">
                        <div></div>
                    </div>
                    <div class="line_dashed"></div>
                @endif
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
                        <a href="{{url('noticias/?pagina='.($noticias['next']))}}"><span
                                class="icon-right"></span></a>
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

