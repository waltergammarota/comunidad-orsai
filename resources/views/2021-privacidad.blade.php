@extends('2021-orsai-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Privacidad | Comunidad Orsai')
@section('description', 'Privacidad')

@section('content')

<section class="resaltado_gris pd_20_tp_bt ">
    <div class="contenedor ft_size form_rel">
        <div class="grilla_perfil ">
        <div class="miga_pan">
            <ul>
                <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel de usuario <span class="icon-right-open"></span></a></li>
                <li><a href="#" class="activo" rel="noopener noreferrer">Privacidad</a></li>
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
                    <h1 class="text_regular">Privacidad</h1>
                </div>
            </div>
            <div class="height_20"></div>
        </div>

            <div class="form_central_3 grilla_perfil grilla_panel_editable">
             
                <form action="#">
                    <div class="grilla_form border_bt_form">
                        <div class="form_ctrl input_ col_6">
                            <div class="align_left">
                            <div class="input_err">
                                <div class="check_div input_err obligatorio">
                                    <label class="checkbox-container letra_chica text_bold">
                                        He leido los términos y condiciones de la plataforma.
                                        <input type="checkbox" id="cbox1" class="check_cond" value="1" checked disabled> 
                                        <span class="crear_check"></span> 
                                    </label>
                                </div>
                                <div class="btn_leer_perfil">
                                    <a href="{{url('terminos-y-condiciones')}}" class="boton_redondeado btn_transparente">Leer</a>
                                </div>
                            </div>
                            </div>
                        </div>   
                    </div>
                    <div class="grilla_form border_bt_form">
                        <div class="form_ctrl input_ col_6">
                            <div class="align_left">
                            <div class="input_err">
                                <div class=" check_div input_err obligatorio">
                                    <label class="checkbox-container letra_chica text_bold">
                                        Estoy de acuerdo con la politica de privacidad.
                                        <input type="checkbox" id="cbox1" class="check_cond" value="1" checked disabled> 
                                        <span class="crear_check"></span> 
                                    </label>
                                </div>
                                <div class="btn_leer_perfil">
                                    <a href="{{url('politica-de-privacidad')}}" class="boton_redondeado btn_transparente">Leer</a>
                                </div>
                            </div>
                            </div>
                        </div>   
                    </div>
                    <div class="grilla_form">
                        <div class="form_ctrl input_ col_6">
                            <div class="align_left">
                            <div class="input_err">
                                <div class="check_div input_err obligatorio">
                                    <label class="checkbox-container letra_chica text_bold">
                                        Estoy de acuerdo con la politica de cookies.
                                        <input type="checkbox" id="cbox1" class="check_cond" value="1" checked disabled> 
                                        <span class="crear_check"></span> 
                                    </label>
                                </div>
                                <div class="btn_leer_perfil">
                                    <a href="{{url('politica-de-cookies')}}" class="boton_redondeado btn_transparente">Leer</a>
                                </div>
                            </div>
                            </div>
                        </div>   
                    </div>
                    <div class="height_35"></div>
                    <div class="form_ctrl input_">
                        <div class="align_left">
                            <button type="submit" id="boton_privacidad" class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg w_200px">Guardar</button>
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
        const buttonSubmit = $('#boton_privacidad');
        console.log(buttonSubmit);
        buttonSubmit.click(() => {
            $('#exito_msg').show();
        });
    </script>
@endsection