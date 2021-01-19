@extends('2021-orsai-template')

@section('title', 'Reestablecer contraseña | Comunidad Orsai') 

@section('content')  
<section class="resaltado_gris">
    <div class="contenedor sin_fondo">
        <div class="cuerpo_card_perfil_publico sin_padding">
            <div class="form_central_2">
                <div class="intro_ ">
                    <div class="pd_20_tp"></div>
                    <p>Restablecer la contraseña</p>
                </div>
            </div>
        </div>
    </div>
    <article class="contenedor">
        <div class="cuerpo_card_perfil_publico">
            <div class="cuerpo_interna">
        <div class="form_central_2">
            <div class="titulo">
                <h1 class="text_regular">Ingresá la dirección de correo electrónico asociada a tu cuenta y te vamos a enviar un enlace para restablecer tu contraseña.</h1>
                @if($errors->has("token"))
	                <span class="span_h2" style="background-color: red">
	                <strong>Tu token expiró o es inválido. Vuelve a ingresar tu email para restablecerla.</strong>
	            </span>
	            @endif
            </div>
        	<form id="form_resetpasswd" action="{{url('restablecer-clave')}}" method="POST">
            @csrf
                    <div class="form_ctrl input_">
                        <div class="input_err">
                            <label class="text_medium">Correo Electrónico</label>
		                    <input type="email" id="nom_us" name="email" placeholder="Email" value="{{old('email')}}">
		                    @if(old('email'))
		                        <span>El email no fue encontrado.</span>
		                    @endif
                        </div>
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
                    <div class="grilla_form"> 
	                    <div id="boton_submit" class="align_center">
	                        <button type="submit" class="boton_redondeado resaltado_amarillo text_bold width_100" id="boton_rest">Recibir enlace</button>
	        			<div class="msg_load"><img alt="Ruedita de estado" src="{{url('recursos/ajax.gif')}}" class="ajaxgif hide" style="margin-top:10px;	margin-bottom:10px;" /></div> 
	                    </div> 
                    </div>
                </form>
        </div>
    </div>
    <div class="mg_50"></div>    
    </div>
    </article>
</section>
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
                }
            }
        }  
        $("#form_resetpasswd").submit(function( event ) {
			$(".msg_load").show(200); 
			$(".ajaxgif").removeClass('hide'); 
        });
    </script>
@endsection
