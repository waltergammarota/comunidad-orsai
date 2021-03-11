@extends('2021-orsai-template')

@section('title', 'Transparencia | Comunidad Orsai')
@section('description', 'Transparencia económica')

@section('content')

    <section class="resaltado_gris pd_20_tp_bt ">
        <div class="contenedor ft_size form_rel">
            <div class="grilla_perfil ">
                <div class="miga_pan">
                    <ul>
                        <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel de usuario <span
                                    class="icon-right-open"></span></a></li>
                        <li><a href="#" class="activo" rel="noopener noreferrer">Transparencia</a></li>
                    </ul>
                    <div class="height_20"></div>
                </div>
            </div>
        </div>
        <article class="contenedor ft_size form_rel pd_15_extra">
            <div class="interna_panel_blanco">
                <div class="form_central_3">
                    <div class="border_bt_form">
                        <div class="titulo titulo_sin_mg">
                            <h1 class="text_regular">Transparencia</h1>
                        </div>
                    </div>
                    <div class="height_20"></div>
                </div>
                <div class="form_central_3">
                    <div class="intro_panel_perfil_2">
                        <div class="intro_panel_fichas_2">
                            <div class="icono">
                                <span class="icon-ficha"></span>
                            </div>
                            <span class="subtitulo">Tenés</span>
                            <p class="titulo"><strong>{{Session::get('balance')}}</strong> Fichas</p>
                        </div>
                    </div>
                </div>
                <div class="form_central_3 ">
                    <div class="tran_creditos">
                        <div class="cont_tabla">
                            <table class="light-3" id="mis_fichas_table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Origen</th>
                                    <th>Débito</th>
                                    <th>Crédito</th>
                                    <th>Fecha y hora</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </article>

    </section>
@endsection

@section('footer')
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
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
            $('#mis_fichas_table').DataTable({
                "searching": false,
                "lengthChange": false,
                "info": false,
                "ordering": true,
                "order": [[0, "desc"]],
                "serverSide": true,
                "ajax": '{{url('transparencia-json')}}',
                language: lang,
                "columns": [
                    {"data": "id"},
                    {"data": "description"},
                    {"data": "username"},
                    {"data": "debit"},
                    {"data": "credit"},
                    {"data": "date"}
                ]
            })
        });
    </script>
@endsection




