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
                    <th>Id</th>
                    <th>Título</th>
                    <th>Slug</th>
                    <th>Fecha publicación</th>
                    <th>Visible</th>
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
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url("admin/contenidos-json/$type")}}",
                "columns": [
                    { "data": "id" },
                    { "data": "title" },
                    { "data": "slug" },
                    { "data": "fecha_publicacion" },
                    {
                        "data": "visible",
                        "render": function (data) {
                            return data == 1? "SI":"NO"
                        }
                    },
                    {
                        "data": "acciones",
                        "render": function (data) {
                            return `<button type="button" class="btn btn-xs btn-success editar">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-danger eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>`;
                        }
                    },
                ]
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

            $("#eliminar-button").click(function(event)  {
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

