@extends('admin.admin-template')

@section('header')
@endsection


@section('name')
    Gestión de fichas
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Gestión de fichas</h3>
        </div>
        <div class="card-body">
            <form role="form" method="POST" action="{{url('admin/gestion-fichas')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="comboDestino">Destinatarios</label>
                            <select class="form-control" id="comboDestino" name="opcion">
                                <option value="0" selected>Todos los usuarios</option>
                                <option value="1">Lista de usuarios</option>
                                <option value="2">Filtro de usuarios</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="inputUsuarios">
                        <div class="form-group">
                            <label for="comboUsuarios">Usuarios</label>
                            <select name="users[]" id="comboUsuarios" class="form-control" multiple="multiple"></select>
                        </div>
                    </div>
                </div>

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
                            <select name="filters[provincia][]" id="comboProvincia" class="form-control"
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
                            <input type="number" name="filters[balance]" step="1" min="0" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Tipo</label>
                            <select name="type" class="form-control">
                                <option value="mint">Entregar</option>
                                <option value="burn">Quitar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Monto</label>
                            <input type="number" step="1" class="form-control @error('amount') is-invalid @enderror"
                                   id="amount" placeholder="Monto"
                                   name="amount"
                                   value="0">
                            @error('amount') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="amount">Descripción</label>
                            <input type="text" class="form-control @error('data') is-invalid @enderror"
                                   id="data" placeholder="Descripción"
                                   name="data"
                                   value="">
                            @error('data') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-right">
                    Enviar Puntos
                </button>
            </form>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dispersiones de fichas</h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Emisor</th>
                    <th>Destinatarios</th>
                    <th>Puntos</th>
                    <th>Usuarios</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Total</th>
                    <th>Filtros</th>
                    <th>Fecha</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('footer')
    <link href="{{url('admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <script src="{{url('admin/plugins/select2/js/select2.full.js')}}"></script>
    <script src="{{url('admin/plugins/select2/js/i18n/es.js')}}"></script>
    <script>
        $(document).ready(function () {
            const comboUsuarios = $('#comboUsuarios');
            const inputUsuarios = $('#inputUsuarios');

            const filtros = $('#filtrosUsuarios');
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
            $('#comboDestino').change(function () {
                const option = $(this).children("option:selected").val();
                console.log(option);
                if (option == 0) {
                    inputUsuarios.hide();
                    filtros.hide();
                }
                if (option == 1) {
                    inputUsuarios.show();
                    filtros.hide()
                }
                if (option == 2) {
                    inputUsuarios.hide();
                    filtros.show();
                }
            });


            comboUsuarios.select2({
                ajax: {
                    url: '{{url('admin/search-users')}}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    }
                },
                placeholder: 'Elija usuarios por nombre, apellido o email',
                minimumInputLength: 3,
                delay: 250,
                language: 'es'
            });
            inputUsuarios.hide();
            filtros.hide();

            $('#example2').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "ordering": true,
                "order": [[8, "desc"]],
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url('admin/show-logs')}}",
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
                    "lengthMenu": 'Mostrar <select name="example2_length" aria-controls="example2" class=" custom-select custom-select-sm form-control form-control-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todas</option>' +
                        '</select> transacciones',

                },
                "columns": [
                    {"data": "emisor"},
                    {"data": "destinatarios"},
                    {"data": "puntos"},
                    {"data": "usuarios"},
                    {"data": "tipo"},
                    {"data": "description"},
                    {"data": "total_puntos"},
                    {"data": "filtros"},
                    {"data": "created_at"}
                ]
            });
        });
    </script>
@endsection

