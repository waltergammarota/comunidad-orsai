@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')

@section('header')
    <link rel="stylesheet" href="{{url('js/front2021/mCustomScrollbar/jquery.mCustomScrollbar.css')}}">
@endsection

@section('content')
    @include('concursos.concurso-header')
    @if($hasWinner)
        <section class="fondo_gris_oscuro pd_50_tp ">
            <article class="contenedor ft_size form_rel pd_15_extra ">
                <div class="max_w_1100">
                    <div class="card_ganador">
                        <div class="btn_fichas_dinero">
                            <h2 class="color_amarillo text_regular">Ganador</h2>
                        </div>
                        <!--inicia bloque ganador -->
                        <div class="contenedor_bloques_">
                            <div class="bloque_blanco ">
                                <div class="datos_ganador">
                                    <div class="cont_glogito">
                                        <span class="boton_redondeado resaltado_amarillo color_negro">1º PUESTO</span>
                                        <span class="numero_linea_bt">007</span>
                                    </div>
                                    <h2 class="titulo">{{$cpa->getAnswerByRonda($currentRonda, 1)}}</h2>
                                    <a href="{{url('cuentos/'.$cpa->id)}}" class="text_medium">Leer cuento <i
                                            class="icon icon-flecha_leitmotiv"></i></a>
                                </div>
                                <div class="pos_rel gan_premio">
                                    <div class="pos_abs">
                                        <p><strong>Premio:</strong> {{$cpa->prize_percentage}} de las fichas del pozo
                                        </p>
                                        <p><strong>{{$cpa->prize_amount}}</strong> Fichas recibidas</p>
                                        <p><strong>{{$cpa->getTotalVotes()}}</strong> Jurados</p>
                                        <!-- <a href="#" class="boton_redondeado resaltado_negro color_amarillo">Ver todos los ganadores</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="bloque_amarillo_">
                                <div class="pro_star">
                                    <img src="{{(url('recursos/SVG/estrella.svg'))}}" alt="">
                                </div>
                                <div class="img_ganador">
                                    <img src="{{(url('recursos/participantes/participante.jpg'))}}" alt="">
                                </div>
                                <div class="datos_ganador">
                                    <span class="text_medium">Autor/a</span>
                                    <span>{{$name}} {{$lastName}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </article>
        </section>
    @endif

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
                                    <th class="color_blanco">Jurados</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ranking as $row)
                                    @if($row->capId == null)
                                        @continue
                                    @endif
                                    <tr>
                                        <td class="color_amarillo">{{$loop->index + 1}}</td>
                                        <td class="color_blanco_gris">
                                            @if($userHasVoted($row->capId->id))
                                                <a href="{{url('cuentos/'.$row->capId->id)}}" target="_blank"
                                                   rel="noopener noreferrer" class="color_blanco_gris">
                                                    ID {{str_pad($row->capId->order,3,0, STR_PAD_LEFT)}}
                                                    - {{$getAnswer($row->capId->id, 1)}}
                                                </a>
                                            @else
                                                <p class="color_blanco_gris">
                                                    ID {{str_pad($row->capId->order,3,0, STR_PAD_LEFT)}} -
                                                    {{$getAnswer($row->capId->id, 1)}}</p>
                                            @endif
                                        </td>
                                        <td class="color_amarillo align_right"><span class="icono icon-ficha"></span>
                                            {{$row->cant}} votantes
                                        </td>
                                        <td class="align_right">
                                            <div class="color_blanco_gris imagen_usuario">
                                                @foreach($avatares($row->cap_id) as $userId)
                                                    <div>
                                                        <img
                                                            src="{{$getAvatar($userId)}}"
                                                            alt="{{$userId}}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="cont_cant_apuestas">
                                                <span class="color_blanco_gris">{{$apostadores($row->cap_id)}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="grilla_form">
                    <div class="form_ctrl col_3">
                        <div class="align_left">
                            <a href="{{url('concursos/'.$contest->id.'/'.$contest->getUrlName())}}"
                               class="boton_redondeado btn_transparente_amarillo"><span class="icon-angle-left"></span>
                                Volver
                                al concurso</a>
                        </div>
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
    <script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
    <script src="{{url('js/front2021/jquery.modal/jquery.modal.min.js')}}"></script>
    <script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
    <script>
        $('html, body').animate({
            scrollTop: $("#hero_fixed").offset().top
        }, 1);
        $("#countdown_concurso").countdown("{{$diferencia}}", function (event) {
            if (event.offset['days'] != 0) {
                $(this).text(
                    event.strftime('%-D día%!D %H:%M')
                );
            } else {
                $(this).text(
                    event.strftime('%H:%M:%S')
                );
            }
        });

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
                "ordering": false,
                language: lang,
            });
        });


        $(".sort").on("click", function () {
            if ($(this).hasClass("icon-down-dir")) {
                $(".icon-up-dir").addClass("icon-down-dir");
                $(".icon-up-dir").removeClass("icon-up-dir");
                $(this).addClass("icon-up-dir");
                $(this).removeClass("icon-down-dir");
            } else {
                $(".icon-up-dir").addClass("icon-down-dir");
                $(".icon-up-dir").removeClass("icon-up-dir");
                $(this).addClass("icon-down-dir");
                $(this).removeClass("icon-up-dir");
            }
        });

        $(".btn_fichas_dinero span").on("click", function () {
            if ($(this).hasClass("active")) {

            } else {
                $(".tran_creditos.transparencia .fichas").toggle();
                $(".tran_creditos.transparencia .dinero").toggle();
                $(".btn_fichas_dinero span.active").removeClass("active");
                $(this).addClass("active");
                $('#mis_fichas_table').table("refresh");
            }
        });

        $(".cerrar").on("click", function () {
            $("#reportar_transaccion").fadeOut();
            $("#validacion_requerida").fadeOut();
            $(".aviso").fadeOut();
            $('html, body').css('overflowY', 'auto');
        })
        $(".icon-flag").on("click", function () {
            $("#report_id").text($(this).parent().parent().find(".id_transaccion").text())
            $("#report_id_input").val($(this).parent().parent().find(".id_transaccion").text())
            $('html, body').css('overflowY', 'hidden');
            $("#reportar_transaccion").fadeIn();
        })
        $("#reportar_transaccion button").on("click", function () {
            $(".aviso").fadeIn();
        });


        $(".hero-nav-content").owlCarousel({
            responsiveClass: true,
            dots: false,
            navText: ["<i class='icon-left_arrow'></i>", "<i class='icon-right_arrow'></i>"],
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    loop: true
                },
                1100: {
                    items: 5,
                    nav: false,
                    loop: false,
                    mouseDrag: false,
                    autoWidth: true
                }
            }
        });
        if (window.matchMedia("(max-width: 1100px)").matches) {
            $('.hero-nav-content').owlCarousel('remove', 4).owlCarousel('update');
        }


    </script>
@endsection
