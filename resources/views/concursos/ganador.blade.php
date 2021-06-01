@extends('2021-orsai-template')

@section('title', 'Ganadores - '.$concurso->name.' |  Comunidad Orsai')
@section('description','Ganadores del Concurso | Comunidad Orsai')


@section('content')
    @include('concursos.concurso-header')

    <main class="cd-main-content resaltado_gris reset_min_height">
        <div class="height_50"></div>
        <div class="height_50"></div>
        <section class="resaltado_gris">
            <div class="contenedor_interna">
                <div class="cuerpo_interna ganador">
                    <div class="bloque_amarillo">
                        <div class="datos_ganador">
                            <div class="cont_glogito">
                                <span class="boton_redondeado resaltado_negro color_amarillo">1º PUESTO</span>
                                <span class="numero_linea_bt">{{str_pad($cpa->order,3,0, STR_PAD_LEFT)}}</span>
                            </div>
                            <h2 class="titulo">{{$cpa->getAnswerByRonda($currentRonda, 0)}}</h2>
                            <a href="{{url('cuentos/'.$cpa->id)}}">Leer
                                cuento <i
                                    class="icon icon-flecha_leitmotiv"></i></a>
                        </div>
                        <div class="pos_rel gan_premio">
                            <div class="pos_abs">
                                <p><strong>Premio:</strong> {{$cpa->prize_percentage}}% de las fichas del pozo</p>
                                <a href="{{url('estadisticas/'.$concurso->id.'/'.$concurso->getUrlName().'?force=1')}}"
                                   class="boton_redondeado resaltado_negro color_amarillo">Ver todos los
                                    ganadores</a>
                            </div>
                        </div>
                    </div>

                    <h2 class="super_titulo">{{$page->title}}</h2>
                    <p>{!! $page->texto !!}</p>
                </div> 
            </div>
        </section>
    </main>
@endsection

@section('footer')
    @include("fundacion.footer-fundacion")
    <script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
    <script type="text/javascript">

        $("#countdown_concurso").countdown("{{$diferencia}}", function (event) {
            if (event.offset['days'] != 0) {
                $(this).text(
                    event.strftime('%-D día%!D %H:%M')
                );
            } else {
                $(this).text(
                    event.strftime('%H:%M:%S')
                );
            }
        });
        $(".hero-nav-content").owlCarousel({
            responsiveClass: true,
            dots: false,
            navText: ["<i class='icon-left_arrow'></i>", "<i class='icon-right_arrow'></i>"],
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    loop: true,
                },
                600: {
                    items: 5,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: false,
                    loop: false,
                    mouseDrag: false,
                    autoWidth: true
                }
            }
        });
        if (window.matchMedia("(max-width: 767px)").matches) {
            $('.hero-nav-content').owlCarousel('remove', 4).owlCarousel('update');
        }
    </script>
@endsection
