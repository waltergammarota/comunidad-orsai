@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    @if($contenido)
        Editar {{$type}}
    @else
        Crear {{$type}}
    @endif
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            @if($contenido)
                <h3 class="card-title">Crear {{$type}}</h3>
            @else
                <h3 class="card-title">Editar {{$type}}</h3>
            @endif
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if($contenido)
            <form role="form" method="POST" action="{{url('admin/contenidos/update')}}" enctype="multipart/form-data">
                <input type="hidden" value="{{$contenido->id}}" name="id">
                @else
                    <form role="form" method="POST" action="{{url('admin/contenidos/store')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" value="0" name="id">
                        @endif
                        @csrf
                        <input type="hidden" name="tipo" value="{{$type}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Título (obligatorio)</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="exampleInputEmail1" placeholder="Título"
                                       name="title"
                                       value="{{$contenido?$contenido->title:old('title')}}">
                                @error('title') <span class="help-block">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Slug"
                                       name="slug"
                                       value="{{$contenido?$contenido->slug:old('slug')}}">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha publicación (obligatorio)</label>
                                        <input type="date"
                                               class="form-control @error('fecha_publicacion') is-invalid @enderror"
                                               id="exampleInputEmail1" name="fecha_publicacion"
                                               value="{{$contenido?$contenido->fecha_publicacion->format('Y-m-d'):old('fecha_publicacion')}}">
                                        @error('fecha_publicacion') <span
                                            class="help-block">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Autor</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                               placeholder="Autor"
                                               name="autor"
                                               value="{{$contenido?$contenido->autor:old('autor')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Copete</label>
                                <textarea class="form-control" rows="2" placeholder="Copete ..."
                                          name="copete">{{$contenido?$contenido->copete:old('copete')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cuerpo (obligatorio)</label>
                                <textarea class="form-control @error('texto') is-invalid @enderror" rows="10"
                                          placeholder="Cuerpo ..." id="summernote"
                                          name="texto">{{$contenido?$contenido->texto:old('texto')}}</textarea>
                                @error('texto') <span class="help-block">{{$message}}</span> @enderror
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                       name="visible" {{$contenido && $contenido->visible?"checked":""}}>
                                <label class="form-check-label" for="exampleCheck1">Visible</label>
                            </div>
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
                        <!-- /.card-body -->

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
        .kv-file-remove {
            display: none;
        }

        .help-block {
            color: #dc3545;
        }
    </style>
    <script>

        $(document).ready(function () {
            $('#summernote').summernote({
                tabsize: 2,
                height: 200
            });
        });

        $("#exampleInputFile").fileinput({
            theme: 'fas',
            language: 'es',
            showUpload: false,
            deleteUrl: false,
            initialPreviewAsData: true,
            @if($imageUrl != '')
            initialPreview: [
                "{{$imageUrl}}"
            ]
            @endif
        });
    </script>

@endsection

