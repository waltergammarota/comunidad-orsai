
@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')

@section('header')
    <link rel="stylesheet" href="{{url('js/front2021/mCustomScrollbar/jquery.mCustomScrollbar.css')}}"> 
@endsection

@section('content')

<div id="mv_apostar" class="cont_mobile_apostar">

    <aside id="md_apostar" class="modulo_apostar_cuento">
        <div class="cerrar">
            <span class="icon icon-cancel-circle"></span>
        </div>
        <div class="titulo">
            <p>Recuerda que este concurso permite un máximo de <strong class="color_amarillo">5 fichas por postulación.</strong></p>
        </div>
        <div class="selecc_fichas">
            <p>Elegí la cantidad de fichas</p>
            <div class="fichas_">
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
            <div class="form_ctrl input_">
                <div class="align_center">
                    <button class="boton_redondeado resaltado_amarillo width_100">Apostar</button>
                </div>
            </div>
        </div>
    </aside>
</div>

<section class="resaltado_gris pd_20 pd_20_tp_bt ">
    <div id="mv_mobile_pro" class="cont_mobile_pro">
        <aside id="md_pro" class="modulo_pro">
            <div class="pro_star abierto">
                <img src="{{url('estilos/front2021/assets/svg/estrella.svg')}}" alt="">
                <span class="icon icon-down-open"></span>
            </div>
            <div class="_autor">
                <div class="img_autor">
                    <img src="{{url('estilos/front2021/assets/participantes/participante.jpg')}}" alt="">
                </div>
                <div class="datos_autor">
                    <span class="text_medium">Autor</span>
                    <span>Nombre y Apellido</span>
                </div>
            </div>
            <div class="numeros_">
                <div>
                    <span class="_barlow_text">153</span>
                    <span class="_barlow_text">Visualizaciones</span>
                </div>
                <div>
                    <span class="_barlow_text">102</span>
                    <span class="_barlow_text">Fichas</span>
                </div>
            </div>

<!-- Meter la lista de apostadores                                     -->
            
            <div id="quien_fichas_modal" class="popup">
                <div id="quien_fichas">
                    <div class="contenedor_quien_fichas ">
                        <div class="header_lista">
                            <ul>
                                <li>                        
                                    <span class="text_medium">Apostador</span>
                                    <span class="text_medium">Fichas</span>
                                </li>
                            </ul>
                        </div>
                    
                        <div id="content-ltn" class="content pusieron_listas">
                        
                            <ul id="ul_listas">
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>
                                <li>
                                    <span class="nombre_puso">Nombre Apellido</span>
                                    <span class="fichas_puso"><span class="icon-ficha"></span> 25</span>
                                </li>                                                            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <div class="contenedor cuento_">

    <article class="cuento_texto">
            <div class="cuerpo_interna">
            <div class="blog_social">
                    <span class="numero _barlow_text">007</span>
                    <h1 class="titulo_blog">Pinocho</h1>
            </div>

            <div class="blog_texto">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. <br/>
                Duis autem vel eum iriure dolor in hendrerit in vulputate velitesse molestie consequat, vel illum dolore eu feugiat nullafacilisis at vero eros et accumsan et iusto odio dignissim quiblandit praesent luptatum zzril delenit augue duis dolore tefeugait nulla facilisi.</p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. <br/>
                Duis autem vel eum iriure dolor in hendrerit in vulputatevelitesse molestie consequat, vel illum dolore eu feugiatnullafacilisis at vero eros et accumsan et iusto odio dignissimquiblandit praesent luptatum zzril delenit augue duis doloretefeugait nulla facilisi.</p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. <br/>
                Duis autem vel eum iriure dolor in hendrerit in vulputatevelitesse molestie consequat, vel illum dolore eu feugiatnullafacilisis at vero eros et accumsan et iusto odio dignissimquiblandit praesent luptatum zzril delenit augue duis doloretefeugait nulla facilisi.</p>
            </div>
        </div>
        <div class="grilla_form">
            <div class="form_ctrl col_3">
                    <div class="align_left">
                        <a href="#" class="boton_redondeado btn_transparente_negro pd_50_lf_rg">Volver</a>
                    </div>
            </div>
        </div> 
    </article>
    <article id="md_laterales" class="modulos_laterales">  
        
        <aside class="modulo_texto">
            <div class="leit_motive">
                <span class="text_bold">Leit motiv</span>
                <span>El hombre desciende del mono y el mono suspira aliviado.</span>
            </div>
            <div class="descripcion">
                <span class="text_bold">Descripción</span>
                <span>Geppeto era un humilde carpintero que siempre había deseado tener un hijo y se le ocurrió la idea de tallar en la madera una marioneta a un niño. Un día, una hada cumple el sueño de Geppeto dándole vida a la marioneta y convirtiéndola en un niño de verdad al que Geppeto llamó Pinocho.</span>
            </div>
            <div class="etiquetas">
                <span class="text_bold">Etiquetas</span>
                <div>
                    <span>tragedia</span>
                    <span>educación</span>
                    <span>madera</span>

                </div>
            </div>
        </aside>
    </article>
    <div class="grilla_form fuera_texto">
        <div class="form_ctrl col_3">
                <div class="align_left">
                    <a href="#" class="boton_redondeado btn_transparente_negro pd_50_lf_rg">Volver</a>
                </div>
        </div>
    </div> 
