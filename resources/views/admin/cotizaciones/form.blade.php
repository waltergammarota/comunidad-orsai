@extends('admin.admin-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('name')
    @if($cotizacion)
        Editar Cotizacion
    @else
        Crear Cotizacion
    @endif
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            @if($cotizacion)
                <h3 class="card-title">Editar</h3>
            @else
                <h3 class="card-title">Crear</h3>
            @endif
        </div>
        <form role="form" method="POST" action="{{url('admin/cotizaciones/store')}}">
            <input type="hidden" value="0" name="id">
            @csrf

            <div class="card-body">
                <br/>

                <div class="form-group" id="price">
                    <label for="exampleInputEmail1">Precio de una ficha (en USD)</label>
                    <input type="number" class="form-control" id="price_input" placeholder="Precio"
                           name="precio" step="0.01"
                           value="{{$cotizacion?$cotizacion->precio:old('precio')}}">
                    @error('precio') <span class="help-block">{{$message}}</span> @enderror
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

