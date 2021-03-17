@extends('2021-orsai-template')

@section('title', 'Transparencia | Comunidad Orsai')
@section('description', 'Transparencia económica')

@section('content')
    @if($user->phone_verified_at)
        <section class="resaltado_gris pd_20_tp_bt ">
            <div class="contenedor  cs6_titulo_seccion_sm transparencia">
                <h2>Cuentas claras conservan la comunidad</h2>
                <p>Acá rendimos cuentas de cada centavo que entra o sale de <strong>Comunidad Orsai.</strong> Esta tabla
                    es un correlato en tiempo real de cómo se mueve el dinero que pusiste. Además podés consultar los
                    listados de benefactores, adherentes y aportantes económicos que bancan los proyectos.</p>
            </div>
        </section>

        <section class="resaltado_gris_oscuro pd_tp_bt pd_20">
            <div class="center_div">
                <div class="contenedor mg_0 dis_flex ">
                    <article class="card_style_6 transparencia">
                        <div class="img_transparencia">
                            <img src="{{url('estilos/front2021/assets/SVG/billetera_transparencia.svg')}}" alt="">
                        </div>
                        <div class="txt_transparencia">
                            <h2>{{$fichasEnBilleteras}}</h2>
                            <p>Fichas en la billetera de los usuarios</p>
                        </div>
                    </article>
                    <article class="card_style_6 transparencia">
                        <div class="img_transparencia">
                            <img src="{{url('estilos/front2021/assets/SVG/monedas_transparencia.svg')}}" alt="">
                        </div>
                        <div class="txt_transparencia">
                            <h2>{{$fichasEnJuego}}</h2>
                            <p>Fichas en juego</p>
                        </div>
                    </article>
                    <article class="card_style_6 transparencia">
                        <div class="img_transparencia">
                            <img src="{{url('estilos/front2021/assets/SVG/baldeo_transparencia.svg')}}" alt="">
                        </div>
                        <div class="txt_transparencia">
                            <h2>{{$baldeosYMordidas}}</h2>
                            <p>Fichas recaudadas por baldeo y mordida</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <section class="resaltado_gris pd_20_tp_bt ">
            <article class="contenedor ft_size form_rel pd_15_extra">
                <div class="">
                    <div class="form_central_3 ">
                        <div class="btn_fichas_dinero">
                            <span class="fichas active" data-type="fichas">Fichas</span>
                            <span class="dinero" data-type="dinero">Dinero</span>
                        </div>
                        <div class="tran_creditos transparencia">
                            <div class="cont_tabla">
                                <table class="light-3" class="display nowrap" style="width:100%height:500px;"
                                       id="mis_fichas_table">
                                    <thead>
                                    <tr>
                                        <th>Fecha y hora</th>
                                        <th>ID</th>
                                        <th>Descripción</th>
                                        <th>Débito/Crédito</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
            </article>
        </section>
        <div id="reportar_transaccion" class="modal_">
            <div class="contenedor">
                <div class="cont_modal_blanco cont_modal_basico">
                    <div class="cerrar">
                        <span>X</span>
                    </div>
                    <div class="cuerpo_modal">
                        <p>Estás a punto de reportar la transacción ID# <span id="report_id"></span></p>
                        <form action="#">
                            <input type="hidden" name="" id="report_id_input" value="">
                            <div class="form_ctrl input_">
                                <div class="input_err">
                                    <textarea name="descripcion" id="" cols="" rows=""
                                              placeholder="Quiero reportar..."></textarea>
                                </div>
                            </div>
                            <div class="aviso">
                                <span><strong>¡Listo, recibimos tu reporte!</strong> Una vez que Comunidad Orsai evalúe el caso, se enviará una respuesta a tu correo.</span>
                            </div>
                            <div class="form_ctrl input_">
                                <div class="align_center">
                                    <button class="boton_redondeado resaltado_amarillo  pd_50_lf_rg">Reportar
                                        transacción
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        ACA VA LA IMAGEN BLUREADA
    @endif
    <div id="validacion_requerida" class="modal_">
        <div class="contenedor">
            <div class="cont_modal_blanco cont_modal_basico resaltado_amarillo">
                <div class="cuerpo_modal">
                    <span class="icono icon-exclamacion_circle"></span>
                    <p class="titulo _barlow_text">Validación requerida</p>
                    <p>Para ver cada centavo que entra y sale de la Comunidad Orsai tenés que validar tu perfil.</p>
                    <div class="form_ctrl input_">
                        <div class="align_center">
                            <a href="{{url('validacion-usuario')}}"
                               class="boton_redondeado resaltado_black color_amarillo  pd_50_lf_rg width_100">Validar mi
                                perfil</a></div>
                        <div class="align_center mg_20">
                            <a href="{{url('/')}}" class="subrayado">Ahora no</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer') 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.3/js/dataTables.scroller.min.js"></script>
    <script>

        @if(!$user->phone_verified_at)
        $('#validacion_requerida').show();
        @endif

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
            const colsDinero = [
                {
                    "data": "date",
                    "render": function (data) {
                        return `<span class="icono icon-flag tooltip"><span class="tooltiptext">Reportar</span> </span> ${data}`;
                    }
                },
                {"data": "id"},
                {"data": "description"},
                {
                    "data": "type",
                    "render": function (data) {
                        let classNegativo = "";
                        if (parseInt(data) < 0) {
                            classNegativo = "dinero_negativo";
                        }
                        return `<div class="dinero dinero_td ${classNegativo}"><span class="icono">$ </span>${data}</div>`;
                    }
                }
            ];
            const colsFichas = [
                {
                    "data": "date",
                    "render": function (data) {
                        return `<span class="icono icon-flag tooltip"><span class="tooltiptext">Reportar</span> </span> ${data}`;
                    }
                },
                {"data": "id"},
                {"data": "description"},
                {
                    "data": "type",
                    "render": function (data) {
                        let classNegativo = "";
                        if (parseInt(data) < 0) {
                            classNegativo = "fichas_negativo";
                        }
                        return `<div class="fichas fichas_td ${classNegativo}"><span class="icono icon-ficha"></span>${data}</div>`;
                    }
                }
            ];
            const dineroOptions = {
                "searching": false,
                "lengthChange": false,
                "info": false,
                "ordering": true,
                "order": [[0, "desc"]],
                "serverSide": true,
                "ajax": '{{url('transparencia-json?query=dinero')}}',
                "language": lang,
                "columns": colsDinero
            };
            const fichasOptions = {
                "searching": false,
                "lengthChange": false,
                "info": false,
                "ordering": true,
                "order": [[0, "desc"]],
                "serverSide": true,
                "ajax": '{{url('transparencia-json?query=fichas')}}',
                "language": lang,
                "columns": colsFichas
            };
            let table = $('#mis_fichas_table').DataTable(fichasOptions);


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
                    table.destroy();
                    if ($(this).data('type') == "fichas") {
                        table = $('#mis_fichas_table').DataTable(fichasOptions);
                    } else {
                        table = $('#mis_fichas_table').DataTable(dineroOptions);
                    }
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
        });
    </script>
@endsection




