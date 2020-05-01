@extends('admin.admin-template')

@section('header')
    <link rel="stylesheet" href="{{url("admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{url("admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection


@section('name')
    Transacciones
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Tipo</th>
                    <th>Monto</th>
                    <th>Postulacion</th>
                    <th>Fecha</th>
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
    <script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>
    <script>
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url('admin/transacciones-json')}}",
                "columns": [
                    { "data": "id" },
                    { "data": "get_from_user.name" },
                    { "data": "get_to_user.name" },
                    { "data": "type" },
                    { "data": "amount" },
                    { "data": "capId",
                        "render": function ( data ) {
                            return data == null ? "" :data.title;
                    }},
                    { "data": "created_at" }
                ]
            });
        });
    </script>
@endsection

