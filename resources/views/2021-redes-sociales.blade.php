@extends('2021-orsai-template')

@section('title', 'Redes sociales | Comunidad Orsai')
@section('description', 'Redes sociales')

@section('header')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url("admin/plugins/fontawesome-free/css/all.min.css")}}">
    <script src="https://cdn.jsdelivr.net/npm/libphonenumber-js@1.9.6/bundle/libphonenumber-min.js"></script>
@endsection

@section('content')

<section class="resaltado_gris pd_20 pd_20_tp_bt pd_20_prueba">
    <div class="contenedor ft_size form_rel">
        <div class="grilla_perfil">
        <div class="miga_pan">
            <ul>
                <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel de usuario <span class="icon-right-open"></span></a></li>
                <li><a href="{{url('perfil')}}" rel="noopener noreferrer">Información personal <span class="icon-right-open"></span></a></li>
                <li><a href="#" class="activo" rel="noopener noreferrer">Redes Sociales</a></li>
            </ul>
        </div>
        </div>
    </div>
<div class="contenedor pd_20_prueba ft_size form_rel">
    @include('2021-menu-informacion-personal',["activo" => "redes-sociales"])
    <div class="grilla_perfil">
        <div id="redes_sociales" class="fondo_blanco">
            <div class="titulo">
                <h1 class="text_regular">Redes sociales</h1>
            </div>
            <div class="mg_20"></div>
            <form action="#">
            <div class="grilla_form">
                <div class="form_ctrl input_ inp_y_btn col_3">
                    <div class="input_err">
                        <label class="text_medium">Facebook</label>
                        <input type="text" name="titulo" class="obligatorio" placeholder="Nombre de Usuario">
                        <span class="icono_aviso icon-check_circle"></span>
                        <span class="icono_aviso icon-exclamacion_circle"></span>
                    </div>
                    <div class="button_lf_side">
                        <button class="conectar boton_redondeado btn_transparente text_bold ">Conectar</button>
                    </div>
                </div>
                <div class="form_ctrl input_ inp_y_btn col_3">
                    <div class="input_err">
                        <label class="text_medium">Twitter</label>
                        <input type="text" name="titulo" class="obligatorio" placeholder="@nombredeusuario">
                        <span class="icono_aviso icon-check_circle"></span>
                        <span class="icono_aviso icon-exclamacion_circle"></span>
                    </div>
                    <div class="button_lf_side">
                        <button class="conectar boton_redondeado btn_transparente text_bold ">Conectar</button>
                    </div>
                    <span class="error">El campo Nombre es obligatorio.</span>
                </div>            

        
            </div>
            <div class="grilla_form">
                <div class="form_ctrl input_ inp_y_btn col_3">
                    <div class="input_err">
                        <label class="text_medium">Instagram</label>
                        <input type="text" name="titulo" class="obligatorio" placeholder="@instagram">
                    </div>
                    <div class="button_lf_side">
                        <button class="conectar boton_redondeado text_bold ">Desconectar</button>
                    </div>
                </div>
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Linkedin</label>
                        <input type="text" name="mail" class="obligatorio" placeholder="URL">
                    </div>
                </div>
        
            </div>
            <div class="grilla_form">
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Portfolio (Behance)</label>
                        <input type="text" name="titulo" class="obligatorio" placeholder="URL">
                    </div>
                </div>
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Sitio personal</label>
                        <input type="text" name="mail" class="obligatorio" placeholder="URL">
                    </div>
                </div>
            </div>
            <div class="grilla_form">
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Medium</label>
                        <input type="text" name="titulo" class="obligatorio" placeholder="URL">
                    </div>
                </div>
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Otra (Pinterest, Tik Tok, etc)</label>
                        <input type="text" name="mail" class="obligatorio" placeholder="URL">
                    </div>
                </div>
            </div>
            <div class="form_ctrl input_">
                <div class="align_right">
                    <button type="submit" class="boton_redondeado resaltado_amarillo text_bold    pd_50_lf_rg">Guardar</button>
                </div>
            </div>
        </form>
        </div>
    </div>

</div>
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


/* Menu logueado */
if ($(window).width() < 1040) {
    $( "#insertar_perfil" ).prepend($( "#clonar_perfil" ));
}
$( window ).resize(function() {
    if( $(window).width() < 1040 ){
        $( "#insertar_perfil" ).prepend($( "#clonar_perfil" ));
    }else{
        $( "#clonar_perfil" ).appendTo( ".logueado" );       
}
});


/* ANIMACION BOTON REDES SOCIALES MI PERFIL */
    $('.conectar').click(function(){
    //   $('#val_tel').hide();
    const btn_=$(this);
    const color_btn = $(this).css("color");
    $(this).siblings('.input_err').find('input').attr('disabled', true);
    
    
      $(btn_).css("color","transparent");
      $(btn_).addClass('btn_loader');
        setTimeout(function () { 
        $(btn_).removeClass('btn_loader');
        $(btn_).css("color", color_btn);
        // $('#val_tel').show();
      }, 2000);
      setTimeout(function () {
        //  Si es Ok
        if ($(btn_).hasClass('btn_transparente')){
            $(btn_).html('Desconectar');
            $(btn_).removeClass('btn_transparente');
        }else{
            $(btn_).html('Conectar');
            $(btn_).addClass('btn_transparente');
        }
        $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-check_circle').fadeIn();

        //   Si es error
        // $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-exclamacion_circle').fadeIn();
    }, 2000);

    setTimeout(function () {
        //  Si es Ok  
        $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-check_circle').fadeOut();

        //   Si es error 
        // $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-exclamacion_circle').fadeOut();
    }, 3000);
    });    



</script>
@endsection