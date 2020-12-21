@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    Productos
@endsection

@section('content')
    <style>
        #myTable {
            font-size: 14px;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <a href="{{url("admin/productos/crear")}}" class="btn btn-primary editar float-right">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($dolar as $cotizacion)
                    <div class="col-md-3 col-lg-3">
                        {{$cotizacion->casa->nombre}}: {{$cotizacion->casa->compra}}
                        - {{$cotizacion->casa->venta}}
                    </div>
                @endforeach
            </div>
            <br>
            <table id="myTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Visible</th>
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
                "ajax": "{{url('admin/productos-json')}}",
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
                    {"data": "name"},
                    {"data": "price"},
                    {
                        "data": "visible",
                        "render": function (data) {
                            return data === 1 ? "SI" : "NO"
                        }
                    },
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
                window.location.href = `{{url('admin/productos')}}/${id}`;
            });
        });
    </script>
@endsection

