@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')


@section('content')

<section class="resaltado_gris concursos_nuevos">
  <div class="container-concurso">
    <h2 class="title">CONCURSOS <span class="line"></span></h2>
    <p class="subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.</p>
    <hr class="gray">
 
    <div class="nav-filter">
      <div class="column-filter">
        <div class="filter-wrapper">
          <div class="filter">
            <input type="radio" value="all" id="all" name="filter" checked>
             <label for="all" {{--@if($filtro == "todos" || $filtro == null)class="activo" @endif onclick="goTo('todos', '{{$busqueda}}')"--}}> 
              TODOS
            </label>
          </div>
          <div class="filter">
            <input type="radio" value="active" id="active" name="filter">
            <label for="active" {{--@if($filtro == "activos")class="activo" @endif onclick="goTo('activos', '{{$busqueda}}')"--}}>
              ACTIVOS
            </label>
          </div>
          <div class="filter">
            <input type="radio" value="soon" id="next" name="filter">
            <label for="next" {{--@if($filtro == "proximos")class="activo" @endif onclick="goTo('proximos', '{{$busqueda}}')"--}}>
              PROXIMOS
            </label>
          </div>
          <div class="filter">
            <input type="radio" value="ended" id="ended" name="filter">
            <label for="ended" {{--@if($filtro == "finalizados")class="activo" @endif onclick="goTo('finalizados', '{{$busqueda}}')"--}}>
              FINALIZADOS
            </label>
          </div>
        </div>
      </div>
      <div class="column-filter">
        <div class="filter-wrapper">
          <select name="modes" id="modes">
            <option value="0">Todos los modos</option>
            <option value="0">Modo Pozo</option>
            <option value="0">Modo Fijo</option>
            <option value="0">Modo Completo</option> 
          </select>
        </div>
      </div>
      <div class="column-filter">
        <div class="content-search">
          <input type="text" id="search-concurso" class="search-filter" placeholder="¿QUÉ CONCURSO BUSCÁS?"/>
          <button type="submit" class="submit-search-filter">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"><path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23	s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92	c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17	s-17-7.626-17-17S14.61,6,23.984,6z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
          </button>
        </div>
      </div>
    </div>
    <div class="content-cards">
      <div id="concursos-cards" class="row">
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card active">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">ACTIVO</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">asdARES</h5>
                <div class="card-footer"> 
                  <div class="card-footer-flex">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Fichas" />
                         <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"alt="Modo Pozo" />
                      <span class="info">Modo pozo</span>
                    </div> 
                    <div class="card-footer-info more-details">
                      <img src="{{url('estilos/front2021/assets/flecha.svg')}}" alt="Ver más" />
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card soon">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">PROXIMAMENTE</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">Concurso internacional de cuento corto con jurado popular y premio incalculable en dólares</h5>
                <div class="card-footer"> 
                  <div class="card-footer-flex">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Fichas" />
                         <span class="total">1.877</span>
                      </div>
                      <span class="info">Premio</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <img src="{{url('estilos/front2021/assets/modo_fijo.svg')}}"alt="Modo Fijo" />
                      <span class="info">Modo Fijo</span>
                    </div> 
                    <div class="card-footer-info more-details">
                      <img src="{{url('estilos/front2021/assets/flecha.svg')}}" alt="Ver más" />
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card ended">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">FINALIZADO</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">Concurso de Logo</h5>
                <div class="card-footer"> 
                  <div class="card-footer-flex">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Fichas" />
                         <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"alt="Modo Pozo" />
                      <span class="info">Modo pozo</span>
                    </div> 
                    <div class="card-footer-info more-details">
                      <img src="{{url('estilos/front2021/assets/flecha.svg')}}" alt="Ver más" />
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div> 
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card active">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">ACTIVO</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">asdARES</h5>
                <div class="card-footer"> 
                  <div class="card-footer-flex">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Fichas" />
                         <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"alt="Modo Pozo" />
                      <span class="info">Modo pozo</span>
                    </div> 
                    <div class="card-footer-info more-details">
                      <img src="{{url('estilos/front2021/assets/flecha.svg')}}" alt="Ver más" />
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card soon">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">PROXIMAMENTE</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">Concurso internacional de cuento corto con jurado popular y premio incalculable en dólares</h5>
                <div class="card-footer"> 
                  <div class="card-footer-flex">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Fichas" />
                         <span class="total">1.877</span>
                      </div>
                      <span class="info">Premio</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <img src="{{url('estilos/front2021/assets/modo_fijo.svg')}}"alt="Modo Fijo" />
                      <span class="info">Modo Fijo</span>
                    </div> 
                    <div class="card-footer-info more-details">
                      <img src="{{url('estilos/front2021/assets/flecha.svg')}}" alt="Ver más" />
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card ended">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">FINALIZADO</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">Concurso de Logo</h5>
                <div class="card-footer"> 
                  <div class="card-footer-flex">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Fichas" />
                         <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"alt="Modo Pozo" />
                      <span class="info">Modo pozo</span>
                    </div> 
                    <div class="card-footer-info more-details">
                      <img src="{{url('estilos/front2021/assets/flecha.svg')}}" alt="Ver más" />
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div> 
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card active">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">ACTIVO</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">asdARES</h5>
                <div class="card-footer"> 
                  <div class="card-footer-flex">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Fichas" />
                         <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"alt="Modo Pozo" />
                      <span class="info">Modo pozo</span>
                    </div> 
                    <div class="card-footer-info more-details">
                      <img src="{{url('estilos/front2021/assets/flecha.svg')}}" alt="Ver más" />
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card soon">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">PROXIMAMENTE</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">Concurso internacional de cuento corto con jurado popular y premio incalculable en dólares</h5>
                <div class="card-footer"> 
                  <div class="card-footer-flex">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Fichas" />
                         <span class="total">1.877</span>
                      </div>
                      <span class="info">Premio</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <img src="{{url('estilos/front2021/assets/modo_fijo.svg')}}"alt="Modo Fijo" />
                      <span class="info">Modo Fijo</span>
                    </div> 
                    <div class="card-footer-info more-details">
                      <img src="{{url('estilos/front2021/assets/flecha.svg')}}" alt="Ver más" />
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card ended">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">FINALIZADO</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">Concurso de Logo</h5>
                <div class="card-footer"> 
                  <div class="card-footer-flex">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Fichas" />
                         <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}"alt="Modo Pozo" />
                      <span class="info">Modo pozo</span>
                    </div> 
                    <div class="card-footer-info more-details">
                      <img src="{{url('estilos/front2021/assets/flecha.svg')}}" alt="Ver más" />
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div> 
      </div>
    </div>
    <!-- status elements -->
    <div class="scroller-status">
      <div class="infinite-scroll-request loader-ellips">
        <div class="loading-section">
          <div class="spinner">
            <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve"><g><circle cx="16" cy="64" r="16" fill="#808080"/><circle cx="16" cy="64" r="16" fill="#aaaaaa" transform="rotate(45,64,64)"/><circle cx="16" cy="64" r="16" fill="#cacaca" transform="rotate(90,64,64)"/><circle cx="16" cy="64" r="16" fill="#e6e6e6" transform="rotate(135,64,64)"/><circle cx="16" cy="64" r="16" fill="#f0f0f0" transform="rotate(180,64,64)"/><circle cx="16" cy="64" r="16" fill="#f0f0f0" transform="rotate(225,64,64)"/><circle cx="16" cy="64" r="16" fill="#f0f0f0" transform="rotate(270,64,64)"/><circle cx="16" cy="64" r="16" fill="#f0f0f0" transform="rotate(315,64,64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;315 64 64;270 64 64;225 64 64;180 64 64;135 64 64;90 64 64;45 64 64" calcMode="discrete" dur="640ms" repeatCount="indefinite"></animateTransform></g></svg>
          </div>
          <div class="text-loading">
            Cargando...
          </div>
        </div>
      </div>
      <p class="infinite-scroll-last">No hay más concursos.</p> 
    </div>
    
    <!-- pagination has path -->
    <p class="pagination">
      <a class="pagination__next" href="{{url('infinite-test.html')}}">Next page</a>
    </p>
    
  </div>
</section> 

@endsection
 
@section('footer')
  <script src="{{url('js/front2021/infinite-scroll.pkgd.min.js')}}"></script>
  @include("fundacion.footer-fundacion") 
    <script>
        $(".content-cards").fadeIn(600).css("display", "inline-block");
  
        function goTo(location, filtro) {
            let busqueda = "";
            if (filtro != null && filtro != "") {
                busqueda = `&busqueda=${filtro}`
            }
            window.location = `{{url('concursos?filtro=')}}${location}${busqueda}`;
        }

        $('#concursos-cards').infiniteScroll({
          path: '.pagination__next',
          append: '.article',
          status: '.scroller-status',
          hideNav: '.pagination',
        });
    </script>
@endsection