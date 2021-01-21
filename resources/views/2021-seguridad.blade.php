@extends('2021-orsai-template')

@section('title', 'Seguridad | Comunidad Orsai')
@section('description', 'Seguridad')

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
                <li><a href="#" class="activo" rel="noopener noreferrer">Seguridad</a></li>
            </ul>
        </div>
        </div>
    </div>
<div class="contenedor pd_20_prueba ft_size form_rel">
    @include('2021-menu-informacion-personal',["activo" => "seguridad"])
    <div class="grilla_perfil">
        <div id="seguridad" class="fondo_blanco">
            <div class="titulo">
                <h1 class="text_regular">Seguridad</h1>
            </div>
            <div class="mg_20"></div>
            <form action="#">
            <div class=" border_bt_form">
                <div class="grilla_form">
                    <div class="form_ctrl input_ col_2">
                        <div class="input_err">
                            <label class="text_medium">Prefijo país</label>
                            <div class="select">
                                <select id ="prefijo_pais" name = "xxxxx" >
                                        <option value="xx" selected="selected">Argentina (+54)</option>
                                        <option value="xxxx">Pais 2</option>
                                        <option value="xxx">Pais 3</option>
                                        <option value="xxxx">Pais 4</option>
                                </select>
                                <div class="select__arrow"></div>
                            </div>
                        </div>
                    </div> 
                    <div class="form_ctrl input_ inp_y_btn col_4">
                        <div class="input_err">
                            <label class="text_medium">Número de celular</label>
                            <input type="text" name="titulo" class="obligatorio" placeholder="1155555555" value="1155555555" disabled>
                            <span class="edit_link link_subrayado_regular">Editar</span>
                            <span class="icono_aviso icon-check_circle"></span>
                            <span class="icono_aviso icon-exclamacion_circle"></span>
                        </div>
                        <div class="button_lf_side">
                            <button id="val_tel" class="boton_redondeado text_bold">Validar teléfono</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grilla_form">
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Contraseña actual</label>
                        <input type="password" name="mail" class="obligatorio" placeholder="********">
                    </div>
                </div>
            </div>
            <div class="grilla_form">
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Nueva contraseña</label>
                        <input type="password" name="titulo" class="obligatorio" placeholder="********">
                        <span class="form_min_text color_gris">Mínimo 8 caracteres</span>
                    </div>
                </div>
                <div class="form_ctrl input_ col_3">
                    <div class="input_err">
                        <label class="text_medium">Repita nueva contraseña</label>
                        <input type="password" name="mail" class="obligatorio" placeholder="********">
                        <span class="form_min_text color_gris">Mínimo 8 caracteres</span>
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


/*Editar campo deshabilitado*/
$(".edit_link").click(function(e){
    $(this).siblings('input').attr('disabled', false);
});


/* ANIMACION BOTON VALIDAR TELEFONO MI PERFIL */
$('#val_tel').click(function(){
    //   $('#val_tel').hide();
    const color_btn = $('#val_tel').css("color");
    $(this).siblings('.input_err').find('input').attr('disabled', true);
    const btn_=$('#val_tel');
    
      $(btn_).css("color","transparent");
      $(btn_).addClass('btn_loader');
        setTimeout(function () { 
        $(btn_).removeClass('btn_loader');
        $(btn_).css("color", color_btn);
        // $('#val_tel').show();
      }, 2000);
      setTimeout(function () {
        //  Si es Ok  
        // $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-check_circle').fadeIn();

        //   Si es error
        $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-exclamacion_circle').fadeIn();
    }, 2000);

    setTimeout(function () {
        //  Si es Ok  
        // $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-check_circle').fadeIn();

        //   Si es error 
        $(btn_).parent('.button_lf_side').siblings('.input_err').find('.icono_aviso.icon-exclamacion_circle').fadeOut();
    }, 3000);
    });


</script>
@endsection