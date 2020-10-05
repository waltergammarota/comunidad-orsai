@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    {{$title}}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{url("admin/contenidos/crear/$type")}}" class="btn btn-primary editar float-right">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Slug</th>
                    <th>Fecha publicación</th>
                    <th>Visible</th>
                    @if($type === "pagina")
                        <th>Pública</th>
                    @endif
                    <th>Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>


    <div class="modal fade" id="modal-eliminar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar novedad</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Desea eliminar la novedad?</p>
                    <p class="novedadData"></p>
                    <input type="hidden" name="id" value="0" class="novedadId">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Cancelar
                    </button>
                    <button type="button" class="btn btn-success"
                            id="eliminar-button">SI
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('footer')

    <script>
        $(function () {
            const table = $('#example2').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "order": [[2, "desc"]],
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url("admin/contenidos-json/$type")}}",
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
                    {
                        "data": "title",
                        "render": function (data) {
                            return '<a href="#" class="editar">' + data + '</a>';
                        }

                    },
                    {"data": "slug"},
                    {"data": "fecha_publicacion"},
                    {
                        "data": "visible",
                        "render": function (data) {
                            return data == 1 ? "SI" : "NO"
                        }
                    },

                        @if($type === "pagina")
                    {
                        "data": "publica",
                        "render": function (data) {
                            return data == 1 ? "SI" : "NO"
                        }
                    },
                        @endif

                    {
                        "data": "acciones",
                        "render": function (data) {
                            return `<button type="button" class="btn btn-xs btn-success editar">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-danger eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-primary link">
                                        <i class="fa fa-eye"></i>
                                    </button>`;
                        }
                    },
                ]
            });

            table.on('click', '.link', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                const slug = data.slug;
                @if($type == "pagina")
                    window.location.href = `{{url('')}}/${slug}`;
                @else
                    window.location.href = `{{url('novedades')}}/${slug}`;
                @endif
            });

            table.on('click', '.editar', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                window.location.href = `{{url('admin/contenidos')}}/${id}`;
            });

            table.on('click', '.eliminar', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                $(".novedadId").val(id);
                $(".novedadData").empty().append(`Novedad: ${data.title}`)
                $("#modal-eliminar").modal('show');
            });

            $("#eliminar-button").click(function (event) {
                event.preventDefault();
                const id = $(".novedadId").val();
                axios.post('{{url('admin/contenidos/eliminar')}}', {
                    id: id
                }).then(response => {
                    alert("Novedad eliminada");
                    table.ajax.reload();
                    $("#modal-eliminar").modal('hide');
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde");
                    $("#modal-eliminar").modal('hide');
                });

            })


        });
    </script>
@endsection

