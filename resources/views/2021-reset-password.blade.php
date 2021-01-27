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
                @if($errors->has("token"))
	                <span class="span_h2" style="display:block;color: red;margin-bottom:20px;">Tu token expiró o es inválido. Vuelve a ingresar tu email para restablecerla.</span>
	            @endif
            </div> 
	        <form id="form_resetpasswd" action="{{url('reset-password')}}" method="POST">
	            @csrf 
                <div class="form_ctrl input_">
	                <div class="input_err">
	                    <input type="hidden" name="token" value="{{$token}}">
	                    <label class='oculto'>Nueva contraseña</label>
	                    <input type="password" id="nom_us" name="password"
	                           placeholder="Contraseña" value="{{old('password')}}">
	                    @if(old('password'))
	                        <span class="invalid-feedback">La contraseña no es válida.</span>
	                    @endif
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">Las claves deben tener al menos 8 caracteres.</span>
                        @endif 
	                </div>
                </div>
                <div class="form_ctrl input_">
                <div class="input_err">
                    <label class='oculto'>Repetir nueva contraseña</label>
                    <input type="password" id="nom_us" name="confirmPassword"
                           placeholder="Repetir nueva contraseña" value="{{old('confirmPassword')}}">
                    @if(old('confirmPassword'))
                        <span class="invalid-feedback">La contraseña no es válida.</span>
                    @endif
                    @if ($errors->has('confirmPassword'))
                        <span class="invalid-feedback">Las claves deben tener al menos 8 caracteres.</span>
                    @endif 
                </div>
                </div>  
                @if(Session::get('alert') == "password_reset_success")
                    <div class="contenedor contenedor_interna_2 feedback_ok" style="padding-bottom:30px;">
                        <div
                            style="min-height:50px;background:#d4edda;border-radius:2px;color:#155724;border:1px solid #c3e6cb;padding:0 15px; margin:0px;display:flex;justify-content: space-between;">
                            <p style="display:inline-block;position:relative;">Guardaste tu nueva contraseña.</p>
                        </div>
                    </div>
                @endif
                <div class="grilla_form"> 
                    <div id="boton_submit" class="align_center">
                        <button type="submit" class="boton_redondeado resaltado_amarillo text_bold width_100" id="boton_rest">Guardar nueva contraseña</button>
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
        $("#form_resetpasswd").submit(function( event ) {
			$(".msg_load").show(200); 
			$(".ajaxgif").removeClass('hide'); 
        });
    </script>
@endsection
