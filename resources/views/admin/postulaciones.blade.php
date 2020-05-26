@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    Postulaciones
@endsection

@section('content')
    <style>
        #myTable {
            font-size: 14px;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <table id="myTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Usuario</th>
                    <th>Descripción</th>
                    <th>Link</th>
                    <th>Votos</th>
                    <th>Status</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rechazo de postulación</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Por favor, escriba un motivo del rechazo</p>
                    <input type="hidden" name="id" value="0" id="postulacion">
                    <textarea name="comentario" id="comentario"
                              class="form-control"
                              rows="3"></textarea>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-primary"
                            id="enviarRechazo">Enviar
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="modal-ganador">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Postulación ganadora</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Desea hacer esta postulación ganadora?</p>
                    <input type="hidden" name="id" value="0" id="postulacion">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-success"
                            id="ganador-button">SI
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-eliminar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar postulación</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Desea eliminar esta postulación?</p>
                    <input type="hidden" name="id" value="0" id="cap_id">
                    <p id="capTitle"></p>
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
            const table = $('#myTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "ajax": "{{url('admin/postulaciones-json')}}",
                "columns": [
                    {"data": "id"},
                    {
                        "data": "title",
                        "render": function (data, type, row, meta) {
                            return `<a href="{{url('propuesta')}}/${row.id}" target="_blank">${data}</a>`;
                        }
                    },
                    {
                        "data": "owner",
                        "render": function (data) {
                            return data == null ? "" : data.name + data.lastName;
                        }
                    },
                    {"data": "description"},
                    {
                        "data": "link",
                        "render": function (data) {
                            const link = data.substring(0,17) + '...';
                            return data == null ? "" : `<a href="${data}" target="_blank">${link}</a>`;
                        }
                    },
                    {
                        "data": "votes",
                        "render": function (data) {
                            return data == null ? "" : data;
                        }
                    },
                    {
                        "data": "status",
                        "render": function (data) {
                            return (data == null || data.length == 0) ? "" : data[0].status.toUpperCase();
                        }
                    },
                    {"data": "created_at"},
                    {
                        "data": "actions",
                        "render": function (data, type, row, meta) {
                            return `<button type="button" class="btn btn-xs btn-success aprobar">
                                        <i class="fa fa-check-circle"></i>
                                    </button>
                            &nbsp;<button type="button" class="btn btn-xs  btn-danger rechazar">
                                        <i class="fa fa-times-circle"></i>
                                    </button>
                            &nbsp;<button type="button" class="btn btn-xs btn-warning ganador">
                                        <i class="fa fa-wine-glass"></i>
                                    </button>
                            <button type="button" class="btn btn-xs btn-danger eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>`;
                        }
                    },
                ]
            });



            table.on('click', '.aprobar', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                axios.post('{{url('admin/application/approve')}}', {
                    id: id
                }).then(response => {
                    alert("Postulación aprobada");
                    table.ajax.reload();
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde");
                });
            });

            table.on('click', '.eliminar', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                $("#cap_id").val(id);
                $("#capTitle").empty().append(`Titulo: ${data.title}`);
                $('#modal-eliminar').modal('show');

            });

            table.on('click', '.rechazar', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                $("#postulacion").val(id);
                $('#modal-default').modal('show');
            });

            table.on('click', '.ganador', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                $("#postulacion").val(id);
                $('#modal-ganador').modal('show');
            });


            $("#enviarRechazo").click((event) => {
                event.preventDefault();
                const text = $("#comentario").val();
                const id = $("#postulacion").val();
                $('#modal-default').modal('hide');
                axios.post('{{url('admin/application/reject')}}', {
                    id: id,
                    comment: text
                }).then(response => {
                    alert("Postulación rechazada");
                    table.ajax.reload();
                    $("#postulacion").val(0);
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde");
                    $("#postulacion").val(0);
                });
            });

            $("#ganador-button").click((event) => {
                event.preventDefault();
                const id = $("#postulacion").val();
                $('#modal-ganador').modal('hide');
                axios.post('{{url('admin/application/winner')}}', {
                    id: id,
                }).then(response => {
                    alert("Habemus logo");
                    table.ajax.reload();
                    $("#postulacion").val(0);
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde");
                    $("#postulacion").val(0);
                });
            });

            $("#eliminar-button").click((event) => {
                event.preventDefault();
                const id = $("#cap_id").val();
                axios.post('{{url('admin/application/eliminar')}}', {
                    id: id
                }).then(response => {
                    alert("Postulación eliminada");
                    table.ajax.reload();
                    $('#modal-eliminar').modal('hide');
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde");
                    $('#modal-eliminar').modal('hide');
                });
            });

        });
    </script>
@endsection

