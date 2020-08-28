@extends('orsai-template')

@section('title', 'Home | Comunidad Orsai')
@section('description', 'Página de Inicio')

@section('content')
    <section id="intro" class="contenedor home">
        <div>
            <h1>La Fundación Orsai
                <span class="span_block text_regular">patea el tablero</span>
            </h1>
        </div>
        <div>
            <p class="index_bajada">
                Desde hoy, apostamos a contar buenas historias.
                <span class="span_block">
					<a href="{{url('fundacion-orsai')}}" class="subrayado resaltado_amarillo">(Quiero saber más)</a>.
				</span>
            </p>
        </div>
    </section>

    <section class="contenedor articles_adduser">
        <article>
            <div>
                <h2 class="titulo">Quiero ser parte
                    <span class="span_block">del juego</span>
                </h2>
            </div>
            <div>
                <p class="subtitulo subrayado">Bien corto y al pie</p>
                <ol>
                    <li>Completá la membresia desde
                        <a href="{{url('registrarse')}}" class="subrayado resaltado_amarillo">este formulario.</a>
                    </li>
                    <li>Sumá <a href="{{url('donaciones')}}"
                                class="subrayado resaltado_amarillo">fichas</a><sup>(1)</sup> para valorar proyectos.
                    </li>
                    <li>Apostá a la narrativa en español.</li>
                </ol>
            </div>
            <div class="nota">
                <p>
                    <sup>(1)</sup>
                    Para concursar necesitás fichas que también te permiten valorar otras propuestas.
                    <a href="{{url('donaciones')}}" class="subrayado resaltado_amarillo">Ver más acá</a>.
                </p>
            </div>
        </article>
        <article>
            <div>
                <h2 class="titulo">Concurso
                    <span class="span_block">de logo</span>
                </h2>
            </div>
            <div>
                <p class="subtitulo subrayado">(Para diseñadores)</p>
                <ol>
                    <li>Revisá las
                        <a href="{{url('bases-concurso')}}" class="subrayado resaltado_amarillo">bases y condiciones</a>
                        del concurso.
                    </li>
                    <li>Completá la membresia desde
                        <a href="{{url('registrarse')}}" class="subrayado resaltado_amarillo">este formulario.</a>
                    <li>Proponé un logotipo para la Fundación.</li>
                    <li>Difundir la propuesta en las redes.</li>
                </ol>
            </div>
        </article>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    </div>


    <!-- historia -->

    <div class="fondo_blanco">
        <section class="contenedor articles_historia">
            <div class="titulo">
                <h2>¿Como llegamos
                    <a href="{{url('fundacion-orsai')}}" class="subrayado">hasta acá?</a>
                </h2>
            </div>
            <div class="contenedor_gral_hist">
                <div class="contenedor_art_hist" style="left: 0px;">
                    <div class="owl-carousel items">
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Septiembre, 2003</span>
                                    <h3>Nace el blog Orsai con cuentos semestrales</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Noviembre, 2005</span>
                                    <h3>Surge el primer libro en español surgido de un blog.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Julio, 2007</span>
                                    <h3>Aparecen seis libros más de Orsai en diversos idiomas.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Septiembre, 2010</span>
                                    <h3>Nace la Editorial Orsai, con sedes en Buenos Aires y Barcelona.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Enero, 2011</span>
                                    <h3>Nace la primera temporada de la revista Orsai, sin publicidad.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Junio, 2011</span>
                                    <h3>Nace la pizzería Orsai en Barcelona.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Julio, 2012</span>
                                    <h3>Nace el bar Orsai en Buenos Aires.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Agosto, 2013</span>
                                    <h3>Aparece la Casa de Estudios Orsai en Buenos Aires.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Febrero, 2014</span>
                                    <h3>Se publica la revista infantil Bonsai.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Diciembre, 2015</span>
                                    <h3>La Editorial Orsai produce eventos culturales.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Enero, 2017</span>
                                    <h3>Nace la segunda temporada de la revista Orsai.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">Enero, 2019</span>
                                    <h3>Aparecen los medios Orsai Digital y Podcast Orsai.</h3>
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="{{url('historia')}}">
                                <div>
                                    <span class="subrayado">2020</span>
                                    <h3>Nace la Fundación Orsai.</h3>
                                </div>
                            </a>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <div class="contenedor mg_100 number_page">
            <span>2</span>
        </div>
    </div>
    <!-- novedades -->

    <div class="fondo_blanco">
        <section class="contenedor articles_novedades">
            <div class="titulo">
                <h2>
                    <a href="{{url('novedades')}}" class="subrayado">Novedades</a>
                </h2>
            </div>
            <div class="contenedor_gral_hist">
                @foreach($novedades as $novedad)
                    <article class="articles_column">
                        <a href="{{url('novedades/'.$novedad->slug)}}">
                            <div class="cuerpo_texto">
                                <div>
                                    <h2 class="titulo_noticias">{{$novedad->title}}</h2>
                                    <span class="text_bold subrayado resaltado_amarillo">Ver más</span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </section>
        <div class="contenedor mg_100 number_page">
            <span>3</span>
        </div>
        @endsection

        @section('footer')
            <script src="owlcarousel/js/owl.carousel.js"></script>
            <script>
                $(document).ready(function () {
                    $(".owl-carousel").owlCarousel();
                });
                var owl = $('.owl-carousel');
                owl.owlCarousel({
                    loop: false,
                    margin: 5,
                    nav: true,
                    dots: false,
                    autoWidth: true,
                    autoplay: false,
                    autoplayTimeout: 2000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        520: {
                            items: 2
                        },
                        600: {
                            items: 3
                        },
                        800: {
                            items: 3
                        },
                        1000: {
                            items: 3
                        }
                    }
                });

            </script>
@endsection
