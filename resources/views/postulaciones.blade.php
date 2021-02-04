@extends('orsai-template')

@section('title', 'Mis transacciones | Comunidad Orsai')
@section('description', 'Mis transacciones')

@section('content')
    <section id="intro" class="contenedor intro_gral panel info_personal"
             style="font-size: inherit !important;">
        <div class="info_per_left">
            <div class="">
                <div id="links_back">
                    <a href="{{url('panel')}}">Panel de usuario</a>
                    <span>Mis postulaciones</span>
                </div>
                <div id="user_alias">
                    <h1>Mis postulaciones</h1>
                </div>
            </div>
        </div>
        <div class="tran_creditos">
            <div class="cont_tabla">
                <table class="light-3 display" id="myTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Postulación</th>
                        <th>Concurso</th>
                        <th>Fecha de presentación</th>
                        <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($postulaciones as $postulacion)
                        <tr>
                            <td>{{$postulacion->id}}</td>
                            <td>{{$postulacion->title}}</td>
                            {{-- TODO DEFINIR IMAGEN DE CADA TIPO--}}
                            <td><img src="{{url('img/participantes/participante.jpg')}}" width="24"
                                     alt="modo_concurso">&nbsp;{{$postulacion->contest()->first()->name}}</td>
                            <td>{{$postulacion->created_at->subHours(3)->format('d/m/Y H:i')}}</td>
                            <?php $status = $postulacion->status()->first(); ?>
                            @if($status->status  == 'approved')
                                <td><a href="{{url('postulacion/'.$postulacion->id)}}"
                                       class="subrayado resaltado_aprobada">Aprobada</a></td>
                            @elseif($status->status == "rejected")
                                <td><a href="{{url('postulacion/'.$postulacion->id)}}"
                                       class="subrayado resaltado_rechazada">Rechazada</a></td>
                            @elseif($status->status== "draft")
                                <td><a href="{{url('postulacion/'.$postulacion->id)}}"
                                       class="subrayado">Borrador</a></td>
                            @elseif($status->status== "sent")
                                <td><a href="{{url('postulacion/'.$postulacion->id)}}"
                                       class="subrayado resaltado_amarillo">En revisión</a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
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
            $('#myTable').DataTable({
                "searching": false,
                "lengthChange": false,
                "paging": true,
                "info": false,
                language: lang,
            });
        });
    </script>
@endsection




