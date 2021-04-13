@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')

@section('content')
<section class="inscripcion-cuento">
    <div class="contenedor">
        <div class="hero">
            <div class="content-hero">
                <p class="pills">Votación</p>
                <h2 class="title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h2>
                <p class="subtitle"><strong class="color_amarillo">¿Estás ok para ser jurado?</strong> Solo tenés que tener fichas disponibles y muchas ganas de apostarle a las historias que creas mejores. Ya podés empezar.</p>
                <p><strong class="color_amarillo">Recordá que los primeros clics son gratis, pero para seguir avanzando en tus veredictos vas a necesitar fichas.</strong></p>
            </div>
            <img src="https://dev.comunidadorsai.org/recursos/front2021/fichas-donaciones.jpg" class="img_fondo" alt="">
        </div> 
        
        <nav class="hero-nav concurso_nav"> 
            <div class="hero-nav-content  owl-carousel owl-theme">
                <div class="hero-nav-item linea">
                    <div class="icon">
                        <img src="{{url('estilos/front2021/assets/reloj.svg')}}" alt="Cierre de votación">
                    </div>
                    <div class="content-nav column">
                        <div>
                            <span>Cierre de votación</span>
                            <span class="big-number_2">46:10:22</span>

                        </div>            
                    </div>
                </div>
                <div class="hero-nav-item linea">
                    <div class="icon">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Pozo acumulado">
                    </div>
                    <div class="content-nav column">

                        <div>
                            <span>Pozo acumulado</span>
                            <div class="numero_dividido">
                                <span class="big-number_2">4502 </span>
                                <span class="_barlow_text">Fichas</span>
                            </div>  
                        </div>      
                    </div>
                </div>
                <div class="hero-nav-item linea">
                    <div class="icon">
                        <img src="{{url('estilos/front2021/assets/ficha.svg')}}" alt="Modo Pozo">
                    </div>
                    <div class="content-nav">
                        <span class="medio">Modo <br/> <strong>Pozo</strong></span>
                    </div>
                </div>
                <div class="hero-nav-item linea">
                    <div class="content-nav column bajar">
                        <div class="numero_dividido">
                            <span class="big-number_3">46 </span>
                            <span>Cuentos <br/>enviados</span>
                        </div>       
                    </div>
                    <div class="content-nav column  bajar" >

                        <div class="numero_dividido">
                            <span class="big-number_3">46 </span>
                            <span>Participantes </span>

                        </div>    
                    </div>
                </div> 
                <div class="hero-nav-item">
                    <div class="content-nav center bloqued">
                        <a href="#" class="btn-postulacion"> <span class="icon-candado "></span> Estadísticas</a>
                    </div>
                </div> 
            </div>
        </nav>
        <div class="subir_postulacion"> 
            <a href="#" class="btn-postulacion">Estadisticas</a> 
        </div>
        
    </div>
