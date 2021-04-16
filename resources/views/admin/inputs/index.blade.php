@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    Campos
@endsection

@section('content')
    <style>
        #myTable {
            font-size: 14px;
        }
    </style>
    <div class="card">
        <div class="card-header">
            {{-- <a href="{{url("admin/inputs/crear")}}" class="btn btn-primary editar float-right">
                <i class="fa fa-plus-circle"></i>
            </a> --}}
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Type</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(function () {
            const table = $('#myTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "ajax": "{{url('admin/inputs-json')}}",
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
                    "info": "Mostrando _START_ al _END_ de un total de _TOTAL_ campos",
                    "lengthMenu": 'Mostrar <select name="example2_length" aria-controls="example2" class=" custom-select custom-select-sm form-control form-control-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todas</option>' +
                        '</select> campos',

                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "type"},
                    {"data": "created_at"},
                    {
                        "data": "acciones",
                        "render": function (data) {
                            return `<button type="button" class="btn btn-xs btn-success editar">
                                        <i class="fa fa-edit"></i>
                                    </button>`;
                        }
                    },

                ]
            });

            table.on('click', '.editar', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                window.location.href = `{{url('admin/inputs')}}/${id}`;
            });
        });
    </script>
@endsection

