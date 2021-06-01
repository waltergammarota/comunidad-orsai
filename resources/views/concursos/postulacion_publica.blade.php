@extends('2021-orsai-template')

@section('title', $concurso->name.' | Comunidad Orsai')
@section('description','Concurso | Comunidad Orsai')

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
                        <li class="cont_icon_cancel">
                            <span class="icon icon-cancel cerrar"></span>
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
                            <div class="form_ctrl input_">
                                <div class="input_err">
                                    <label class="text_medium">Buscar</label>
                                    <input type="text" name="palabras_buscar" placeholder="palabra" class="obligatorio">
                                </div>
                            </div> 
                        </li>
                        <li> 
                            <div class="grilla_form sin_margin">
                                <div class="form_ctrl input_ col_6">
                                    <div class="align_left">
                                    <div class="input_err">
                                        <div class="check_div input_err obligatorio">
                                            <label class="checkbox-container letra_chica text_bold">
                                                Ver destrabados
                                                <input type="checkbox" value="Destrabados" id="cbox3" name="filtro3" class="check_cond"> 
                                                <span class="crear_check"></span> 
                                            </label>
                                        </div>
                                    </div>
                                    </div>
                                </div>   
                            </div>
                        </li>  
                        <li> 
                            <div class="input_err tag-container"> 
                            </div> 
                        </li>
                        <li class="cont_btn_filtro">
                            <div class="form_ctrl input_">
                                <div class="align_right">
                                    <a class="boton_redondeado resaltado_amarillo pd_50_lf_rg">Filtrar</a>
                                </div>
                            </div>    
                        </li>
                    </ul>
                </form>
            </li>
           </ul>
           <ul class="cd-filters">
            <li class="filter">
                <a href="ronda_1" data-type="all" class="selected">
                    <span class="icon icon-carpeta_abierta"></span> 
                    Leit motivs 
                    <span class="counter_">(12)</span>
                </a> 
            </li>
            <li class="filter bloqued" data-filter=".color-1">
                <a href="ronda_2" data-type="color-1" class="">
                <span class="icon icon-candado"></span> 
                Descripciones 
                <span class="counter_">(0)</span>
              </a> 
            </li>          
            <li class="filter bloqued" data-filter=".color-2"><a href="ronda_3" data-type="color-2"  >
                <span class="icon icon-candado"></span> 
                Cuentos <span class="counter_">(0)</span>
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
<h2>Ponele fichas a la narrativa</h2>
<p class="">Si llegaste hasta acá, no es azar. Una historia necesita tus fichas para ganar el <strong>primer concurso de cuento con premio incalculable en dólares.</strong>Del otro lado, un socio de Comunidad Orsai espera una apuesta a su narrativa ¡Ponele fichas!</p>
<a href="#" class="link_subrayado">Ver otras postulaciones del concurso</a>
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
    <div class="contenedor titulo_leit_motivs postulacion_publica">
        <div class="cont_card_leitmotiv ">
            <!-- Card -->
            <div class="card_leitmotiv_2">
                    <div class="card-leitmotiv__" href="#">
                        <span class="id_card">005</span>
                        <h3 class="title_card">Geppeto era un humilde carpintero que siempre había deseado tener un hijo y se le ocurrió la idea de tallar en la madera una marioneta a un niño. Un día, una hada cumple el sueño de Geppeto dándole vida a la marioneta y convirtiéndola en un niño de verdad al que Geppeto llamó Pinocho. </h3>
                        <span class="cat_card"><span>tragedia</span> <span>educacion</span></span>
                        
                        <div class="button_card">
                            <a href="#" class="tip-button  boton_redondeado resaltado_amarillo width_100">
                                <span class="tip-button__text">Destrabar cuento completo</span>
                                <span class="icon"></span>
                                <div class="coin-wrapper">
                                  <div class="coin">
                                    <div class="coin__middle"></div>
                                    <div class="coin__back"></div>
                                    <div class="coin__front"></div>
                                    
                                  </div>
                                </div>
                                <span class="num_coins">2</span>
                            </a>
                        </div>
                </div>
            </div>
        </div>
        <div class="form_ctrl input_">
            <div class="align_center">
                <a href="#ex1" rel="modal:open" class="boton_redondeado btn_transparente">Ver otras postulaciones en este concurso</a>
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
/* Submenu de busqueda */
$("#form_filtro .icon-cancel").on("click", function(){
    $("#form_filtro").removeClass("abierto");
})
$("#open_menu").on("click", function(){
    if($("#form_filtro").hasClass("abierto")){
        
        $("#form_filtro").removeClass("abierto");
    }else{
        $("#form_filtro").addClass("abierto");
    }
})
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
        console.log(tags.indexOf(consulta_tag));
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
    
    
    /*Agrega el click a las solapas a medida que se van desbloqueando funcion*/
    function add_click(x){
        $(x).not(".cd-filters li.bloqued a").on("click", function(){
            if (!$(this).hasClass("selected")){
                $(".cd-filters li a.selected").find(".icon").removeClass("icon-carpeta_abierta").addClass("icon-carpeta_cerrada");
    
                $(".cd-filters li a.selected").removeClass("selected");
    
                $(this).addClass("selected");
                $(this).find(".icon").addClass("icon-carpeta_abierta");
                if ($(this).data('type') === "all"){
                    $(".cd-gallery li").fadeIn(100, "swing");
                }else{
                    var variable ="."+ $(this).data('type');
                    $(".cd-gallery li"+ variable).fadeIn(100, "swing");
                    $(".cd-gallery li").not(variable).fadeOut();
    
                }
            }
        });
    }
    add_click(".cd-filters li a");
    
    /*Función contador de elementos desbloquedos y se los añade a las solapas*/
    // function counter_(){
    //     $(".cd-filters li.filter a").each(function( index ) {
    //     var data_type= $(this).data('type');
    //     switch ($(this).data('type')){
    //             case "all":
    //                 $(this).find(".counter_").text($(".cd-gallery li").length);
    //                 break;
    //             case "color-1":
    //                 $(this).find(".counter_").text($(".cd-gallery li.color-1").length);
    //                 if ($(this).find(".counter_").text() > 0){
    //                     $(this).parent().removeClass("bloqued");
    //                     $(this).find(".icon").removeClass("icon-candado");
                        
    //                     if (!$(this).hasClass("selected")){
    //                         if ($(this).find(".counter_").text() == 1){
    //                             $(this).find(".icon").addClass("icon-carpeta_cerrada");
    //                             add_click($(this));
    //                         }
    //                     }
    //                 }  
    //                 break;
    //             case "color-2":
    //                 $(this).find(".counter_").text($(".cd-gallery li.color-2").length);
    //                 break;
    //                 default:
    //         }
    //     });
    // };
    // counter_();
    
    
    
        
    
    // Boton de tarjeta
    $('.button_card a').on('click', function(e) {
        
        /*Si se hace por php cambiar link */
        
        if (!$(this).hasClass("clicked")){
            e.preventDefault();
            $(this).attr("href", "ronda_2")
        }
        $(this).find(".tip-button__text").text("Leer descripción");
        $(this).find(".num_fichas").text("");
        $(this).find(".icon").not(".icon_flip").addClass("icon-flecha_leitmotiv");
        $(this).find(".num_coins").css("display","none");
        
+       $(this).parent().parent().addClass("card-leitmotiv-animate");
        if ($(this).parent().parent($(".cd-gallery li.color-1")) && $(this).parent().parent($(".cd-gallery li.color-1"))){
            $(this).parent().parent().addClass("color-1")
        }
    
        /*Funcion que activa el contador en las solapas, si se hace por php borrar la llamada de la funcion*/
        // counter_();
    
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
        // button.find(".tip-button").classList.add('clicked')
      })
    })
    
    $('.btn-postulacion').on('click', function(e) {
        
        /*Si se hace por php cambiar link */
        
        if (!$(this).parent().hasClass(".bloqued .btn-postulacion")){
            e.preventDefault();
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
    </script>
    
    <SCRIPt>
        const tipButtons = document.querySelectorAll('.tip-button')
    
    // Loop through all buttons (allows for multiple buttons on page)
    tipButtons.forEach((button) => {
      let coin = button.querySelector('.coin')
    
      // The larger the number, the slower the animation
      coin.maxMoveLoopCount = 90
    
      button.addEventListener('click', () => {
        if (button.clicked) return
    
        button.classList.add('clicked')
    
        // Wait to start flipping the coin because of the button tilt animation
        setTimeout(() => {
          // Randomize the flipping speeds just for fun
          coin.sideRotationCount = Math.floor(Math.random() * 5) * 90
          coin.maxFlipAngle = (Math.floor(Math.random() * 4) + 3) * Math.PI
          button.clicked = true
          flipCoin()
        }, 50)
      })
    
      const flipCoin = () => {
        coin.moveLoopCount = 0
        flipCoinLoop()
      }
    
      const resetCoin = () => {
        coin.style.setProperty('--coin-x-multiplier', 0)
        coin.style.setProperty('--coin-scale-multiplier', 0)
        coin.style.setProperty('--coin-rotation-multiplier', 0)
        coin.style.setProperty('--shine-opacity-multiplier', 0.4)
        coin.style.setProperty('--shine-bg-multiplier', '50%')
        coin.style.setProperty('opacity', 1)
        // Delay to give the reset animation some time before you can click again
        setTimeout(() => {
          button.clicked = false
        }, 300)
      }
    
      const flipCoinLoop = () => {
        coin.moveLoopCount++
        let percentageCompleted = coin.moveLoopCount / coin.maxMoveLoopCount
        coin.angle = -coin.maxFlipAngle * Math.pow((percentageCompleted - 1), 2) + coin.maxFlipAngle
        
        // Calculate the scale and position of the coin moving through the air
        coin.style.setProperty('--coin-y-multiplier', -11 * Math.pow(percentageCompleted * 2 - 1, 4) + 11)
        coin.style.setProperty('--coin-x-multiplier', percentageCompleted)
        coin.style.setProperty('--coin-scale-multiplier', percentageCompleted * 0.6)
        coin.style.setProperty('--coin-rotation-multiplier', percentageCompleted * coin.sideRotationCount)
    
        // Calculate the scale and position values for the different coin faces
        // The math uses sin/cos wave functions to similate the circular motion of 3D spin
        coin.style.setProperty('--front-scale-multiplier', Math.max(Math.cos(coin.angle), 0))
        coin.style.setProperty('--front-y-multiplier', Math.sin(coin.angle))
    
        coin.style.setProperty('--middle-scale-multiplier', Math.abs(Math.cos(coin.angle), 0))
        coin.style.setProperty('--middle-y-multiplier', Math.cos((coin.angle + Math.PI / 2) % Math.PI))
    
        coin.style.setProperty('--back-scale-multiplier', Math.max(Math.cos(coin.angle - Math.PI), 0))
        coin.style.setProperty('--back-y-multiplier', Math.sin(coin.angle - Math.PI))
    
        coin.style.setProperty('--shine-opacity-multiplier', 4 * Math.sin((coin.angle + Math.PI / 2) % Math.PI) - 3.2)
        coin.style.setProperty('--shine-bg-multiplier', -40 * (Math.cos((coin.angle + Math.PI / 2) % Math.PI) - 0.5) + '%')
    
        // Repeat animation loop
        if (coin.moveLoopCount < coin.maxMoveLoopCount) {
          if (coin.moveLoopCount === coin.maxMoveLoopCount - 6) button.classList.add('shrink-landing')
          window.requestAnimationFrame(flipCoinLoop)
        } 
        else {
          button.classList.add('coin-landed')
          coin.style.setProperty('opacity', 0)
          setTimeout(() => {
            // button.classList.remove('shrink-landing', 'coin-landed')
            setTimeout(() => {
              resetCoin()
            }, 300)
          }, 1500)
        }
      }
    })
    </SCRIPt>
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