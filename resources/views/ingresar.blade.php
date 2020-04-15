@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_registro ingresar_login_tit">
        <div>
            <h1>Ingresar</h1>
        </div>
    </section>
    <section id="login_js" class="contenedor form_reg">
        <form method="POST" action="{{url('ingresar')}}">
            @csrf
            <div class="contenedor_campos">
                <div class="input_err obligatorio">
                    <label class='oculto'>Correo Electrónico</label>
                    <input type="email" id="mail_us" name="email"
                           placeholder="Correo Electrónico"
                           value="{{ old('email') }}">
                </div>
                <div class="input_err obligatorio">
                    <label class='oculto'>Contraseña</label>
                    <input type="password" id="ps" name="password" value="">
                    @if ($errors->has('password') || $errors->has('email') || $errors->has('login'))
                        <span class="invalid-feedback">
                            <strong>Credenciales no válidas.</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="forg_pass">
                <a href="password/reset"
                   class="subrayado resaltado_amarillo">No recuerdo la
                    contraseña</a>
            </div>
            <div class="wan_reg">
                <a href="registrarse" class="subrayado resaltado_amarillo">Quiero
                    registrarme</a>
            </div>
            <div class="line_dashed"></div>
            <div id="boton_submit">
                <button class="subrayado resaltado_amarillo text_bold"
                        id="boton_susc">
                    Ingresar
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

@endsection
