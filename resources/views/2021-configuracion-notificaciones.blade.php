@extends('2021-orsai-template')

@section('title', 'Notificaciones | Comunidad Orsai')
@section('description', 'Configuración de notificaciones')

@section('content')
<section class="resaltado_gris pd_20_tp_bt ">
    <div class="contenedor ft_size form_rel">
        <div class="grilla_perfil ">
        <div class="miga_pan">
            <ul>
                <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel de usuario <span class="icon-right-open"></span></a></li>
                <li><a href="#" class="activo" rel="noopener noreferrer">Notificaciones</a></li>
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
                    <h1 class="text_regular">¿Qué notificaciones querés recibir?</h1>
                </div>
            </div>
            <div class="height_20"></div>
        </div>

            <div class="form_central_3 grilla_perfil grilla_panel_editable">
            
                <form action="guardar-configuracion-notificaciones" method="POST" id="registro-form">
                @csrf
                    <div class="grilla_form border_bt_form">
                        <div class="form_ctrl input_ col_6 switch_contenedor">
                            <div class="align_left">
                            <div class="input_err">
                                <div class=" input_err obligatorio">
                                    <label class="switch_label letra_chica text_bold">
                                        <input type="checkbox" name="plataforma" class="check_switch" id="switch_1" value="1" {{$preferencias && $preferencias->plataforma == 1? 'checked': ''}}> 
                                        <label for="switch_1" class="toggle_checkbox">Toggle</label>
                                        <span>Notificaciones en la plataforma.</span>
                                    </label>
                                </div>
                                <div class="explica_notif">
                                    <span class="color_gris_claro">Recibir en el sitio anuncios, últimas novedades y actividad de tu cuenta.
                                    </span>
                                </div>
                            </div>
                            </div>
                        </div>   
                    </div>
                    <div class="grilla_form border_bt_form">
                        <div class="form_ctrl input_ col_6 switch_contenedor">
                            <div class="align_left">
                            <div class="input_err">
                                <div class=" input_err obligatorio">
                                    <label class="switch_label letra_chica text_bold">
                                        <input type="checkbox" name="correo" class="check_switch" id="switch_2" value="1" {{$preferencias && $preferencias->correo == 1? 'checked': ''}}> 
                                        <label for="switch_2" class="toggle_checkbox">Toggle</label>
                                        <span>Notificaciones por correo electrónico.</span>
                                    </label>
                                </div>
                                <div class="explica_notif">
                                    <span class="color_gris_claro">Recibir en tu casilla de correo anuncios, últimas novedades y otras cosas similares.
                                    </span>
                                </div>
                            </div>
                            </div>
                        </div>   
                    </div>
                    <div class="height_35"></div>
                    <div class="form_ctrl input_">
                        <div class="align_left">
                            <button type="submit" class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg w_200px" id="boton_notificaciones">Guardar</button>
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
        const buttonSubmit = $('#boton_notificaciones');
        console.log(buttonSubmit);
        buttonSubmit.click(() => {
            $('#exito_msg').show();
        });
    </script>
@endsection