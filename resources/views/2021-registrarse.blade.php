@extends('2021-orsai-template')

@section('title', 'Asociarse | Comunidad Orsai')
@section('description', 'Registrate y formá parte de la Comunidad Orsai.')

@section('content')
    <section class="resaltado_gris pd_20 pd_20_bt">
        <div class="contenedor grilla_asociarse">
            <div class="form_central_3">
                <div class="intro_ ">
                    <p>Asociarse</p>
                </div>
            </div>
        </div>
        <article id="registro_js" class="contenedor grilla_asociarse_blanco">

            <div class="form_central_3 form_reg">
                <form action="registrarse" method="POST" id="registro-form">
                  <input type="hidden" id="usr" name="usuario" value="test">
                    @csrf
                    <div class="grilla_form contenedor_campos">
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Nombre</label>
                                <input type="text" id="nom_us" name="nombre" placeholder="Nombre"
                                    value="{{ old('nombre') }}">
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback">{{ $errors->first('nombre') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Apellido</label>
                                <input type="text" id="ape_us" name="apellido" placeholder="Apellido"
                                    value="{{ old('apellido') }}">
                                @if ($errors->has('apellido'))
                                    <span class="invalid-feedback">{{ $errors->first('apellido') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="grilla_form">
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Correo electrónico</label>
                                <input type="email" id="mail_us" name="email" placeholder="Correo Electrónico"
                                    value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">País</label>
                                <div class="select">
                                    <select name='pais' id='pais_suscriptor' class=''>
                                        <option id="select_pais" value='ninguno' disabled="disabled" selected="selected"
                                            hidden>Elegir...</option>
                                        @foreach ($paises as $pais)
                                            <option value='{{ $pais->nombre }}'
                                                {{ old('pais') == $pais->nombre ? 'selected' : '' }}>{{ $pais->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('pais'))
                                        <span class="invalid-feedback">{{ $errors->first('pais') }}</span>
                                    @endif
                                    <div class="select__arrow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grilla_form">
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                              <label class="text_medium">Contraseña</label>
                              <input type="password" id="ps" name="password">
                              @if ($errors->has('password'))
                                  <span class="invalid-feedback">Las claves deben tener al menos 8 caracteres.</span>
                              @endif
                            </div>
                        </div>
                        <div class="form_ctrl input_ col_3">
                            <div class="grilla_form">
                                <div class="input_err col_6">
                                    <label class="text_medium">Repetir contraseña</label>
                                    <input type="password" id="rp_ps" name="confirmPassword">
                                    @if ($errors->has('confirmPassword'))
                                        <span class="invalid-feedback">Las claves deben tener al menos 8 caracteres.</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form_ctrl input_">
                        <div class="align_center">
                            <div class="input_err">
                                <div id="check_div" class="input_err obligatorio">
                                    <label class="checkbox-container letra_chica">
                                        Aceptación de <a href="{{ url('terminos-y-condiciones') }}" target="_blank"
                                            rel="noopener noreferrer" class="subrayado">términos y condiciones</a>.
                                        <input type="checkbox" id="cbox1" name="terminos" class="check_cond" value="1"
                                            {{ old('terminos') ? 'checked' : '' }}>
                                        <span class="crear_check"></span>
                                    </label>
                                </div>
                                @if(!empty($msg)) 
                                <span class="invalid-feedback" style="
                                    margin: 1rem 0;
                                    display: flex;
                                    text-align: center;
                                    justify-content: center;
                                ">{{$msg}}</span>
                                @endif
                                @if ($errors->has('terminos'))
                                    <span class="invalid-feedback">Por favor, aceptá los términos y condiciones.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form_ctrl input_ col_3 ">
                        <div class="align_center asoc_btn">
                          <input class="boton_redondeado resaltado_amarillo text_bold width_100 g-recaptcha"
		                        type="submit"
		                        id="">
                            <div class="msg_load"><img alt="Ruedita de estado" src="{{ url('recursos/ajax.gif') }}"
                                    class="ajaxgif hide" style="margin-top:10px;	margin-bottom:10px;" /></div>
                        </div>
                    </div>
                </form>
                <div class="form_footer_term">
                    <span class="text_center color_gris">
                        Este sitio está protegido por reCAPTCHA y se aplican la <a
                            href="https://policies.google.com/privacy" target="_blank">Política de privacidad</a> y los <a
                            href="https://policies.google.com/terms" target="_blank">Términos de servicio</a> de Google.
                    </span>
                </div>
            </div>
        </article>
    </section>
@endsection
@section('footer')
  <script>
      $(document).ready(function() {
        $('#usr').val(makeid(25));
      });
      
      $('select').on('change', function() {
          console.log("test");
          if ($(this).val()) {
              $(this).css('font-style', 'normal');
              return $(this).css('color', 'black');
          }
      });

      function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * 
          charactersLength));
        }
        return result;
      }

      /*function onSubmit(token) {
          document.getElementById('registro-form').submit();
          $(".msg_load").show(200);
          $(".ajaxgif").removeClass('hide');
      }*/
  </script>
@endsection
