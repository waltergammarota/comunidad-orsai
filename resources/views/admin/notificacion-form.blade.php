@extends('admin.admin-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('name')
    @if($notificacion)
        Editar Notificación
    @else
        Crear Notificación
    @endif
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            @if($notificacion)
                <h3 class="card-title">Editar Notificación</h3>
            @else
                <h3 class="card-title">Crear Notificación</h3>
            @endif
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <div class="card-body">

            @if($notificacion)
                <form role="form" method="POST" action="{{url('admin/notificaciones/update')}}">
                    <input type="hidden" value="{{$notificacion->id}}" name="id">
                    @else
                        <form role="form" method="POST" action="{{url('admin/notificaciones/store')}}">
                            <input type="hidden" value="0" name="id">
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asunto (obligatorio)</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Asunto de email"
                                       name="subject"
                                       value="{{$notificacion?$notificacion->subject:old('subject')}}">
                                @error('subject') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Título (obligatorio)</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Título"
                                       name="title"
                                       value="{{$notificacion?$notificacion->title:old('title')}}">
                                @error('title') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripción (obligatorio)</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="10"
                                          placeholder="Cuerpo ..." id="summernote"
                                          name="description">{{$notificacion?$notificacion->description:old('description')}}</textarea>
                                @error('description') <span class="help-block">{{$message}}</span> @enderror
                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha notificación (obligatorio)</label>
                                        <input type="date"
                                               class="form-control @error('deliver_date') is-invalid @enderror"
                                               id="exampleInputEmail1" name="deliver_date"
                                               value="{{$notificacion?$notificacion->deliver_time->format('Y-m-d'):$now}}">
                                        @error('deliver_date') <span
                                            class="help-block">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hora publicación (obligatorio)</label>
                                        <input type="time"
                                               class="form-control @error('deliver_hour') is-invalid @enderror"
                                               id="exampleInputEmail1" name="deliver_hour"
                                               value="{{$notificacion?$notificacion->deliver_time->format('H:i'):$timeNow}}">
                                        @error('deliver_hour') <span
                                            class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Url botón</label>
                                        <input type="text" class="form-control @error('button_url') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Link del botón"
                                               name="button_url"
                                               value="{{$notificacion?$notificacion->button_url:old('button_url')}}">
                                        @error('button_url') <span class="help-block">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Texto botón</label>
                                        <input type="text" class="form-control @error('button_text') is-invalid @enderror"
                                               id="exampleInputEmail1" placeholder="Texto del botón"
                                               name="button_text"
                                               value="{{$notificacion?$notificacion->button_text:old('button_text')}}">
                                        @error('button_text') <span class="help-block">{{$message}}</span> @enderror
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Destinatario</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="users[]">
                                            <option value="0" selected>Todos</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Template</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="template">
                                            <option value="1" selected>Default</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Notificación por plataforma</label>
                                <div class="form-check">
                                    @if($notificacion)
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                               name="database" {{$notificacion->database?"checked":""}}>
                                    @else
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                               name="database" checked>
                                    @endif
                                    <label class="form-check-label" for="exampleCheck1">Plataforma</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Notificación por correo</label>
                                <div class="form-check">
                                    @if($notificacion)
                                        <input type="checkbox" class="form-check-input" id="publicaCheck" value="1"
                                               name="mail" {{$notificacion->mail?"checked":""}}>
                                    @else
                                        <input type="checkbox" class="form-check-input" id="publicaCheck" value="1"
                                               name="mail">
                                    @endif
                                    <label class="form-check-label" for="publicaCheck">Correo</label>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
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


    <link href="{{url('js/file-input/css/fileinput.css')}}" media="all" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('js/file-input/themes/explorer-fas/theme.css')}}" media="all" rel="stylesheet"
          type="text/css"/>
    <script src="{{url('js/file-input/js/plugins/piexif.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/js/plugins/sortable.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/js/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/js/locales/fr.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/js/locales/es.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/themes/fas/theme.js')}}" type="text/javascript"></script>
    <script src="{{url('js/file-input/themes/explorer-fas/theme.js')}}" type="text/javascript"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css"
          rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

    <style>
        .close.fileinput-remove {
            display: none;
        }

        .help-block {
            color: #dc3545;
        }
    </style>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#summernote').summernote({
                tabsize: 2,
                height: 200
            });
        });

    </script>

@endsection

