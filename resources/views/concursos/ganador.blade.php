@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')


@section('content')
    <section class="inscripcion-cuento">
        <div class="contenedor">
            <div class="hero" 
                @if($logo)
                style="background-image:url('{{url('storage/images/'.$logo->name.".".$logo->extension)}}')"
                @else
                style="background-image:url('{{'/recursos/front2021/fichas-donaciones.jpg'}}')"
                @endif
            >
                <div class="content-hero ganador_hero">
                    <p class="pills">Finalizado</p>
                    <h2 class="title">{{$concurso->name}}</h2>
                    <p class="subtitle">{{$concurso->bajada_corta}}</p>
                    @if($bases)
                        <a href="{{url($bases->slug)}}" class="link">Leer bases y condiciones</a>
                    @endif
                </div> 
            </div>


            <nav class="hero-nav concurso_nav">
                <div class="hero-nav-content  owl-carousel owl-theme">
                    <div class="hero-nav-item linea">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/reloj.svg')}}" alt="Cierre de votación">
                        </div>
                        <div class="content-nav column">
                            <div>
                                <span class="big-number_2 finalizado">finalizado</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero-nav-item linea">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Pozo acumulado">
                        </div>
                        <div class="content-nav column">

                            <div>
                                <span>Pozo acumulado</span>
                                <div class="numero_dividido">
                                    <span class="big-number_2">{{$cantidadFichasEnJuego}}</span>
                                    <span class="_barlow_text">Fichas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-nav-item linea">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/ficha.svg')}}" alt="Modo Pozo">
                        </div>
                        <div class="content-nav">
                            <span class="medio">Modo <br/> <strong>{{$modo}}</strong></span>
                        </div>
                    </div>
                    <div class="hero-nav-item linea">
                        <div class="content-nav column bajar">
                            <div class="numero_dividido">
                                <span class="big-number_3">{{$cantidadPostulacionesAprobadas}}</span>
                                <span>Cuentos <br/>enviados</span>
                            </div>
                        </div>
                        <div class="content-nav column  bajar">

                            <div class="numero_dividido">
                                <span class="big-number_3">{{$cuentistasInscriptos}}</span>
                                <span>Participantes </span>

                            </div>
                        </div>
                    </div>
                    <div class="hero-nav-item">
                        <div class="content-nav center">
                            <a href="{{url('mis-postulaciones')}}" class="btn-postulacion">Mis Postulaciones</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </section>
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
                                <a href="{{url('estadisticas/'.$concurso->id.'/'.$concurso->name.'?force=1')}}"
                                   class="boton_redondeado resaltado_negro color_amarillo">Ver todos los
                                    ganadores</a>
                            </div>
                        </div>
                    </div>

                    <h2 class="super_titulo">{{$page->title}}</h2>
                    <p>{!! $page->texto !!}</p>
                </div>
                <div class="form_ctrl input_" style="margin-top:20px;">
                    <div class="align_left btn_noti_ico">
                        <a href="{{url('concursos')}}"
                           class="boton_redondeado btn_transparente"><span class="icon-angle-left"></span>
                            Volver a concursos</a>
                    </div>
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
            if(event.offset['days'] != 0){
                $(this).text(
                    event.strftime('%-D día%!D %H:%M')
                ); 
            }else{
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
