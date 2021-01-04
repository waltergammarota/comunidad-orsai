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
            <form role="form" method="POST" action="{{url('admin/contest/update')}}" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Título"
                                       name="name"
                                       value="{{$contest?$contest->name:old('name')}}">
                                @error('name') <span class="help-block">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="bajadaCorta">Bajada corta</label>
                                <textarea type="text" class="form-control" id="bajadaCorta" placeholder="Bajada corta"
                                          name="bajada_corta">{{$contest?$contest->bajada_corta:old('bajada_corta')}}</textarea>
                                @error('bajada_corta') <span class="help-block">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="bajadaCompleta">Bajada completa</label>
                                <textarea type="text" class="form-control" id="bajadaCompleta"
                                          placeholder="Bajada completa"
                                          name="bajada_completa">{{$contest?$contest->bajada_corta:old('bajada_completa')}}</textarea>
                                @error('bajada_completa') <span class="help-block">{{$message}}</span> @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha inicio del
                                            concurso</label>
                                        <input type="datetime-local" class="form-control" id="exampleInputEmail1"
                                               name="start_date"
                                               value="{{$contest?$contest->start_date->format('Y-m-d\TH:i'):old('start_date')}}">
                                        @error('start_date') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha finalización del concurso</label>
                                        <input type="datetime-local" class="form-control" id="exampleInputEmail1"
                                               name="end_date"
                                               value="{{$contest?$contest->end_date->format('Y-m-d\TH:i'):old('end_date')}}">
                                        @error('end_date') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha inicio de las postulaciones</label>
                                        <input type="datetime-local" class="form-control" id="exampleInputEmail1"
                                               name="start_app_date"
                                               value="{{$contest?$contest->start_app_date->format('Y-m-d\TH:i'):old('start_app_date')}}">
                                        @error('start_app_date') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha finalización de las postulaciones</label>
                                        <input type="datetime-local" class="form-control" id="exampleInputEmail1"
                                               name="end_app_date"
                                               value="{{$contest?$contest->end_app_date->format('Y-m-d\TH:i'):old('end_app_date')}}">
                                        @error('end_app_date') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha inicio de las votaciones</label>
                                        <input type="datetime-local" class="form-control" id="exampleInputEmail1"
                                               name="start_vote_date"
                                               value="{{$contest?$contest->start_vote_date->format('Y-m-d\TH:i'):old('start_vote_date')}}">
                                        @error('start_vote_date') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha finalización de las votaciones</label>
                                        <input type="datetime-local" class="form-control" id="exampleInputEmail1"
                                               name="end_vote_date"
                                               value="{{$contest?$contest->end_vote_date->format('Y-m-d\TH:i'):old('end_vote_date')}}">
                                        @error('end_vote_date') <span class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Imagen</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="file" class="file" id="exampleInputFile"
                                                       name="images[]" accept="image/*" data-browse-on-zone-click="true"
                                                       data-msg-placeholder="Seleccione imagen..."
                                                >
                                            </div>
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
                                                       id="exampleInputEmail1"
                                                       placeholder="Cantidad de caracteres"
                                                       name="cant_caracteres"
                                                       value="{{$contest?$contest->cant_caracteres:old('cant_caracteres')}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group narrativaLarga">
                                                <label for="exampleInputEmail1">Cantidad máxima de capítulos</label>
                                                <input type="number" step="1" min="0" class="form-control"
                                                       id="exampleInputEmail1"
                                                       placeholder="Cantidad de capítulos"
                                                       name="cant_capitulos"
                                                       value="{{$contest?$contest->cant_capitulos:old('cant_capitulos')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="modo">Modo de concurso</label>
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
                                            @for($i=0;$i<5;$i++)
                                                @if($contest && $i == $contest->cant_winners)
                                                    <option value="{{$i}}" selected>{{$i}}</option>
                                                @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                @foreach($per_winner as $item)
                                    <div class="col-md-6 porcentajeWinners">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Porcentaje premio</label>
                                            <input type="number" step="1" class="form-control"
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
<<<<<<< HEAD
                                        <label for="exampleInputEmail1">Fichas necesarias</label>
                                        <input type="number" step="1" class="form-control"
                                               placeholder="Fichas necesarias"
                                               name="required_amount"
                                               value="{{$contest?$contest->required_amount:old('required_amount')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="fijo">
                                <div class="col-md-6">
                                    <div class="form-group">
=======
>>>>>>> c365291ebe8ae41c9e26f382c9464c803a5e3869
                                        <label for="exampleInputEmail1">Monto premio</label>
                                        <input type="number" step="1" class="form-control"
                                               placeholder="Monto ganador"
                                               name="amount_winner"
                                               value="{{$contest?$contest->amount_winner:old('amount_winner')}}">
                                    </div>
                                </div>
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
                                                       name="active" checked>
                                            @endif
                                            <label class="form-check-label" for="exampleCheck1">Publicado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bases">Bases del concurso</label>
                                        <div class="form-control">
                                            @if($contest && $contest->getBases())
                                                <a href="{{url('admin/contenidos/'.$contest->getBases()->id)}}">{{$contest->getBases()->title}}</a>
                                            @else
<<<<<<< HEAD
                                                <a href="{{url('admin/contenidos/crear/pagina')}}"
                                                   target="_blank">Crear</a>
=======
                                                <a href="{{url('admin/contenidos/crear/pagina')}}">Crear</a>
>>>>>>> c365291ebe8ae41c9e26f382c9464c803a5e3869
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right">Guardar</button>
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
<<<<<<< HEAD
                        $("#fijo").hide();
=======
>>>>>>> c365291ebe8ae41c9e26f382c9464c803a5e3869
                        break;
                    case "2":
                        $("#pozo").hide();
                        $("#completo").show();
<<<<<<< HEAD
                        $("#fijo").show();
                        break;
                    case "3":
                        $("#pozo").hide();
                        $("#completo").hide();
                        $("#fijo").show();
=======
                        break;
                    case "3":
                        $("#pozo").hide();
                        $("#completo").show();
>>>>>>> c365291ebe8ae41c9e26f382c9464c803a5e3869
                        break;
                }
            });


            $("#contest_type").change(function () {
                const type = $(this).val();
                switch (type) {
                    case "1":
                        $(".narrativa").show();
                        $(".narrativaLarga").hide();
                        break;
                    case "2":
                        $(".narrativa").show();
                        $(".narrativaLarga").show();
                        break;
                    case "3":
                        $(".narrativa").hide();
                        $(".narrativaLarga").hide();
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
    </script>
@endsection
