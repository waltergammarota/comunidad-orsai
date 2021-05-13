@extends('orsai-template')

@section('title', 'Postulación | Comunidad Orsai')
@section('description', 'Postulación')

@section('header')
    <link rel="stylesheet" href="{{url('estilos/estilos_conc.css')}}">
@endsection

@section('content')
    <div class="fondo_blanco">
        <section id="intro" class="contenedor intro_gral grilla_texto">
            <div class="pd_bt_20">
                <h1 class="span_h1">Verificá tu postulación</h1>
            </div> 
            <div class="titulo"> 
                <h3 class="span_h3">{{$postulacion->title}}</h3>
            </div>
            <div class="descripcion"> 
                <p class="texto">{{$postulacion->description}}</p>
            </div>
            <div class="portada_concurso"> 
                @if($logo)
                    <img src="{{url('storage/images/'.$logo->name.".".$logo->extension)}}" alt="">
                @else
                    // TODO CAMBIAR IMAGEN DEFAULT DE CONCURSO
                    <img src="https://comunidadorsai.org/storage/images/15fc7e28ea8b2c.png" alt="">
                @endif
            </div>
        </section> 
        <section class="contenedor grilla_texto">
            @foreach($capitulos as $capitulo)
                <div class="capitulos">
                    @if($concurso->type == 1) 
                    @else
                        <span class="numero_capitulo">Capítulo {{$capitulo->orden}}</span>
                    @endif
                    <h2 class="subtitulo">{{$capitulo->title}}</h2>
                    <div class="texto">{!! $capitulo->body !!}</div>
                </div>
            @endforeach
        </section>
        <section id="confirmar_postulacion" class="contenedor grilla_texto">
            <form action="{{url('enviar-postulacion')}}" method="POST">
                @csrf
                <input type="hidden" name="cap_id" value="{{$postulacion->id}}">
                <div id="check_div" class="input_err obligatorio">
                    <label class="checkbox-container letra_chica text_bold">
                        Acepto <a href="#" target="_blank" rel="noopener noreferrer"
                                  class="subrayado resaltado_amarillo text_bold">bases y condiciones</a> del concurso.
                        <input type="checkbox" id="cbox1" class="check_cond" name="bases" value="1">
                        <span class="crear_check"></span>
                    </label> 
                </div>
                <div class="new_form">
                    <div class="align_center">
                        <button id="btn_finalizar" onclick="popup()" class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg font_16 width_100" disabled>Confirmar
                        </button>
                    </div>
                </div>
                <div class="btn_scroll_down">
                    <span id="btn_scroll" class="resaltado_amarillo" href="#">Confirmar postulación</span>
                </div><a onclick="goToCpa()"target="_blank" class="boton_redondeado resaltado_gris font_14 pd_50_lf_rg">&laquo; Volver</a> 
                            
            </form>
        </section>
 

    </div>
@endsection
<div class="modal_msg hidden">
    <div class="mensaje">
        <div>
            <span class="text_bold">¡Qué bueno!</span>
            <span>Gracias por enviar tu postulación.</span> 
        </div>
    </div>
</div>

@section('footer')
    <script>

        $("#btn_scroll").click(function () {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#confirmar_postulacion").offset().top + -200
            }, 2000);
        });


        $.fn.isInViewport = function () {
            var elementTop = $("#confirmar_postulacion").offset().top;
            var elementBottom = elementTop + $("footer").outerHeight();

            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            return elementBottom > viewportTop && elementTop < viewportBottom;
        };

        $(window).on('resize scroll', function () {

            if ($(this).isInViewport()) {
                $(".btn_scroll_down").fadeOut();
            } else {
                $(".btn_scroll_down").fadeIn();
            }
        });


        $(document).on('change', '.check_cond', function () {
            var checked_cond;
            $(".check_cond").each(function (indice, elemento) {

                if ($('.check_cond').eq(indice).prop('checked')) {
                    if (checked_cond != false) {
                        checked_cond = true;
                    }
                } else {
                    checked_cond = false;
                }
            });
            if (checked_cond == true) {
                $('#btn_finalizar').prop('disabled', false);
            } else {
                $('#btn_finalizar').prop('disabled', true);
            }
        });

        $(".cerrar").on("click", function () {
            $("body").css('overflow', 'visible');
            $(".modal_msg").fadeOut();
        });

        function popup() {
            $("body").css('overflow', 'hidden');
            $(".modal_msg").fadeIn();
        };

        function goToCpa() {
            event.preventDefault();
            window.location = `{{url('postulaciones/'.$concurso->id.'/'.$concurso->getUrlName())}}`;
        }

    </script>
@endsection
