@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')


@section('content')
    <section class="inscripcion-cuento">
        <div class="contenedor">
            <div class="hero">
                <div class="content-hero">
                    <p class="pills">Inscripción</p>
                    <h2 class="title">{{$concurso->name}}</h2>
                    <p class="subtitle">{{$concurso->bajada_corta}}</p>
                    @if($bases)
                        <a href="{{url($bases->slug)}}" class="link">Leer bases y condiciones</a>
                    @endif
                </div>
                <nav class="hero-nav">
                    <div class="hero-nav-content">
                        <div class="hero-nav-item">
                            <div class="icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;"
                                     xml:space="preserve"><path style="fill:#EF8A2E;"
                                                                d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/>
                                    <path style="fill:#F4D22B;"
                                          d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/>
                                    <path style="fill:#23150B;"
                                          d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g></svg>
                            </div>
                            <div class="content-nav">
                                <span>Quedan</span>
                                <span class="strong">{{$diferencia}} dias</span>
                            </div>
                        </div>
                        <div class="hero-nav-item">
                            <div class="icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;"
                                     xml:space="preserve"><path style="fill:#EF8A2E;"
                                                                d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/>
                                    <path style="fill:#F4D22B;"
                                          d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/>
                                    <path style="fill:#23150B;"
                                          d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g></svg>
                            </div>
                            <div class="content-nav column">
                                <span class="big-number">{{$cantidadFichasEnJuego}}</span>
                                <span>Fichas de<br> pozo acumulado</span>
                            </div>
                        </div>
                        <div class="hero-nav-item">
                            <div class="icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;"
                                     xml:space="preserve"><path style="fill:#EF8A2E;"
                                                                d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/>
                                    <path style="fill:#F4D22B;"
                                          d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/>
                                    <path style="fill:#23150B;"
                                          d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g></svg>
                            </div>
                            <div class="content-nav column">
                                <span class="big-number">{{$concurso->cost_per_cpa}}</span>
                                <span>Fichas de<br> costo de inscripcion</span>
                            </div>
                        </div>
                        <div class="hero-nav-item">
                            <div class="icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;"
                                     xml:space="preserve"><path style="fill:#EF8A2E;"
                                                                d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/>
                                    <path style="fill:#F4D22B;"
                                          d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/>
                                    <path style="fill:#23150B;"
                                          d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g>
                                    <g></g></svg>
                            </div>
                            <div class="content-nav">
                                <span>Modo</span>
                                <span class="strong">{{$concurso->getMode()->name}}</span>
                            </div>
                        </div>

                        @if($estado == "abierto")
                            @if(!$hasPostulacion && $concurso->hasPostulacionesAbiertas())
                                <div class="hero-nav-item">
                                    <div class="content-nav center">
                                        <a href="{{url('postulaciones/'.$concurso->id.'/'.$concurso->name)}}"
                                           class="btn-postulacion">Subir mi postulación</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </section>
    <section class="resaltado_gris cuerpo_inscripcion">
        <div class="contenedor_interna">
            <div class="cuerpo_interna">
                <h2 class="cuerpo_inscripcion_title">{{$concurso->name}}</h2>
                {{$concurso->bajada_completa}}
                <div class="center-columns">
                    @if($bases)
                        <a href="{{url($bases->slug)}}" class="link">Leer bases y condiciones</a>
                    @endif
                    @if($estado == "abierto")
                        @if(!$hasPostulacion && $concurso->hasPostulacionesAbiertas())
                            <a href="{{url('postulaciones/'.$concurso->id.'/'.$concurso->name)}}"
                               class="rounded-save--yellow">Subir
                                mi postulación</a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="concurso-footer">
                <a href="{{url('concursos')}}" class="btn-back">Volver</a>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include("fundacion.footer-fundacion")
@endsection
