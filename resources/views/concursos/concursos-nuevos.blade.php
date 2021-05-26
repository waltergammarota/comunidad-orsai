@extends('2021-orsai-template')

@section('title', 'Concursos | Comunidad Orsai')
@section('description','Concursos | Comunidad Orsai')


@section('content')

    <section class="resaltado_gris concursos_nuevos">
        <div class="container-concurso">
            <h2 class="title">CONCURSOS <span class="line"></span></h2>
            <p class="subtitle">Este es el casino cultural de Comunidad Orsai.</p>
            <p class="subtitle">Participá de los concursos: subí la cantidad de postulaciones que quieras y ponele fichas a otras historias que te gusten. ¿Querés tener ventaja? <strong>Convertite en jurado VIP</strong>.</p>
            <hr class="gray">

            <div class="nav-filter">
                <div class="column-filter">
                    <div class="filter-wrapper">
                        <div class="filter">
                            <input type="radio" value="todos" id="Todos" name="filter"
                                   @if($filtro == "todos" || $filtro == null)
                                   checked
                                   @endif onclick="goTo('todos', '{{$busqueda}}')">
                            <label
                                for="Todos" {{--@if($filtro == "todos" || $filtro == null)class="activo" @endif onclick="goTo('todos', '{{$busqueda}}')"--}}>
                                TODOS
                            </label>
                        </div>
                        <div class="filter">
                            <input type="radio" value="activos" id="Vigentes" name="filter"
                                   @if($filtro == "activos") checked
                                   @endif onclick="goTo('activos', '{{$busqueda}}')">
                            <label
                                for="Vigentes" {{--@if($filtro == "activos")class="activo" @endif onclick="goTo('activos', '{{$busqueda}}')"--}}>
                                ACTIVOS
                            </label>
                        </div>
                        <div class="filter">
                            <input type="radio" value="proximos" name="filter"
                                   id="Próximamente" @if($filtro == "proximos") checked
                                   @endif onclick="goTo('proximos', '{{$busqueda}}')"
                            >
                            <label
                                for="Próximamente" {{--@if($filtro == "proximos")class="activo" @endif onclick="goTo('proximos', '{{$busqueda}}')"--}}>
                                PROXIMOS
                            </label>
                        </div>
                        <div class="filter">
                            <input type="radio" value="finalizados" name="filter"
                                   id="Finalizados" @if($filtro == "finalizados")checked
                                   @endif onclick="goTo('finalizados', '{{$busqueda}}')"
                            >
                            <label
                                for="Finalizados" {{--@if($filtro == "finalizados")class="activo" @endif onclick="goTo('finalizados', '{{$busqueda}}')"--}}>
                                FINALIZADOS
                            </label>
                        </div>
                    </div>
                </div>
                <div class="column-filter">
                    <div class="filter-wrapper">
                        <select name="modes" id="modes">
                            <option value="">Todos los modos</option>
                            <option value="pozo" @if($modo == "pozo") selected @endif>Modo Pozo</option>
                            <option value="fijo" @if($modo == "fijo") selected @endif>Modo Fijo</option>
                            <option value="completo" @if($modo == "completo") selected @endif>Modo Completo</option>
                        </select>
                    </div>
                </div>
                <div class="column-filter">
                    <div class="content-search">
                        <input type="text" id="search-concurso" class="search-filter" name="busqueda"
                               placeholder="¿QUÉ CONCURSO BUSCÁS?" value="{{$busqueda}}"/>
                        <button type="submit" class="submit-search-filter" onclick="goTo()">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 56.966 56.966"
                                 style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"><path
                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23	s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92	c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17	s-17-7.626-17-17S14.61,6,23.984,6z"/>
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
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-cards">
                <div id="concursos-cards" class="row">
                    @foreach($concursos as $concurso)
                        <div class="col-12 col-md-6 col-lg-4">
                            @if($concurso->start_date > $now)
                                <div class="card soon">
                                    @elseif($concurso->end_date < $now)
                                        <div class="card ended">
                                            @else
                                                <div class="card active">
                                                    @endif
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
                                                                            <img
                                                                                src="{{url('estilos/front2021/assets/fichas.svg')}}"
                                                                                alt="Fichas"/>
                                                                            <span
                                                                                class="total">{{$concurso->cantidadFichasEnJuego()}}</span>
                                                                        </div>
                                                                        <span class="info">Pozo acumulado</span>
                                                                    </div>
                                                                    <div class="card-footer-info modo-pozo">
                                                                        @if($concurso->getMode()->id == 1)
                                                                            <img
                                                                                src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"
                                                                                alt="Modo Pozo"/>
                                                                        @elseif($concurso->getMode()->id = 3)
                                                                            <img
                                                                                src="{{url('estilos/front2021/assets/modo_fijo.svg')}}"
                                                                                alt="Modo Fijo"/>
                                                                        @else
                                                                            <img
                                                                                src="{{url('estilos/front2021/assets/modo_completo.svg')}}"
                                                                                alt="Modo Completo"/>
                                                                        @endif
                                                                        <span
                                                                            class="info">Modo {{$concurso->getMode()->name}}</span>
                                                                    </div>
                                                                    <div class="card-footer-info more-details">
                                                                        <img
                                                                            src="{{url('estilos/front2021/assets/flecha.svg')}}"
                                                                            alt="Ver más"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                        </div>
                                        @endforeach

                                </div>
                                <!-- status elements -->
                                <div class="scroller-status">
                                    <div class="infinite-scroll-request loader-ellips" style="display:none;">
                                        <div class="loading-section">
                                            <div class="spinner">
                                                <svg xmlns:svg="http://www.w3.org/2000/svg"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0"
                                                     width="64px"
                                                     height="64px"
                                                     viewBox="0 0 128 128" xml:space="preserve"><g>
                                                        <circle cx="16" cy="64" r="16" fill="#808080"/>
                                                        <circle cx="16" cy="64" r="16" fill="#aaaaaa"
                                                                transform="rotate(45,64,64)"/>
                                                        <circle cx="16" cy="64" r="16" fill="#cacaca"
                                                                transform="rotate(90,64,64)"/>
                                                        <circle cx="16" cy="64" r="16" fill="#e6e6e6"
                                                                transform="rotate(135,64,64)"/>
                                                        <circle cx="16" cy="64" r="16" fill="#f0f0f0"
                                                                transform="rotate(180,64,64)"/>
                                                        <circle cx="16" cy="64" r="16" fill="#f0f0f0"
                                                                transform="rotate(225,64,64)"/>
                                                        <circle cx="16" cy="64" r="16" fill="#f0f0f0"
                                                                transform="rotate(270,64,64)"/>
                                                        <circle cx="16" cy="64" r="16" fill="#f0f0f0"
                                                                transform="rotate(315,64,64)"/>
                                                        <animateTransform attributeName="transform" type="rotate"
                                                                          values="0 64 64;315 64 64;270 64 64;225 64 64;180 64 64;135 64 64;90 64 64;45 64 64"
                                                                          calcMode="discrete" dur="640ms"
                                                                          repeatCount="indefinite"></animateTransform>
                                                    </g></svg>
                                            </div>
                                            <div class="text-loading">
                                                Cargando...
                                            </div>
                                        </div>
                                    {{-- </div>
                                    <p class="infinite-scroll-last">No hay más concursos.</p> --}}
                                </div>

                                <!-- pagination has path -->
                                @if($pagina < $totalPaginas)
                                    <p class="pagination">
                                        <a class="pagination__next" href="{{url($links[$pagina + 1])}}">Next page</a>
                                    </p>
                                @endif
                        </div>
    </section>

@endsection

@section('footer')
    <script src="{{url('js/front2021/infinite-scroll.pkgd.min.js')}}"></script>
    @include("fundacion.footer-fundacion")
    <script>
        $(".content-cards").fadeIn(600).css("display", "inline-block");


        function goTo() {
            const radios = $("input[name=filter]");
            const location = radios.filter(":checked").val();
            let busqueda = "";
            const mode = $("#modes").val();
            const filtro = $("#search-concurso").val();
            if (filtro != null && filtro != "") {
                busqueda = `&busqueda=${filtro}`
            }
            if (mode != null && mode != "") {
                busqueda = `${busqueda}&modo=${mode}`
            }
            window.location = `{{url('concursos?filtro=')}}${location}${busqueda}`;
        }

        $("#modes").change(function () {
            goTo();
        });


        $('#concursos-cards').infiniteScroll({
            path: '.pagination__next',
            append: '.article',
            status: '.scroller-status',
            hideNav: '.pagination',
            history: false
        });

    </script>
@endsection
