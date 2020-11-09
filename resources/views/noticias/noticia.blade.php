@extends('orsai-template')

@section('title', ucfirst($noticia->title))
@section('description', $noticia->title)

@section('coral')
    <meta name="title" content="{{ $noticia->title }}"/>
    <meta name="description" content="{{ $noticia->copete }}"/>
    <meta name="author" content="{{ $noticia->autor }}"/>
    <meta name="publication_date" content="{{ $noticia->created_at }}"/>
    <link rel="canonical" href="{{url()->full()}}"/>
@endsection

@section('content')
    <section id="novedad" class="contenedor intro_gral ">
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
                <div class="autor gris span_block">{{$noticia->autor}} <span class="fecha_nota">{{$noticia->fecha_publicacion->format("d/m/Y")}}</span></div>
                <div class="share-social">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->full()}}" title="Compartir novedad" target="_blank" class="share-fb" onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"><i class="icon-facebook"></i></a>
                    <a href="https://twitter.com/intent/tweet?text={{$noticia->title}}&amp;url={{url()->full()}}&amp;lang=es" title="Twittear novedad" class="share-tw" onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"><i class="icon-twitter"></i></a>
                    <a href="whatsapp://send?text={{$noticia->title}} – {{url()->full()}}" data-action="share/whatsapp/share" title="Compartir novedad" class="share-wa"><i class="icon-whatsapp"></i></a>
                </div>
            </div>
            @php
                $image = $noticia->images()->first();
                $imageUrl = "";
                if($image) {
                $imageUrl = 'storage/images/'.$image->name.".".$image->extension;
                }
            @endphp
            <div class="img_noticia">
                @if($imageUrl)
                    <img src="{{url($imageUrl)}}" alt="{{$noticia->title}}">
                @endif
            </div>
            <div class="copete">{!! $noticia->copete !!}</div>
            <div class="texto">{!! $noticia->texto !!}</div>

             @if(Auth::check())
                <div id="coral_thread"></div>
            @else
                <div id="coral_thread_anonimo">
                    <p>La Comunidad Orsai es 62% más divertida si te logueaste.</p>
                    <a href="{{url('ingresar')}}">Ingresar</a>
                </div>
            @endif
        </div>

    </section>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')
    @if(Auth::check())
        <script type="text/javascript">
            (function () {
                var d = document, s = d.createElement('script');
                s.src = '{{env('CORAL_URL')}}assets/js/embed.js';
                s.async = false;
                s.defer = true;
                s.onload = function () {
                    Coral.createStreamEmbed({
                        id: "coral_thread",
                        autoRender: true,
                        rootURL: '{{env('CORAL_URL')}}',
                        storyID: '{{$noticia->slug}}',
                        storyURL: '{{url()->current()}}',
                        accessToken: '{{$coral_token}}'
                    });
                };
                (d.head || d.body).appendChild(s);
            })();
        </script>  
    @endif
@endsection
