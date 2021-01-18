@extends('2021-orsai-template')

@section('title', 'Contacto | Comunidad Orsai')
@section('description', 'Contacto')

@section('content')

<section class="resaltado_gris pd_20 pd_20_bt">
    <div class="contenedor blog_preview sin_fondo">
        <div class="mg_20"></div>
    </div>
    <article class="contenedor_interna grilla_contacto" id="page-contacto">
        <div class="form_central_3">
            <div class="border_bt_form">
                <div class="titulo titulo_sin_mg">
                    <h1 class="text_regular">Sin pelos en la lengua</h1>
		            <p class="page_description">No somos perfectos ni queremos serlo: decinos dónde ves una tuerca floja así
		                podemos ajustarla. Tu comentario, sugerencia o lo que quieras decirnos nos ayudan a mejorar la
		                experiencia en Comunidad Orsai.</p>
                </div>
            </div>

            <form role="form" method="POST" action="{{url('contacto')}}" enctype="multipart/form-data">
                @csrf
                    <div class="grilla_form">
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Nombre</label>
                                <input type="text" name="Nombre" class="obligatorio" placeholder="Nombre" value="{{$name}}">
                                @if ($errors->has('name'))
			                        <span class="invalid-feedback"> 
			                        	<span class="error">El campo Nombre es obligatorio.</span>
			                        </span>
			                    @endif 
                            </div> 
                        </div> 
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Apellido</label>
                                <input type="text" name="apellido" class="obligatorio" placeholder="Apellido" value="{{$lastName}}">
                                @if ($errors->has('lastName'))
			                        <span class="invalid-feedback"> 
			                        	<span class="error">El campo Apellido es obligatorio.</span>
			                        </span>
			                    @endif  
                            </div> 
                        </div> 
                    </div>
                    <div class="grilla_form">
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Correo electrónico</label>
                                <input type="email" name="Nombre" class="obligatorio" placeholder="Correo electrónico" value="{{$email}}">
                                @if ($errors->has('email'))
			                        <span class="invalid-feedback"> 
			                            <span class="error">Este correo electrónico no es válido.</span>
			                        </span>
			                    @endif  
                            </div> 
                        </div> 
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Asunto</label>
                                <input type="text" name="asunto" class="obligatorio" placeholder="Asunto del mensaje" value="{{old('asunto')}}">
                                @if ($errors->has('asunto'))
			                        <span class="invalid-feedback"> 
			                            <span class="error">El campo Asunto es obligatorio.</span>
			                        </span>
			                    @endif 
   {{-- 	 --}}
                            </div> 
                        </div>
                    </div>
                    <div class="form_ctrl input_">
                        <div class="input_err">
                            <label class="text_medium">Mensaje</label>
                            <textarea name="mensaje" placeholder="Escribir...">{{old('mensaje')}}</textarea>
                            @if ($errors->has('mensaje'))
		                        <span class="invalid-feedback"> 
			                         <span class="error">El campo Mensaje es obligatorio.</span>
		                        </span>
		                    @endif 
                        </div>
                    </div>
                    <div id="captcha_div">
                        <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LeRgN4UAAAAANiTeJSbMlk0VLNys96klWlt_Wmz"></div>
                    </div>
                    <div class="form_ctrl input_ asoc_btn ">
                        <div class="align_center">
                                <div class="align_center">
                                    <button type="submit" class="boton_redondeado resaltado_amarillo text_bold custom_size mg_20">Enviar</button>
                                </div>
                        </div>
                    </div>{{-- 
	                <div class="msg"></div><img alt="Ruedita de estado" src="recursos/ajax.gif" class="ajaxgif hide" /> --}}
                </form>
        </div>    
    </article>
</section> 
    @if(Session::get('alert') == "contact_data_sent")
        <div class="general_profile_msg popup top_msg">
            <div class="contenedor msg_position_rel">
                <div id="texto_exito">
                    <span>Pronto se contactarán contigo. ¡Gracias!</span>
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
        if (document.getElementsByClassName("general_profile_msg")) {
            var get_general_msg = document.getElementsByClassName("general_profile_msg");
            for (var x = 0; x < get_general_msg.length; x++) {
                get_general_msg[x].numerito = x;
                var get_close_modal = get_general_msg[x].getElementsByClassName("cerrar")[0];
                get_close_modal.onclick = function () {
                    close(this.parentNode.parentNode);
                };
            }
        }
    </script>
@endsection
