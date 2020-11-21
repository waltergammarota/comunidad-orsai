@extends('orsai-template')

@section('title', 'Historia en Fundación Orsai | Comunidad Orsai')
@section('description','Historia en Fundación Orsai | Comunidad Orsai')


@section('content')
    <section id="page" class="contenedor intro_gral ">
        <div class="cuerpo_texto">
            <div class="titulo tit_term">
                <h1 class="span_h1">Linea de Tiempo Orsai</h1>
            </div> 
            <article id="linea_interna" >
                <div class="">
                    <div class="tiempo_tabla">
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Septiembre, <span class="span_block">2003</span></span>
                            </div>
                            <div>
                                <span>Nace el blog Orsai con cuentos semestrales</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Noviembre, <span class="span_block">2005</span></span>
                            </div>
                            <div>
                                <span>Surge el primer libro en español surgido de un blog.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Julio, <span class="span_block">2007</span></span>
                            </div>
                            <div>
                                <span>Aparecen seis libros más de Orsai en diversos idiomas.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Septiembre, <span class="span_block">2010</span></span>
                            </div>
                            <div>
                                <span>Nace la Editorial Orsai, con sedes en Buenos Aires y Barcelona.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Enero, <span class="span_block">2011</span></span>
                            </div>
                            <div>
                                <span>Nace la primera temporada de la revista Orsai, sin publicidad.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Junio, <span class="span_block">2011</span></span>
                            </div>
                            <div>
                                <span>Nace la pizzería Orsai en Barcelona.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Julio, <span class="span_block">2012</span></span>
                            </div>
                            <div>
                                <span>Nace el bar Orsai en Buenos Aires.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Agosto, <span class="span_block">2013</span></span>
                            </div>
                            <div>
                                <span>Aparece la Casa de Estudios Orsai en Buenos Aires.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Febrero, <span class="span_block">2014</span></span>
                            </div>
                            <div>
                                <span>Se publica la revista infantil Bonsai.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Diciembre, <span class="span_block">2015</span></span>
                            </div>
                            <div>
                                <span>La Editorial Orsai produce eventos culturales.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Enero, <span class="span_block">2017</span></span>
                            </div>
                            <div>
                                <span>Nace la segunda temporada de la revista Orsai.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span>Enero, <span class="span_block">2019</span></span>
                            </div>
                            <div>
                                <span>Aparecen los medios Orsai Digital y Podcast Orsai.</span>
                            </div>
                        </div>
                        <div class="tiempo_fila elemento_invisible">
                            <div>
                                <span><span class="span_block">2020</span></span>
                            </div>
                            <div>
                                <span>Nace la Fundación Orsai.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    </div>
    <div class="icono_up">
        <span class="icon-angle-up"></span>
    </div>
@endsection

