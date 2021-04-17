@extends('admin.admin-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('name')
    {{ $section_name }}
@endsection

@section('content')
    <style>
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        table {
            font-size: 14px;
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
    <div class="modal fade" id="modal-validar">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="POST" action="{{ route('inputs.delete') }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminación de campo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <p class="block-message"></p>
                        <p class="usuarioData"></p>
                        <input type="hidden" name="form_id" value="{{ isset($form->id) ? $form->id : 0 }}" />
                        <input type="hidden" name="input_id" id="input_id" value="0" />
                        <input type="hidden" name="message" id="message" value="" />

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Sí</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="card card-warning card-outline">
        <form role="form" method="POST" action="{{ isset($form->id) ? route('forms.update') : route('forms.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Datos del formulario</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="callout">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Nombre" name="name"
                                       value="{{ isset($form) ? old('name', $form->name) : old('name') }}" />
                                @error('name') <span class="help-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Titulo</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Título" name="title"
                                       value="{{ old('title', $form->title) }}">
                                @error('title') <span class="help-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripción</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Descripción" name="description"
                                          rows="3">{{ old('description', $form->description) }}</textarea>
                                @error('description') <span class="help-block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        @if (isset($form->id))
                            <input type="hidden" value="{{ $form->id }}" name="id" />
                            <table id="table-inputs" class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Título</th>
                                        <th>Type</th>
                                        <th class="text-center">Rondas</th>
                                        <th class="text-center">Respuestas</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inputs as $input)
                                        <tr>
                                            <td class="text-right">
                                                {{ $input->id }}
                                            </td>
                                            <td>
                                                {{ $input->name }}
                                            </td>
                                            <td>
                                                {{ $input->title }}
                                            </td>
                                            <td>
                                                {{ $input->type }}
                                            </td>
                                            <td class="text-center">
                                                {{ $input->rondas }}
                                            </td>
                                            <td class="text-center">
                                                {{ $input->answers }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('admin/inputs') }}/{{ $input->id }}" class="btn btn-xs btn-success editar" data-toggle="tooltip" title="Editar input">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if ($input->rondas == 0 && $input->answers == 0)
                                                    <button type="button" class="btn btn-xs btn-danger eliminar" data-row="{{ $input->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-warning">
                                        <td class="text-right">#</td>
                                        <td colspan="5"><strong>Crear campo</strong></td>
                                        <td class="text-center">
                                            <a href="{{ route('inputs.create', $form) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Crear campo">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
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
            const table = document.getElementById("table-inputs");

            $('#table-inputs .eliminar').click(function() {
    
                const row = $(this).closest("tr");

                let id = row.find("td:eq(0)").text();
                let name = row.find("td:eq(1)").text();

                const message = $(".block-message");

                message.empty().append('Desea eliminar el Input: #' + id.trim() + ' ' + name.trim() + '?');

                document.getElementById("input_id").value = id.trim();
                document.getElementById("message").value = 'Input #' + id.trim() + ' ' + name.trim() + ' borrado';

                $('#modal-validar').modal('show');
            });
        });

    </script>
@endsection
