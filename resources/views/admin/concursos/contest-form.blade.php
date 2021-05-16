@extends('admin.admin-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('name')
    @if ($contest)
        Editar concurso
    @else
        Crear concurso
    @endif
@endsection

@section('content')
    <div class="card card-warning card-outline">
        <div class="card-header">
            <h3 class="card-title">Concurso</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if ($contest)
            <form role="form" method="POST" action="{{ url('admin/contest/update') }}" enctype="multipart/form-data"
                  id="contestForm">
                <input type="hidden" value="{{ $contest->id }}" name="id">
                @else
                    <form role="form" method="POST" action="{{ url('admin/contest/store') }}"
                          enctype="multipart/form-data">
                        <input type="hidden" value="0" name="id">
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control" id="name" placeholder="Título"
                                       name="name"
                                       value="{{ $contest ? $contest->name : old('name') }}">
                                @error('name') <span class="help-block">Este campo es obligatorio</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="bajadaCorta">Bajada (Máximo 168 caracteres)</label>
                                <textarea type="text" class="form-control" id="bajadaCorta" placeholder="Bajada"
                                          name="bajada_corta">{{ $contest ? $contest->bajada_corta : old('bajada_corta') }}</textarea>
                                @error('bajada_corta') <span
                                    class="help-block">Este campo es obligatorio</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="bajadaCompleta">Descripción</label>
                                <textarea type="text" class="form-control" id="bajadaCompleta"
                                          placeholder="Descripción"
                                          name="bajada_completa">{{ $contest ? $contest->bajada_completa : old('bajada_completa') }}</textarea>
                                @error('bajada_completa') <span
                                    class="help-block">Este campo es obligatorio</span> @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha inicio del
                                            concurso</label>
                                        <input type="datetime-local" class="form-control" id="start_date"
                                               name="start_date"
                                               value="{{ $contest ? $contest->start_date->format('Y-m-d\TH:i') : old('start_date') }}">
                                        @error('start_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha finalización del concurso</label>
                                        <input type="datetime-local" class="form-control" id="end_date"
                                               name="end_date"
                                               value="{{ $contest ? $contest->end_date->format('Y-m-d\TH:i') : old('end_date') }}">
                                        @error('end_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha inicio de las postulaciones</label>
                                        <input type="datetime-local" class="form-control" id="start_app_date"
                                               name="start_app_date"
                                               value="{{ $contest ? $contest->start_app_date->format('Y-m-d\TH:i') : old('start_app_date') }}">
                                        @error('start_app_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha finalización de las postulaciones</label>
                                        <input type="datetime-local" class="form-control" id="end_app_date"
                                               name="end_app_date"
                                               value="{{ $contest ? $contest->end_app_date->format('Y-m-d\TH:i') : old('end_app_date') }}">
                                        @error('end_app_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha inicio de las votaciones</label>
                                        <input type="datetime-local" class="form-control" id="start_vote_date"
                                               name="start_vote_date"
                                               value="{{ $contest ? $contest->start_vote_date->format('Y-m-d\TH:i') : old('start_vote_date') }}">
                                        @error('start_vote_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha finalización de las votaciones</label>
                                        <input type="datetime-local" class="form-control" id="end_vote_date"
                                               name="end_vote_date"
                                               value="{{ $contest ? $contest->end_vote_date->format('Y-m-d\TH:i') : old('end_vote_date') }}">
                                        @error('end_vote_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Imagen de portada del concurso</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="file" class="file" id="exampleInputFile"
                                                       name="images[]" accept="image/*" data-browse-on-zone-click="true"
                                                       data-msg-placeholder="Seleccione imagen...">
                                                @error('images') <span
                                                    class="help-block">Este campo es obligatorio</span> @enderror
                                            </div>
                                            <div id="inputFileError"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="modo">Tipo de concurso</label>
                                        <select name="type" id="contest_type" class="form-control">
                                            @foreach ($types as $type)
                                                @if ($contest && $type->id == $contest->type)
                                                    <option value="{{ $type->id }}"
                                                            selected>{{ ucfirst($type->name) }}</option>
                                                @else
                                                    <option value="{{ $type->id }}">{{ ucfirst($type->name) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 narrativa">
                                            <div class="form-group">
                                                <label>Cantidad máxima de caracteres</label>
                                                <input type="number" min="1" step="1" class="form-control"
                                                       id="cant_caracteres"
                                                       placeholder="Cantidad de caracteres"
                                                       name="cant_caracteres"
                                                       value="{{ $contest ? $contest->cant_caracteres : old('cant_caracteres') }}"/>
                                                @error('cant_caracteres') <span
                                                    class="help-block">Este campo es obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group narrativaLarga">
                                                <label>Cantidad máxima de capítulos</label>
                                                <input type="number" step="1" min="0" class="form-control"
                                                       id="cant_capitulos"
                                                       placeholder="Cantidad de capítulos"
                                                       name="cant_capitulos"
                                                       value="{{ $contest ? $contest->cant_capitulos : old('cant_capitulos') }}">
                                                @error('cant_capitulos') <span
                                                    class="help-block">Este campo es obligatorio</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="modo">Modo de apuesta</label>
                                        <select name="mode" id="modo" class="form-control">
                                            @foreach ($modes as $mode)
                                                @if ($contest && $mode->id == $contest->mode)
                                                    <option value="{{ $mode->id }}"
                                                            selected>{{ ucfirst($mode->name) }}</option>
                                                @else
                                                    <option value="{{ $mode->id }}">{{ ucfirst($mode->name) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="pozo">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cantidad de ganadores</label>
                                        <select name="cant_winners" id="cant_winners" class="form-control">
                                            @for ($i = 1; $i < 5; $i++)
                                                @if ($contest && $i == $contest->cant_winners)
                                                    <option value="{{ $i }}"
                                                            selected>{{ $i }}</option>
                                                @else
                                                    <option value="{{ $i }}">{{ $i }}</option> @endif
                                            @endfor
                                        </select>
                                        @error('per_winner') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                @foreach ($per_winner as $item)
                                    <div class="col-md-6 porcentajeWinners">
                                        <div class="form-group">
                                            <label>Porcentaje premio</label>
                                            <input type="number" step="1" class="form-control per_winner"
                                                   placeholder="Porcentaje ganador"
                                                   name="per_winner[]"
                                                   value="{{ $item }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row" id="completo">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cantidad de fichas necesarias para ganar</label>
                                        <input type="number" step="1" class="form-control" id="required_amount"
                                               placeholder="Fichas necesarias"
                                               name="required_amount"
                                               value="{{ $contest ? $contest->required_amount : old('required_amount') }}">
                                        @error('required_amount') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="fijo">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Monto total del premio</label>
                                        <input type="number" step="1" class="form-control" id="amount_winner"
                                               placeholder="Monto ganador"
                                               name="amount_winner"
                                               value="{{ $contest ? $contest->amount_winner : old('amount_winner') }}">
                                        @error('amount_winner') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Monto total del premio en USD</label>
                                        <input type="number" step="1" class="form-control" id="amount_usd"
                                               placeholder="Monto ganador en USD"
                                               name="amount_usd"
                                               value="{{ $contest ? $contest->amount_usd : old('amount_usd') }}">
                                        @error('amount_usd') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Costo por publicar</label>
                                        <input type="number" step="1" class="form-control" id="cost_per_cpa"
                                               placeholder="0"
                                               name="cost_per_cpa"
                                               value="{{ $contest ? $contest->cost_per_cpa : old('cost_per_cpa') }}">
                                        @error('cost_per_cpa') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fichas para ser Jurado VIP</label>
                                        <input type="number" step="1" class="form-control" id="cost_jury"
                                               placeholder="0"
                                               name="cost_jury"
                                               value="{{ $contest ? $contest->cost_jury : old('cost_jury') }}">
                                        @error('amount_usd') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Límite de apuesta por postulación</label>
                                        <input type="number" step="1" class="form-control" id="vote_limit"
                                               placeholder="0"
                                               name="vote_limit"
                                               value="{{ $contest ? $contest->vote_limit : old('vote_limit') }}">
                                        @error('vote_limit') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form-id">Formulario</label>
                                        <select name="form_id" id="form-id" class="form-control">
                                            <option value="0">Ninguno</option>
                                            @foreach ($forms as $form)
                                                @if ($contest && $contest->form_id == $form->id)
                                                    <option value="{{ $form->id }}" selected>{{ $form->name }}</option>
                                                @else
                                                    <option value="{{ $form->id }}">{{ $form->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row card card-body" id="rondas">
                                <div class="col-md-12">
                                    <h4>Rondas</h4>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-2 col-sm-2">
                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab"
                                                 role="tablist" aria-orientation="vertical">
                                                @for ($i = 0; $i < 3; $i++)
                                                    <a class="nav-link {{ $i == 0 ? 'active' : '' }}" data-toggle="pill"
                                                       href="#tabs-ronda-{{ $i + 1 }}" role="tab"
                                                       aria-controls="vert-tabs-home"
                                                       aria-selected="true">Ronda {{ $i + 1 }}</a>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="col-10 col-sm-10">
                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                @for ($i = 0; $i < 3; $i++)
                                                    <div
                                                        class="{{ $i == 0 ? 'tab-pane text-left fade active show' : 'tab-pane text-left fade' }}"
                                                        id="tabs-ronda-{{ $i + 1 }}" role="tabpanel"
                                                        aria-labelledby="vert-tabs-home-tab">
                                                        <div class="form-group">
                                                            <input type="hidden" value="{{ $rondas[$i]->id }}"
                                                                   name="ronda_id[]">
                                                            <h4 class="text-right"><span
                                                                    class="badge badge-light">Ronda {{ $i + 1 }}</span>
                                                            </h4>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label>Nombre solapa</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="Título de la ronda"
                                                                       name="solapa[]"
                                                                       value="{{ count($rondas) ? $rondas[$i]->solapa : old('solapa') }}">
                                                                @error('solapa') <span class="help-block">Este campo es obligatorio</span> @enderror
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Costo</label>
                                                                <input type="number" step="1" class="form-control"
                                                                       placeholder="Costo por ronda en fichas"
                                                                       name="cost[]"
                                                                       value="{{ count($rondas) ? $rondas[$i]->cost : old('cost') }}">
                                                                @error('cost') <span class="help-block">Este campo es obligatorio</span> @enderror
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Título</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="Título de la ronda"
                                                                       name="title[]"
                                                                       value="{{ count($rondas) ? $rondas[$i]->title : old('cost') }}">
                                                                @error('title') <span class="help-block">Este campo es obligatorio</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Bajada</label>
                                                                <textarea type="text" class="form-control" rows="3"
                                                                          placeholder="Bajada de la ronda"
                                                                          name="bajada[]">{{ count($rondas) ? $rondas[$i]->bajada : old('bajada') }}</textarea>
                                                                @error('bajada') <span class="help-block">Este campo es obligatorio</span> @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Contenido</label>
                                                                <textarea type="text" class="form-control" rows="3"
                                                                          placeholder="Contenido"
                                                                          name="body[]">{{ count($rondas) ? $rondas[$i]->body : old('body') }}</textarea>
                                                                @error('body') <span class="help-block">Este campo es obligatorio</span> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Campos</label>
                                                            <div class="select2-warning">
                                                                <select class="select2" id="input-{{ $i }}"
                                                                        name="inputs[{{ $i }}][]" multiple="multiple"
                                                                        data-placeholder="Selecciones campos"
                                                                        data-dropdown-css-class="select2-warning"
                                                                        style="width: 100%;">
                                                                    @if (isset($rondas[$i]->inputs))
                                                                        @foreach ($rondas[$i]->inputs as $input)
                                                                            <option
                                                                                value="{{ $input->id }}" {{ $input->selected ? 'selected' : '' }}>{{ $input->id }}
                                                                                - {{ $input->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            @error('inputs') <span class="help-block">Este campo es obligatorio</span> @enderror
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Publicar</label>
                                        <div class="form-check">
                                            @if ($contest)
                                                <input type="checkbox" class="form-check-input" id="check-active"
                                                       value="1"
                                                       name="active" {{ $contest->active ? 'checked' : '' }}>
                                            @else
                                                <input type="checkbox" class="form-check-input" id="check-active"
                                                       value="1"
                                                       name="active">
                                            @endif
                                            <label class="form-check-label" for="check-active">Publicado</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Aprobaciones automáticas</label>
                                        <div class="form-check">
                                            @if ($contest)
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                       value="1"
                                                       name="auto_approval" {{ $contest->auto_approval ? 'checked' : '' }}>
                                            @else
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                       value="1"
                                                       name="auto_approval">
                                            @endif
                                            <label class="form-check-label" for="exampleCheck1">Aprobaciones
                                                automáticas</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bases">Valor de pago de la ficha</label>
                                        <input type="number" step="0.01" class="form-control"
                                               value="{{ old('token_value') ? old('token_value') : ($contest ? $contest->token_value : 0) }}"
                                               name="token_value" placeholder="Valor de ficha para el pago en USD"
                                               required>
                                        @error('token_value') <span
                                            class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bases">Bases del concurso</label>
                                        @if ($contest && $contest->getBases())
                                            <input type="hidden" id="editar_pagina" value="0" name="editar_pagina">
                                            <div class="form-control">
                                                <a href="{{ url('admin/contenidos/' . $contest->getBases()->id . '?concurso=' . $contest->id) }}">{{ $contest->getBases()->title }}</a>
                                            </div>
                                            <button type="submit" class="btn btn-success" onclick="editarPagina()">
                                                Guardar y Editar página
                                            </button>
                                        @else
                                            <input type="hidden" id="crear_pagina" value="0" name="crear_pagina">
                                            <button type="submit" class="btn btn-success" onclick="crearPagina()">
                                                Guardar y
                                                crear página
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bases">Texto página ganador</label>
                                        @if ($contest && $contest->getPaginaGanador())
                                            <input type="hidden" id="editar_pagina" value="0" name="editar_pagina">
                                            <div class="form-control">
                                                <a href="{{ url('admin/contenidos/' . $contest->getPaginaGanador()->id . '?concurso=' . $contest->id) }}">{{ $contest->getPaginaGanador()->title }}</a>
                                            </div>
                                            <button type="submit" class="btn btn-success" onclick="editarPagina()">
                                                Guardar y Editar página de ganador
                                            </button>
                                        @else
                                            <input type="hidden" id="crear_pagina" value="0" name="crear_pagina">
                                            <button type="submit" class="btn btn-success" onclick="crearPagina()">
                                                Guardar y
                                                crear página
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right" id="submitBtn">Guardar</button>
                        </div>
                    </form>
    </div>


@endsection

@section('footer')

    <link href="{{ url('js/file-input/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ url('js/file-input/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ url('admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/>
    <script src="{{ url('js/file-input/js/plugins/piexif.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/file-input/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/file-input/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/file-input/js/locales/fr.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/file-input/js/locales/es.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/file-input/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ url('js/file-input/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ url('admin/plugins/select2/js/select2.full.js') }}"></script>
    <script src="{{ url('admin/plugins/select2/js/i18n/es.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

    <style>
        .close.fileinput-remove {
            display: none;
        }

        .help-block {
            color: #dc3545;
        }

        .narrativaLarga,
        .porcentajeWinners,
        #completo {
            display: none;
        }

    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#bajadaCompleta').summernote({
                tabsize: 2,
                height: 200
            });

            $('.select2').select2();

            $("select").on("select2:select", function (evt) {
                var element = evt.params.data.element;
                var $element = $(element);

                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });

            $("#cant_winners").change(function () {
                const qty = $(this).val();
                const per_winners = $(".porcentajeWinners");
                $(".porcentajeWinners").hide();
                let counter = 0;
                for (counter; counter < qty; counter++) {
                    $(per_winners[counter]).show();
                }
            });

            $("#modo").change(function () {
                const modo = $(this).val();
                switch (modo) {
                    case "1":
                        $("#pozo").show();
                        $("#completo").hide();
                        $("#fijo").hide();
                        break;
                    case "2":
                        $("#pozo").hide();
                        $("#completo").show();
                        $("#fijo").show();
                        break;
                    case "3":
                        $("#pozo").hide();
                        $("#completo").hide();
                        $("#fijo").show();
                        break;
                }
            });


            $("#contest_type").change(function () {
                const type = $(this).val();
                switch (type) {
                    case "1":
                        $(".narrativa").show();
                        $(".narrativaLarga").hide();
                        $("#rondas").show();
                        break;
                    case "2":
                        $(".narrativa").show();
                        $(".narrativaLarga").show();
                        $("#rondas").hide();
                        break;
                    case "3":
                        $(".narrativa").hide();
                        $(".narrativaLarga").hide();
                        $("#rondas").hide();
                        break;
                }
            });

            $("#contest_type").trigger("change");
            $("#modo").trigger("change");
            $("#cant_winners").trigger("change");
        });

        $("#exampleInputFile").fileinput({
            theme: 'fas',
            language: 'es',
            showUpload: false,
            deleteUrl: "/admin/contest/deleteImage",
            initialPreviewAsData: true,
            @if ($imageUrl != '')
            initialPreview: [
                "{{ $imageUrl }}"
            ],
            initialPreviewConfig: [
                {caption: "{{ $imageUrl }}", key: "{{ $imageKey }}"}
            ]

            @endif
        });

        const nameInput = $('#name');
        const bajadaCorta = $("#bajadaCorta");
        const bajadaCompleta = $("#bajadaCompleta");
        const start_date = $("#start_date");
        const end_date = $("#end_date");
        const start_app_date = $("#start_app_date");
        const end_app_date = $("#end_app_date");
        const start_vote_date = $("#start_vote_date");
        const end_vote_date = $("#end_vote_date");
        const fileInput = $("#exampleInputFile");
        const contestType = $("#contest_type");
        const cant_caracteres = $("#cant_caracteres");
        const cant_capitulos = $("#cant_capitulos");
        const modo = $("#modo");
        const required_amount = $("#required_amount");
        const amount_winner = $("#amount_winner");
        const amount_usd = $("#amount_usd");
        const cant_winners = $("#cant_winners");
        const form = $("form");
        @if ($imageUrl != '')
        const hasImage = true;
        @else
        const hasImage = false;
        @endif

        function crearPagina() {
            event.preventDefault();
            const flag = $("#crear_pagina");
            flag.val(1);
            form.submit()
        }

        function editarPagina() {
            event.preventDefault();
            const flag = $("#editar_pagina");
            flag.val(1);
            form.submit();
        }


        function validateInput(input) {
            if (input.val().length > 0) {
                return true;
            }
            input.parent().append('<span class="help-block">Este campo es obligatorio</span>');
            return false;
        }

        function validateFileInput(input) {
            return true;
            if (input.val().length > 0 || hasImage) {
                return true;
            }
            $("#inputFileError").append('<span class="help-block">La imagen es obligatoria</span>');
            return false;
        }

        function validateNarrativa() {
            const type = contestType.val();
            if (type == 1) {
                return validateInput(cant_caracteres);
            }
            if (type == 2) {
                const result1 = validateInput(cant_caracteres)
                const result2 = validateInput(cant_capitulos);
                return result1 && result2;
            }
            if (type == 3) {
                return true;
            }
            return false;
        }

        function validateModo() {
            const modoValue = modo.val();
            switch (modoValue) {
                case "1":
                    return validateWinners();
                case "2":
                    const result1 = validateInput(required_amount);
                    const result2 = validateInput(amount_winner);
                    const result3 = validateInput(amount_usd);
                    return result1 && result2 && result3;
                case "3":
                    const result4 = validateInput(amount_usd);
                    const result5 = validateInput(amount_winner);
                    return result4 && result5;
            }
        }

        function validateWinners() {
            const per_winners = $(".per_winner");
            const results = [];
            const maxIndex = cant_winners.val();
            per_winners.each((index, item) => {
                if (index < maxIndex) {
                    const value = $(item).val() > 0;
                    results.push(value);
                    if (!value) {
                        $(item).parent().append('<span class="help-block">El monto tiene que ser mayor a 0</span>');
                    }
                }
            });
            return results.every((item) => item);
        }


        function validateDate(input) {
            return validateInput(input);
        }

        form.submit(function (event) {
            $('.help-block').remove();
            $("#inputFileError").empty();
            const validate = [];
            validate.push(validateInput(nameInput));
            validate.push(validateInput(bajadaCorta));
            validate.push(validateInput(bajadaCompleta));
            validate.push(validateDate(start_date));
            validate.push(validateDate(end_date));
            validate.push(validateDate(start_app_date));
            validate.push(validateDate(end_app_date));
            validate.push(validateDate(start_vote_date));
            validate.push(validateDate(end_vote_date));
            validate.push(validateFileInput(fileInput));
            validate.push(validateNarrativa());
            validate.push(validateModo());
            if (validate.every((item) => item)) {
                return;
            }
            event.preventDefault();
        });


        function setProperty(value, text) {
            let opt = document.createElement("option");
            opt.value = value;
            opt.text = text;
            return opt;
        }

        document.getElementById("form-id").addEventListener('change', function (e) {

            let url = "{!! url('admin/contest/inputs') !!}/" + this.value;

            const input0 = document.getElementById("input-0");
            const input1 = document.getElementById("input-1");
            const input2 = document.getElementById("input-2");

            input0.innerHTML = "";
            input1.innerHTML = "";
            input2.innerHTML = "";

            fetch(url, {
                method: 'GET',
            }).then(response => response.text()).then(data => {

                try {
                    let inputs = JSON.parse(data);
                    inputs.forEach(function (input, index) {
                        let value = input.id;
                        let text = input.id + ' - ' + input.name;

                        input0.add(setProperty(value, text), null);
                        input1.add(setProperty(value, text), null);
                        input2.add(setProperty(value, text), null);
                    });

                } catch (e) {
                    console.log(data);
                    console.log(e);
                }

            }).catch(error => console.log(error));


        }, false);

    </script>
@endsection
