@extends('admin.admin-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('name')
    @if($producto)
        Editar Producto
    @else
        Crear Producto
    @endif
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            @if($producto)
                <h3 class="card-title">Editar</h3>
            @else
                <h3 class="card-title">Crear</h3>
            @endif
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if($producto)
            <form role="form" method="POST" action="{{url('admin/productos/update')}}" enctype="multipart/form-data">
                <input type="hidden" value="{{$producto->id}}" name="id">
                @else
                    <form role="form" method="POST" action="{{url('admin/productos/store')}}">
                        <input type="hidden" value="0" name="id">
                        @endif
                        @csrf
                        <div class="card-body">

                            <br/>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Nombre"
                                       name="name"
                                       value="{{$producto?$producto->name:old('name')}}">
                                @error('name') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Precio (en USD)</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Precio"
                                       name="price" step="1"
                                       value="{{$producto?$producto->price:old('price')}}">
                                @error('price') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Cantidad de fichas a entregar</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Fichas"
                                       name="fichas" step="1"
                                       value="{{$producto?$producto->fichas:old('fichas')}}">
                                @error('fichas') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripción</label>
                                <textarea class="form-control" rows="2" placeholder="Descripción ..."
                                          name="description"
                                          id="summernote2">{{$producto?$producto->description:old('description')}}</textarea>
                                @error('description') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Visible por los usuarios</label>
                                <div class="form-check">
                                    @if($producto)
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                               name="visible" {{$producto->visible?"checked":""}}>
                                    @else
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                               name="visible">
                                    @endif
                                    <label class="form-check-label" for="exampleCheck1">Visible</label>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">
                                Guardar
                            </button>
                        </div>
                    </form>
    </div>
@endsection

@section('footer')
@endsection

