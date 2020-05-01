@extends('admin.admin-template')

@section('header')
    <link rel="stylesheet"
          href="{{url("admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet"
          href="{{url("admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection


@section('name')
    Usuarios
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Activo</th>
                    <th>Empezar</th>
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
                "responsive": true,
                "ajax": "{{url('admin/concurso-json')}}",
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "start_date"},
                    {"data": "end_date"},
                    {
                        "data": "active",
                        "render": function (data) {
                            return data == 1 ? "SI" : "NO";
                        }
                    },
                    {
                        "data": "actions",
                        "render": function (data, type, row, meta) {
                            if(row.active == 1) {
                                return `<button type="button" class="btn btn-block btn-primary">Pausar</button>`;
                            }
                            return `<button type="button" class="btn btn-block btn-primary">Activar</button>`;
                        }
                    }
                ]
            });

            table.on( 'click', 'button', function () {
                const data = table.row( $(this).parents('tr') ).data();
                const id = data.id;
                axios.post('{{url('admin/contest/approve')}}',{
                    id: id
                }).then(response => {
                    alert("Concurso ha cambiado de estado");
                    table.ajax.reload();
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde")
                })
            } );
        });
    </script>
@endsection

