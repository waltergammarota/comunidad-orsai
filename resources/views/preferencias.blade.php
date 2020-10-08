@extends('orsai-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Preferencias | Comunidad Orsai')
@section('description', 'Preferencias')

@section('content')
    <section id="intro" class="contenedor intro_gral panel info_personal">
        <div class="info_per_left">
            <div class="">
                <div id="links_back">
                    <a href="{{url('panel')}}">Panel de usuario</a>
                    <span>Preferencias generales</span>
                </div>
                <div id="user_alias">
                    <h1>Preferencias generales</span>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section id="panel_user_profile" class="contenedor">
        <div class="form_left">

            <form action="#">
                <div class="input_err select">
                    <label class='oculto'>Idioma</label>
                    <div class="in_sp editar">
                        <div class="arm_sel">
                            <select name='idioma' id='idioma'
                                    class=''>
                                @foreach($idiomas as $idiomaOpcion)
                                    <option
                                        value='{{$idiomaOpcion}}'
                                        {{$preferencias && strtolower($preferencias->idioma) == strtolower($idiomaOpcion)? "selected":""}}
                                    >{{$idiomaOpcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

            <form action="#">
                <div class="input_err select">
                    <label class='oculto'>Moneda preferida</label>
                    <div class="in_sp editar">
                        <div class="arm_sel">
                            <select name='moneda' id='moneda'
                                    class=''>
                                @foreach($monedas as $monedaOpcion)
                                    <option
                                        value='{{$monedaOpcion}}'
                                        {{$preferencias && strtolower($preferencias->moneda) == strtolower($monedaOpcion)? "selected":""}}
                                    >{{$monedaOpcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

        </div>

        <div class="form_right">

            <form action="#">
                <div class="input_err select">
                    <label class='oculto'>Método de pago</label>
                    <div class="in_sp editar">
                        <div class="arm_sel">
                            <select name='pago' id='pago'
                                    class=''>
                                @foreach($pagos as $pagoOpcion)
                                    <option
                                        value='{{$pagoOpcion}}'
                                        {{$preferencias && strtolower($preferencias->pago) == strtolower($pagoOpcion)? "selected":""}}
                                    >{{$pagoOpcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>

            <form action="#">
                <div class="input_err select">
                    <label class='oculto'>Zona horaria</label>
                    <div class="in_sp editar">
                        <div class="arm_sel">
                            <select name='zona' id='zona'
                                    class=''>
                                @foreach($zonas as $key => $zonaOpcion)
                                    <option
                                        value='{{$key}}'
                                        {{$preferencias && strtolower($preferencias->zona) == strtolower($key)? "selected":""}}
                                    >{{$zonaOpcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
        </div>

        <div id="boton_submit">
            <button
                class="subrayado resaltado_amarillo text_bold"
                id="boton_preferencias">
                Guardar
            </button>
        </div>

    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>

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
