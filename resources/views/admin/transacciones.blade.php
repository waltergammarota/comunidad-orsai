@extends('admin.admin-template')

@section('header')

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
                    <th>Descripción</th>
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
                    "lengthMenu": 'Mostrar <select name="example2_length" aria-controls="example2" class=" custom-select custom-select-sm form-control form-control-sm">'+
                      '<option value="10">10</option>'+
                      '<option value="20">20</option>'+
                      '<option value="30">30</option>'+
                      '<option value="40">40</option>'+
                      '<option value="50">50</option>'+
                      '<option value="-1">Todas</option>'+
                      '</select> transacciones',

                },
                "columns": [
                    { "data": "id" },
                    { "data": "get_from_user.name" },
                    { "data": "get_to_user.name" },
                    { "data": "type",
                        "render": function(data) {
                            switch (data) {
                                case "MINT":
                                    return "Emisión";
                                    break;
                                case "BURN":
                                    return "Quemado";
                                    break;
                                case "TRANSFER":
                                    return "Transferencia";
                                    breack;
                            }
                        }},
                    { "data": "amount" },
                    { "data": "data" },
                    { "data": "created_at" }
                ]
            });
        });
    </script>
@endsection

