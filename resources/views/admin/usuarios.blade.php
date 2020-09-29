@extends('admin.admin-template')

@section('header')

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
                    <th>Apellido</th>
                    <th>Fecha nac</th>
                    <th>Email</th>
                    <th>Validado</th>
                    <th>País</th>
                    <th>Bloqueado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<div class="modal fade" id="modal-bloquear">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bloquear usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="block-message"></p>
                <p class="usuarioData"></p>
                <input type="hidden" name="id" value="0" class="usuarioId">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar
                </button>
                <button type="button" class="btn btn-success" id="bloquear-button">SI
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
                <h4 class="modal-title">Eliminar usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Desea eliminar al usuario?</p>
                <p class="usuarioData"></p>
                <input type="hidden" name="id" value="0" class="usuarioId">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar
                </button>
                <button type="button" class="btn btn-success" id="eliminar-button">SI
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('footer')
<style>
    button.dt-button.buttons-csv.buttons-html5 {
        padding: 5px 15px;
        background-color: #007bff;
        border-color: #007bff;
        color: white
    }

    button.dt-button.buttons-excel.buttons-html5 {
        padding: 5px 15px;
        background-color: #28a745;
        border-color: #28a745;
        color: white
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script>
    $(function () {
            const table = $('#example2').DataTable({
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url('admin/usuarios-json')}}",
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
                    "info": "Mostrando _START_ al _END_ de un total de _TOTAL_ usuarios",
                    "lengthMenu": 'Mostrar <select name="example2_length" aria-controls="example2" class=" custom-select custom-select-sm form-control form-control-sm">'+
                      '<option value="10">10</option>'+
                      '<option value="20">20</option>'+
                      '<option value="30">30</option>'+
                      '<option value="40">40</option>'+
                      '<option value="50">50</option>'+
                      '<option value="-1">Todos</option>'+
                      '</select> Usuarios',
                
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "lastName"},
                    {"data": "birth_date"},
                    {"data": "email"},
                    {
                        "data": function (data) {
                            return (data.email_verified_at != null) ? "SI" : "NO";
                        }
                    },
                    {"data": "country"},
                    {
                        "data": function (data) {
                            return (data.blocked == 0) ? "NO" : "SI";
                        }
                    },
                    {
                        "data": function (data, type, row, meta) {
                            return `<button type="button" class="btn  btn-xs btn-primary editar" data-row="${meta.row}">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <button type="button" class="btn  btn-xs btn-warning bloquear" data-row="${meta.row}" >
                                        <i class="fa fa-times-circle"></i>
                                    </button>
                                    <button type="button" class="btn  btn-xs btn-danger eliminar" data-row="${meta.row}">
                                        <i class="fa fa-trash"></i>
                                    </button>`;
                        }
                    }
                ]
            });

            table.on('click', '.bloquear', function () {
                const row = $(this).data('row');
                const data = table.row(row).data();
                const id = data.id;
                const message = $(".block-message");
                if(data.blocked == 0) {
                    message.empty().append("Desea bloquear al usuario");
                } else {
                    message.empty().append("Desea desbloquear al usuario");
                }
                $(".usuarioId").val(id);
                $(".usuarioData").empty().append(`Email: ${data.email}`);
                $('#modal-bloquear').modal('show');
                
            });

            table.on('click', '.eliminar', function () {
                const row = $(this).data('row');
                const data = table.row(row).data();
                const id = data.id;
                $(".usuarioId").val(id);
                $(".usuarioData").empty().append(`Email: ${data.email}`);
                $('#modal-bloquear').modal('show');
            });

            table.on('click', '.editar', function () {
                const row = $(this).data('row');
                const data = table.row(row).data();
                const id = data.id;
                window.location.href = `{{url('admin/usuarios/editar')}}/${id}`;
            });

            $("#bloquear-button").click((event) => {
                event.preventDefault();
                const id = $(".usuarioId").val();
                $('#modal-bloquear').modal('hide');
                axios.post('{{url('admin/usuarios/bloquear')}}', {
                    id: id,
                }).then(response => {
                    alert(response.data.message);
                    table.ajax.reload();
                    $(".usuarioId").val(0);
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde");
                    $(".usuarioId").val(0);
                });
            });

            $("#eliminar-button").click((event) => {
                event.preventDefault();
                const id = $(".usuarioId").val();
                $('#modal-eliminar').modal('hide');
                axios.post('{{url('admin/usuarios/eliminar')}}', {
                    id: id,
                }).then(response => {
                    alert("Usuario eliminado");
                    table.ajax.reload();
                    $(".usuarioId").val(0);
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde");
                    $(".usuarioId").val(0);
                });
            });

        });
</script>
@endsection