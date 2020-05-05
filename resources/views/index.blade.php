@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor home">
        <div>
            <h1>La Fundación Orsai
                <span class="span_block text_regular">patea el tablero</span>
            </h1>
        </div>
        <div>
            <p>
                Desde hoy, apostamos a contar buenas historias.
                <span class="span_block">
							<a href="#" class="subrayado resaltado_amarillo">(Quiero saber más).</a>
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
                        <a href="#" class="subrayado resaltado_amarillo">este formulario.</a>
                    </li>
                    <li>Suma fichas para valorar proyectos.</li>
                    <li>Apostá a la narrativa en español.</li>
                </ol>
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
                    <li>Completá la membresia desde
                        <a href="#" class="subrayado resaltado_amarillo">este formulario.</a>
                    </li>
                    <li>Revisá las
                        <a href="#" class="subrayado resaltado_amarillo">bases y condiciones</a>
                        del concurso.</li>
                    <li>
                        <a href="#" class="subrayado resaltado_amarillo">Proponé un logotipo</a>
                        para la Fundación
                        <sup>(1)</sup>.</li>
                    <li>Difundir la propuesta en las redes.</li>
                </ol>
            </div>
            <div class="nota">
                <p>
                    <sup>(1)</sup>
                    Para concursar necesitás fichas que tambien te permiten valorar otras propuestas.
                    <a href="#" class="subrayado resaltado_amarillo">Ver más acá.</a>
                </p>
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
                    <a href="#" class="subrayado">hasta acá?</a>
                </h2>
            </div>
            <div class="contenedor_gral_hist">
                <div class="contenedor_art_hist" style="left: 0px;">
                    <div class="owl-carousel items">
                        <article>
                            <a href="#">
                                <div>
                                    <span class="subrayado">Septiembre, 2003</span>
                                    <h3>Nace el blog Orsai con cuentos semanales.</h3>
                                    <!-- <p>En un garage de Sillicon Valley.</p> -->
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="#">
                                <div>
                                    <span class="subrayado">Noviembre, 2005</span>
                                    <h3>Surge el primer libro en español surgido de un blog.</h3>
                                    <!-- <p>A todo color.</p> -->
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="#">
                                <div>
                                    <span class="subrayado">Julio, 2007</span>
                                    <h3>Aparecen seis libros más de Orsai en diversos idiomas.</h3>
                                    <!-- <p>Las calles de San Telmo ya no serán las mismas.</p> -->
                                </div>
                            </a>
                        </article>
                        <article>
                            <a href="#">
                                <div>
                                    <!-- falta este texto -->
                                    <span class="subrayado">2011</span>
                                    <h3>Sale Revista Bonsai</h3>
                                    <p>Los más chicos tambien leen.</p>
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
