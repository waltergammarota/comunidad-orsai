@extends('orsai-template')

@section('title', 'Mis notificaciones | Comunidad Orsai')
@section('description', 'Mis notificaciones')

@section('header')
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
         

        <div class="box_notifications">
            <a href="#" class="btn_readed">Marcar como leídas</a>
            @foreach($notifications as $notification)
                <article class="box_notification resaltado_amarillo" >
                    <a href="{{url('notificacion')}}/{{$notification->id}}">
                        <div class="box_notification_read">
                            <input type="checkbox">
                        </div>
                        <div class="box_notification_data">
                                <h2 class="box_notification_title">{{$notification->data['title']}}</h2> 
                                <p class="box_notification_author">{{$notification->data['author']}}</p>
                                <span class="box_notification_date">{{$notification->data['deliver_time']}}</span> 

                        </div>
                    </a>
                </article>
                <article class="box_notification" >
                    <a href="{{url('notificacion')}}/{{$notification->id}}">
                        <div class="box_notification_read">
                            <input type="checkbox">
                        </div>
                        <div class="box_notification_data">
                                <h2 class="box_notification_title">{{$notification->data['title']}}</h2> 
                                <p class="box_notification_author">{{$notification->data['author']}}</p>
                                <span class="box_notification_date">{{$notification->data['deliver_time']}}</span> 

                        </div>
                    </a>
                </article>
                <article class="box_notification" >
                    <a href="{{url('notificacion')}}/{{$notification->id}}">
                        <div class="box_notification_read">
                            <input type="checkbox">
                        </div>
                        <div class="box_notification_data">
                                <h2 class="box_notification_title">{{$notification->data['title']}}</h2> 
                                <p class="box_notification_author">{{$notification->data['author']}}</p>
                                <span class="box_notification_date">{{$notification->data['deliver_time']}}</span> 

                        </div>
                    </a>
                </article>
            @endforeach  
        </div>
        <div class="tran_creditos">
            <div class="cont_tabla">

                <table class="light-3 display" id="myTable">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Título</th>
                        <th>Asunto</th>
                        <th>Autor</th>
                        <th>Fecha</th>
                        <th>Leída</th>
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
                "order": [[4, "desc"]],
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
                    {"defaultContent": ""},
                    {"data": "title"},
                    {"data": "subject"},
                    {"data": "autor"},
                    {"data": "deliver_time"},
                    {"data": "readed"},
                    {"data": "id"}

                ],
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                },
                    {
                        "targets": [6],
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
                        text: 'Marcar como leído',
                        action: function (e, dt, node, config) {
                            markAsRead();
                        }
                    }
                ]
            });

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
        });


    </script>
@endsection




