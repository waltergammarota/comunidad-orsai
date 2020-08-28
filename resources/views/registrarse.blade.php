@extends('orsai-template')

@section('title', 'Registro | Fundación Orsai')
@section('description', 'Registro')

@section('content')
    <section id="intro" class="contenedor intro_registro">
        <div>
            <h1>Registro</h1>
        </div> 
    </section>
    <section id="registro_js" class="contenedor form_reg">
        <form action="registrarse" method="POST" id="registro-form">
            @csrf
            <div class="contenedor_campos">
                <div class="input_err obligatorio">
                    <label class='oculto'>Nombre</label>
                    <input type="text" id="nom_us" name="nombre"
                           placeholder="Nombre" value="{{old('nombre')}}">
                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('nombre')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="input_err obligatorio">
                    <label class='oculto'>Apellido</label>
                    <input type="text" id="ape_us" name="apellido"
                           placeholder="Apellido" value="{{old('apellido')}}">
                    @if ($errors->has('apellido'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('apellido')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="input_err obligatorio">
                    <label class='oculto'>Correo Electrónico</label>
                    <input type="email" id="mail_us" name="email"
                           placeholder="Correo Electrónico"
                           value="{{old('email')}}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{$errors->first('email')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="input_err select">
                    <label class='oculto'>País</label>
                    <div class="arm_sel">
                        <select name='pais' id='pais_suscriptor' class=''>
                            <option id="select_pais" value='ninguno' disabled
                                    selected hidden>Elegir...
                            </option>
                            @foreach($paises as $pais)
                                <option
                                    value='{{$pais->nombre}}' {{old('pais') == $pais->nombre? "selected":""}}>{{$pais->nombre}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('pais'))
                            <span class="invalid-feedback">
                            <strong>{{$errors->first('pais')}}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="input_err obligatorio">
                    <label class='oculto'>Usuario</label>
                    <input type="text" id="usr" name="usuario"
                           placeholder="Usuario" value="{{old('usuario')}}">
                    @if ($errors->has('usuario'))
                        <span class="invalid-feedback">
                            <strong>El nombre de usuario ya fue usado.  Elija otro.</strong>
                        </span>
                    @endif
                </div>
                <div class="input_err cont_pass fst_pss obligatorio">
                    <div class="pass">
                        <label class='oculto'>Contraseña</label>
                        <input type="password" id="ps" name="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                            <strong>Revise las claves.  Al menos 8 caracteres.</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="input_err cont_pass sc_pss obligatorio">
                    <div class="pass">
                        <label class='oculto'>Repetir contraseña</label>
                        <input type="password" id="rp_ps"
                               name="confirmPassword">
                        @if ($errors->has('confirmPassword'))
                            <span class="invalid-feedback">
                            <strong>Revise las claves.  Al menos 8 caracteres.</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div id="check_div" class="input_err obligatorio"
                 style="padding-right: 0px !important;">
                <label class="checkbox-container letra_chica text_bold">
                    Aceptación de <a href="{{url('terminos')}}"
                                     class="subrayado resaltado_amarillo text_bold" target="_blank">Términos
                        y condiciones</a>.
                    <input type="checkbox" id="cbox1" name="terminos"
                           value="1" {{old('terminos')? "checked":""}}>
                    @if ($errors->has('terminos'))
                        <span class="invalid-feedback">
                            <strong>Por favor, acepte los términos y condiciones</strong>
                        </span>
                    @endif
                    <span class="crear_check"></span>
                </label>
            </div>
            <div id="recaptcha_legal" class="input_err obligatorio"> 
                <p class="recaptcha_legal-container letra_chica"><small><br>
Este sitio está protegido por reCAPTCHA y se aplican la <a href="https://policies.google.com/privacy" target="_blank">Política de privacidad</a> y los <a href="https://policies.google.com/terms" target="_blank">Términos de servicio</a> de Google.</small></p>
            </div>
            <div id="boton_submit">
                <button class="subrayado resaltado_amarillo text_bold g-recaptcha"
                        data-sitekey="{{env('CAPTCHA_SITE_KEY')}}"
                        data-callback="onSubmit"
                        data-action="submit"
                        id="boton_susc">
                    Registrarme
                </button>
                <!-- <div class="msg"></div>
                    <img alt="Ruedita de estado" src="recursos/ajax.gif" class="ajaxgif hide" /> -->
            </div>

        </form>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')
    <script src="js/main.js"></script>
    <script>
        $('select').on('change', function () {
            if ($(this).val()) {
                $(this).css('font-style', 'normal');
                return $(this).css('color', 'black');
            }
        });

        function onSubmit(token) {
            document.getElementById('registro-form').submit();
        }
@endsection
