@extends('orsai-template')

@section('title', 'Comunidad Orsai')
@section('description', 'Ingresar')

@section('content')
    <section id="intro" class="contenedor intro_registro ingresar_login_tit">
   <!--      <div>
       <h1>Ingresar</h1>
   </div> -->
    </section>
    <section id="login_js" class="contenedor form_reg">
        <form method="POST" action="{{url('ingresar')}}" id="ingresar-form">
            @csrf
            <div class="contenedor_campos">
                <h1>Ya somos {{$totalusers}}</h1>
                <p>Los primeros 15.000 registrados serán llamados "socios fundadores".</p>
            </div>
            <div class="contenedor_campos">
                <div class="input_err obligatorio"> 
                    <input type="email" id="mail_us" name="email"
                           placeholder="Correo Electrónico"
                           value="{{ old('email') }}">
                </div>
                <div class="input_err obligatorio"> 
                    <input type="password" id="ps" name="password" placeholder="Contraseña" value="">
                    @if ($errors->has('password') || $errors->has('email') || $errors->has('login'))
                        <span class="invalid-feedback">
                            <strong>Credenciales no válidas.</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div id="boton_submit">
                <button class="subrayado resaltado_amarillo text_bold g-recaptcha"
                        data-sitekey="{{env('CAPTCHA_SITE_KEY')}}"
                        data-callback="onSubmit"
                        data-action="submit"
                        id="boton_susc">
                    Ingresar
                </button>
                <!-- <div class="msg"></div>
                    <img alt="Ruedita de estado" src="recursos/ajax.gif" class="ajaxgif hide" /> -->
            </div>
            <div class="wan_reg">
                <a href="registrarse" class="subrayado resaltado_gris">Quiero
                    registrarme</a>
            </div>
            <div class="forg_pass">
                <a href="{{url('restablecer-clave')}}"
                   class="subrayado resaltado_gris">Olvidé la
                    contraseña</a>
            </div>
            <div id="recaptcha_legal" class="input_err obligatorio"> 
                <p class="recaptcha_legal-container letra_chica"><small><br>
Este sitio está protegido por reCAPTCHA y se aplican la <a href="https://policies.google.com/privacy" target="_blank">Política de privacidad</a> y los <a href="https://policies.google.com/terms" target="_blank">Términos de servicio</a> de Google.</small></p>
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

        function onSubmit(token) {
            document.getElementById('ingresar-form').submit();
        }
    </script>
@endsection
