
@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')

@section('header')
    <link rel="stylesheet" href="{{url('js/front2021/mCustomScrollbar/jquery.mCustomScrollbar.css')}}"> 
@endsection

@section('content')
<section class="inscripcion-cuento">
    <div class="contenedor">
        <div class="hero">
            <div class="content-hero">
                <p class="pills">Acá empieza la timba</p>
                <h2 class="title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h2>
                <p class="subtitle">Minuto a minuto te spoileamos todo lo que está pasando tras bambalinas para que puedas apostar a las postulaciones <strong class="color_amarillo">más elegidas por la Comunidad.</strong></p>
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
                    <div class="content-nav center">
                        <a href="#" class="btn-postulacion">Estadísticas</a>
                    </div>
                </div> 
            </div>
        </nav>
        <div class="subir_postulacion"> 
            <a href="#" class="btn-postulacion">Estadisticas</a> 
        </div>
    </div>
</section>

<section class="fondo_gris_oscuro pd_20_tp_bt ">
<article class="contenedor ft_size form_rel pd_15_extra ">
    <div class="max_w_1100">

    <div class="form_central_3 ">
        <div class="btn_fichas_dinero">
            <h2 class="color_amarillo text_regular">Ranking</h2>
        </div>
        <div class="tran_creditos transparencia ranking">
            <div class="cont_tabla">
                <table class="light-3" id="ranking_table">
                    <thead>
                    <tr>
                        <th class="color_blanco">Puesto</th>
                        <th class="color_blanco">Cuento</th>
                        <th class="color_blanco">Fichas</th>
                        <th class="color_blanco">Apostadores</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td class="color_amarillo">1.</td>
                          <td class="color_blanco_gris"><a href="#" target="_blank" rel="noopener noreferrer" class="color_blanco_gris">Cuento ID 675528</a></td>
                          <td class="color_amarillo"><span class="icono icon-ficha"></span> 156</td>
                          <td class="">
                            <div class="color_blanco_gris imagen_usuario">
                                  <div>
                                    <img src="{{url('estilos/front2021/assets/participantes/participante.jpg')}}" alt="">
                                  </div>
                                  <div>
                                      <img src="{{url('estilos/front2021/assets/participantes/usuario.png')}}" alt="">
                                  </div>
                                  <div>
                                      <img src="{{url('estilos/front2021/assets/participantes/participante.jpg')}}" alt="">
                                  </div>
                            </div>
                            <div class="cont_cant_apuestas">
                                <span class="color_blanco_gris">55</span>
                            </div> 
                        </td>
                        </tr>
                        <tr>
                            <td class="color_amarillo">2.</td>
                            <td class="color_blanco_gris"><a href="#" target="_blank" rel="noopener noreferrer" class="color_blanco_gris">Cuento ID 675528</a></td>
                            <td class="color_amarillo"><span class="icono icon-ficha"></span>95</td>
                            <td class="">
                                <div class="color_blanco_gris imagen_usuario">
                                    <div>
                                      <img src="{{url('estilos/front2021/assets/participantes/participante.jpg')}}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{url('estilos/front2021/assets/participantes/usuario.png')}}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{url('estilos/front2021/assets/participantes/participante.jpg')}}" alt="">
                                    </div>
                                </div>
                                <div class="cont_cant_apuestas">
                                    <span class="color_blanco_gris">85</span>
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td class="color_amarillo">3.</td>
                            <td class="color_blanco_gris"><a href="#" target="_blank" rel="noopener noreferrer" class="color_blanco_gris">Cuento ID 675528</a></td>
                            <td class="color_amarillo"><span class="icono icon-ficha"></span> 78</td>
                              <td class="">
                                  <div class="color_blanco_gris imagen_usuario">
                                    <div>
                                      <img src="{{url('estilos/front2021/assets/participantes/participante.jpg')}}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{url('estilos/front2021/assets/participantes/usuario.png')}}" alt="">
                                    </div>
                                    <div>
                                        <img src="{{url('estilos/front2021/assets/participantes/participante.jpg')}}" alt="">
                                    </div>  
                                  </div>
                                  <div class="cont_cant_apuestas">
                                      <span class="color_blanco_gris">55</span>
                                  </div> 
                              </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grilla_form">
        <div class="form_ctrl col_3">
                <div class="align_left">
                    <a href="#" class="boton_redondeado btn_transparente_amarillo">Volver al concurso</a>
                </div>
        </div>
    </div> 
</article>

</section>
@endsection

@section('footer')
  @include("fundacion.footer-fundacion")  
  <link rel="stylesheet"
        href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
  <script>
        
        const lang = {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "No hay datos disponibles.",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",

            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        };

        $(document).ready(function () {
            $('#ranking_table').DataTable({
                "searching": false,
                "lengthChange": false,
                "paging": false,
                "info": false,
                "ordering": true,
                "order": [[0, "asc"]],
                language: lang,
            });
        }); 


        $(".sort").on("click", function(){
            if($(this).hasClass("icon-down-dir")){
                $(".icon-up-dir").addClass("icon-down-dir");
                $(".icon-up-dir").removeClass("icon-up-dir");
                $(this).addClass("icon-up-dir");
                $(this).removeClass("icon-down-dir");
            }else{
                $(".icon-up-dir").addClass("icon-down-dir");
                $(".icon-up-dir").removeClass("icon-up-dir");
                $(this).addClass("icon-down-dir");
                $(this).removeClass("icon-up-dir");
            }
        });

        $(".btn_fichas_dinero span").on("click", function(){
            if($(this).hasClass("active")){

            }else{
                    $(".tran_creditos.transparencia .fichas").toggle();
                    $(".tran_creditos.transparencia .dinero").toggle();
                    $(".btn_fichas_dinero span.active").removeClass("active");
                    $(this).addClass("active");
                    $('#mis_fichas_table').table( "refresh");
                }
        });

        $(".cerrar").on("click", function(){
        $("#reportar_transaccion").fadeOut();
        $("#validacion_requerida").fadeOut();
        $(".aviso").fadeOut();
        $('html, body').css('overflowY', 'auto'); 
    })
    $(".icon-flag").on("click", function(){
            $("#report_id").text($(this).parent().parent().find(".id_transaccion").text())
            $("#report_id_input").val($(this).parent().parent().find(".id_transaccion").text())
            $('html, body').css('overflowY', 'hidden'); 
            $("#reportar_transaccion").fadeIn();
    })
        $("#reportar_transaccion button").on("click", function(){
            $(".aviso").fadeIn();
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
@endsection
  