</section>    
<main class="cd-main-content resaltado_gris">
<div class="cd-tab-filter-wrapper"> 
        <div class="cd-tab-filter">
           <ul class="filtro_menu">
               <li class="color_blanco"> <span id="open_menu"> <span class="icon icon-filtro"></span><span class="text_tit_submenu">Filtros </span><span class="color_amarillo cant_filtros_aplicados">(4)</span></span>
                <form action="#" id="form_filtro" autocomplete="off">
                    <ul class="sub_menu">
                        <li> <span class="icon icon-cancel"></span></li>
                        <li>
                            Mis filtros
                            <div class="input_err tag-container">

                            </div>
                            
                        </li>
                        <li>
                            <div class="border_bt_form">
                                <div class="form_ctrl input_">
                                    <div class="input_err">
                                        <label class="text_medium">Buscar</label>
                                        <input type="text" name="palabras_buscar" placeholder="palabra" class="obligatorio">
                                    </div>
                                </div>
                            </div>    
                        </li>
                        <li>
                            <div class="form_ctrl input_">
                                <div class="input_err">
                                    <label class="text_medium">Categorias</label>
                                    <div class="select">
                                        <select id ="categorias" name = "categorias" >
                                                <option value="Tragedia">Tragedia</option>
                                                <option value="Drama">Drama</option>
                                                <option value="Terror">Terror</option>
                                                <option value="Romantico">Romantico</option>
                                        </select>
                                        <div class="select__arrow"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="titulo_checkbox">
                                <span class="text_medium">Ver</span>
                            </div> 
                            <div class="grilla_form sin_margin">
                                <div class="form_ctrl input_ col_6">
                                    <div class="align_left">
                                    <div class="input_err">
                                        <div class="check_div input_err obligatorio">
                                            <label class="checkbox-container letra_chica text_bold">
                                                Destrabados
                                                <input type="checkbox" value="Destrabados" id="cbox3" name="filtro3" class="check_cond"> 
                                                <span class="crear_check"></span> 
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                                </div>   
                            </div>
                        </li>  
                    </ul>
                </form>
            </li>
           </ul><ul class="cd-filters">                

            <li class="filter" data-orden="1">
              <a class="" href="ronda_1" data-type="all">
                  <span class="icon icon-carpeta_cerrada"></span> 
                  Leit motivs 
                  <span class="counter_">(12)</span>
              </a> 
           </li>

          <li class="filter" data-filter=".color-1" data-orden="2">
              <a href="ronda_2" data-type="color-1" class="">
                  <span class="icon icon-carpeta_cerrada"></span> 
                  Descripciones 
                  <span class="counter_">(3)</span>
                </a>
            </li>
            <li class="filter" data-filter=".color-2" data-orden="3"><a href="ronda_3" data-type="color-2"  class="selected">
              <span class="icon icon-carpeta_abierta"></span> 
              Cuentos <span class="counter_">(3)</span>
            </a>
        </li>
       </ul> <!-- cd-filters -->
     <div class="desp_mobile_tab">
         <span class="icon  icon-angle-down tabs_cli"></span>
     </div>



        </div> <!-- cd-tab-filter --> 
