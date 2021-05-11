@extends('2021-orsai-template')

@section('title', 'Transparencia | Comunidad Orsai')
@section('description', 'Transparencia económica')

@section('content')
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
                        <div class="icon">
                            <i id="open_menu" class="icon-filtro"></i>
                            <form action="#" id="form_filtro" autocomplete="off">
                            <ul class="sub_menu">
                                <li class="cont_icon_cancel"> <span class="icon icon-cancel"></span></li>
                                <li class="titulo_checkbox">
                                    <div>
                                        <span class="text_regular color_negro">Mis filtros</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="grilla_form sin_margin ">
                                        <div class="form_ctrl input_ col_6">
                                            <div class="align_left">
                                            <div class="input_err">
                                                <div class="check_div input_err obligatorio">
                                                    <label class="checkbox-container letra_chica text_regular color_negro">
                                                        Concursos
                                                        <input type="checkbox" value="Concursos" id="chkcon" name="filtro1" class="check_cond"> 
                                                        <span class="crear_check"></span> 
                                                    </label>
                                                </div>
                                            </div>
                                            </div>
                                        </div>   
                                    </div>
                                </li>
                                <li>
                                    <div class="grilla_form sin_margin">
                                        <div class="form_ctrl input_ col_6">
                                            <div class="align_left">
                                            <div class="input_err">
                                                <div class="check_div input_err obligatorio">
                                                    <label class="checkbox-container letra_chica text_regular color_negro">
                                                        Baldeos
                                                        <input type="checkbox" value="Baldeos" id="chkbal" name="filtro2" class="check_cond"> 
                                                        <span class="crear_check"></span> 
                                                    </label>
                                                </div>
                                            </div>
                                            </div>
                                        </div>   
                                    </div>
                                </li>
                                <li>
                                    <div class="grilla_form sin_margin">
                                        <div class="form_ctrl input_ col_6">
                                            <div class="align_left">
                                            <div class="input_err">
                                                <div class="check_div input_err obligatorio">
                                                    <label class="checkbox-container letra_chica text_regular color_negro">
                                                        Donaciones
                                                        <input type="checkbox" value="Donaciones" id="chkdon" name="filtro3" class="check_cond"> 
                                                        <span class="crear_check"></span> 
                                                    </label>
                                                </div>
                                            </div>
                                            </div>
                                        </div>   
                                    </div>
                                </li>
                                <li>
                                    <div class="grilla_form sin_margin">
                                        <div class="form_ctrl input_ col_6">
                                            <div class="align_left">
                                            <div class="input_err">
                                                <div class="check_div input_err obligatorio">
                                                    <label class="checkbox-container letra_chica text_regular color_negro">
                                                        Mordidas
                                                        <input type="checkbox" value="mordidas" id="chkmor" name="filtro3" class="check_cond"> 
                                                        <span class="crear_check"></span> 
                                                    </label>
                                                </div>
                                            </div>
                                            </div>
                                        </div>   
                                    </div>
                                </li>
                                <li class="cont_btn_filtro">
                                    <div class="form_ctrl input_">
                                        <div class="align_right">
                                            <button id="btn-filtro" class="boton_redondeado resaltado_amarillo pd_50_lf_rg">Filtrar</button>
                                        </div>
                                    </div>    
                                </li>
                            </ul>
                        </form>
                        </div>        
                        <span class="btn_tr fichas active" data-type="fichas">Fichas</span>
                        <span class="btn_tr dinero" data-type="dinero">Dinero</span>
                    </div>
                    {{-- <div class="tran_creditos transparencia">
                        <div class="cont_tabla">
                            <table class="light-3" class="display nowrap" style="width:100%height:500px;"
                                    id="mis_fichas_table">
                                <thead>
                                <tr>
                                    <th width="150">Fecha y hora</th>
                                    <th width="100">ID</th>
                                    <th>Descripción</th>
                                    <th width="100">Débito/Crédito</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div> --}}
                    <div class="tran_creditos transparencia">
                        <div class="cont_tabla">
                            <table class="light-3" id="mis_fichas_table">
                                <thead>
                                <tr>
                                    <th>Fecha y hora</th>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Débito/Crédito</th>
                                </tr>
                                </thead>
                                <tbody id="cargar_">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="cargar_texto" class="">
                        <div class="spinner_"><img src="{{url('estilos/front2021/assets/25.gif')}}" alt=""></div>
                        <span class="loading_">Cargando...</span>
                    </div> 
                    <div id="cargar_texto_2">
                        <span class="loading_">No hay más...</span>
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
                        <form action="{{url('reportar')}}" method="POST">
                            @csrf
                            <input type="hidden" name="tx_id" id="report_id_input" value="">
                            <div class="form_ctrl input_">
                                <div class="input_err">
                                    <textarea name="reclamo" id="" cols="" rows=""
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
    {{-- <div id="validacion_requerida" class="modal_">
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
                            <a href="#" class="modal_no subrayado">Ahora no</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div id="validacion_requerida" class="modal_">
        <div class="contenedor">
            <div class="cont_modal_blanco cont_modal_basico resaltado_amarillo">
                <div class="cuerpo_modal">
                    <span class="icono icon-exclamacion_circle"></span>
                    <p class="titulo _barlow_text">Validación requerida</p>
                    <p>Para reportar una transacción tenes que ser miembro.</p>
                    <div class="form_ctrl input_">
                        <div class="align_center">
                            <a href="{{url('validacion-usuario')}}"
                               class="boton_redondeado resaltado_black color_amarillo  pd_50_lf_rg width_100">Validar mi
                                perfil</a></div>
                        <div class="align_center mg_20">
                            <a href="#" class="modal_no subrayado">Ahora no</a>
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


        const colsDinero = [
            {
                "data": "date",
                "render": function (data) {
                    return `<span class="icono icon-flag tooltip"><span class="tooltiptext">Reportar</span></span> ${data}`;
                }
            },
            { "data": "id" },
            { "data": "description" },
            {
                "data": "type",
                "render": function (data) {
                    let classNegativo = "";
                    if (parseInt(data) < 0) {
                        classNegativo = "dinero_negativo";
                    }
                    return `<div class="dinero_td ${classNegativo} align_right"><span class="icono">USD </span>${data}</div>`;
                }
            }
        ];
        const colsFichas = [
            {
                "data": "date",
                "width": "20%",
                "render": function (data) {
                    return `<span class="icono icon-flag tooltip"><span class="tooltiptext">Reportar</span></span> ${data}`;
                }
            },
            { "data": "id", "width": "10%", },
            { "data": "description", "width": "60%", },
            {
                "data": "type",
                "width": "10%",
                "render": function (data) {
                    let classNegativo = "";
                    if (parseInt(data) < 0) {
                        classNegativo = "fichas_negativo";
                    }
                    return `<div class="fichas fichas_td ${classNegativo}"><span class="icono icon-ficha"></span><span class="align_right">${data}</span></div>`;
                }
            }
        ];

        
        const columns = {fichas: colsFichas, dinero: colsDinero};
        const datos = {fichas: {page: 1, pages: 0, data: []}, dinero: {page: 1, pages: 0, data: []}};

        $(document).ready(function () {

            $(".btn_fichas_dinero .btn_tr").on("click", function () {
                if ($(this).hasClass("active")) {

                } else {
                    $(".tran_creditos.transparencia .fichas").toggle();
                    $(".tran_creditos.transparencia .dinero").toggle();
                    $(".btn_fichas_dinero span.active").removeClass("active");
                    $(this).addClass("active");

                    target = $(this).data('type');
                    let page = datos[target].page;

                    if (page == 1) {
                        getData(target);
                    } else {
                        setTable(target);
                    }

                    page = datos[target].page;
                    let pages = datos[target].pages;

                    if (pages >= page) {
                        $("#cargar_texto_2").removeClass("activo");
                    } 


                }
            });


            $(".modal_no").on("click", function () {
                $("#validacion_requerida").fadeOut();
                $(".aviso").fadeOut();
                $('html, body').css('overflowY', 'auto');
            });

            $(".cerrar").on("click", function () {
                $("#reportar_transaccion").fadeOut();
                $("#validacion_requerida").fadeOut();
                $(".aviso").fadeOut();
                $('html, body').css('overflowY', 'auto');
            });

            table.on('click', ".icon-flag", function () {
                const data = table.row($(this).parents('tr')).data();
                $("#report_id").empty().append(data.id);
                $("#report_id_input").val(data.id);
                $('html, body').css('overflowY', 'hidden');

                @if (Auth:: check())
            $("#reportar_transaccion").fadeIn();
            @else
            $("#validacion_requerida").fadeIn();
            @endif
        })
        $("#reportar_transaccion button").on("click", function () {
            $(".aviso").fadeIn();
        });
            });

        function click_flag() {
            $(".icon-flag").on("click", function () {
                $("#report_id").text($(this).parent().parent().find(".id_transaccion").text())
                $("#report_id_input").val($(this).parent().parent().find(".id_transaccion").text())
                $('html, body').css('overflowY', 'hidden');

                @if (Auth:: check())
            $("#reportar_transaccion").fadeIn();
            @else
            $("#validacion_requerida").fadeIn();
            @endif
        })
        $("#reportar_transaccion button").on("click", function () {
            $(".aviso").fadeIn();
        });
            }
        click_flag();


        var cant_agrega = 0;

        var counter_;

        let target = 'fichas';
        
        const user_id = {!! json_encode($user_id) !!};
        const contest_id = {!! json_encode($contest_id) !!};

        let table = $('#mis_fichas_table').DataTable({
            paging: false,
            searching: false,
            lengthChange: false,
            info: false,
            ordering: false,
        });

        getData('fichas');


        document.getElementById("btn-filtro").addEventListener('click', function (event) {
            'use strict';
            event.preventDefault();

            $("#form_filtro").removeClass("abierto");

            if (target == 'fichas')
            {
                datos[target].data = [];
                datos[target].pages = 0;
                datos[target].page = 1;

                getData('fichas');
            }

        }, false);




        $(window).scroll(function () {

            if (($(window).scrollTop() + $(window).height()) >= ($(document).height() - 100)) {

                if (counter_ != undefined) {
                    clearInterval(counter_)
                }

                let page = datos[target].page;
                let pages = datos[target].pages;

                //if (page >= pages + 1 || cant_agrega == "no hay mas") {
                if (page >= pages + 1) {
                    $("#cargar_texto").removeClass("activo");
                    $("#cargar_texto_2").addClass("activo");

                } else {

                    $("#cargar_texto").addClass("activo");

                    counter_ = setTimeout(function () {
                        
                        getData(target);

                        click_flag();
                        $("#cargar_texto").removeClass("activo");

                        $('body').css('overflow', 'auto')

                        cant_agrega++;
                    }, 1000);
                }

            };
        });


        /* Submenu de busqueda */

        $("#form_filtro .icon-cancel").on("click", function () {
            $("#form_filtro").removeClass("abierto");
        })
        $("#open_menu").on("click", function () {
            if ($("#form_filtro").hasClass("abierto")) {

                $("#form_filtro").removeClass("abierto");
            } else {
                $("#form_filtro").addClass("abierto");
            }
        })
        $(document).ready(function () {
            $('#form_filtro').submit(function (e) {
                e.preventDefault();
            });
        });

        function getData(target) {

            const chkcon = document.getElementById('chkcon').checked;
            const chkdon = document.getElementById('chkdon').checked;
            const chkbal = document.getElementById('chkbal').checked;
            const chkmor = document.getElementById('chkmor').checked;

            let url = `{!! url('transparencia/${target}') !!}/?chkcon=${chkcon}&chkdon=${chkdon}&chkbal=${chkbal}&chkmor=${chkmor}&page=${datos[target].page}`;

            if (user_id) {
                url += `&user_id=${user_id}`;
            } 

            if (contest_id) {
                url += `&contest_id=${contest_id}`;
            } 

            fetch(url, {
                method: 'GET',
            }).then(response => response.text()).then(data => {

                let txs = JSON.parse(data);

                if (txs.last_page >= txs.current_page) {
                    $("#cargar_texto_2").removeClass("activo");
                } 

                datos[target].data = datos[target].data.concat(txs.data);
                datos[target].pages = txs.last_page;
                datos[target].page++; 

                setTable(target);

            }).catch(error => console.log(error));

        }

        function setTable(target) {
            table.destroy();
            table = $('#mis_fichas_table').DataTable({
                paging: false,
                searching: false,
                lengthChange: false,
                info: false,
                ordering: false,
                language: lang,
                data: datos[target].data,
                columns: columns[target]
            });
        }

    </script>

@endsection




