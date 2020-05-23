@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
@if($contest)
Editar concurso
@else
Crear concurso
@endif
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Concurso</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if($contest)
    <form role="form" method="POST" action="{{url('admin/contest/update')}}">
        <input type="hidden" value="{{$contest->id}}" name="id">
        @else
        <form role="form" method="POST" action="{{url('admin/contest/store')}}">
            <input type="hidden" value="0" name="id">
            @endif
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Título" name="name"
                        value="{{$contest?$contest->name:old('name')}}">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha inicio Concurso</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" name="start_date"
                                value="{{$contest?$contest->start_date->format('Y-m-d'):old('start_date')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha Fin Votación</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" name="votes_end_date"
                                value="{{$contest?$contest->votes_end_date->format('Y-m-d'):old('votes_end_date')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha Fin Concurso</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" name="end_date"
                                value="{{$contest?$contest->end_date->format('Y-m-d'):old('end_date')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha Fin Postulaciones</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" name="end_upload_app"
                                value="{{$contest?$contest->end_upload_app->format('Y-m-d'):old('end_upload_app')}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Cantidad mínima de postulaciones para iniciar votación</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Cantidad"
                        name="min_apps_qty" value="{{$contest?$contest->min_apps_qty:old('min_apps_qty')}}">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Guardar</button>
            </div>
        </form>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')


@endsection