</div> <!-- cd-tab-filter-wrapper -->
<section class="resaltado_gris pd_20_ pd_20_tp_bt ">
    <div class="contenedor titulo_leit_motivs">
    <h2>Votá descripciones</h2>
    <p class=""><strong>¡Ya podés seguir votando!</strong> Actualmente elegiste ver las descripciones de estos 2 cuentos. Si querés leer el cuento completo te costará tres fichas. Recordá que estarás poniendo esas fichas en el cuento al que le hagas clic.</p>
    </div>
    <div class="contenedor filtros_aplicados">
        <div>
            <span>4 filtros aplicados  / 18 postulaciones encontradas</span>
        </div>
        <div>
            <span><span class="icon icon-borrar_filtro"></span> Limpiar filtros</span>
        </div>
    </div>
 </section>
 <section class="pd_20_">
    <div class="contenedor titulo_leit_motivs ">
        <div class="cont_card_leitmotiv">
                        <!-- Card -->
                        <div class="card_leitmotiv_2 card_rn_3">
                            <div class="card-leitmotiv__" href="#">
                                <span class="id_card">005</span>
                                <h3 class="title_card">Geppeto era un humilde carpintero que siempre había deseado tener un hijo y se le ocurrió la idea de tallar en la madera una marioneta a un niño. Un día, una hada cumple el sueño de Geppeto dándole vida a la marioneta y convirtiéndola en un niño de verdad al que Geppeto llamó Pinocho. </h3>
                                <span class="cat_card"><span>tragedia</span> <span>educacion</span></span>
                                <div class="rn_3 selecc_fichas">
                                    <p>Ponele fichas</p>
                                    <div class="rn_flex_fichas">
            
                                    
                                    <div class=" fichas_">
                                        <div class="fichin apostado">
                                            <span class="icon-ficha"></span>
                                        </div>
                                        <div class="fichin apostado">
                                            <span class="icon-ficha"></span>
                                        </div>
                                        <div class="fichin apostado">
                                            <span class="icon-ficha"></span>
                                        </div>
                                        <div class="fichin ">
                                            <span class="icon-ficha"></span>
                                        </div>
                                        <div class="fichin ">
                                            <span class="icon-ficha"></span>
                                        </div>
                                    </div>
                                    <div>
                                        <form action="#">
                                            <input type="hidden" name="apostar_fichas"  id="ap_fichas">
                                            <div class="form_ctrl input_">
                                                <div class="align_center">
                                                    <button class="boton_redondeado     resaltado_black color_amarillo  pd_25_lf_rg" disabled>Apostar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div>
                                        <a href="cuento_corto_" class="">Leer cuento <span class="icon-flecha_leitmotiv"></span></a>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
            <!-- Card -->
            <div class="card_leitmotiv_2 card_rn_3">
                <div class="card-leitmotiv__" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">Geppeto era un humilde carpintero que siempre había deseado tener un hijo y se le ocurrió la idea de tallar en la madera una marioneta a un niño. Un día, una hada cumple el sueño de Geppeto dándole vida a la marioneta y convirtiéndola en un niño de verdad al que Geppeto llamó Pinocho. </h3>
                    <span class="cat_card"><span>tragedia</span> <span>educacion</span></span>
                    <div class="rn_3 selecc_fichas">
                        <p>Ponele fichas</p>
                        <div class="rn_flex_fichas">

                        
                        <div class=" fichas_">
                            <div class="fichin apostado">
                                <span class="icon-ficha"></span>
                            </div>
                            <div class="fichin">
                                <span class="icon-ficha"></span>
                            </div>
                            <div class="fichin">
                                <span class="icon-ficha"></span>
                            </div>
                            <div class="fichin ">
                                <span class="icon-ficha"></span>
                            </div>
                            <div class="fichin ">
                                <span class="icon-ficha"></span>
                            </div>
                        </div>
                        <div>
                            <form action="#">
                                <input type="hidden" name="apostar_fichas"  id="ap_fichas">
                                <div class="form_ctrl input_">
                                    <div class="align_center">
                                        <button class="boton_redondeado     resaltado_black color_amarillo  pd_25_lf_rg" disabled>Apostar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <a href="cuento_corto_" class="">Leer cuento <span class="icon-flecha_leitmotiv"></span></a>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
                    <!-- Card -->
                    <div class="card_leitmotiv_2 card_rn_3">
                        <div class="card-leitmotiv__" href="#">
                            <span class="id_card">008</span>
                            <h3 class="title_card">Geppeto era un humilde carpintero que siempre había deseado tener un hijo y se le ocurrió la idea de tallar en la madera una marioneta a un niño. Un día, una hada cumple el sueño de Geppeto dándole vida a la marioneta y convirtiéndola en un niño de verdad al que Geppeto llamó Pinocho. </h3>
                            <span class="cat_card"><span>tragedia</span> <span>educacion</span></span>
                            <div class="rn_3 selecc_fichas">
                                <p>Ponele fichas</p>
                                <div class="rn_flex_fichas max_apostado">
        
                                
                                <div class=" fichas_">
                                    <div class="fichin apostado">
                                        <span class="icon-ficha"></span>
                                    </div>
                                    <div class="fichin apostado">
                                        <span class="icon-ficha"></span>
                                    </div>
                                    <div class="fichin apostado">
                                        <span class="icon-ficha"></span>
                                    </div>
                                    <div class="fichin apostado">
                                        <span class="icon-ficha"></span>
                                    </div>
                                    <div class="fichin apostado">
                                        <span class="icon-ficha"></span>
                                    </div>
                                </div>
                                <div class="cont_form">
                                    <form action="#">
                                        <input type="hidden" name="apostar_fichas" >
                                        <div class="form_ctrl input_">
                                            <div class="align_center">
                                                <button class="boton_redondeado     resaltado_black color_amarillo  pd_25_lf_rg" disabled>Apostar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <a href="cuento_corto_" class="">Leer cuento <span class="icon-flecha_leitmotiv"></span></a>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>          
        </div>
    </div> 
 </section>
 </main>

<!-- Ventanas modales -->

<div id="ex1" class="modal">
<div class="modal_flex">
    <div>
       <img src="src/assets/svg/modal_star.svg" alt="">
    </div>
    <div>
        <p><strong>¡Convertite en Jurado VIP!</strong> <br/> 
           Te faltan apostar [50 fichas] para ver las estadísticas del concurso.</p>
    </div>
</div>
<div class="form_ctrl input_">
   <div class="align_center">
       <a href="#" class="boton_redondeado resaltado_amarillo width_100">Seguir apostando</a>
   </div>
</div>
</div>


<div id="ex2" class="modal">
<div class="modal_flex">
   <div>
       <img src="src/assets/svg/modal_exc.svg" alt="">
   </div>
   <div>
       <p><strong>No te alcanzan las fichas.</strong></br> 
           Hacé una donación para seguir.</p>
   </div>
