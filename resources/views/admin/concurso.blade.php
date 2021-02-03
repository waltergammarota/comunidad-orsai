@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    Concursos
@endsection

@section('content')
    <style>
        #example2 {
            font-size: 14px;
        }

        .btn {
            font-size: 11px;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <a href="{{url("admin/concursos/crear")}}" class="btn btn-primary editar float-right">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Modo</th>
                    <th>Inicio Concurso</th>
                    <th>Fin Concurso</th>
                    <th>Inicio postulaciones</th>
                    <th>Fin postulaciones</th>
                    <th>Inicio votación</th>
                    <th>Fin votación</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('footer')
    <script
        src="{{url("admin/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script
        src="{{url("admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script
        src="{{url("admin/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script
        src="{{url("admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
    <script
        src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>
    <script>
        $(function () {

            const table = $('#example2').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "ajax": "{{url('admin/concurso-json')}}",
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {
                        "data": "type",
                        "render": function (data) {
                            switch (data) {
                                case 1:
                                    return "Narrativa corta";
                                    break;
                                case 2:
                                    return "Narrativa larga";
                                    break;
                                case 3:
                                    return "Imagen";
                                    break;
                            }
                        }
                    },
                    {
                        "data": "mode",
                        "render": function (data) {
                            switch (data) {
                                case 1:
                                    return "Pozo";
                                    break;
                                case 2:
                                    return "Completo";
                                    break;
                                case 3:
                                    return "Fijo";
                                    break;
                            }
                        }
                    },
                    {"data": "start_date"},
                    {"data": "end_date"},
                    {"data": "start_app_date"},
                    {"data": "end_app_date"},
                    {"data": "start_vote_date"},
                    {"data": "end_vote_date"},
                    {
                        "data": "active",
                        "render": function (data) {
                            return data == 1 ? "SI" : "NO";
                        }
                    },
                    {
                        "data": "actions",
                        "render": function (data, type, row, meta) {
                            if (row.active == 1) {
                                return `<button type="button" class="btn btn-primary pausar">Ocultar</button>
                                 <button type="button" class="btn btn-success editar">Editar</button>`;
                            }
                            return `<button type="button" class="btn btn-primary pausar">Mostrar</button>
                                    <button type="button" class="btn btn-success editar">Editar</button>`;
                        }
                    }
                ]
            });

            table.on('click', '.editar', function () {
                const data = table.row($(this).parents('tr')).data();
                window.location.href = `{{url('admin/contest/editar')}}/${data.id}`;
            });

            table.on('click', '.pausar', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                axios.post('{{url('admin/contest/approve')}}', {
                    id: id
                }).then(response => {
                    alert("Concurso ha cambiado de estado");
                    table.ajax.reload();
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde")
                })
            });
        });
    </script>
@endsection

