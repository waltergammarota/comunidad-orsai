@extends('2021-orsai-template')

@section('title', 'Reenvío de mail | Comunidad Orsai')
@section('description', 'Reenvío de mail')

@section('content')
<section class="resaltado_gris">
    <div class="contenedor sin_fondo">
        <div class="cuerpo_card_perfil_publico sin_padding">
            <div class="form_central_2">
                <div class="intro_ ">
                    <div class="pd_20_tp"></div>
                    <p>Reenvío de email de activación</p>
                </div>
            </div>
        </div>
    </div>
    <article class="contenedor">
        <div class="cuerpo_card_perfil_publico">
            <div class="cuerpo_interna">
        <div class="form_central_2">
            <div class="titulo">
                <h1 class="text_regular"><strong>Tu cuenta no está activada.</strong><br/> Ingresá la dirección de correo electrónico asociada a tu cuenta y te vamos a reenviar un enlace para activar tu cuenta.</h1>
                @if($errors->has("token"))
	                <span class="span_h2" style="background-color: red">
	                <strong>Tu token expiró o es inválido. Vuelve a ingresar tu email para restablecerla.</strong>
	            </span>
	            @endif
            </div>
        	<form action="{{url('reenviar-mail')}}" method="POST">
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
					@if(Session::get('alert') == "activation_email") 
					    <div class="contenedor contenedor_interna_2 feedback_ok" style="padding-bottom:30px;">
					        <div
					            style="min-height:50px;background:#d4edda;border-radius:2px;color:#155724;border:1px solid #c3e6cb;padding:0 15px; margin:0px;display:flex;justify-content: space-between;">
					            <p style="display:inline-block;position:relative;font-size:14px;">Te enviamos un mail de activación de cuenta.</p> 
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