</div>

   <div class="form_ctrl input_">
       <div class="align_center">
           <a href="#" class="boton_redondeado resaltado_amarillo width_100">Donar</a>
       </div>
   </div>
   <div class="form_ctrl input_">
       <div class="align_center">
           <a href="#" id="custom-close" class="pd_25_lf_rg subrayado" rel="modal:close">Ahora no</a>
       </div>
   </div>
   
</div> 
@endsection

@section('footer')
  @include("fundacion.footer-fundacion")  
<script>
   
$("#form_filtro .icon-cancel").on("click", function(){
    $("#form_filtro").fadeOut();
})
$("#open_menu").on("click", function(){
    $("#form_filtro").fadeIn();
})
$(document).ready(function() {
  $('#form_filtro').submit(function(e) {
    e.preventDefault();
  });
});
const tagContainer = document.querySelector('.tag-container');
const input = document.querySelector('input');
const input_check = document.querySelectorAll('.check_cond');
const select = document.querySelector('#categorias');
let tags = [];

function createTag(label) {
  const div = document.createElement('div');
  div.setAttribute('class', 'tag');
  const span = document.createElement('span');
  span.innerHTML = label;
  const closeIcon = document.createElement('i');
  closeIcon.innerHTML = 'cancel';
  closeIcon.setAttribute('class', 'material-icons');
  closeIcon.setAttribute('data-item', label);
  div.appendChild(span);
  div.appendChild(closeIcon);
  return div;
}

function clearTags() {
  document.querySelectorAll('.tag').forEach(tag => {
    tag.parentElement.removeChild(tag);
  });
}

function addTags() {
  clearTags();
  tags.slice().reverse().forEach(tag => {
    tagContainer.prepend(createTag(tag));
  });
}

input.addEventListener('keyup', (e) => {
    e.preventDefault();
    if (e.key === 'Enter') {
      e.target.value.split(',').forEach(tag => {
        tags.push(tag);  
      });
      addTags();
      input.value = '';
    }
});

select.addEventListener('change', (e) => {

    const consulta_tag = e.target.value;
    if(tags.indexOf(consulta_tag)==-1){
    e.target.value.split(',').forEach(tag => {
        tags.push(tag);  

    });
    addTags();
    }
});

for (var x=0; x < input_check.length; x++){
    input_check[x].addEventListener('change', (e) => {
    e.preventDefault();
    if(e.target.checked == true){
    e.target.value.split(',').forEach(tag => {
        tags.push(tag);  
    });
    addTags();
    }else{
      const tagLabel = e.target.value;
      const index = tags.indexOf(tagLabel);
        tags = [...tags.slice(0, index), ...tags.slice(index+1)];
        addTags();    
    }
});  
}

document.addEventListener('click', (e) => {

  if (e.target.tagName === 'I') {
    const tagLabel = e.target.getAttribute('data-item');
    const index = tags.indexOf(tagLabel);
    tags = [...tags.slice(0, index), ...tags.slice(index+1)];
    addTags();    
  }
})

input.focus();





    

// Boton de tarjeta
$('.button_card').on('click', function(e) {
    /*Si se hace por php cambiar link */
    
    if (!$(this).hasClass("clicked")){
        e.preventDefault();
        $(this).attr("href", "cuento_corto_")
    }
    $(this).find(".desc_boton").text("Leer cuento");
    $(this).find(".num_fichas").text("");
    $(this).find(".icon").not(".icon_flip").removeClass("icon-ficha");
    $(this).find(".icon").not(".icon_flip").addClass("icon-flecha_leitmotiv");
    
+   $(this).parent().parent().addClass("card-leitmotiv-animate");
    if ($(this).parent().parent($(".cd-gallery li.color-1")) && $(this).parent().parent($(".cd-gallery li.color-1"))){
        $(this).parent().parent().addClass("color-1")
    }



    $(this).addClass("button_card-animate");

    $(this).animate({ 
        // left: "+=50"
    }, 5, function() {
    });
});


//Animacion de boton ficha
const tip_Buttons = document.querySelectorAll('.button_card')
tip_Buttons.forEach((button) => {
  button.addEventListener('click', () => {
    if (button.clicked) return
    button.classList.add('clicked')
  })
})


$('.btn-postulacion').on('click', function(e) {
    
    /*Si se hace por php cambiar link */
    
    if (!$(this).parent().hasClass(".bloqued .btn-postulacion")){
        e.preventDefault();
    }
});




