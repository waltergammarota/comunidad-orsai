@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    Cotizaciones
@endsection

@section('content')
    <style>
        #myTable {
            font-size: 14px;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <a href="{{url("admin/cotizaciones/crear")}}" class="btn btn-primary editar float-right">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="card-body">
            <br>
            <table id="myTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Precio</th>
                    <th>Usuario</th>
                    <th>Creado</th>
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
                "ajax": "{{url('admin/cotizaciones-json')}}",
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
                    "info": "Mostrando _START_ al _END_ de un total de _TOTAL_ entradas",
                    "lengthMenu": 'Mostrar <select name="example2_length" aria-controls="example2" class=" custom-select custom-select-sm form-control form-control-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todas</option>' +
                        '</select> entradas',

                },
                "columns": [
                    {"data": "id"},
                    {"data": "precio"},
                    {
                        "data": "user",
                        render: function (data) {
                            return data.email;
                        }
                    },
                    {"data": "created_at"}
                ]
            });

            table.on('click', '.editar', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                window.location.href = `{{url('admin/productos')}}/${id}`;
            });
        });
    </script>
@endsection

