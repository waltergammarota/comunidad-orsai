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
        <form action="{{url('restablecer-clave')}}" method="POST">
            @csrf
            <div class="contenedor_campos">
                <div class="input_err">
                    <label class='oculto'>Dirección de correo
                        electrónico</label>'
                    <input type="email" id="nom_us" name="email"
                           placeholder="Email" value="{{old('email')}}">
                    @if(old('email'))
                        <span>El email no fue encontrado.</span>
                    @endif
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

    @if(Session::get('alert') == "reset_password_email")
        <div class="general_profile_msg popup top_msg">
            <div class="contenedor msg_position_rel">
                <div id="texto_exito">
                    <span>Te enviamos un mail para restablecer tu contraseña.</span>
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


