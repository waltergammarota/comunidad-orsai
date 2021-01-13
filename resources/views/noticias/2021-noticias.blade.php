@extends('2021-orsai-template')

@section('title', 'Novedades | Comunidad Orsai')
@section('description', 'Entrá a descubrir lo que la Fundación Orsai tiene entre manos.')

@section('content')
    <section class="resaltado_gris pd_20 pd_20_tp_bt">
        @foreach($noticias['noticias'] as $key => $noticia)
            @php
                $image = $noticia->images()->first();
                $imageUrl = "";
                if($image) {
                    $imageUrl = 'storage/images/'.$image->name.".".$image->extension;
                }
            @endphp
            <article class="contenedor blog_preview">
                @if($imageUrl)
                    <a href="{{url('novedades/'.$noticia->slug)}}" class="blog_preview_img">
                        <img src="{{url($imageUrl)}}" alt="{{$noticia->title}}">
                    </a>
                @endif
                <div class="contenedor_texto">
                    <div class="blog_preview_text">
                        <span class="fecha">{{$noticia->fecha_publicacion->format("d/m/Y")}}</span>
                        <a href="{{url('novedades/'.$noticia->slug)}}">
                            <h2>{{$noticia->title}}</h2>
                        </a>
                        <p>{!! $noticia->copete !!}</p>
                    </div>
                    <div class="blog_preview_social">
                        <div class="share_redes_gral">
                            <div class="resaltado_gris">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->full()}}"
                                   title="Compartir novedad"
                                   target="_blank"
                                   onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"
                                   rel="noopener noreferrer"><span class="icono icon-fb"></span></a>
                            </div>
                            <div class="resaltado_gris">
                                <a href="https://twitter.com/intent/tweet?text={{$noticia->title}}&amp;url={{url()->full()}}&amp;lang=es"
                                   title="Twittear novedad"
                                   onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"
                                   rel="noopener noreferrer"><span class="icono icon-tw"></span></a>
                            </div>
                            <div class="resaltado_gris">
                                <a href="whatsapp://send?text={{$noticia->title}} – {{url()->full()}}"
                                   data-action="share/whatsapp/share" title="Compartir novedad"
                                   rel="noopener noreferrer"><span class="icono icon-whatsapp"></span></a>
                            </div>
                        </div>
                        <div class="meta_novedad">
                            <span class="cant_comentarios">{{$noticia->comments}} comentarios &nbsp;|&nbsp; </span>
                            <span class="cant_comentarios">{{$noticia->respect}} me gusta</span>
                        </div>
                    </div>
                </div>
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
    </section>
@endsection

@section('footer')

@endsection
