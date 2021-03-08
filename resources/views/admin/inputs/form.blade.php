@extends('admin.admin-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('name')
    @if($input)
        Editar Input
    @else
        Crear Input
    @endif
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            @if($input)
                <h3 class="card-title">Editar</h3>
            @else
                <h3 class="card-title">Crear</h3>
            @endif
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if($input)
            <form role="form" method="POST" action="{{url('admin/inputs/update')}}" enctype="multipart/form-data">
                <input type="hidden" value="{{$input->id}}" name="id">
                @else
                    <form role="form" method="POST" action="{{url('admin/inputs/store')}}">
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
                                       value="{{$input?$input->name:old('name')}}">
                                @error('name') <span class="help-block">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Titulo</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Título"
                                       name="title"
                                       value="{{$input?$input->title:old('title')}}">
                                @error('title') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripción</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Descripción"
                                       name="description"
                                       value="{{$input?$input->description:old('description')}}">
                                @error('description') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tutorial</label>
                                <input type="text" class="form-control @error('tutorial') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Link al tutorial"
                                       name="tutorial"
                                       value="{{$input?$input->tutorial:old('tutorial')}}">
                                @error('tutorial') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de Contador</label>
                                <select name="counter_type" class="form-control">
                                    @foreach($counter_types as $key => $value)
                                        @if($input && $input->counter_type ==  $value)
                                            <option value="{{$value}}" selected>{{$key}}</option>
                                        @else
                                            <option value="{{$value}}">{{$key}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('dynamic_price') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor máximo contador</label>
                                <input type="number" class="form-control" placeholder="Valor contador"
                                       name="counter_max" step="1"
                                       value="{{$input?$input->counter_max:old('counter_max')}}">
                                @error('counter_max') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo</label>
                                <select name="type" class="form-control">
                                    @foreach($types as $type)
                                        @if($input && $input->type ==  $type)
                                            <option value="{{$type}}" selected>{{$type}}</option>
                                        @else
                                            <option value="{{$type}}">{{$type}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('type') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Opciones (separar con coma)</label>
                                <input type="text" class="form-control @error('options') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Opciones separar con coma"
                                       name="options"
                                       value="{{$input?implode(",",$input->options):old('options')}}">
                                @error('options') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Placeholder</label>
                                <input type="text" class="form-control @error('placeholder') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Placeholder del input"
                                       name="placeholder"
                                       value="{{$input?$input->placeholder:old('placeholder')}}">
                                @error('placeholder') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Formulario</label>
                                <select name="form_id" class="form-control">
                                    @foreach($forms as $form)
                                        @if($input && $input->form_id ==  $form->id)
                                            <option value="{{$form->id}}" selected>{{$form->name}}</option>
                                        @else
                                            <option value="{{$form->id}}">{{$form->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('form_id') <span class="help-block">{{$message}}</span> @enderror
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
    <script>
        const dynamic_price = $("#dynamic_price");
        const price = $("#price");
        const price_input = $("#price_input");

        dynamic_price.on('change', function () {
            if (dynamic_price.val() == 1) {
                price_input.val(0);
                price.hide();
            } else {
                price.show();
            }
        });

        $(document).ready(function () {
            if (dynamic_price.val() == 0) {
                price.show();
            } else {
                price.hide();
            }
        });
    </script>
@endsection

