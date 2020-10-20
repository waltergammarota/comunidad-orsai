@extends('orsai-template')

@section('title', 'Mis notificaciones | Comunidad Orsai')
@section('description', 'Mis notificaciones')

@section('header')
    <style>
        table.dataTable tbody td {
            padding: 0px !important;
        }

        thead {
            display: none;
        }

        td.select-checkbox {
            width: 5% !important;
        }

        table.dataTable tbody td.select-checkbox:before, table.dataTable tbody th.select-checkbox:before {
            margin-top: 5px !important;
        }

        table.dataTable tr.selected td.select-checkbox:after, table.dataTable tr.selected th.select-checkbox:after {
            margin-top: -1px !important;
        }

        .no-border {
            border: 0px;
            padding: 15px 10px;
        }

        article.box_notification.no-border {
            text-align: left;
        }

        .tran_creditos .cont_tabla table tbody tr td:not(:last-child) {
            border-right: 0px !important;
        }

        table.dataTable.row-border tbody tr:first-child th, table.dataTable.row-border tbody tr:first-child td, table.dataTable.display tbody tr:first-child th, table.dataTable.display tbody tr:first-child td {
            border-top: 1px solid black !important;
        }

        table.dataTable.row-border tbody th, table.dataTable.row-border tbody td, table.dataTable.display tbody th, table.dataTable.display tbody td {
            border-top: 1px solid black !important;
        }

        .tran_creditos .cont_tabla table tbody tr, tbody tr td:last-child {
            border-right: 1px solid black;
        }

        .tran_creditos .cont_tabla table tbody tr, tbody tr td:first-child {
            border-left: 1px solid black;
        }

        button.dt-button {
            margin-bottom: 20px !important;
            display: none !important;
        }

        .btn_readed {
            cursor: pointer;
        }

        .resaltado_amarillo {
            background-color: #ffed00 !important;
        }

        .resaltado_blanco {
            background-color: white !important;
        }
    </style>
@endsection



@section('content')
    <section id="intro" class="contenedor intro_gral panel info_personal"
             style="font-size: inherit !important;">
        <div class="info_per_left">
            <div class="">
                <div id="links_back">
                    <a href="{{url('panel')}}">Panel de usuario</a>
                    <span>Mis notificaciones</span>
                </div>
                <div id="user_alias">
                    <h1>Mis notificaciones</h1>
                </div>
            </div>
        </div>


        <div class="tran_creditos">
            <div class="cont_tabla">
                <table class="light-3 display" id="myTable">
                    <thead>
                    <tr>
                        <th>checkbox</th>
                        <th>data</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: none !important;
            border: transparent !important;
            text-decoration-line: underline !important;
            font-weight: 700;
            font-size: 15px;
            color: black;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: none !important;
            border: transparent !important;
            color: black !important;
            font-weight: 700 !important;
        }
    </style>
    <script
        src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
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

        $(function () {
            const myTable = $('#myTable').DataTable({
                "paging": true,
                "searching": false,
                "info": true,
                "ordering": true,
                "order": [[2, "desc"]],
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url('notificaciones-json')}}",
                "language": {
                    "paginate": {
                        "first": "Primera",
                        "last": "Última",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "emptyTable": "No hay notificaciones para tí",
                    "search": "Buscar:",
                    "processing": "Procesando...",
                    "loadingRecords": "Cargando....",
                    "info": "Mostrando _START_ al _END_ de un total de _TOTAL_ transacciones",
                    "lengthMenu": 'Mostrar <select name="example2_length" aria-controls="example2" class=" custom-select custom-select-sm form-control form-control-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todas</option>' +
                        '</select> notificaciones',

                },
                "columns": [
                    {
                        "data": function (data) {
                            return '';
                        }
                    },
                    {
                        "data": function (data) {
                            console.log(data);
                            return `<article class="box_notification no-border">
                    <a href="{{url('notificacion')}}/${data.id}">
                        <div class="box_notification_data">
                            <h2 class="box_notification_title">${data.title}</h2>
                                <p class="box_notification_author">${data.autor}</p>
                                <span class="box_notification_date">${data.deliver_time}</span>
                        </div>
                    </a>
                </article>`;
                        }
                    },
                    {"data": "id"}

                ],
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0,
                    width: "20%",
                },
                    {
                        "targets": [2],
                        "visible": false,
                        "searchable": false
                    }
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'

                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Marcar como leídas',
                        className: 'btn_readed',
                        action: function (e, dt, node, config) {
                            markAsRead();
                        }
                    },
                    {
                        text: 'Marcar todas como leídas',
                        className: 'btn_readed',
                        action: function (e, dt, node, config) {
                            markAllAsRead();
                        }
                    },
                    {
                        text: 'Borrar',
                        className: 'btn_readed',
                        action: function (e, dt, node, config) {
                            deleteNotification();
                        }
                    }
                ],
                initComplete: function (settings, json) {
                    $(".btn_readed").removeClass("dt-button");
                },
                "rowCallback": function (row, data) {
                    console.log(row, data);
                    if (data.readed == "NO") {
                        $(row).addClass("resaltado_amarillo");
                    } else {
                        $(row).addClass("resaltado_blanco");
                    }
                }
            });

            function markAllAsRead() {
                axios.post('{{url('notificaciones/markallasreaded')}}', {}).then(response => {
                    myTable.ajax.reload();
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde");
                });

            }

            function deleteNotification() {
                const indexes = myTable.rows({selected: true});
                const rows = indexes.map(item => {
                    return myTable.rows(item).data().toArray();
                });
                if (rows.length > 0) {
                    const notifications = rows[0].map(item => {
                        return item.id;
                    });
                    axios.post('{{url('notificaciones/delete')}}', {
                        ids: notifications
                    }).then(response => {
                        myTable.ajax.reload();
                    }).catch(error => {
                        alert("Ha ocurrido un error. Intente más tarde");
                    });

                }
            }

            function markAsRead() {
                const indexes = myTable.rows({selected: true});
                const rows = indexes.map(item => {
                    return myTable.rows(item).data().toArray();
                });
                if (rows.length > 0) {
                    const notifications = rows[0].map(item => {
                        return item.id;
                    });
                    axios.post('{{url('notificaciones/mark-as-read')}}', {
                        ids: notifications
                    }).then(response => {
                        myTable.ajax.reload();
                    }).catch(error => {
                        alert("Ha ocurrido un error. Intente más tarde");
                    });

                }

            }
        })
        ;
    </script>
@endsection




