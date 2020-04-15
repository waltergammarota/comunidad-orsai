@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral">
        <div class="titulo">
            <span class="span_h1">Restablecer <span class="span_block">la contraseña.</span></span>
            <h1 class="span_h2 texto_italica">Ingresá la dirección de correo
                electrónico asociada a tu cuenta y te vamos a enviar un enlac
                para restablecer tu contraseña.</h1>
        </div>
    </section>
    <div class="contenedor form_reg">
        <form action="#">
            <div class="contenedor_campos">
                <div class="input_err">
                    <label class='oculto'>Dirección de correo
                        electrónico</label>
                    <input type="email" id="nom_us" name="nom_us"
                           placeholder="Email">
                    <span>hola este es un error</span>
                </div>
                <div class="line_dashed"></div>
                <div id="boton_submit">
                    <button class="subrayado resaltado_amarillo text_bold"
                            id="boton_rest">
                        Recibir enlace
                    </button>
                    <!-- <div class="msg"></div>
                        <img alt="Ruedita de estado" src="recursos/ajax.gif" class="ajaxgif hide" /> -->
                </div>
            </div>
        </form>
    </div>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    </div>
@endsection

@section('footer')

@endsection
