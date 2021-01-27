@extends('2021-orsai-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Preferencias | Comunidad Orsai')
@section('description', 'Preferencias')

@section('content')

<section class="resaltado_gris pd_20_tp_bt ">
    <div class="contenedor ft_size form_rel">
        <div class="grilla_perfil ">
        <div class="miga_pan">
            <ul>
                <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel de usuario <span class="icon-right-open"></span></a></li>
                <li><a href="#" class="activo" rel="noopener noreferrer">Preferencias generales </a></li>
            </ul>
            <div class="height_20"></div>
        </div>
        </div>
    </div>
    <article class="contenedor ft_size form_rel pd_15_extra">
        <div class="interna_panel_blanco">
        <div class="form_central_3">
            <div class="border_bt_form">
                <div class="titulo titulo_sin_mg">
                    <h1 class="text_regular">Preferencias generales</h1>
                </div>
            </div>
            <div class="height_35"></div>
        </div>

            <div class="form_central_3 grilla_perfil grilla_panel_editable">
            
                <form action="#">
                    <div class="grilla_form">
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Idioma</label>
                                <div class="select">
		                            <select name='idioma' id='idioma'
		                                    class=''>
		                                @foreach($idiomas as $idiomaOpcion)
		                                    <option
		                                        value='{{$idiomaOpcion}}'
		                                        {{$preferencias && strtolower($preferencias->idioma) == strtolower($idiomaOpcion)? "selected":""}}
		                                    >{{$idiomaOpcion}}</option>
		                                @endforeach
		                            </select>
                                    <div class="select__arrow"></div>
                                </div> 
                            </div>
                        </div>
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Método de pago</label>
                                <div class="select">
		                            <select name='pago' id='pago'
		                                    class=''>
		                                @foreach($pagos as $pagoOpcion)
		                                    <option
		                                        value='{{$pagoOpcion}}'
		                                        {{$preferencias && strtolower($preferencias->pago) == strtolower($pagoOpcion)? "selected":""}}
		                                    >{{$pagoOpcion}}</option>
		                                @endforeach
		                            </select>
                                    <div class="select__arrow"></div>
                                </div> 
                            </div>
                        </div>  
                    </div>
                    <div class="grilla_form">
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Moneda preferida</label>
                                <div class="select">
		                            <select name='moneda' id='moneda'
		                                    class=''>
		                                @foreach($monedas as $monedaOpcion)
		                                    <option
		                                        value='{{$monedaOpcion}}'
		                                        {{$preferencias && strtolower($preferencias->moneda) == strtolower($monedaOpcion)? "selected":""}}
		                                    >{{$monedaOpcion}}</option>
		                                @endforeach
		                            </select>
                                    <div class="select__arrow"></div>
                                </div> 
                            </div>
                        </div>
                        <div class="form_ctrl input_ col_3">
                            <div class="input_err">
                                <label class="text_medium">Zona horaria</label>
                                <div class="select">
		                            <select name='zona' id='zona'
		                                    class=''>
		                                @foreach($zonas as $key => $zonaOpcion)
		                                    <option
		                                        value='{{$key}}'
		                                        {{$preferencias && strtolower($preferencias->zona) == strtolower($key)? "selected":""}}
		                                    >{{$zonaOpcion}}</option>
		                                @endforeach
		                            </select>
                                    <div class="select__arrow"></div>
                                </div> 
                            </div>
                        </div>  
                    </div>
                    <div class="height_20"></div>
                    <div class="form_ctrl input_">
                        <div class="align_left">
                            <button type="submit" class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg w_200px" id="boton_preferencias">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>    
        </div>    
    </article> 
</section> 

<div id="exito_msg" class="popup">
    <div>
        <div id="texto_exito">
            <span>Guardando</span>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        const buttonSubmit = $('#boton_preferencias');
        console.log(buttonSubmit);
        buttonSubmit.click(() => {
            const idioma = $('#idioma').val();
            const moneda = $('#moneda').val();
            const pago = $('#pago').val();
            const zona = $('#zona').val();
            const formData = new FormData();
            formData.append('idioma', idioma);
            formData.append('moneda', moneda);
            formData.append('pago', pago);
            formData.append('zona', zona);
            const url = '{{url('guardar-configuracion-preferencias')}}';
            $('#exito_msg').show();
            axios({
                url: url,
                method: 'post',
                data: formData,
                headers: {
                    'accept': 'application/json',
                    'Accept-Language': 'en-US,en;q=0.8',
                    'Content-Type': `multipart/form-data; boundary=${formData._boundary}`
                }
            }).then(response => {
                const get_modal_exito = document.getElementById("exito_msg");
                const efecto1 = setTimeout(close(get_modal_exito), 600);
            }).catch((error) => {
                const get_modal_exito = document.getElementById("exito_msg");
                const efecto1 = setTimeout(close(get_modal_exito), 600);
            });
        });
    </script>
@endsection