@extends('orsai-template')

@section('title', 'Ingresar')

@section('content')
    <section id="intro" class="contenedor intro_registro ingresar_login_tit">
   <!--      <div>
       <h1>Ingresar</h1>
   </div> -->
    </section>
    <section id="login_js" class="contenedor form_reg">
        <form method="POST" action="{{url('ingresar')}}">
            @csrf
            <div class="contenedor_campos">
                <div class="input_err obligatorio">
                <!-- <label class='oculto'>Correo Electrónico</label> -->
                    <input type="email" id="mail_us" name="email"
                           placeholder="Correo Electrónico"
                           value="{{ old('email') }}">
                </div>
                <div class="input_err obligatorio">
                    <!-- <label class='oculto'>Contraseña</label> -->
                    <input type="password" id="ps" name="password" placeholder="Contraseña" value="">
                    @if ($errors->has('password') || $errors->has('email') || $errors->has('login'))
                        <span class="invalid-feedback">
                            <strong>Credenciales no válidas.</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div id="boton_submit">
                <button class="subrayado resaltado_amarillo text_bold"
                        id="boton_susc">
                    Ingresar
                </button>
                <!-- <div class="msg"></div>
                    <img alt="Ruedita de estado" src="recursos/ajax.gif" class="ajaxgif hide" /> -->
            </div>
            <div class="forg_pass">
                <a href="{{url('restablecer-clave')}}"
                   class="subrayado resaltado_gris">No recuerdo la
                    contraseña</a>
            </div>
            <div class="wan_reg">
                <a href="registrarse" class="subrayado resaltado_gris">Quiero
                    registrarme</a>
            </div>
        </form>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    @if(Session::get('alert') == "password_reset_success")
        <div class="general_profile_msg popup top_msg">
            <div class="contenedor msg_position_rel">
                <div id="texto_exito">
                    <span>Tu password fue reseteada con éxito.</span>
                </div>
                <div class="cerrar">
                    <span>X</span>
                </div>
            </div>
        </div>
    @endif
    @if(Session::get('alert') == "activation_email")
        <div class="general_profile_msg popup top_msg">
            <div class="contenedor msg_position_rel">
                <div id="texto_exito">
                    <span>Te falta validar el mail.</span>
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
        if (document.getElementsByClassName("general_profile_msg")){
            var get_general_msg = document.getElementsByClassName("general_profile_msg");
            for (var x = 0; x < get_general_msg.length; x++){
                get_general_msg[x].numerito=x;
                var get_close_modal = get_general_msg[x].getElementsByClassName("cerrar")[0];
                get_close_modal.onclick = function(){
                    close(this.parentNode.parentNode);
                }
            }
        }
    </script>
@endsection
