@extends('admin.admin-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <form role="form" method="POST" action="{{url('admin/contest/update')}}" enctype="multipart/form-data"
                  id="contestForm">
                <input type="hidden" value="{{$contest->id}}" name="id">
                @else
                    <form role="form" method="POST" action="{{url('admin/contest/store')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" value="0" name="id">
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Título</label>
                                <input type="text" class="form-control" id="name" placeholder="Título"
                                       name="name"
                                       value="{{$contest?$contest->name:old('name')}}">
                                @error('name') <span class="help-block">Este campo es obligatorio</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="bajadaCorta">Bajada (Máximo 168 caracteres)</label>
                                <textarea type="text" class="form-control" id="bajadaCorta" placeholder="Bajada"
                                          name="bajada_corta">{{$contest?$contest->bajada_corta:old('bajada_corta')}}</textarea>
                                @error('bajada_corta') <span
                                    class="help-block">Este campo es obligatorio</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="bajadaCompleta">Descripción</label>
                                <textarea type="text" class="form-control" id="bajadaCompleta"
                                          placeholder="Descripción"
                                          name="bajada_completa">{{$contest?$contest->bajada_completa:old('bajada_completa')}}</textarea>
                                @error('bajada_completa') <span
                                    class="help-block">Este campo es obligatorio</span> @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha inicio del
                                            concurso</label>
                                        <input type="datetime-local" class="form-control" id="start_date"
                                               name="start_date"
                                               value="{{$contest?$contest->start_date->format('Y-m-d\TH:i'):old('start_date')}}">
                                        @error('start_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha finalización del concurso</label>
                                        <input type="datetime-local" class="form-control" id="end_date"
                                               name="end_date"
                                               value="{{$contest?$contest->end_date->format('Y-m-d\TH:i'):old('end_date')}}">
                                        @error('end_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha inicio de las postulaciones</label>
                                        <input type="datetime-local" class="form-control" id="start_app_date"
                                               name="start_app_date"
                                               value="{{$contest?$contest->start_app_date->format('Y-m-d\TH:i'):old('start_app_date')}}">
                                        @error('start_app_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha finalización de las postulaciones</label>
                                        <input type="datetime-local" class="form-control" id="end_app_date"
                                               name="end_app_date"
                                               value="{{$contest?$contest->end_app_date->format('Y-m-d\TH:i'):old('end_app_date')}}">
                                        @error('end_app_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha inicio de las votaciones</label>
                                        <input type="datetime-local" class="form-control" id="start_vote_date"
                                               name="start_vote_date"
                                               value="{{$contest?$contest->start_vote_date->format('Y-m-d\TH:i'):old('start_vote_date')}}">
                                        @error('start_vote_date') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha finalización de las votaciones</label>
                                        <input type="datetime-local" class="form-control" id="end_vote_date"
                                               name="end_vote_date"
                                               value="{{$contest?$contest->end_vote_date->format('Y-m-d\TH:i'):old('end_vote_date')}}">
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
                                                       data-msg-placeholder="Seleccione imagen..."
                                                >
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
                                            @foreach($types as $type)
                                                @if($contest && $type->id == $contest->type)
                                                    <option value="{{$type->id}}"
                                                            selected>{{ucfirst($type->name)}}</option>
                                                @else
                                                    <option value="{{$type->id}}">{{ucfirst($type->name)}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 narrativa">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Cantidad máxima de caracteres</label>
                                                <input type="number" min="1" step="1" class="form-control"
                                                       id="cant_caracteres"
                                                       placeholder="Cantidad de caracteres"
                                                       name="cant_caracteres"
                                                       value="{{$contest?$contest->cant_caracteres:old('cant_caracteres')}}"/>
                                                @error('cant_caracteres') <span
                                                    class="help-block">Este campo es obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group narrativaLarga">
                                                <label for="exampleInputEmail1">Cantidad máxima de capítulos</label>
                                                <input type="number" step="1" min="0" class="form-control"
                                                       id="cant_capitulos"
                                                       placeholder="Cantidad de capítulos"
                                                       name="cant_capitulos"
                                                       value="{{$contest?$contest->cant_capitulos:old('cant_capitulos')}}">
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
                                            @foreach($modes as $mode)
                                                @if($contest && $mode->id == $contest->mode)
                                                    <option value="{{$mode->id}}"
                                                            selected>{{ucfirst($mode->name)}}</option>
                                                @else
                                                    <option value="{{$mode->id}}">{{ucfirst($mode->name)}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="pozo">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cantidad de ganadores</label>
                                        <select name="cant_winners" id="cant_winners" class="form-control">
                                            @for($i=1;$i<5;$i++)
                                                @if($contest && $i == $contest->cant_winners)
                                                    <option value="{{$i}}" selected>{{$i}}</option>
                                                @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        @error('per_winner') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                @foreach($per_winner as $item)
                                    <div class="col-md-6 porcentajeWinners">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Porcentaje premio</label>
                                            <input type="number" step="1" class="form-control per_winner"
                                                   placeholder="Porcentaje ganador"
                                                   name="per_winner[]"
                                                   value="{{$item}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row" id="completo">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cantidad de fichas necesarias para ganar</label>
                                        <input type="number" step="1" class="form-control" id="required_amount"
                                               placeholder="Fichas necesarias"
                                               name="required_amount"
                                               value="{{$contest?$contest->required_amount:old('required_amount')}}">
                                        @error('required_amount') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="fijo">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Monto total del premio</label>
                                        <input type="number" step="1" class="form-control" id="amount_winner"
                                               placeholder="Monto ganador"
                                               name="amount_winner"
                                               value="{{$contest?$contest->amount_winner:old('amount_winner')}}">
                                        @error('amount_winner') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Monto total del premio en USD</label>
                                        <input type="number" step="1" class="form-control" id="amount_usd"
                                               placeholder="Monto ganador en USD"
                                               name="amount_usd"
                                               value="{{$contest?$contest->amount_usd:old('amount_usd')}}">
                                        @error('amount_usd') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Costo por publicar</label>
                                        <input type="number" step="1" class="form-control" id="cost_per_cpa"
                                               placeholder="0"
                                               name="cost_per_cpa"
                                               value="{{$contest?$contest->cost_per_cpa:old('cost_per_cpa')}}">
                                        @error('cost_per_cpa') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fichas para ser Jurado VIP</label>
                                        <input type="number" step="1" class="form-control" id="cost_jury"
                                               placeholder="0"
                                               name="cost_jury"
                                               value="{{$contest?$contest->cost_jury:old('cost_jury')}}">
                                        @error('amount_usd') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Límite de apuesta por postulación</label>
                                        <input type="number" step="1" class="form-control" id="cost_jury"
                                               placeholder="0"
                                               name="vote_limit"
                                               value="{{$contest?$contest->vote_limit:old('vote_limit')}}">
                                        @error('vote_limit') <span
                                            class="help-block">Este campo es obligatorio</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="forms">Formulario</label>
                                    <select name="form_id" id="forms" class="form-control">
                                        <option value="0">Ninguno</option>
                                        @foreach($forms as $form)
                                            @if($contest && $contest->form_id == $form->id)
                                                <option value="{{$form->id}}" selected>{{$form->name}}</option>
                                            @else
                                                <option value="{{$form->id}}">{{$form->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="rondas">
                                @for($i=0; $i<3;$i++)
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Costo ronda {{$i+1}}</label>
                                            <input type="number" step="1" class="form-control"
                                                   placeholder="Costo por ronda en fichas"
                                                   name="cost[{{$i}}]"
                                                   value="{{count($rondas)?$rondas[$i]->cost:old('cost')}}">
                                            @error('cost') <span
                                                class="help-block">Este campo es obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Título ronda {{$i+1}}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="Título de la ronda"
                                                   name="title[{{$i}}]"
                                                   value="{{count($rondas)?$rondas[$i]->title:old('cost')}}">
                                            @error('title') <span
                                                class="help-block">Este campo es obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Bajada ronda {{$i+1}}</label>
                                            <input type="text" class="form-control"
                                                   placeholder="Bajada de la ronda"
                                                   name="bajada[{{$i}}]"
                                                   value="{{count($rondas)?$rondas[$i]->bajada:old('cost')}}">
                                            @error('bajada') <span
                                                class="help-block">Este campo es obligatorio</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="bajadaCompleta">Contenido ronda {{$i+1}}</label>
                                            <textarea type="text" class="form-control" id="bajadaCompleta"
                                                      placeholder="Contenido"
                                                      name="body[{{$i}}]">{{count($rondas)?$rondas[$i]->body:old('body')}}</textarea>
                                            @error('body') <span
                                                class="help-block">Este campo es obligatorio</span> @enderror
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Publicar</label>
                                        <div class="form-check">
                                            @if($contest)
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                       value="1"
                                                       name="active" {{$contest->active?"checked":""}}>
                                            @else
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                       value="1"
                                                       name="active">
                                            @endif
                                            <label class="form-check-label" for="exampleCheck1">Publicado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bases">Valor de pago de la ficha</label>
                                        <input type="number" step="0.01" class="form-control"
                                               value="{{old('token_value')? old('token_value'): ($contest? $contest->token_value: 0)}}"
                                               name="token_value" placeholder="Valor de ficha para el pago en USD"
                                               required>
                                        @error('token_value') <span
                                            class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bases">Bases del concurso</label>
                                        @if($contest && $contest->getBases())
                                            <input type="hidden" id="editar_pagina" value="0" name="editar_pagina">
                                            <div class="form-control">
                                                <a href="{{url('admin/contenidos/'.$contest->getBases()->id.'?concurso='.$contest->id)}}">{{$contest->getBases()->title}}</a>
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
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right" id="submitBtn">Guardar</button>
                        </div>
                    </form>
    </div>


@endsection

@section('footer')

    <link href="{{url('js/file-input/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{url('js/file-input/themes/explorer-fas/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <script src="{{url('js/file-input/js/plugins/piexif.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/js/plugins/sortable.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/js/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/js/locales/fr.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/js/locales/es.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/themes/fas/theme.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/themes/explorer-fas/theme.js')}}" type="text/javascript"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

    <style>
        .close.fileinput-remove {
            display: none;
        }

        .help-block {
            color: #dc3545;
        }

        .narrativaLarga, .porcentajeWinners, #completo {
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
            @if($imageUrl != '')
            initialPreview: [
                "{{$imageUrl}}"
            ],
            initialPreviewConfig: [
                {caption: "{{$imageUrl}}", key: "{{$imageKey}}"}
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
        @if($imageUrl != '')
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


    </script>
@endsection
