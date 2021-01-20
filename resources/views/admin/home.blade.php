@extends('admin.admin-template')

@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        h3.card-title.danger {
            background-color: red;
    }
    </style>
@endsection 

@section('name')
    {{$title}}
@endsection

@section('content')
    <div class="card card-primary"> 
        <!-- /.card-header -->
        <!-- form start -->

        <div class="card-body">
 
                <form role="form" method="POST" action="{{url('admin/home/update')}}"> 
                            <input type="hidden" value="0" name="id"> 
                            @csrf  
                            <div class="form-group">
                                <label for="exampleInputEmail1">Módulo Superior</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="10"
                                          placeholder="Cuerpo ..." id="summernote"
                                          name="description1">@isset($home[0]) {{$home[0]?$home[0]->description:old('description')}}@endisset</textarea> 
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Módulo Inferior</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="10"
                                          placeholder="Cuerpo ..." id="summernote2"
                                          name="description2">@isset($home[1]) {{$home[1]?$home[1]->description:old('description')}} @endisset</textarea> 
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
/*
        $(document).ready(function () {
            $('#summernote').summernote({
                tabsize: 2,
                height: 200
            });
            $('#summernote2').summernote({
                tabsize: 2,
                height: 200
            });
        });
*/
    </script>

@endsection

