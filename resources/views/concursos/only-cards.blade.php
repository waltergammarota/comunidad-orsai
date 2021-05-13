@foreach($concursos as $concurso)
    <div class="col-12 col-md-6 col-lg-4 article">
        <div class="card active">
            <a href="{{url('concursos/'.$concurso->id.'/'.urlencode($concurso->getUrlName()))}}">
                <div class="thumbnail">
                    @if($concurso->image > 0)
                        <img
                            src="{{url('storage/images/' . $concurso->logo()->name . "." . $concurso->logo()->extension)}}"
                            alt="">
                    @else
                        <img src="{{url('recursos/curso_1.png')}}" alt="">
                    @endif

                    @if($concurso->start_date > $now)
                        <span class="pills">PROXIMAMENTE</span>
                    @elseif($concurso->end_date < $now)
                        <span class="pills">FINALIZADO</span>
                    @else
                        <span class="pills">ACTIVO</span>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$concurso->name}}</h5>
                    <div class="card-footer">
                        <div class="card-footer-flex">
                            <div class="card-footer-info pozo-cumulado">
                                <div class="img-total">
                                    <img src="{{url('estilos/front2021/assets/fichas.svg')}}"
                                         alt="Fichas"/>
                                    <span
                                        class="total">{{$concurso->cantidadFichasEnJuego()}}</span>
                                </div>
                                <span class="info">Pozo acumulado</span>
                            </div>
                            <div class="card-footer-info modo-pozo">
                                @if($concurso->getMode()->id == 1)
                                    <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"
                                         alt="Modo Pozo"/>
                                @elseif($concurso->getMode()->id = 3)
                                    <img src="{{url('estilos/front2021/assets/modo_fijo.svg')}}"
                                         alt="Modo Fijo"/>
                                @else
                                    <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"
                                         alt="Modo Completo"/>
                                @endif
                                <span class="info">Modo {{$concurso->getMode()->name}}</span>
                            </div>
                            <div class="card-footer-info more-details">
                                <img src="{{url('estilos/front2021/assets/flecha.svg')}}"
                                     alt="Ver más"/>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endforeach

@if($pagina == $totalPaginas)
    <p class="infinite-scroll-last">No hay más concursos.</p>
@endif

<p class="pagination">
    @if($pagina < $totalPaginas)
        <a class="pagination__next" href="{{url($links[$pagina + 1])}}">Next page</a>
    @endif
</p>

