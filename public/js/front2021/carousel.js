$(document).ready(function() {
 
    $("#owlMainSlider").owlCarousel({

        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        loop:true, 
        items : 1,
        nav:true,
        navText : ["<i class='icon-left_arrow'></i>","<i class='icon-right_arrow'></i>"]

        // "singleItem:true" is a shortcut for:
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false

    });
    $("#owl-demo_2").owlCarousel({

       navigation : true, // Show next and prev buttons
       slideSpeed : 300,
       paginationSpeed : 400,
       stagePadding: 0,
       singleItem:true,
       dots:false,
       rewind:true,
       loop:true, 
       margin:10,
       nav:true,
       navText : ["<i class='icon-left_arrow color_amarillo'></i>","<i class='icon-right_arrow color_amarillo'></i>"],
       responsive : {
       0 : {
           autoWidth:false,
           items : 1
       },
       1040 : {
           items : 1,
           autoWidth:false
           // mergeFit:false

       },
       1700 : {
           items : 2,
           margin:200,
           mergeFit:false
       },
       1900 : {
           items : 2,
           margin:200,
           mergeFit:false
       }    
       }
   });

   $("#owl-demo_3").owlCarousel({

   navigation : true, // Show next and prev buttons
   slideSpeed : 300,
   paginationSpeed : 400,
   singleItem:true,
   dots:false,
   rewind:true,
   loop:true,
   autoWidth:true,
   margin:10,
   items : 1,
   nav:true,
   navText : ["<i class='icon-left_arrow color_amarillo'></i>","<i class='icon-right_arrow color_amarillo'></i>"]

   });










   });
    

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

if (document.getElementsByClassName("menu_lateral")[0]){
   if (document.getElementById("ordenar")) {
       var get_ordenar = document.getElementById("ordenar");
       get_ordenar.onclick = function() {
           var get_icon = get_ordenar.getElementsByClassName("ordenar_bt")[0].getElementsByTagName("span")[0];
           var get_lista_orden = document.getElementsByClassName("menu_lateral")[0].getElementsByTagName("ul")[0];
           if (get_lista_orden.classList.contains("orden_abierto")) {
               get_icon.classList.remove("icon-angle-up");
               get_icon.classList.add("icon-angle-down");
               get_lista_orden.classList.remove("orden_abierto");
           } else {
               get_icon.classList.remove("icon-angle-down");
               get_icon.classList.add("icon-angle-up");
               get_lista_orden.classList.add("orden_abierto");
           }
       }
   }} 


   $(document).ready(function() {
       if ($(window).width() < 1040) {
           startCarousel();
       } else {
           $('.owl_demo_cards').addClass('off');
       }
   });
   
   $(window).resize(function() {
       if ($(window).width() < 1040) {
           startCarousel();
       } else {
           stopCarousel();
       }
   });
   
   
   
   function startCarousel() {
   
       $(".owl_demo_cards").owlCarousel({
           margin: 10,
           responsiveClass: true,
           responsive: {
               0: {
                   items: 1,
                   nav: true,
                   margin: 30
               },
               991: {
                   items: 2,
                   nav: true,
                   autoHeight: false,
                   margin: 30
               },
               1040: {
                   items: 3,
                   nav: false,
                   dots: false,
                   autoWidth: true
               }
           }
       });
   }
   
   function stopCarousel() {
       var owl = $('.owl_demo_cards');
       owl.trigger('destroy.owl.carousel');
       owl.addClass('off');
   }
   
   
   var options = {
       margin: 50,
       responsiveClass: true,
       items: 2,
       nav: true,
       slideBy: 2,
       autoHeight:true,
       navText : ["<i class='icon-left_arrow color_amarillo'></i>","<i class='icon-right_arrow color_negro'></i>"],
       responsive: {
           0: {
               items: 1
           },
           768: {
               margin: 20,
               items: 1
           },
           992:{
               items: 2
           },
           1040: {
               margin: 50
   
           }
       }
   };
   
   
   var transient = {};
   
   var events = {
       onDrag: onDrag.bind(transient),
       onDragged: onDragged.bind(transient)
   };
   
   var owl = $('.owl_demo_7').owlCarousel(Object.assign(options, events));
   
   
   if ($(window).width() > 992) {
   if ($(".owl-item").length % 2 != 0) {
       $(owl).owlCarousel('add', '<article class="vacio resaltado_blanco"></article>').trigger('refresh.owl.carousel');
       $('.owl_demo_7').find(".vacio").parent(".owl-item").addClass("item-vacio");
   }
   }
   
   
   
   $( window ).resize(function() {
   if ($(window).width() < 992) {
   if ($(owl).find(".vacio")){
       indice = $(".owl-item").length;
       for (var x=0; x< $(".owl-item").length; x++){
           if ($(".owl-item").eq(x).hasClass("item-vacio")){
               $(".owl_demo_7").trigger('remove.owl.carousel', [x]).trigger('refresh.owl.carousel');
           }
       }
   }
   }else{
       if ($(".owl-item").length % 2 != 0) {
           $(owl).owlCarousel('add', '<article class="vacio resaltado_blanco"></article>').trigger('refresh.owl.carousel');
           $('.owl_demo_7').find(".vacio").parent(".owl-item").addClass("item-vacio");
       }
   }
   })
   
   
   
   
   
   function onDrag(event) {
       this.initialCurrent = event.relatedTarget.current();
   }
   
   function onDragged(event) {
       var owl = event.relatedTarget;
       var draggedCurrent = owl.current();
   
       if (draggedCurrent > this.initialCurrent) {
           owl.current(this.initialCurrent);
           owl.next();
       } else if (draggedCurrent < this.initialCurrent) {
           owl.current(this.initialCurrent);
           owl.prev();
       }
       if ($(".owl-item").length != 0) {
   
       }
   
   
   }  

   





