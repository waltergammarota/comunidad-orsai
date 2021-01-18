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
            <form id="form-contacto" role="form" method="POST" action="{{url('contacto')}}" enctype="multipart/form-data">
                @csrf
                    <div class="grilla_form">
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Nombre</label>
                                <input type="text" name="name" class="obligatorio" placeholder="Nombre" value="{{$name}}">
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
                                <input type="text" name="lastName" class="obligatorio" placeholder="Apellido" value="{{$lastName}}">
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
                                <input type="email" name="email" class="obligatorio" placeholder="Correo electrónico" value="{{$email}}">
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
                                <input type="text" name="subject" class="obligatorio" placeholder="Asunto del mensaje" value="{{old('asunto')}}">
                                @if ($errors->has('subject'))
			                        <span class="invalid-feedback"> 
			                            <span class="error">El campo Asunto es obligatorio.</span>
			                        </span>
			                    @endif  
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
				    @if(Session::get('alert') == "contact_data_sent") 
					    <div class="contenedor contenedor_interna_2 feedback_ok" style="padding-bottom:30px;">
					        <div
					            style="min-height:50px;background:#d4edda;border-radius:2px;color:#155724;border:1px solid #c3e6cb;padding:0 15px; margin:0px;display:flex;justify-content: space-between;">
					            <p style="display:inline-block;position:relative;">Pronto se contactarán contigo. ¡Gracias!</p> 
					        </div>
					    </div> 
				    @endif
                    <div class="msg_load"><img alt="Ruedita de estado" src="recursos/ajax.gif" class="ajaxgif hide" /></div> 
                    <div class="form_ctrl input_ asoc_btn ">
                        <div class="align_center">
                                <div class="align_center">
                                    <button type="submit" class="boton_redondeado resaltado_amarillo text_bold custom_size mg_20">Enviar</button>
                                </div>
                        </div>
                    </div>
                </form>
        </div>    
    </article>
</section> 
@endsection 
@section('footer')
    <script> 
        $(document).ready(function() { 	
            $("#form-contacto").submit(function( event ) {
                  $(".msg_load").show(200); 
                  $(".ajaxgif").removeClass('hide');
            });
        });
    </script>
@endsection
