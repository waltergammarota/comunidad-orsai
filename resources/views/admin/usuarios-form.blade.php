@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    @if($user)
        Ver Usuario
    @else
        Ver Usuario
    @endif
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            @if($user)
                <h3 class="card-title">Ver Usuario</h3>
            @else
                <h3 class="card-title">Ver Usuario</h3>
            @endif
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if($user)
            <form role="form" method="POST" action="{{url('admin/usuarios/update')}}" enctype="multipart/form-data">
                <input type="hidden" value="{{$user->id}}" name="id">
                @else
                    <form role="form" method="POST" action="{{url('admin/usuarios/store')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" value="0" name="id">
                        @endif
                        @csrf
                        <div class="card-body">
                            <div><strong>Balance:&nbsp;</strong>{{$balance}} fichas</div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre y apellido</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Nombre" name="name"
                                               value="{{$user?$user->name." ".$user->lastName:old('name')}}" disabled>
                                        @error('name') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Usuario</label>
                                        <input type="text" class="form-control @error('userName') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Usuario" name="userName"
                                               value="{{$user?$user->userName:old('userName')}}" disabled>
                                        @error('userName') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Apellido" name="lastName"
                                               value="{{$user?$user->email:old('email')}}" disabled>
                                        @error('email') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pais</label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="País" name="country"
                                               value="{{$user?$user->country:old('country')}}" disabled>
                                        @error('country') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Provincia</label>
                                        <input type="text" class="form-control @error('provincia') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="provincia" name="provincia"
                                               value="{{$user?$user->provincia:old('provincia')}}" disabled>
                                        @error('provincia') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ciudad</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="provincia" name="provincia"
                                               value="{{$user?$user->city:old('city')}}" disabled>
                                        @error('city') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha Nacimiento</label>
                                        <input type="date"
                                               class="form-control @error('birth_date') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Fecha nacimiento" name="birth_date"
                                               value="{{$user?$user->birth_date:old('birth_date')}}" disabled>
                                        @error('birth_date') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Profesión</label>
                                        <input type="text" class="form-control @error('profesion') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Profesión" name="profesion"
                                               value="{{$user?$user->profesion:old('profesion')}}" disabled>
                                        @error('profesion') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Rol</label>
                                        <input type="text" class="form-control @error('role') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Rol" name="role"
                                               value="{{$user?$user->role:old('role')}}" disabled>
                                        @error('role') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Descripción</label>
                                        <input type="text"
                                               class="form-control @error('description') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Descripción" name="twitter"
                                               value="{{$user?$user->description:old('description')}}" disabled>
                                        @error('description') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Twitter</label>
                                        <input type="text" class="form-control @error('twitter') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Twitter" name="twitter"
                                               value="{{$user?$user->twitter:old('twitter')}}" disabled>
                                        @error('twitter') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Facebook</label>
                                        <input type="text" class="form-control @error('facebook') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Facebook" name="facebook"
                                               value="{{$user?$user->facebook:old('facebook')}}" disabled>
                                        @error('facebook') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Whatsapp</label>
                                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Whatsapp" name="whatsapp"
                                               value="{{$user?$user->whatsapp:old('whatsapp')}}" disabled>
                                        @error('whatsapp') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Instagram</label>
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Instagram" name="instagram"
                                               value="{{$user?$user->instagram:old('instagram')}}" disabled>
                                        @error('instagram') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </form>
    </div>

    {{--TRANSACCIONES--}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Transacciones</h3>
        </div>
        <div class="card-body">
            <table id="txs" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Tipo</th>
                    <th>Fichas</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>


@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script>
        $(function () {
            const table = $('#txs').DataTable({
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "order": [[6,'desc']],
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url("admin/transacciones/{$user->id}/json")}}",
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
                        '</select> transacciones',
                    emptyTable: "No se registran transacciones para este usuario"

                },
                "columns": [
                    {"data": "id"},
                    {"data": "get_from_user.name"},
                    {"data": "get_to_user.name"},
                    {
                        "data": "type",
                        "render": function (data) {
                            switch (data) {
                                case "MINT":
                                    return "Emisión";
                                    break;
                                case "BURN":
                                    return "Quemado";
                                    break;
                                case "TRANSFER":
                                    return "Transferencia";
                                    breack;
                            }
                        }
                    },
                    {"data": "amount"},
                    {"data": "data"},
                    {"data": "created_at"}
                ],
            });
        });
    </script>



@endsection
