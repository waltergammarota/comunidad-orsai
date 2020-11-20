@extends('orsai-template')

@section('title', 'Contacto | Comunidad Orsai')
@section('description', 'Contacto')

@section('content')
    <section id="intro" class="contenedor intro_gral ">
        <div class="titulo">
            <h1 class="span_h1">Sin pelos en la lengua.</h1>
            <p class="page_description">No somos perfectos ni queremos serlo: decinos dónde ves una tuerca floja así
                podemos ajustarla. Tu comentario, sugerencia o lo que quieras decirnos nos ayudan a mejorar la
                experiencia en Comunidad Orsai.</p>
        </div>
        <div class="cuerpo_texto texto_noticia">
            <div class="contenedor form_reg">
                <form role="form" method="POST" action="{{url('contacto')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="contenedor_campos">
                        <div class="input_err obligatorio">
                            <label class="oculto">Nombre</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nombre"
                                   name="name"
                                   value="{{$name}}">
                        </div>
                        <div class="input_err obligatorio">
                            <label class="checkbox-container letra_chica text_bold">Apellido</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Apellido"
                                   name="lastName"
                                   value="{{$lastName}}">
                        </div>

                        <div class="input_err obligatorio" style="width: 100% !important;padding-right: 0px;">
                            <label class="oculto">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email"
                                   name="email"
                                   value="{{$email}}">
                        </div>
                    </div>
                    <div class="contenedor_campos">
                        <div class="input_err obligatorio" style="width: 100% !important;padding-right: 0px;">
                            <label class="oculto">Asunto</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Asunto"
                                   name="subject"
                                   value="{{old('asunto')}}">
                        </div>

                        <div class="input_err obligatorio" style="width: 100% !important; padding-left: 0px;">
                            <label class="oculto">Mensaje</label>
                            <textarea placeholder="Mensaje"
                                      name="mensaje" rows="5"
                                      style="width: 100%;"
                            >{{old('mensaje')}}</textarea>
                        </div>

                        <div id="captcha_div">
                            <div class="g-recaptcha" data-callback="recaptchaCallback"
                                 data-sitekey="6LeRgN4UAAAAANiTeJSbMlk0VLNys96klWlt_Wmz"></div>
                        </div>
                    </div>
                    <div id="boton_submit">
                        <button class="subrayado resaltado_amarillo text_bold"
                                id="botonito">
                            Enviar
                        </button>
                        <!-- <div class="msg"></div>
                            <img alt="Ruedita de estado" src="recursos/ajax.gif" class="ajaxgif hide" /> -->
                    </div>
                </form>
            </div>
        </div>
        <div class="publicidad_noticia">
        </div>
    </section>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>


    @if(Session::get('alert') == "contact_data_sent")
        <div class="general_profile_msg popup top_msg">
            <div class="contenedor msg_position_rel">
                <div id="texto_exito">
                    <span>Pronto se contactarán contigo.  Gracias!!</span>
                </div>
                <div class="cerrar">
                    <span>X</span>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('footer')
    <script>
        if (document.getElementsByClassName("general_profile_msg")) {
            var get_general_msg = document.getElementsByClassName("general_profile_msg");
            for (var x = 0; x < get_general_msg.length; x++) {
                get_general_msg[x].numerito = x;
                var get_close_modal = get_general_msg[x].getElementsByClassName("cerrar")[0];
                get_close_modal.onclick = function () {
                    close(this.parentNode.parentNode);
                };
            }
        }
    </script>
@endsection
