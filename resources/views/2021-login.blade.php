@extends('2021-orsai-template')

@section('title', 'Ingresar | Comunidad Orsai')
@section('description', 'Una apuesta a la narrativa para contar buenas historias que trasciendan la pantalla.')

@section('content') 

<section class="resaltado_amarillo">
    <div class="contenedor">
    <div class="cuerpo_card_perfil_publico sin_padding">
   
        <div class="intro_text">
            <p><span class="icono icon-card"></span> Ya somos <span class="text_bold">{{$sociosPosta}}</span></p>
        </div>
    </div>
    </div>
    <article class="contenedor">
        <div class="cuerpo_card_perfil_publico">
            <div class="cuerpo_interna">
        <div id="login_js" class="form_central">
            <div class="titulo">
                <h1 class="text_regular">Los primeros 15.000 socios posta serán llamados "socios fundadores".</h1>
            </div>
	        <form method="POST" action="{{url('ingresar')}}" id="ingresar-form">
	            @csrf
                    <div class="form_ctrl input_">
                        <div class="input_err">
                            <label class="text_medium">Correo electrónico</label>  
                    		<input type="email" id="mail_us" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form_ctrl input_">
                        <div class="input_err">
                            <label class="text_medium">Contraseña</label>  
                    		<input type="password" id="ps" name="password" placeholder="Contraseña" value="">
                        </div>
                    </div>
                    <div class="form_ctrl input_  "> 
                        <div class="align_center">
                        	<button class="boton_redondeado resaltado_amarillo text_bold width_100 g-recaptcha"
		                        data-sitekey="{{env('CAPTCHA_SITE_KEY')}}"
		                        data-callback="onSubmit"
		                        data-action="submit"
		                        id="boton_susc">
		                    Ingresar
		                </button>
		                @if ($errors->has('password') || $errors->has('email') || $errors->has('login'))
		                    <p class="invalid-feedback">
		                        <strong>Uy, algo salió mal.</strong>
		                        <span>Revisá que tu correo y contraseña estén bien escritos.</span>
		                        <span>Si no pudiste ingresar, <a href="{{url('preguntas-frecuentes')}}">acá</a> te ayudamos a resolverlo.</span>
		                    </p>
		                @endif 
                        </div>
                    </div>
                    <div class="msg_load"><img alt="Ruedita de estado" src="{{url('recursos/ajax.gif')}}" class="ajaxgif hide" style="margin-bottom:10px;" /></div> 
                    <div class="grilla_form  border_tp_form">
                        <div class="form_ctrl col_3">
                                <div class="align_center">
                                    <a href="{{url('registrarse')}}"class="boton_redondeado btn_transparente  width_100">Quiero registrarme</a>
                                </div>
                        </div>
                        <div class="form_ctrl col_3">
                                <div class="align_center">
                                    <a href="{{url('restablecer-clave')}}" class="boton_redondeado btn_transparente width_100">Olvide mi cotraseña</a>
                                </div>
                        </div>
                    </div>
                </form>
                <div class="form_footer_term">
                    <span class="text_center color_gris">
                        Este sitio está protegido por reCAPTCHA y se aplican la <a href="https://policies.google.com/privacy" target="_blank" class="subrayado color_gris">Política de privacidad</a> y los <a href="https://policies.google.com/terms" target="_blank" class="subrayado color_gris">Términos de servicio de Google</a>.
                    </span>
                </div>
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
        function onSubmit(token) {
            document.getElementById('ingresar-form').submit(); 
	          $(".msg_load").show(200); 
	          $(".ajaxgif").removeClass('hide'); 
        }
    </script>
@endsection
