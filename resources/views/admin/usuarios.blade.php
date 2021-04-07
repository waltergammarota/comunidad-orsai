@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    Usuarios
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Usuarios</h3>
        </div>
        <div class="card-body">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                        Búsqueda avanzada
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row" id="filtrosUsuarios">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="comboPais">Pais</label>
                                                <select name="filters[country][]" id="comboPais" class="form-control"
                                                        multiple="multiple" autocomplete="off"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="comboProvincia">Provincia</label>
                                                <select name="filters[provincia][]" id="comboProvincia"
                                                        class="form-control"
                                                        multiple="multiple"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="comboCiudad">Ciudad</label>
                                                <select name="filters[city][]" id="comboCity" class="form-control"
                                                        multiple="multiple"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="comboCiudad">Fichas</label>
                                                <select name="filters[operacion]" id="operacion" class="form-control">
                                                    <option value="0">---</option>
                                                    <option value="1">=</option>
                                                    <option value="2">></option>
                                                    <option value="3"><</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="balance">Cantidad</label>
                                                <input type="number" name="filters[balance]" step="1" min="0"
                                                       class="form-control" id="balance">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="balance">Profesión</label>
                                                <input type="text" name="filters[profesion]" placeholder="Profesión"
                                                       class="form-control" id="profesion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="balance">Fecha Nacimiento - desde</label>
                                                <input type="date" name="filters[birth_date][start]"
                                                       placeholder="Fecha desde"
                                                       class="form-control" id="startDate">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="balance">Fecha Nacimiento - hasta</label>
                                                <input type="date" name="filters[birth_date][end]"
                                                       placeholder="Fecha hasta"
                                                       class="form-control" id="endDate">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary float-right"
                                                    onclick="getData()">
                                                Buscar Usuarios
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Balance</th>
                            <th>Fecha nac</th>
                            <th>Email</th>
                            <th>Validado</th>
                            <th>País</th>
                            <th>Provincia</th>
                            <th>Ciudad</th>
                            <th>Bloqueado</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                            <th>Nombre usuario</th>
                            <th>Profesión</th>
                            <th>Twitter</th>
                            <th>Facebook</th>
                            <th>Whatsapp</th>
                            <th>Instagram</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="modal fade" id="modal-admin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cambio de rol Administrador</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="admin-message"></p>
                    <p class="usuarioData"></p>
                    <input type="hidden" name="id" value="0" class="usuarioId">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar
                    </button>
                    <button type="button" class="btn btn-success" id="admin-button">Sí
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-bloquear">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bloqueo de usuario</h4>
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
                    <button type="button" class="btn btn-success" id="bloquear-button">Sí
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-validar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Validación manual de usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="block-message"></p>
                    <p class="usuarioData"></p>
                    <input type="hidden" name="id" value="0" class="usuarioId">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prefijo</label>
                                <input type="text" class="form-control " id="prefijo" placeholder="Ingrese prefijo" name="prefijo" value="" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Teléfono</label>
                                <input type="text" class="form-control " id="whatsapp" placeholder="Ingrese teléfono" name="whatsapp" value="" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar
                    </button>
                    <button type="button" class="btn btn-success" id="validar-button">Sí
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
                    <h4 class="modal-title">Eliminación de usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Desea eliminar al usuario? Esto implica que el usuario se borra del sistema y las.</p>
                    <p class="usuarioData"></p>
                    <input type="hidden" name="id" value="0" class="usuarioId">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar
                    </button>
                    <button type="button" class="btn btn-success" id="eliminar-button">Sí
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
    <link href="{{url('admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <script src="{{url('admin/plugins/select2/js/select2.full.js')}}"></script>
    <script src="{{url('admin/plugins/select2/js/i18n/es.js')}}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.21/api/processing().js"></script>
    <script>
        $(function () {
            const comboPais = $('#comboPais');
            const comboProvincia = $("#comboProvincia");
            const comboCity = $('#comboCity');

            comboCity.select2({
                ajax: {
                    url: '{{url('admin/search-ciudades')}}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    }
                },
                placeholder: 'Elija ciudades',
                minimumInputLength: 3,
                delay: 250,
                language: 'es'
            });

            comboProvincia.select2({
                ajax: {
                    url: '{{url('admin/search-provincias')}}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    }
                },
                placeholder: 'Elija provincias',
                minimumInputLength: 3,
                delay: 250,
                language: 'es'
            });

            comboPais.select2({
                ajax: {
                    url: '{{url('admin/search-paises')}}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    }
                },
                placeholder: 'Elija países',
                minimumInputLength: 3,
                delay: 250,
                language: 'es'
            });

            const options = {
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17],
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17],
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18]
                        }
                    },
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "order": [[0, 'desc']],
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url('admin/usuarios-json')}}",
                "processing": true,
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
                    "lengthMenu": 'Mostrar <select name="example2_length" aria-controls="example2" class=" custom-select custom-select-sm form-control form-control-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todos</option>' +
                        '</select> Usuarios',
                    "emptyTable": "No se han encontrado usuarios",

                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "lastName"},
                    {"data": "balance"},
                    {"data": "birth_date"},
                    {"data": "email"},
                    {"data": "validado"},
                    {"data": "pais"},
                    {"data": "provincia", "visible": false},
                    {"data": "ciudad", "visible": false},
                    {"data": "bloqueado"},
                    {"data": "rol"},
                    {
                        "data": function (data, type, row, meta) {
                            return `<button type="button" class="btn  btn-xs btn-primary editar" data-row="${meta.row}">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <button type="button" class="btn  btn-xs btn-warning bloquear" data-row="${meta.row}" >
                                        <i class="fa fa-times-circle"></i>
                                    </button>
                                    <button type="button" class="btn  btn-xs btn-success admin" data-row="${meta.row}" >
                                        <i class="fa fa-user-circle"></i>
                                    </button>
                                    <button type="button" class="btn  btn-xs btn-success validar" data-row="${meta.row}" >
                                        <i class="fa fa-check-circle"></i>
                                    </button>
                                    <button type="button" class="btn  btn-xs btn-danger eliminar" data-row="${meta.row}">
                                        <i class="fa fa-trash"></i>
                                    </button>`;
                        }
                    },
                    {"data": "usuario", "visible": false},
                    {"data": "profesion", "visible": false},
                    {"data": "twitter", "visible": false},
                    {"data": "facebook", "visible": false},
                    {"data": "prefijo", "visible": false},
                    {"data": "whatsapp", "visible": false},
                    {"data": "instagram", "visible": false},
                ],
            };

            const table = $('#example2').DataTable(options);

            table.on('click', '.admin', function () {
                const row = $(this).data('row');
                const data = table.row(row).data();
                const id = data.id;
                const message = $(".admin-message");
                if (data.role === "admin") {
                    message.empty().append("Desea quitar el rol de Administrador a este usuario?");
                } else {
                    message.empty().append("Desea ascender a este usuario a Administrador?");
                }
                $(".usuarioId").val(id);
                $(".usuarioData").empty().append(`Email: ${data.email}`);
                $('#modal-admin').modal('show');

            });

            /* CO-437 Validación manual de usuarios */
            table.on('click', '.validar', function() {
                const row = $(this).data('row');
                const data = table.row(row).data();
                const id = data.id;
                const message = $(".block-message");

                const phone = data.whatsapp ? '(' + data.prefijo + ') ' + data.whatsapp : 'El usuario no registra teléfono.';

                message.empty().append(`Desea validar el número telefónico de ${data.name} ${data.lastName}?`);

                $(".usuarioId").val(id);
                $("#prefijo").val(data.prefijo);
                $("#whatsapp").val(data.whatsapp);
                // $(".usuarioData").empty().append(`Telefono: ${phone}`);
                $('#modal-validar').modal('show');
            });


            table.on('click', '.bloquear', function () {
                const row = $(this).data('row');
                const data = table.row(row).data();
                const id = data.id;
                const message = $(".block-message");
                if (data.blocked == 0) {
                    message.empty().append("Desea bloquear al usuario? Esto implica que el usuario no podrá ingresar al sistema");
                } else {
                    message.empty().append("Desea desbloquear al usuario? Esto implica que el usuario podrá ingresar al sistema");
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
                $('#modal-eliminar').modal('show');
            });

            table.on('click', '.editar', function () {
                const row = $(this).data('row');
                const data = table.row(row).data();
                const id = data.id;
                window.location.href = `{{url('admin/usuarios/editar')}}/${id}`;
            });

            $("#validar-button").click((event) => {
                event.preventDefault();

                const data = {};
                data.id = $(".usuarioId").val();
                data.prefijo = $("#prefijo").val();
                data.whatsapp = $("#whatsapp").val();

                $('#modal-validar').modal('hide');
                axios.post('{{ url('admin/usuarios/validar') }}', data ).then(response => {
                    alert(response.data.message);
                    table.ajax.reload();
                    $(".usuarioId").val(0);
                }).catch(error => {
                    alert("Ha ocurrido un error. Intente más tarde");
                    $(".usuarioId").val(0);
                });
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

            $("#admin-button").click((event) => {
                event.preventDefault();
                const id = $(".usuarioId").val();
                $('#modal-admin').modal('hide');
                axios.post('{{url('admin/usuarios/ascender')}}', {
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

            $('#collapseOne').collapse('toggle');
        });

        function getData() {
            const params = {};
            params.paises = $('#comboPais').val();
            params.provincias = $('#comboProvincia').val();
            params.ciudades = $('#comboCity').val();
            params.operacion = $('#operacion').val();
            params.balance = $('#balance').val();
            params.profesion = $('#profesion').val();
            params.startDate = $('#startDate').val();
            params.endDate = $('#endDate').val();

            const queryParams = new URLSearchParams(params).toString();
            const newUrl = `{{url('admin/usuarios-json')}}?${queryParams}`;

            const table = $('#example2').DataTable();
            table.processing(true);
            table.ajax.url(newUrl).load();

        }
    </script>
    <style>
        table#example2 {
            font-size: 12px;
        }
    </style>
@endsection
