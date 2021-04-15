@extends('admin.admin-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('name')
    @if ($input)
        Editar Input
    @else
        Crear Input
    @endif
@endsection

@section('content')
    <style>
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

    </style>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card card-warning card-outline">
        <div class="card-header">
            <h3 class="card-title">Datos del input - Formulario: {{ $form->name }}</h3>
        </div>

        @if (isset($input->id))
            <form role="form" method="POST" action="{{ url('admin/inputs/update') }}" enctype="multipart/form-data">
                <input type="hidden" value="{{ $input->id }}" name="id" />
            @else
                <form role="form" method="POST" action="{{ url('admin/inputs/store') }}">
                    <input type="hidden" value="0" name="id" />
        @endif

        <input type="hidden" value="{{ $form->id }}" name="form_id" />

        @csrf
        <div class="card-body">
            <div class="row">

                <div class="col-md-4">
                    <h3>Tipo de input</h3>
                    <div class="form-group">
                        <label for="type">Tipo</label>
                        <select id="type" name="type" class="form-control">
                            @foreach ($types as $key => $value)
                                @if ($input && $input->type == $key)
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('type') <span class="help-block">{{ $message }}</span> @enderror
                    </div>

                    <div id="div-counter" class="form-row" style="display:none">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Tipo de Contador</label>
                            <select name="counter_type" class="form-control">
                                @foreach ($counter_types as $key => $value)
                                    @if ($input && $input->counter_type == $value)
                                        <option value="{{ $value }}" selected>{{ $key }}</option>
                                    @else
                                        <option value="{{ $value }}">{{ $key }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('counter_type') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Valor máximo contador</label>
                            <input type="number" class="form-control" placeholder="Valor contador" name="counter_max" step="1"
                                   value="{{ $input ? $input->counter_max : old('counter_max') }}">
                            @error('counter_max') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div id="div-textarea" class="form-row" style="display:none">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Columnas</label>
                            <input type="number" class="form-control" placeholder="Nro de columnas"
                                   name="cols" step="1"
                                   value="{{ $input ? $input->cols : old('cols') }}">
                            @error('cols') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Filas</label>
                            <input type="number" class="form-control" placeholder="Nro de filas"
                                   name="rows" step="1"
                                   value="{{ $input ? $input->filas : old('rows') }}">
                            @error('rows') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div id="div-options" class="form-group" style="display:none">
                        <label for="exampleInputEmail1">Opciones (separar con punto y coma [;] )</label>
                        <input type="text" class="form-control @error('options') is-invalid @enderror"
                               id="exampleInputEmail1" placeholder="Opciones separar con coma"
                               name="options"
                               value="{{ $input ? implode(';', $input->options) : old('options') }}">
                        @error('options') <span class="help-block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <h3>Datos comunes</h3>
                    <div class="callout">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Nombre" name="name"
                                       value="{{ old('title', $input->name) }}" />
                                @error('name') <span class="help-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Título</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Título" name="title"
                                       value="{{ old('title', $input->title) }}">
                                @error('title') <span class="help-block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Tutorial</label>
                                <input type="text" class="form-control @error('tutorial') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Link al tutorial"
                                       name="tutorial"
                                       value="{{ $input ? $input->tutorial : old('tutorial') }}">
                                @error('tutorial') <span class="help-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Placeholder</label>
                                <input type="text" class="form-control @error('placeholder') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Placeholder del input"
                                       name="placeholder"
                                       value="{{ $input ? $input->placeholder : old('placeholder') }}">
                                @error('placeholder') <span class="help-block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Descripción</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Descripción" name="description"
                                          rows="3">{{ old('description', $input->description) }}</textarea>
                                @error('description') <span class="help-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Obligatorio</label>
                                <div class="form-check">
                                    @if ($input)
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                               name="required" {{ $input->required ? 'checked' : '' }}>
                                    @else
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                               name="required">
                                    @endif
                                    <label class="form-check-label" for="exampleCheck1">Obligatorio</label>
                                </div>
                            </div>
                        </div>

                    </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {

            const type = document.getElementById("type");
            typeInput(type.value)

            type.addEventListener('change', function(e) {
                typeInput(type.value)
            }, false);

        });

        function typeInput(type) {

            const counter = document.getElementById("div-counter");
            const options = document.getElementById("div-options");
            const textarea = document.getElementById("div-textarea");

            counter.removeAttribute('style');
            options.removeAttribute('style');
            textarea.removeAttribute('style');

            switch (type) {
                case 'input':
                    options.style.display = 'none'
                    textarea.style.display = 'none'
                    break;

                case 'select':
                    counter.style.display = 'none'
                    textarea.style.display = 'none'
                    break;

                case 'textarea':
                    options.style.display = 'none'
                    break;

                case 'nube':
                    options.style.display = 'none'
                    textarea.style.display = 'none'
                    break;

                default:
                    options.style.display = 'none'
                    counter.style.display = 'none'
                    textarea.style.display = 'none'
            }
        };

    </script>
@endsection
