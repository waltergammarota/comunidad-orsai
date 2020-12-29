@extends('2021-orsai-template')

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
<section class="resaltado_gris pd_20 pd_20_tp_bt">
    <article class="contenedor_interna blog_articulo_completo">
            <div class="cuerpo_interna">
            <div class="">
                <span class="fecha">{{$noticia->fecha_publicacion->format("d/m/Y")}}</span>
                    <h1 class="titulo_blog">{{$noticia->title}}</h1>
                    <span class="autor_texto">{{$noticia->autor}}</span>
                    <div class="blog_social">
                        <div class="share_redes_gral">
                            <div class="resaltado_gris">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->full()}}" title="Compartir novedad"
                               target="_blank" onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;" rel="noopener noreferrer"><span class="icono icon-fb"></span></a>
                            </div>
                            <div class="resaltado_gris">
                                <a href="https://twitter.com/intent/tweet?text={{$noticia->title}}&amp;url={{url()->full()}}&amp;lang=es"
                               title="Twittear novedad" onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;" rel="noopener noreferrer"><span class="icono icon-tw"></span></a>
                            </div>
                            <div class="resaltado_gris">
                                <a href="whatsapp://send?text={{$noticia->title}} – {{url()->full()}}"
                               data-action="share/whatsapp/share" title="Compartir novedad" rel="noopener noreferrer"><span class="icono icon-whatsapp"></span></a>
                            </div>
                        </div>
                      {{--   <div>
                            <span class="cant_comentarios">500 comentarios</span>
                        </div> --}}
                    </div> 
            </div> 
            @php
                $image = $noticia->images()->first();
                $imageUrl = "";
                if($image) {
                $imageUrl = 'storage/images/'.$image->name.".".$image->extension;
                }
            @endphp
            @if($imageUrl)
            <div class="blog_img">
                    <img src="{{url($imageUrl)}}" alt="{{$noticia->title}}">
            </div>
            @endif
            <div class="blog_copete">
                <p class="text_bold intro p_no_mg">{!! $noticia->copete !!}</p>
            </div>
            <div class="blog_texto"> 
                {!! $noticia->texto !!}
            </div>{{-- 
            <div class="blog_cta">
                <h2 class="titulo_blog">FORMULARIO PARA SACAR TURNO(*)</h2>
                <a href="#" class="boton_redondeado resaltado_amarillo" >PayPal o Tarjeta de Crédito Internacional</a>
                <a href="#" class="boton_redondeado resaltado_amarillo" >Transferencia bancaria en dólares para Argentina</a>
                <p>
                (*) Si tienen pensado ser «productores asociados», métanse ya en lista de espera. Como es obvio que este proyecto va a tener mucha repercusión y va a haber más productores asociados que fichas disponibles al 1 de enero (porque los conozco y sé que son muy manija) abrimos desde hoy un formulario para reservar turno.
                </p>
            </div> --}}
        </div>
    </article>
    <article class="contenedor_interna">
    @if(Auth::check()) 
        <div id="coral_thread"></div>
    @else
        <div id="coral_thread_anonimo">
            <p>La Comunidad Orsai es 62% más divertida si te logueaste.</p>
            <a href="{{url('ingresar')}}">Ingresar</a>
        </div>
    @endif
    </article>
</section> 
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
                        storyID: '{{$noticia->coral_id}}',
                        storyURL: '{{url()->current()}}',
                        accessToken: '{{$coral_token}}'
                    });
                };
                (d.head || d.body).appendChild(s);
            })();
        </script>
    @endif
@endsection
