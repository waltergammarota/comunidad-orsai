@extends('2021-orsai-template')

@section('title', 'Formación y experiencia | Comunidad Orsai')
@section('description', 'Formación y experiencia')

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
                <li><a href="#" class="activo" rel="noopener noreferrer">Formación y experiencia</a></li>
            </ul>
        </div>
        </div>
    </div>
<div class="contenedor pd_20_tp_bt ft_size form_rel">
    @include('2021-menu-informacion-personal',["activo" => "formacion-y-experiencia"])
    
    <div class="grilla_perfil">
        <div id="formacion" class="fondo_blanco">
            <div class="titulo">
                <h1 class="text_regular">Formación y experiencia</h1>
            </div>
            <div class="mg_20"></div>
            <form action="#">
            <div class="border_bt_form">                
                <div class="form_ctrl input_">
                    <div class="input_err">
                        <label class="text_medium">Ocupación actual</label>
                        <div class="select">
                            <select id ="ocupacion" class="form_select">
                                    <option value="xax" selected>Elegir...</option>
                                    <option value="ocupacion_1">ocupacion 1</option>
                                    <option value="ocupacion_2">ocupacion 2</option>
                                    <option value="ocupacion_3">ocupacion 3</option>
                                    <option value="ocupacion_4">ocupacion 4</option>
                            </select>
                            <div class="select__arrow"></div>
                        </div>
                        <span class="form_min_text color_gris cant_max_sel" data-cantop="5" data-texto="Agregá máximo 5 ítems" data-aviso="Ya agregaste suficientes items">Agregá máximo 5 ítems</span>
                    </div>
                </div>
            </div>
            <div class="border_bt_form"> 
            <div class="grilla_form">
                <div class="form_ctrl col_3">
                    <div class="input_err">
                        <label class="text_medium">Nombre de la empresa donde trabajás actualmente</label>
                        <input type="text" name="titulo" class="obligatorio" placeholder="Usuario">
                    </div>
                </div>
                <div class="form_ctrl col_3">
                    <div class="input_err">
                        <label class="text_medium">Sector en el que trabajás actualmente</label>
                        <div class="select">
                            <select id ="sector_empresa" name = "xxxxx" >
                                    <option value="xxq" selected="selected">Elegir...</option>
                                    <option value="xxxxs">Sector 2</option>
                                    <option value="xxxxw">Sector 3</option>
                                    <option value="xxxx1">Sector 4</option>
                            </select>
                            <div class="select__arrow"></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="border_bt_form"> 
            <div class="form_ctrl input_">
                <div class="input_err">
                    <label class="text_medium">Formación alcanzada</label>
                    <div class="select">
                        <select id ="formacion_alc" class="form_select">
                                <option value="xxaaq" selected>Elegir...</option>
                                <option value="formacion_1">formacion 1</option>
                                <option value="formacion_2">formacion 2</option>
                                <option value="formacion_3">formacion 3</option>
                                <option value="formacion_4">formacion 4</option>
                        </select>
                        <div class="select__arrow"></div>
                    </div>
                    <span class="form_min_text color_gris cant_max_sel" data-cantop="5" data-texto="Agregá máximo 5 ítems" data-aviso="Ya agregaste suficientes items">Agregá máximo 5 ítems</span>
                </div>
            </div>
            </div>
            <div class="form_ctrl input_">
                <div class="input_err">
                    <label class="text_medium">Idiomas que hablas</label>
                    <div class="select">
                        <select id ="idiomas" class="form_select">
                                <option selected disabled>Elegir...</option>
                                <option value="Ingles">Ingles</option>
                                <option value="Frances">Frances</option>
                                <option value="Chino">Chino</option>
                                <option value="Portugues">Portugues</option>
                        </select>
                        <div class="select__arrow"></div>
                    </div>
                    <span class="form_min_text color_gris cant_max_sel" data-cantop="5" data-texto="Agregá máximo 5 ítems" data-aviso="Ya agregaste suficientes items">Agregá máximo 5 ítems</span>

                </div>
            </div>
            <div class="form_ctrl input_">
                <div class="align_right">
                    <button  type="submit"  class="boton_redondeado resaltado_amarillo text_bold pd_50_lf_rg">Guardar</button>
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



/* GLOBO SELECT crea elimina */
function eliminar_globo(ev){
    var min_cant = $(ev).parent().parent().find($('.cant_max_sel')).data('cantop');
    min_cant = min_cant + 1;
    
    $(ev).parent().parent().find($('.cant_max_sel')).data('cantop', min_cant);

    $(ev).parent().parent().find('.form_select option[value="'+ $(ev).parent().data('selopt')+'"]').attr("disabled", false);
    $(ev).parent().fadeOut(100, function() {
        $(ev).parent().remove();
    });
    if ($(ev).parent().parent().find($('.cant_max_sel')).hasClass("error")){
        
        $(ev).parent().parent().find($('.cant_max_sel')).removeClass("error");
        $(ev).parent().parent().find($('.cant_max_sel')).text($(ev).parent().parent().find($('.cant_max_sel')).data("texto"));

    }

};


$(".form_select").on('change', function (e) {

    var max_cant = $(this).parent().parent().find($('.cant_max_sel')).data('cantop');
    if(max_cant > 0){
        max_cant -=1;
        if ($(this).parent().parent().find($('.cant_max_sel')).hasClass("error")){
        
        $(this).parent().parent().find($('.cant_max_sel')).removeClass("error");
        $(this).parent().parent().find($('.cant_max_sel')).text($(this).parent().parent().find($('.cant_max_sel')).data("texto"));

            // Agregá máximo 5 ítems
        }
        $(this).parent().parent().find($('.cant_max_sel')).data('cantop', max_cant);

        $(this).parent().parent().append($('<span class="globo_select resaltado_gris color_gris" data-selopt="'+$( this).find("option:selected").val()+'"><input type="hidden" name="'+$( this).attr('id')+'[]" value="'+$( this).find("option:selected").text()+'">'+ $( this).find("option:selected").text() +' <span class="globo_cerrar" onclick="eliminar_globo(this)">X</span></span>'));

        $( this).find("option:selected").attr('disabled', true);
        $( this).find("option:selected").removeAttr('selected');
        $(this).prop('selectedIndex',0);
        $(this).find("option:first").attr("selected", true);
    }else{
        $(this).parent().parent().find($('.cant_max_sel')).addClass("error");
        $(this).parent().parent().find($('.cant_max_sel')).text($(this).parent().parent().find($('.cant_max_sel')).data("aviso"));
    }
});
</script>
@endsection