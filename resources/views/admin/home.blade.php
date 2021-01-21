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

                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                        Respaldo de código Superior
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row" id="filtrosUsuarios">
                                        <div class="col-md-12"> 
                                            <textarea class="form-control" rows="10">
                                                                                 <section class="mainslider">
                                            <div>
                                                <div id="owlMainSlider" class="owl-carousel owl-theme">
                                                    <div>
                                                        <div class="item"><img src="https://beta.comunidadorsai.org/recursos/front2021/cine-1.jpg" alt="Orsai producirá cine y será una película aparte">
                                                            <div class="banner_text_inside">
                                                                <h1 class="contenedor">Orsai producirá cine y será <span class="block_item">una película aparte2</span>
                                                                </h1>
                                                                <div class="contenedor">
                                                                    <p class="contenedor">El debut de «Orsai Audiovisuales» será con la adaptación del
                                                                        primer gran best-seller rioplatense de este siglo: la novela «La uruguaya», de Pedro
                                                                        Mairal.</strong></p>
                                                                    <a href="https://beta.comunidadorsai.org/novedades/orsai-audiovisual"
                                                                       class="boton_redondeado resaltado_amarillo">
                                                                        <span>Ver proyecto</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="item"><img src="https://beta.comunidadorsai.org/recursos/front2021/cine-3.jpg" alt="Presentamos el nuevo proyecto Orsai para la década que viene">
                                                            <div class="banner_text_inside">

                                                                <h1 class="contenedor">Presentamos el nuevo proyecto Orsai <span class="block_item">para la década que viene</span>
                                                                </h1>
                                                                <div class="contenedor">
                                                                    <p class="contenedor">El 1 de enero de 2021 nació la <strong>Fundación Orsai</strong>,
                                                                        con sede física en Mercedes, sede virtual en <i>ComunidadOrsai.org</i> y con las
                                                                        características legales y jurídicas de una organización sin fines de lucro.</p>

                                                                    <a href="https://beta.comunidadorsai.org/novedades/piedra-fundamental"
                                                                       class="boton_redondeado resaltado_amarillo">
                                                                        <span>Ver proyecto</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="item"><img src="https://beta.comunidadorsai.org/recursos/front2021/cine-2.jpg" alt="Nuestra sede física: una historia que empezó hace 40 años">
                                                            <div class="banner_text_inside">
                                                                <h1 class="contenedor">Nuestra sede física: una historia <span class="block_item">que empezó hace 40 años</span>
                                                                </h1>
                                                                <div class="contenedor">
                                                                    <p class="contenedor">Nos cedieron el ex Cine de Mercedes hasta el año 2040, y vamos a
                                                                        hacer que ese lugar se convierta en la capital hispanoamericana de la narrativa del
                                                                        siglo veintiuno.</strong></p>
                                                                    <a href="https://beta.comunidadorsai.org/novedades/la-sede-fisica"
                                                                       class="boton_redondeado resaltado_amarillo">
                                                                        <span>Ver proyecto</span>
                                                                    </a> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </section>
                                            </textarea>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion1">
                        <div class="card">
                            <div class="card-header" id="headingOne1">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne1"
                                            aria-expanded="true" aria-controls="collapseOne">
                                        Respaldo de código Inferior
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne1" class="collapse" aria-labelledby="headingOne1"
                                 data-parent="#accordion1">
                                <div class="card-body">
                                    <div class="row" id="filtrosUsuarios">
                                        <div class="col-md-12"> 
                                            <textarea class="form-control" rows="10"> <section class="resaltado_black pd_tp_bt pd_20">
        <div class="contenedor titulo_seccion_med">
            <h2>Más sobre <span class="color_amarillo">la Fundación</span></h2>
        </div>
        <div class="contenedor grilla_3">  
            <article class="item card_style_3">
                <div class="card_img">
                    <a href="https://beta.comunidadorsai.org/novedades/voluntariado-y-biblioteca">
                        <img src="https://beta.comunidadorsai.org/recursos/front2021/novedades-1.jpg" alt="Imagen sobre la fundacion">
                    </a>
                </div>
                <a href="https://beta.comunidadorsai.org/novedades/voluntariado-y-biblioteca">
                    <h3 class="color_amarillo">Desde 2021 la Fundación Orsai va a crear una Biblioteca de Escritores
                        Vivos</h3>
                </a>
                <p>La sede física (el exCine Español de Mercedes) recibirá los volúmenes donados y la comunidad los
                    grabará en voz alta.</p>
                <a href="https://beta.comunidadorsai.org/novedades/voluntariado-y-biblioteca" class="boton_redondeado resaltado_amarillo">
                    <span>Más info</span>
                </a> 
            </article>
            <article class="item card_style_3">
                <div class="card_img">
                    <a href="https://beta.comunidadorsai.org/novedades/orsai-edicion-10-aniversario">
                        <img src="https://beta.comunidadorsai.org/recursos/front2021/novedades-2.jpg" alt="Imagen sobre la fundacion">
                    </a>
                </div>
                <a href="https://beta.comunidadorsai.org/novedades/orsai-edicion-10-aniversario">
                    <h3 class="color_amarillo">Una maravilla en papel de 400 páginas para celebrar diez años de
                        Orsai</h3>
                </a>
                <p>Un catálogo que será frontera entre la Editorial y la Fundación. Y como dios manda: son historias de
                    los lectores.</p>
                <a href="https://beta.comunidadorsai.org/novedades/orsai-edicion-10-aniversario" class="boton_redondeado resaltado_amarillo">
                    <span>Más info</span>
                </a>
            </article>
            <article class="item card_style_3">
                <div class="card_img">
                    <a href="https://beta.comunidadorsai.org/novedades/sistema-de-fichas">
                        <img src="https://beta.comunidadorsai.org/recursos/front2021/novedades-3.jpg" alt="Imagen sobre la fundacion">
                    </a>
                </div>
                <a href="https://beta.comunidadorsai.org/novedades/sistema-de-fichas">
                    <h3 class="color_amarillo">La casa invita: el sistema de fichas en la comunidad y cómo
                        conseguirlas</h3>
                </a>
                <p>Las fichas serán recursos para valorar proyectos que ComunidadOrsai.org les entregará a sus
                    benefactores a cambio de tiempo o plata.</p>
                <a href="https://beta.comunidadorsai.org/novedades/sistema-de-fichas" class="boton_redondeado resaltado_amarillo">
                    <span>Más info</span>
                </a>
            </article> 
        </div>
    </section> 
                                            </textarea>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

