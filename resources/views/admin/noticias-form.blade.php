@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    @if($noticia)
        Editar noticia
    @else
        Crear noticia
    @endif
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Crear noticia</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if($noticia)
            <form role="form" method="POST" action="{{url('admin/noticias/update')}}" enctype="multipart/form-data">
                <input type="hidden" value="{{$noticia->id}}" name="id">
                @else
                    <form role="form" method="POST" action="{{url('admin/noticias/store')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" value="0" name="id">
                        @endif
                        @csrf
                        <input type="hidden" name="tipo" value="noticia">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Título</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Título"
                                       name="title"
                                       value="{{$noticia?$noticia->title:old('title')}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Autor</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Autor"
                                       name="autor"
                                       value="{{$noticia?$noticia->autor:old('autor')}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha publicación</label>
                                <input type="date" class="form-control" id="exampleInputEmail1" name="fecha_publicacion"
                                       value="{{$noticia?$noticia->fecha_publicacion->format('Y-m-d'):old('fecha_publicacion')}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Copete</label>
                                <textarea class="form-control" rows="2" placeholder="Copete ..."
                                          name="copete">{{$noticia?$noticia->copete:old('copete')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cuerpo</label>
                                <textarea class="form-control" rows="10" placeholder="Cuerpo ..."
                                          name="texto">{{$noticia?$noticia->texto:old('texto')}}</textarea>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                       name="visible" {{$noticia && $noticia->visible?"checked":""}}>
                                <label class="form-check-label" for="exampleCheck1">Visible</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Imagen</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile"
                                                       name="images[]" accept="image/*">
                                                <label class="custom-file-label" for="exampleInputFile">Elija una
                                                    imagen</label>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    @if($noticia)
                                        <div class="col-md-2">
                                            <img src="{{$imageUrl}}" alt="" class="img-fluid">
                                            <br/>
                                        </div>
                                    @endif

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


@endsection

