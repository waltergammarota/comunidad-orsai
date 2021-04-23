@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')


@section('content')
    <section class="inscripcion-cuento">
        <div class="contenedor">
            <div class="hero">
                <div class="content-hero ganador_hero">
                    <p class="pills">Finalizado</p>
                    <h2 class="title">{{$concurso->name}}</h2>
                    <p class="subtitle">{{$concurso->bajada_corta}}</p>
                    @if($bases)
                        <a href="{{url($bases->slug)}}" class="link">Leer bases y condiciones</a>
                    @endif
                </div>
                @if($logo)
                    <img src="{{url('storage/images/'.$logo->name.".".$logo->extension)}}" alt="" class="img_fondo">
                @else
                    <img src="https://dev.comunidadorsai.org/recursos/front2021/fichas-donaciones.jpg" class="img_fondo"
                         alt="">
                @endif
            </div>

            
        <nav class="hero-nav concurso_nav"> 
            <div class="hero-nav-content  owl-carousel owl-theme">
                <div class="hero-nav-item linea">
                    <div class="icon">
                        <img src="{{url('estilos/front2021/assets/reloj.svg')}}" alt="Cierre de votación">
                    </div>
                    <div class="content-nav column">
                        <div>
                            {{-- <span>Cierre de votación</span>
                            <span class="big-number_2">46:10:22</span>   --}}
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
                                <span class="big-number_2">4502 </span>
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
                        <span class="medio">Modo <br/> <strong>Pozo</strong></span>
                    </div>
                </div>
                <div class="hero-nav-item linea">
                    <div class="content-nav column bajar">
                        <div class="numero_dividido">
                            <span class="big-number_3">46 </span>
                            <span>Cuentos <br/>enviados</span>
                        </div>       
                    </div>
                    <div class="content-nav column  bajar" >

                        <div class="numero_dividido">
                            <span class="big-number_3">46 </span>
                            <span>Participantes </span>

                        </div>    
                    </div>
                </div> 
                <div class="hero-nav-item">
                    <div class="content-nav center">
                        <a href="#" class="btn-postulacion">Mis Postulaciones</a>
                    </div>
                </div> 
            </div>
        </nav>
            @if($estado == "abierto")
                @if($concurso->hasPostulacionesAbiertas())
                    <div class="subir_postulacion">
                        <a href="{{url('postulaciones/'.$concurso->id.'/'.$concurso->name)}}" class="btn-postulacion">Subir
                            mi postulación</a>
                    </div>
                @endif
            @endif
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
                                <span class="numero_linea_bt">007</span>
                            </div>
                            <h2 class="titulo">Título del cuento dos líneas</h2>
                            <a href="#">Leer cuento <i class="icon icon-flecha_leitmotiv"></i></a>
                        </div>
                        <div class="pos_rel gan_premio">
                            <div class="pos_abs">
                                <p><strong>Premio:</strong> 100% de las fichas del pozo</p>
                                <a href="#" class="boton_redondeado resaltado_negro color_amarillo">Ver todos los ganadores</a>
                            </div>
        
                        </div>
                    </div>
                    
                    <h2 class="super_titulo">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</h2>
                    <p class="">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. <strong>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat,</strong>  vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, cons ectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim  <strong>veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</strong></p>
                    <p class="">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna <strong>aliquam erat volutpat.</strong> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                
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
        $("#countdown_concurso")
            .countdown("{{$diferencia}}", function (event) {
                $(this).text(
                    event.strftime('%D días %H:%M:%S')
                );
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