/*Agregar o quitar fichas Si el usuario ya agrego con anteriorida van con la clase apostadas*/
$(".card_rn_3").each(function(index) {
    console.log($(".card_rn_3").eq(index).find(".fichin.apostado").length);
    if (($(".card_rn_3").eq(index).find(".fichin.apostado").length)+ ($(".card_rn_3").eq(index).find(".fichin.activo").length) == 5){
        $(".card_rn_3").eq(index).find(".selecc_fichas").addClass("max_apostado");
        $(".card_rn_3").eq(index).find(".selecc_fichas p").text("Ya apostaste el máximo de fichas");
    }
});



$( ".fichin" ).on("click", function() {
    var indice_click_ = $(this).parent().find(".fichin").index(this);
    var obj_fichin= $(this).parent();
    $(obj_fichin).find(".fichin.activo").removeClass("activo");
    for (var x = 0; x <= indice_click_; x++ ){
        console.log($(obj_fichin).find(".fichin").eq(x).hasClass("activo"));
        if(!$(obj_fichin).find(".fichin").eq(x).hasClass("apostado")){
            $(obj_fichin).find(".fichin").eq(x).addClass("activo")
        }
    }

    var cantidad = $(obj_fichin).find(".fichin.activo").length;
    console.log($(obj_fichin));
        $("#ap_fichas").val(cantidad);
        if (cantidad > 0){
            $(obj_fichin).parent().find( ".form_ctrl button").attr("disabled", false);
            $(obj_fichin).parent().parent().find("p").text("Vas a sumar " + cantidad + " fichas");
            $(obj_fichin).parent().find( ".form_ctrl button").text("Apostar " + cantidad + " fichas");
            $(obj_fichin).parent().find( "form").val(cantidad);
        }else{
            $(obj_fichin).parent().parent().find("p").text("Ponele fichas");
            $(obj_fichin).parent().find( ".form_ctrl button").text("Apostar");
            $(obj_fichin).parent().find( ".form_ctrl button").attr("disabled", true);
            $(obj_fichin).parent().find( "form").val(cantidad);
        }
});



$(".desp_mobile_tab .tabs_cli").on("click", function(){

if ($(".desp_mobile_tab .tabs_cli").hasClass("icon-angle-down")){
    $(".cd-tab-filter ul.cd-filters").css("maxHeight", "450px");
    $(".desp_mobile_tab .tabs_cli").removeClass("icon-angle-down");
    $(".desp_mobile_tab .tabs_cli").addClass("icon-angle-up");
}else{
    $(".cd-tab-filter ul.cd-filters").css("maxHeight", "60px");
    $(".desp_mobile_tab .tabs_cli").removeClass("icon-angle-up");
    $(".desp_mobile_tab .tabs_cli").addClass("icon-angle-down");
}
});

$(".hero-nav-content").owlCarousel({   
    responsiveClass:true, 
    dots:false,
    navText : ["<i class='icon-left_arrow'></i>","<i class='icon-right_arrow'></i>"],
    responsive:{
        0:{
            items:1,
            nav:true,
            loop:true
        },
        1100:{
            items:5,
            nav:false,
            loop:false,
            mouseDrag:false, 
            autoWidth:true
        }
    }
});
if(window.matchMedia("(max-width: 1100px)").matches){ 
    $('.hero-nav-content').owlCarousel('remove', 4).owlCarousel('update');
}
if( $(window).width() < 1170 ){
var orden_tabs_mobile = $(".selected").parent();
$(".cd-filters").prepend(orden_tabs_mobile);
}
$( window ).resize(function() {
  if( $(window).width() < 1170 ){
    var orden_tabs_mobile = $(".selected").parent();
    console.log(orden_tabs_mobile)
    $(".cd-filters").prepend(orden_tabs_mobile);
    }else{
        // $(".cd-filters").data("orden", "2").insertAfter($(".cd-filters").data("orden", "1"));
        // $(".cd-filters").data("orden", "3").insertAfter($(".cd-filters").data("orden", "2"));
        
    }

});
    </script>
    <script>
    var distance = $('.cd-main-content').offset().top;
    
    $(window).scroll(function() {
        if( $(window).width() >= 1101){
        if ( $(this).scrollTop() >= distance ) {
            $(".cd-tab-filter").css("padding-top", "0px");
        } else {
            $(".cd-tab-filter").css("padding-top", "40px");
        }
    }
    });
    </script>
@endsection