</div>
</section>
@endsection

@section('footer')
  @include("fundacion.footer-fundacion") 
  <script src="{{url('js/front2021/mCustomScrollbar/jquery.mCustomScrollbar.js')}}"></script>
  <script>
    /* Efecto hover en fichas */
    $( ".fichin" )
    .mouseenter(function() {
        var indice_ = $( ".fichin" ).index( this ); 

        for (var x = 0; x <= indice_; x++ ){
        $( ".fichin" ).eq(x).css("backgroundColor", "#ffe600");
        
    }
    })
    .mouseleave(function() {
        var indice_ = $( ".fichin" ).index( this ); 
        for (var x = 0; x <= indice_; x++ ){
            if (!$( ".fichin" ).eq(x).hasClass("activo") ){
                if (!$( ".fichin" ).eq(x).hasClass("apostado")){
                    $( ".fichin" ).eq(x).css("backgroundColor", "");
                }
            }
        
    }
    });

    /*Agregar o quitar fichas Si el usuario ya agrego con anteriorida van con la clase apostadas*/
    $( ".fichin" ).on("click", function() {
        var indice_click_ = $( ".fichin" ).index( this );
        $( ".fichin.activo" ).css("backgroundColor", "");

        if ($( this ).hasClass("activo")){
            var cant_fichas_apostar = $( ".fichin.activo" ).length
            $( ".fichin.activo" ).removeClass("activo");
            var _contador =1;
            for (var x = 0; x < $( ".fichin" ).length; x++ ){
            if (!$( ".fichin" ).eq(x).hasClass("apostado") && _contador < cant_fichas_apostar ){
                $( ".fichin" ).eq(x).addClass("activo");
                console.log("contador: "+ _contador + " cant_fichas apostar: "+cant_fichas_apostar);
                _contador++;
            }
        }
        }else{
        for (var x = 0; x <= indice_click_; x++ ){
            if (!$( ".fichin" ).eq(x).hasClass("apostado")){
                $( ".fichin" ).eq(x).addClass("activo");
            }
        }

        }
        if ($( ".fichin").hasClass("activo")){
            $( ".modulo_apostar_cuento .form_ctrl button").attr("disabled", false);
        }else{
            $( ".modulo_apostar_cuento .form_ctrl button").attr("disabled", true);
        }
        
        if(window.matchMedia("(max-width: 992px)").matches){
            var cantidad = $( ".cont_mobile_apostar .fichin.activo" ).length;
            $(".cont_mobile_apostar .selecc_fichas p").text("Vas a sumar " + cantidad + " fichas");
            $(".cont_mobile_apostar .modulo_apostar_cuento").css("max-height", "600px");
            $(".cont_mobile_apostar .modulo_apostar_cuento .titulo").css("display", "block");
            $(".cont_mobile_apostar .cerrar").css("display", "block");
            $(".cont_mobile_apostar .cerrar").css("display", "block");
            $(".cont_mobile_apostar .form_ctrl").css("display", "block");
            $(".cont_mobile_apostar .modulo_apostar_cuento .selecc_fichas p").css("display", "block");
        }else{
            var cantidad = $( ".modulos_laterales .fichin.activo" ).length;
            $(".modulos_laterales .selecc_fichas p").text("Vas a sumar " + cantidad + " fichas");
        }
    });

    /*Evita avanzar si el usuario no realiza una nueva apuesta*/


    $( ".modulo_apostar_cuento .form_ctrl a").on("click", function(e){
        if (!$( ".fichin").hasClass("activo")){
            e.preventDefault();
        }
    })

    /*Abre y cierra desplegables en mobile de fichas y modulo pro*/
    $(".cont_mobile_apostar .cerrar").on("click", function() {
        
        $(".cont_mobile_apostar .modulo_apostar_cuento").css("max-height", "80px");
        setTimeout(function() { 
            $(".cont_mobile_apostar .modulo_apostar_cuento .titulo").css("display", "none");
            $(".cont_mobile_apostar .cerrar").css("display", "none");
            $(".cont_mobile_apostar .modulo_apostar_cuento .selecc_fichas p").css("display", "none");
            $( ".cont_mobile_apostar .fichin.activo" ).css("backgroundColor", "");
            $( ".cont_mobile_apostar .fichin.activo" ).removeClass("activo");
            $(".cont_mobile_apostar .selecc_fichas p").text("Elegí la cantidad de fichas");
            $(".cont_mobile_apostar .form_ctrl").css("display", "none");
        }, 300);

    });

    $(".cont_mobile_pro .modulo_pro .pro_star").on("click", function(){
        
        if ($("#mv_mobile_pro .modulo_pro .pro_star").hasClass("abierto")){
            $("#mv_mobile_pro .modulo_pro").css("max-height", "70px");
            $(".cont_mobile_pro .modulo_pro .pro_star .icon").removeClass("icon-up-open").addClass("icon-down-open");

            $(".cont_mobile_pro .modulo_pro .pro_star").removeClass("abierto");
            $(".cont_mobile_pro .modulo_pro .pro_star").addClass("cerrado");
        }else if ($("#mv_mobile_pro .modulo_pro .pro_star").hasClass("cerrado")){
            $(".cont_mobile_pro .modulo_pro").css("max-height", "700px")
            $(".cont_mobile_pro .modulo_pro .pro_star .icon").removeClass("icon-down-open").addClass("icon-up-open");
            $(".cont_mobile_pro .modulo_pro .pro_star").removeClass("cerrado");
            $(".cont_mobile_pro .modulo_pro .pro_star").addClass("abierto");

        }
    });


    /*Mueve elementos nativos en mobile de apuesta de fichas y modulo pro al lateral*/
    $( window ).resize(function() {
        if(window.matchMedia("(max-width: 992px)").matches){

            if (!$("#mv_mobile_pro").find("#md_pro").length > 0){ 
                $("#mv_mobile_pro").append($("#md_pro"));
            }
            if (!$("#mv_apostar").find("#md_apostar").length > 0){ 
                $("#mv_apostar").append($("#md_apostar"));
                $("#md_apostar.modulo_apostar_cuento").css("max-height", "80px");
            }
        }else{
        if ($("#mv_mobile_pro").find("#md_pro").length > 0){ 
            $("#md_laterales").prepend($("#md_pro"));
                $("#md_laterales .modulo_pro").css("max-height", "none");
            }
        if ($("#mv_apostar").find("#md_apostar").length > 0){ 
            $("#md_laterales").prepend($("#md_apostar"));
                $("#md_laterales .modulo_apostar_cuento").css("max-height", "none");
            }

    }
    });
    if(window.matchMedia("(max-width: 992px)").matches){
        if (!$("#mv_mobile_pro").find("#md_pro").length > 0){ 
                $("#mv_mobile_pro").append($("#md_pro"));
            }
            if (!$("#mv_apostar").find("#md_apostar").length > 0){ 
                $("#mv_apostar").append($("#md_apostar"));
                $("#md_apostar.modulo_apostar_cuento").css("max-height", "80px");
            }
        }else{

        if ($("#mv_apostar").find("#md_apostar").length > 0){ 
            $("#md_laterales").prepend($("#md_apostar"));
                $("#md_laterales .modulo_apostar_cuento").css("max-height", "none");
            }
            if ($("#mv_mobile_pro").find("#md_pro").length > 0){ 
            $("#md_laterales").prepend($("#md_pro"));
                $("#md_laterales .modulo_pro").css("max-height", "none");
            }
    };
</script> 
@endsection
  