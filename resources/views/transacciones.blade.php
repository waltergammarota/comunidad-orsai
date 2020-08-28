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
                    <span>Mis fichas</span>
                </div>
                <div id="user_alias">
                    <h1>Mis fichas</h1>
                </div>
            </div>
        </div>
        <!-- Agregar acá la verificación si ya inició el concurso -->
        <!-- Necesito la variable $hasStarted --><!-- 
        @if($hasStarted)
            <div class="lets_start ">
                <a href="{{url('participantes')}}" class="resaltado_amarillo">Empezá a poner fichas &raquo;</a>
            </div>
        @endif -->
        <div class="tran_creditos">
            <div class="cont_tabla">
                <table class="light-3 display" id="myTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Información</th>
                        <th>Fichas</th>
                        <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($txs as $tx)
                        <tr>
                            <td>{{$tx->id}}</td>
                            <td>{{$tx->data}}</td>
                            <td>{{$tx->amount}}</td>
                            <td>{{$tx->created_at}}</td>
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
            "sEmptyTable": "Ningún dato disponible en esta tabla =(",
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




