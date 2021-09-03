@extends('2021-orsai-template')

@section('title', 'Asociarse | Comunidad Orsai')
@section('description', 'Registrate y formá parte de la Comunidad Orsai.')

@section('content') 
<section class="resaltado_gris pd_20 pd_20_bt">
    <div class="contenedor grilla_asociarse">
        <div class="form_central_3">
            <div class="intro_ ">
                <p>Asociarse</p>
            </div>
        </div>
    </div>
    <article id="registro_js" class="contenedor grilla_asociarse_blanco">
        <h2>Bienvenido a Comunidad Orsar</h2>
        <p>Como es tu primera vez, te vamos a pedir algunos datos</p>
        
        <div class="form_central_3 form_reg">
        <form action="registrarse" method="POST" id="registro-form">
          <input type="hidden" id="mail_us" name="email" value="{{$email}}">
          <input type="hidden" id="usr" name="usuario" value="{{$email}}">
          <input type="hidden" id="ps" name="password" value="{{$pass}}">
          <input type="hidden" id="rp_ps" name="confirmPassword" value="{{$pass}}">
          <input type="hidden" id="nom_us" name="nombre" value="{{$nombre}}">
          <input type="hidden" id="ape_us" name="apellido" value="{{$apellido}}">
            @csrf
                    <div class="grilla_form">
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">País</label>
                                <div class="select">
                                    <select name='pais' id='pais_suscriptor' class=''>
			                            <option id="select_pais" value='ninguno' disabled="disabled" selected="selected" hidden>Elegir...</option>
			                            @foreach($paises as $pais)
			                                <option value='{{$pais->nombre}}' {{old('pais') == $pais->nombre? "selected":""}}>{{$pais->nombre}}</option>
			                            @endforeach
			                        </select>
			                        @if ($errors->has('pais'))
			                            <span class="invalid-feedback">{{$errors->first('pais')}}</span>
			                        @endif
                                    <div class="select__arrow"></div>
                                </div> 
                            </div>
                        </div> 
                    </div>

                    </div>
                    <div class="form_ctrl input_">
                        <div class="align_center">
                        <div class="input_err">
                            <div id="check_div" class="input_err obligatorio">
                                <label class="checkbox-container letra_chica">
                                    Aceptación de <a href="{{url('terminos-y-condiciones')}}" target="_blank" rel="noopener noreferrer" class="subrayado">términos y condiciones</a>. 
                   				<input type="checkbox" id="cbox1" name="terminos" class="check_cond"
                           value="1" {{old('terminos')? "checked":""}}>
                                    <span class="crear_check"></span> 
                                </label>
                            </div>
		                    @if ($errors->has('terminos'))
		                        <span class="invalid-feedback">Por favor, aceptá los términos y condiciones.</span>
		                    @endif
                        </div>
                        </div>
                    </div>   
                    <div class="form_ctrl input_ col_3 ">
                        <div class="align_center asoc_btn">
                        <button class="boton_redondeado resaltado_amarillo  mobile_100 custom_size "
		                        type="submit"
		                        id="boton_susc">
		                    Asociarme
		                </button>
                    	<div class="msg_load"><img alt="Ruedita de estado" src="{{url('recursos/ajax.gif')}}" class="ajaxgif hide" style="margin-top:10px;	margin-bottom:10px;" /></div> 
                        </div>
                    </div>
                </form>
                <div class="form_footer_term">
                    <span class="text_center color_gris">
                        Este sitio está protegido por reCAPTCHA y se aplican la <a href="https://policies.google.com/privacy" target="_blank">Política de privacidad</a> y los <a href="https://policies.google.com/terms" target="_blank">Términos de servicio</a> de Google.
                    </span>
                </div>
        </div>    
    </article>
</section>
@endsection  
@section('footer') 
    <script>
        $('select').on('change', function () {
        	console.log("test");
            if ($(this).val()) {
                $(this).css('font-style', 'normal');
                return $(this).css('color', 'black');
            }
        }); 
        function onSubmit(token) {
			document.getElementById('registro-form').submit(); 
			$(".msg_load").show(200); 
			$(".ajaxgif").removeClass('hide'); 
        }
    </script>
@endsection
