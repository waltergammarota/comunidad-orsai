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
                <div class="content-hero">
                    <p class="pills">Inscripción</p>
                    <h2 class="title">{{$concurso->name}}</h2>
                    <p class="subtitle">{{$concurso->bajada_corta}}</p>
                    @if($bases)
                        <a href="{{url($bases->slug)}}" class="link">Leer bases y condiciones</a>
                    @endif
                </div> 
            </div>

            <nav class="hero-nav concurso_nav">
                <div class="hero-nav-content  owl-carousel owl-theme">
                    <div class="hero-nav-item">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/reloj.svg')}}"
                                 alt="insertar SVG con la etiqueta image">
                        </div>
                        <div class="content-nav">
                            <span>Te queda<br/><strong id="countdown_concurso"></strong></span>
                        </div>
                    </div>
                    <div class="hero-nav-item">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/cuentos_postulados.svg')}}"
                                 alt="insertar SVG con la etiqueta image">
                        </div>
                        <div class="content-nav column">
                            <span class="big-number">{{$cuentosPostulados}}</span>
                            <span>Cuentos <br> postulados</span>
                        </div>
                    </div>
                    <div class="hero-nav-item">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/cuentos_aprobados.svg')}}"
                                 alt="insertar SVG con la etiqueta image">
                        </div>
                        <div class="content-nav column">
                            <span class="big-number">{{$cantidadPostulacionesAprobadas}}</span>
                            <span>Cuentos<br> aprobados </span>
                        </div>
                    </div>
                    <div class="hero-nav-item">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/cuentistas_inscriptos.svg')}}"
                                 alt="insertar SVG con la etiqueta image">
                        </div>
                        <div class="content-nav column">
                            <span class="big-number">{{$cuentistasInscriptos}}</span>
                            <span>Cuentistas<br> inscriptos </span>
                        </div>
                    </div>
                    {{--                    <div class="hero-nav-item">--}}
                    {{--                        <div class="icon">--}}
                    {{--                            @if($concurso->getMode()->id == 1)--}}
                    {{--                                <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"--}}
                    {{--                                     alt="">--}}
                    {{--                            @elseif($concurso->getMode()->id == 2)--}}
                    {{--                                <img src="{{url('estilos/front2021/assets/modo_completo.svg')}}"--}}
                    {{--                                     alt="">--}}
                    {{--                            @else--}}
                    {{--                                <img src="{{url('estilos/front2021/assets/modo_fijo.svg')}}"--}}
                    {{--                                     alt="">--}}
                    {{--                            @endif--}}
                    {{--                        </div>--}}
                    {{--                        <div class="content-nav">--}}
                    {{--                            <span>Modo</span>--}}
                    {{--                            <span class="strong">{{$concurso->getMode()->name}}</span>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    @if($estado == "abierto")
                        @if($concurso->hasPostulacionesAbiertas())
                            <div class="hero-nav-item">
                                <div class="content-nav center">
                                    <a href="{{url('postulaciones/'.$concurso->id.'/'.$concurso->getUrlName())}}"
                                       class="btn-postulacion">Subir mi postulación</a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </nav>
            @if($estado == "abierto")
                @if($concurso->hasPostulacionesAbiertas())
                    <div class="subir_postulacion">
                        <a href="{{url('postulaciones/'.$concurso->id.'/'.$concurso->getUrlName())}}" class="btn-postulacion">Subir
                            mi postulación</a>
                    </div>
                @endif
            @endif
        </div>
    </section>
    <section class="resaltado_gris cuerpo_inscripcion">
        <div class="contenedor_interna">
            <div class="cuerpo_interna">
                {{-- <h2 class="cuerpo_inscripcion_title">{{$concurso->getUrlName()}}</h2> --}}
                {!! $concurso->bajada_completa !!}
                <div class="center-columns">
                    @if($bases)
                        <a href="{{url($bases->slug)}}" target="_blank" class="link">Leer bases y condiciones</a>
                    @endif
                    @if($estado == "abierto")
                        @if($concurso->hasPostulacionesAbiertas())
                            <div class="align_center">
                                <a href="{{url('postulaciones/'.$concurso->id.'/'.$concurso->getUrlName())}}"
                                   class="boton_redondeado resaltado_amarillo text_bold width_100">Subir mi
                                    postulación</a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            {{-- <div class="form_ctrl input_" style="margin-top:20px;">
                <div class="align_left btn_noti_ico">
                    <a href="{{url('concursos')}}"
                       class="boton_redondeado btn_transparente"><span class="icon-angle-left"></span>
                         Volver a concursos</a>
                </div>
            </div> --}}
        </div>
    </section>
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
