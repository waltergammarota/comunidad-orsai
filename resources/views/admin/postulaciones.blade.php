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
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 20px;">
                    <button type="button" class="btn btn-success" disabled id="aprobar"
                            onclick="showConfirmModal()">Aprobar
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Usuario</th>
                            <th>Votos</th>
                            <th>Status</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
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
    <!-- modal multiple approval -->
    <div class="modal fade" id="modal-approve">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Aprobar postulaciones</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estás por aprobar <span id="approveQty"></span> postulaciones</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Cancelar
                    </button>
                    <button type="button" class="btn btn-success"
                            onclick="approveMultiple()">SI
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('footer')
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script type="text/javascript"
            src="//cdn.datatables.net/plug-ins/1.10.16/sorting/custom-data-source/dom-checkbox.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css"/>
    <script>
        let table;

        $(function () {
            const aprobarBtn = $('#aprobar');
            table = $('#myTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "ajax": "{{url('admin/postulaciones-json')}}",
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
                        "data": function (data) {
                            return '<input type="checkbox">';
                        }
                    },
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return `<a href="{{url('postulacion')}}/${row.id}" target="_blank">${row.id}</a>`;
                        }
                    },
                    {
                        "data": "owner",
                        "render": function (data) {
                            return data == null ? "" : data.name + data.lastName;
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
                            <button type="button" class="btn btn-xs btn-danger eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>`;
                        }
                    },
                ],
                columnDefs: [{
                    orderDataType: "dom-checkbox",
                    targets: 0
                }],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
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

            table
                .on('select', function (e, dt, type, indexes) {
                    const rowData = table.rows(indexes).data().toArray();
                    aprobarBtn.removeAttr('disabled');
                })
                .on('deselect', function (e, dt, type, indexes) {
                    var rowData = table.rows(indexes).data().toArray();
                    const qty = table.rows({selected: true}).count();
                    if (qty == 0) {
                        aprobarBtn.attr('disabled', 'disabled');
                    }
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

        function showConfirmModal() {
            $('#modal-approve').modal('show');
            const qty = table.rows({selected: true}).count();
            $('#approveQty').empty().append(qty);
        }

        function approveMultiple() {
            const indexes = table.rows({selected: true});
            const rows = indexes.map(function (item) {
                return table.rows(item).data().toArray();
            });
            const responses = rows[0].map(function (item) {
                console.log(item.id);
                return axios.post('{{url('admin/application/approve')}}', {
                    id: item.id,
                });
            });
            Promise.all(responses).then(function (values) {
                $('#modal-approve').modal('hide');
                alert("Todas las postulaciones seleccionadas fueron aprobadas");
                table.ajax.reload();
                $('#aprobar').attr('disabled', 'disabled');
            }).catch(function (error) {
                console.log(error);
                alert("Ha occurido un error, las postulaciones no se han podido aprobar");
            });
        }
    </script>
@endsection

