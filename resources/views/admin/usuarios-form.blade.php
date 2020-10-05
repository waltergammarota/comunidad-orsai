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
        <form role="form" method="POST" action="{{url('admin/usuarios/store')}}" enctype="multipart/form-data">
            <input type="hidden" value="0" name="id">
            @endif
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Nombre" name="name"
                                value="{{$user?$user->name:old('name')}}" disabled>
                            @error('name') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Apellido</label>
                            <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Apellido" name="lastName"
                                value="{{$user?$user->lastName:old('lastName')}}" disabled>
                            @error('lastName') <span class="help-block">{{$message}}</span> @enderror
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
                            <input type="text" class="form-control @error('provincia') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="provincia" name="provincia"
                                value="{{$user?$user->provincia:old('provincia')}}" disabled>
                            @error('provincia') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha Nacimiento</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
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
                            <label for="exampleInputEmail1">Profesion</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Profesión" name="profesion"
                                value="{{$user?$user->description:old('description')}}" disabled>
                            @error('description') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Rol</label>
                            <input type="text" class="form-control @error('role') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Rol" name="role"
                                value="{{$user?$user->description:old('role')}}" disabled>
                            @error('role') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Twitter</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Twitter" name="twitter"
                                value="{{$user?$user->description:old('twitter')}}" disabled>
                            @error('twitter') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Facebook</label>
                            <input type="text" class="form-control @error('facebook') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Facebook" name="facebook"
                                value="{{$user?$user->description:old('facebook')}}" disabled>
                            @error('facebook') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Whatsapp</label>
                            <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Whatsapp" name="whatsapp"
                                value="{{$user?$user->description:old('whatsapp')}}" disabled>
                            @error('whatsapp') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Instagram</label>
                            <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                id="exampleInputEmail1" placeholder="Instagram" name="instagram"
                                value="{{$user?$user->description:old('instagram')}}" disabled>
                            @error('instagram') <span class="help-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

        </form>
</div>





@endsection

@section('footer')




@endsection
