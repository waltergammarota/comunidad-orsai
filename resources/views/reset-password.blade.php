@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral">
        <div class="titulo">
            <span class="span_h1">Restablecer <span class="span_block">la contraseña.</span></span>
            <h1 class="span_h2 texto_italica">Ingresá tu nueva contraseña.</h1>
        </div>
    </section>
    <div class="contenedor form_reg">
        <form action="{{url('reset-password')}}" method="POST">
            @csrf
            <div class="contenedor_campos">
                <div class="input_err">
                    <input type="hidden" name="token" value="{{$token}}">
                    <label class='oculto'>Nueva contraseña</label>'
                    <input type="password" id="nom_us" name="password"
                           placeholder="Clave" value="{{old('password')}}">
                    @if(old('password'))
                        <span>La contraseña no es válida.</span>
                    @endif
                </div>
                <div class="input_err">
                    <label class='oculto'>Nueva contraseña</label>'
                    <input type="password" id="nom_us" name="confirmPassword"
                           placeholder="Repita la clave" value="{{old('confirmPassword')}}">
                    @if(old('confirmPassword'))
                        <span>La contraseña no es válida.</span>
                    @endif
                </div>
                <div class="line_dashed"></div>
                <div id="boton_submit">
                    <button class="subrayado resaltado_amarillo text_bold"
                            id="boton_rest">
                        Guardar nueva clave
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    @if(Session::get('alert') == "activation_email")
        <div class="general_profile_msg popup top_msg">
            <div class="contenedor msg_position_rel">
                <div id="texto_exito">
                    <span>Te enviamos un mail de activación de cuenta.</span>
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


