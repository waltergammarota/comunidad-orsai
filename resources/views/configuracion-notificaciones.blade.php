@extends('orsai-template')

@section('title', 'Notificaciones | Comunidad Orsai')
@section('description', 'Configuración de notificaciones')

@section('content')
    <section id="intro" class="contenedor intro_gral panel info_personal">
        <div class="info_per_left">
            <div class="">
                <div id="links_back">
                    <a href="{{url('panel')}}">Panel de usuario</a>
                    <span>Notificaciones</span>
                </div>
                <div id="user_alias">
                    <h1>¿Qué notificaciones queres recibir?</span>
                    </h1>
                    <p>Siempre te vamos a contar las novedades más recientes de Fundación Orsai, pero podés elegir qué es lo que más te interesa saber. </p>
                </div>
            </div>
        </div>
    </section>

    <section id="registro_js" class="contenedor">
        <form action="guardar-configuracion-notificaciones" method="POST" id="registro-form">
            @csrf
            <div class="contenedor_campos">
                <div id="check_div" class="obligatorio"
                     style="padding-right: 0px !important;"> 
 
                    <label class="checkbox-container letra_chica checkbox_toggle"> 
                        <input type="checkbox" id="cbox1" name="plataforma" class="cb cb1"
                               value="1" {{$preferencias && $preferencias->plataforma == 1? 'checked': ''}}> 
                          <i></i> 
                          <span>Notificaciones en la plataforma</span> 
                    </label> 
                    <span class="notif_detail">Recibir en el sitio anuncios, últimas novedades y actividad de tu cuenta.</span>
                </div>
 

                <div id="check_div" class="obligatorio"
                     style="padding-right: 0px !important;">

                    <label class="checkbox-container letra_chica checkbox_toggle"> 
                        <input type="checkbox" id="cbox1" name="correo" class="cb cb1"
                               value="1" {{$preferencias && $preferencias->correo == 1? 'checked': ''}}> 
                          <i></i> 
                          <span>Notificaciones por correo electrónico</span> 
                    </label> 
                    <span class="notif_detail">Recibir en tu casilla de correo anuncios, últimas novedades y otras cosas similares.</span>
                </div>
                <br/>
                <br/>
                <div id="boton_submit">
                    <button
                        class="subrayado resaltado_amarillo text_bold marginTop10"
                        id="boton_notificaciones">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
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
        const buttonSubmit = $('#boton_notificaciones');
        console.log(buttonSubmit);
        buttonSubmit.click(() => {
            $('#exito_msg').show();
        });
    </script>
@endsection
