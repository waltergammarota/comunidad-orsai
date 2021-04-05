@extends('admin.admin-template')

@section('header')
@endsection


@section('name')
    Gestión de dinero
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Gestión de dinero</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <p>Cotización dolar: {{$cotizacion}}</p>
                </div>
            </div>
            <form role="form" method="POST" action="{{url('admin/gestion-dinero')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Tipo</label>
                            <select name="type" class="form-control">
                                <option value="MINT">Ingreso</option>
                                <option value="BURN">Egreso</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Monto en USD</label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                   id="amount" placeholder="Monto"
                                   name="amount"
                                   value="0">
                            @error('amount') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Descripción</label>
                            <input type="text" class="form-control @error('data') is-invalid @enderror"
                                   id="data" placeholder="Descripción"
                                   name="data"
                                   value="">
                            @error('data') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">ID comprobante</label>
                            <input type="text" class="form-control @error('payment_id') is-invalid @enderror"
                                   id="data" placeholder="ID Comprobante"
                                   name="payment_id"
                                   value="">
                            @error('payment_id') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha</label>
                            <input type="datetime-local" class="form-control" id="fecha"
                                   name="fecha"
                            @error('fecha') <span
                                class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success float-right">
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Ingresos/Egresos de dinero</h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>ID comprobante</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {

            $('#example2').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "ordering": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url('admin/gestion-dinero-json')}}",
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
                    {"data": "user"},
                    {"data": "type"},
                    {"data": "description"},
                    {"data": "payment_id"},
                    {"data": "amount"},
                    {"data": "fecha"},
                ]
            });
        });
    </script>
@endsection

