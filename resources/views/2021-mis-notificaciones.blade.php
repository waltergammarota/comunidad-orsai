@extends('2021-orsai-template')

@section('title', 'Mis notificaciones | Comunidad Orsai')
@section('description', 'Mis notificaciones')

@section('header')
@endsection

@section('content')
    <section class="resaltado_gris pd_20_tp_bt ">
        <article class="contenedor ft_size form_rel pd_15_extra">
            <div class="interna_panel_blanco">
                <div class="form_central_3">
                    <div class="border_bt_form">
                        <div class="titulo titulo_sin_mg">
                            <h1 class="text_regular">Mis notificaciones</h1>
                        </div>
                    </div>
                    <div class="height_20"></div>
                </div>
                <div class="form_central_3 ">
                    <table class="light-3 display" id="notificaciones_table" border="0">
                    </table>
                    <div class="height_35"></div>
                </div>
            </div>
        </article>
        @endsection
        @section('footer')
            <link rel="stylesheet"
                  href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
            <style>

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
                    const myTable = $('#notificaciones_table').DataTable({
                        "paging": true,
                        "searching": false,
                        "info": false,
                        "ordering": true,
                        "order": [[2, "desc"]],
                        "autoWidth": false,
                        "responsive": true,
                        "ajax": "{{url('notificaciones-json')}}",
                        "language": {
                            select: {
                                rows: {
                                    _: "| %d notificaciones selecionadas",
                                    0: "",
                                    1: "| 1 notificación selecionada"
                                }
                            },
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": ">",
                                "sPrevious": "<"
                            },
                            "emptyTable": "No hay notificaciones para tí",
                            "search": "Buscar:",
                            "processing": "Procesando...",
                            "loadingRecords": "Cargando....",
                            "info": "Mostrando _START_ al _END_ de un total de _TOTAL_ notificaciones",
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
                                    return `<div style="display:none">${data.deliver_time}</div>`;
                                }
                            },
                            {
                                "data": function (data) {
                                    return `<div class="grilla_form notificacion read"><div class="form_ctrl input_ col_6 round_label_cont "><div class="align_left"><div class="input_err"><div class=" input_err obligatorio"><div class="contenedor_notif"><a href="{{url('notificacion')}}/${data.id}"><div class="preview_notificacion"><span class="letra_chica text_bold">${data.title}</span></div><div class="explica_notif color_gris_claro"><span class="text_bold">${data.autor}</span> <span>-</span> <span>${data.deliver_time}</span></div></a></div></div></div></div></div></div>`;
                                }
                            },
                            {
                                "data": function (data) {
                                    return data.deliver_time;
                                }
                            }

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
                                text: '<div class="icono_notif no_leido_notif" title="Marcar como no leida"><span class="icono icon-mail"></span></div>',
                                className: 'btn_notif tooltip-read',
                                action: function (e, dt, node, config) {
                                    markAsNotRead();
                                }
                            },
                            {
                                text: '<div class="icono_notif leida_ind_notif" title="Marcar como leida"><span class="icono icon-mail-open-regular "></span></div>',
                                className: 'btn_notif tooltip-noread',
                                action: function (e, dt, node, config) {
                                    markAsRead();
                                }
                            },
                            {
                                text: '<div class="icono_notif leida_todas_notif" title="Marcar todas como leidas"><span class="icono icon-mail-open"></span></div>',
                                className: 'btn_notif tooltip-readall',
                                action: function (e, dt, node, config) {
                                    markAllAsRead();
                                }
                            },
                            {
                                text: '<div class="icono_notif eliminar_notif" title="Eliminar"><span class="icono icon-trash-empty"></span></div>',
                                className: 'btn_notif tooltip-trash',
                                action: function (e, dt, node, config) {
                                    deleteNotification();
                                }
                            }
                        ],
                        initComplete: function (settings, json) {
                            $(".btn_notif").removeClass("dt-button");
                        },
                        "rowCallback": function (row, data) {
                            if (data.readed == "NO") {
                                $(row).addClass("unread");
                            } else {
                                $(row).addClass("read");
                            }
                        }
                    });

                    function markAllAsRead() {
                        axios.post('{{url('notificaciones/markallasreaded')}}', {}).then(response => {
                            myTable.ajax.reload();
                            updateNotifications();
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
                                updateNotifications();
                            }).catch(error => {
                                alert("Ha ocurrido un error. Intente más tarde");
                            });

                        }
                    }

                    function markAsNotRead() {
                        const indexes = myTable.rows({selected: true});
                        const rows = indexes.map(item => {
                            return myTable.rows(item).data().toArray();
                        });
                        if (rows.length > 0) {
                            const notifications = rows[0].map(item => {
                                return item.id;
                            });
                            axios.post('{{url('notificaciones/mark-as-not-read')}}', {
                                ids: notifications
                            }).then(response => {
                                myTable.ajax.reload();
                                updateNotifications();
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
                                updateNotifications();
                            }).catch(error => {
                                alert("Ha ocurrido un error. Intente más tarde");
                            });

                        }

                    }
                })
                ;
            </script>
@endsection