@section('footer')
    <script>
        $('.icono_up').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 1000);
            return false;
        });
        $(window).scroll(function(){
            if ($(window).scrollTop() >= 300){
                $( ".icono_up" ).fadeIn();
            }else{
                $( ".icono_up" ).fadeOut();
            }
            if( $(window).width() > 991 ){
                if ($(this).scrollTop() > 140) {
                    $('.menu_lateral_izq ul').addClass('fixed');
                } else {
                    $('.menu_lateral_izq ul').removeClass('fixed');
                }
            }

        });
        $( window ).resize(function() {
            console.log($(window).scrollTop())
            if( $(window).width() > 991 ){
                if ($(window).scrollTop() > 140) {
                    $('.menu_lateral_izq ul').addClass('fixed');
                } else {
                    $('.menu_lateral_izq ul').removeClass('fixed');
                }
            }else{
                $('.menu_lateral_izq ul').removeClass('fixed');
            }
        });

        $(document).ready(function(){
            $(this).scrollTop(0);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(1)").removeClass("elemento_invisible");
            }, 400);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(1)").addClass("animated bounceInLeft");
            }, 400);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(2)").removeClass("elemento_invisible");
            }, 800);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(2)").addClass("animated bounceInLeft");
            }, 800);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(3)").removeClass("elemento_invisible");
            }, 1000);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(3)").addClass("animated bounceInLeft");
            }, 1000);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(4)").removeClass("elemento_invisible");
            }, 1200);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(4)").addClass("animated bounceInLeft");
            }, 1200);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(5)").removeClass("elemento_invisible");
            }, 1400);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(5)").addClass("animated bounceInLeft");
            }, 1400);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(6)").removeClass("elemento_invisible");
            }, 1600);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(6)").addClass("animated bounceInLeft");
            }, 1600);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(7)").removeClass("elemento_invisible");
            }, 1800);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(7)").addClass("animated bounceInLeft");
            }, 1800);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(8)").removeClass("elemento_invisible");
            }, 2000);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(8)").addClass("animated bounceInLeft");
            }, 2000);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(9)").removeClass("elemento_invisible");
            }, 2200);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(9)").addClass("animated bounceInLeft");
            }, 2200);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(10)").removeClass("elemento_invisible");
            }, 2400);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(10)").addClass("animated bounceInLeft");
            }, 2400);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(11)").removeClass("elemento_invisible");
            }, 2600);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(11)").addClass("animated bounceInLeft");
            }, 2600);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(12)").removeClass("elemento_invisible");
            }, 2800);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(12)").addClass("animated bounceInLeft");
            }, 2800);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(13)").removeClass("elemento_invisible");
            }, 3000);
            setTimeout(function() {
                $(".tiempo_tabla .tiempo_fila:nth-child(13)").addClass("animated bounceInLeft");
            }, 3000);


        });
        $(window).scroll(function() {
            var scroll_pos=$(window).scrollTop();
            if( $(window).width() < 370 ){

                if (scroll_pos >= 0 && scroll_pos <= 250){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(1) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 250 && scroll_pos <= 460){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(2) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 460 && scroll_pos <= 628){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(3) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 628 && scroll_pos <= 792){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(4) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 792 && scroll_pos <= 996){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(5) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 996 && scroll_pos <= 1191){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(6) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1191 && scroll_pos <= 1323){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(7) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 1323 && scroll_pos <= 1511){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(8) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 1511 && scroll_pos <= 1661){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(9) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1661 && scroll_pos <= 1805){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(10) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1805 && scroll_pos <= 1975){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(11) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1975 && scroll_pos <= 2137){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(12) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 2137){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(13)").removeClass("animated bounceInLeft");
                    $(".tiempo_tabla .tiempo_fila:nth-child(13)").addClass("animated shake");
                }


            }else if( $(window).width() >= 370 && $(window).width() < 485){

                if (scroll_pos >= 0 && scroll_pos <= 130){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(1) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 130 && scroll_pos <= 236){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(2) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 236 && scroll_pos <= 304){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(3) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 304 && scroll_pos <= 388){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(4) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 388 && scroll_pos <= 550){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(5) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 550 && scroll_pos <= 717){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(6) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 717 && scroll_pos <= 832){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(7) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 832 && scroll_pos <= 980){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(8) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 980 && scroll_pos <= 1183){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(9) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1183 && scroll_pos <= 1283){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(10) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1283 && scroll_pos <= 1383){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(11) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1383 && scroll_pos <= 1483){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(12) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 1483){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(13)").removeClass("animated bounceInLeft");
                    $(".tiempo_tabla .tiempo_fila:nth-child(13)").addClass("animated shake");

                }

            }else if( $(window).width() >= 485 && $(window).width() < 579){

                if (scroll_pos >= 0 && scroll_pos <= 130){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(1) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 130 && scroll_pos <= 236){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(2) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 236 && scroll_pos <= 304){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(3) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 304 && scroll_pos <= 388){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(4) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 388 && scroll_pos <= 550){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(5) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 550 && scroll_pos <= 717){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(6) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 717 && scroll_pos <= 832){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(7) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 832 && scroll_pos <= 980){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(8) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 980 && scroll_pos <= 1083){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(9) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1083 && scroll_pos <= 1140){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(10) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1140 && scroll_pos <= 1200){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(11) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1200 && scroll_pos <= 1280){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(12) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 1280){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(13)").removeClass("animated bounceInLeft");
                    $(".tiempo_tabla .tiempo_fila:nth-child(13)").addClass("animated shake");

                }

            }else if( $(window).width() >= 579){


                if (scroll_pos >= 0 && scroll_pos <= 130){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(1) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 130 && scroll_pos <= 236){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(2) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 236 && scroll_pos <= 304){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(3) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 304 && scroll_pos <= 388){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(4) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 388 && scroll_pos <= 550){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(5) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 550 && scroll_pos <= 717){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(6) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 717 && scroll_pos <= 832){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(7) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 832 && scroll_pos <= 980){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(8) > div:nth-child(2)").addClass('activo');

                }
                if (scroll_pos >= 980 && scroll_pos <= 1083){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(9) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1083 && scroll_pos <= 1120){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(10) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1120 && scroll_pos <= 1150){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(11) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1150 && scroll_pos <= 1180){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(12) > div:nth-child(2)").addClass('activo');
                }
                if (scroll_pos >= 1180){
                    $(".tiempo_tabla .tiempo_fila > div:nth-child(2)").removeClass('activo');
                    $(".tiempo_tabla .tiempo_fila:nth-child(13)").removeClass("animated bounceInLeft");
                    $(".tiempo_tabla .tiempo_fila:nth-child(13)").addClass("animated shake");
                }
                console.log(scroll_pos);
            }
        });

    </script>
@endsection
