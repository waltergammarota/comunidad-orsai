@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_registro">
        <div>
            <h1>Registro <span class="span_block">de usuario</span></h1>
        </div>
        <div>
            <p class="texto_italica">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                diam nonummy nibh.
            </p>
        </div>
    </section>
    <section id="registro_js" class="contenedor form_reg">
        <form action="registrarse" method="POST">
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
                           placeholder="Correo Electrónico" value="{{old('email')}}">
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
                            <option value='Argentina' {{old('pais') == 'Argentina'? "selected":""}}>Argentina</option>
                            <option value='Bolivia' {{old('pais') == 'Bolivia'? "selected":""}}>Bolivia</option>
                            <option value='Brasil' {{old('pais') == 'Brasil'? "selected":""}}>Brasil</option>
                            <option value='Chile' {{old('pais') == 'Chile'? "selected":""}}>Chile</option>
                            <option value='Paraguay' {{old('pais') == 'Paraguay'? "selected":""}}>Paraguay</option>
                            <option value='Perú' {{old('pais') == 'Perú'? "selected":""}}>Perú</option>
                            <option value='Uruguay' {{old('pais') == 'Uruguay'? "selected":""}}>Uruguay</option>
                            <option value='otro' {{old('pais') == 'otro'? "selected":""}}>Otro</option>
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

            <div id="check_div" class="input_err obligatorio" style="padding-right: 0px !important;">
                <label class="checkbox-container letra_chica text_bold">
                    Aceptación de <a href="{{url('terminos')}}"
                                     class="subrayado resaltado_amarillo text_bold">Términos
                        y condiciones</a> (RDGP)
                    <input type="checkbox" id="cbox1" name="terminos" value="1"  {{old('terminos')? "checked":""}}>
                    @if ($errors->has('terminos'))
                        <span class="invalid-feedback">
                            <strong>Por favor, acepte los términos y condiciones</strong>
                        </span>
                    @endif
                    <span class="crear_check"></span>
                </label>
            </div>
            <div id="captcha_div">
                <div class="g-recaptcha" data-callback="recaptchaCallback"
                     data-sitekey="6LeRgN4UAAAAANiTeJSbMlk0VLNys96klWlt_Wmz"></div>
            </div>
            <div class="line_dashed"></div>
            <div id="boton_submit">
                <button class="subrayado resaltado_amarillo text_bold"
                        id="botonito">
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
            } else {
                // // $(this).css('font-style', 'italic');
                // return $(this).css('color', '#808080');
            }
        });
@endsection
