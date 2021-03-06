@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')


@section('content')

<section class="resaltado_gris concursos_nuevos">
  <div class="container-concurso">
    <h2 class="title">CONCURSOS <span class="line"></span></h2>
    <p class="subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea.</p>
    <hr class="gray">
    <div class="nav-filter">
      <div class="column-filter">
        <div class="filter-wrapper">
          <div class="filter">
            <input type="radio" value="all" id="all" name="filter" checked>
            <label for="all">
              TODOS
            </label>
          </div>
          <div class="filter">
            <input type="radio" value="active" id="active" name="filter">
            <label for="active">
              ACTIVOS
            </label>
          </div>
          <div class="filter">
            <input type="radio" value="soon" id="next" name="filter">
            <label for="next">
              PROXIMOS
            </label>
          </div>
          <div class="filter">
            <input type="radio" value="ended" id="ended" name="filter">
            <label for="ended">
              FINALIZADOS
            </label>
          </div>
        </div>
      </div>
      <div class="column-filter">
        <div class="filter-wrapper">
          <select name="modes" id="modes">
            <option value="0">TODOS LOS MODOS</option>
            <option value="0">TODOS LOS MODOS</option>
            <option value="0">TODOS LOS MODOS</option>
            <option value="0">TODOS LOS MODOS</option>
            <option value="0">TODOS LOS MODOS</option>
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
      <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card active">
            <a href="#!">
              <div class="thumbnail">
                <img src="{{url('recursos/curso_1.png')}}" alt="">
                <span class="pills">ACTIVO</span>
              </div>
              <div class="card-body">
                <h5 class="card-title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h5>
                <div class="card-footer">
                  <div class="card-footer-left">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                      <span class="info">Modo pozo</span>
                    </div>
                  </div>
                  <div class="card-footer-right">
                    <a href="#!" class="more-details">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 447.243 447.243" style="enable-background:new 0 0 447.243 447.243;" xml:space="preserve"><g>	<g>		<path d="M437.883,201.174c-0.008-0.008-0.017-0.017-0.025-0.025l-160-160c-12.552-12.441-32.813-12.351-45.254,0.201			c-0.983,0.992-1.9,2.047-2.746,3.159c-8.971,13.381-7.013,31.276,4.64,42.4l88.32,88.64c4.695,4.7,10.093,8.641,16,11.68			l9.76,5.12h-314.4c-16.099-0.677-30.349,10.332-33.76,26.08c-2.829,17.445,9.019,33.881,26.465,36.71			c1.83,0.297,3.682,0.434,5.535,0.41h315.52l-6.88,3.2c-6.713,3.135-12.83,7.412-18.08,12.64l-88.48,88.48			c-11.653,11.124-13.611,29.019-4.64,42.4c10.441,14.259,30.464,17.355,44.724,6.914c1.152-0.844,2.247-1.764,3.276-2.754l160-160			C450.361,233.939,450.372,213.678,437.883,201.174z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                    </a>
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
                <h5 class="card-title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h5>
                <div class="card-footer">
                  <div class="card-footer-left">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                      <span class="info">Modo pozo</span>
                    </div>
                  </div>
                  <div class="card-footer-right">
                    <a href="#!" class="more-details">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 447.243 447.243" style="enable-background:new 0 0 447.243 447.243;" xml:space="preserve"><g>	<g>		<path d="M437.883,201.174c-0.008-0.008-0.017-0.017-0.025-0.025l-160-160c-12.552-12.441-32.813-12.351-45.254,0.201			c-0.983,0.992-1.9,2.047-2.746,3.159c-8.971,13.381-7.013,31.276,4.64,42.4l88.32,88.64c4.695,4.7,10.093,8.641,16,11.68			l9.76,5.12h-314.4c-16.099-0.677-30.349,10.332-33.76,26.08c-2.829,17.445,9.019,33.881,26.465,36.71			c1.83,0.297,3.682,0.434,5.535,0.41h315.52l-6.88,3.2c-6.713,3.135-12.83,7.412-18.08,12.64l-88.48,88.48			c-11.653,11.124-13.611,29.019-4.64,42.4c10.441,14.259,30.464,17.355,44.724,6.914c1.152-0.844,2.247-1.764,3.276-2.754l160-160			C450.361,233.939,450.372,213.678,437.883,201.174z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                    </a>
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
                <h5 class="card-title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h5>
                <div class="card-footer">
                  <div class="card-footer-left">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                      <span class="info">Modo pozo</span>
                    </div>
                  </div>
                  <div class="card-footer-right">
                    <a href="#!" class="more-details">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 447.243 447.243" style="enable-background:new 0 0 447.243 447.243;" xml:space="preserve"><g>	<g>		<path d="M437.883,201.174c-0.008-0.008-0.017-0.017-0.025-0.025l-160-160c-12.552-12.441-32.813-12.351-45.254,0.201			c-0.983,0.992-1.9,2.047-2.746,3.159c-8.971,13.381-7.013,31.276,4.64,42.4l88.32,88.64c4.695,4.7,10.093,8.641,16,11.68			l9.76,5.12h-314.4c-16.099-0.677-30.349,10.332-33.76,26.08c-2.829,17.445,9.019,33.881,26.465,36.71			c1.83,0.297,3.682,0.434,5.535,0.41h315.52l-6.88,3.2c-6.713,3.135-12.83,7.412-18.08,12.64l-88.48,88.48			c-11.653,11.124-13.611,29.019-4.64,42.4c10.441,14.259,30.464,17.355,44.724,6.914c1.152-0.844,2.247-1.764,3.276-2.754l160-160			C450.361,233.939,450.372,213.678,437.883,201.174z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                    </a>
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
                <h5 class="card-title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h5>
                <div class="card-footer">
                  <div class="card-footer-left">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                      <span class="info">Modo pozo</span>
                    </div>
                  </div>
                  <div class="card-footer-right">
                    <a href="#!" class="more-details">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 447.243 447.243" style="enable-background:new 0 0 447.243 447.243;" xml:space="preserve"><g>	<g>		<path d="M437.883,201.174c-0.008-0.008-0.017-0.017-0.025-0.025l-160-160c-12.552-12.441-32.813-12.351-45.254,0.201			c-0.983,0.992-1.9,2.047-2.746,3.159c-8.971,13.381-7.013,31.276,4.64,42.4l88.32,88.64c4.695,4.7,10.093,8.641,16,11.68			l9.76,5.12h-314.4c-16.099-0.677-30.349,10.332-33.76,26.08c-2.829,17.445,9.019,33.881,26.465,36.71			c1.83,0.297,3.682,0.434,5.535,0.41h315.52l-6.88,3.2c-6.713,3.135-12.83,7.412-18.08,12.64l-88.48,88.48			c-11.653,11.124-13.611,29.019-4.64,42.4c10.441,14.259,30.464,17.355,44.724,6.914c1.152-0.844,2.247-1.764,3.276-2.754l160-160			C450.361,233.939,450.372,213.678,437.883,201.174z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                    </a>
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
                <h5 class="card-title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h5>
                <div class="card-footer">
                  <div class="card-footer-left">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                      <span class="info">Modo pozo</span>
                    </div>
                  </div>
                  <div class="card-footer-right">
                    <a href="#!" class="more-details">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 447.243 447.243" style="enable-background:new 0 0 447.243 447.243;" xml:space="preserve"><g>	<g>		<path d="M437.883,201.174c-0.008-0.008-0.017-0.017-0.025-0.025l-160-160c-12.552-12.441-32.813-12.351-45.254,0.201			c-0.983,0.992-1.9,2.047-2.746,3.159c-8.971,13.381-7.013,31.276,4.64,42.4l88.32,88.64c4.695,4.7,10.093,8.641,16,11.68			l9.76,5.12h-314.4c-16.099-0.677-30.349,10.332-33.76,26.08c-2.829,17.445,9.019,33.881,26.465,36.71			c1.83,0.297,3.682,0.434,5.535,0.41h315.52l-6.88,3.2c-6.713,3.135-12.83,7.412-18.08,12.64l-88.48,88.48			c-11.653,11.124-13.611,29.019-4.64,42.4c10.441,14.259,30.464,17.355,44.724,6.914c1.152-0.844,2.247-1.764,3.276-2.754l160-160			C450.361,233.939,450.372,213.678,437.883,201.174z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                    </a>
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
                <h5 class="card-title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h5>
                <div class="card-footer">
                  <div class="card-footer-left">
                    <div class="card-footer-info pozo-cumulado">
                      <div class="img-total">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                        <span class="total">1.877</span>
                      </div>
                      <span class="info">Pozo acumulado</span>
                    </div>
                    <div class="card-footer-info modo-pozo">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 378.632 378.632" style="enable-background:new 0 0 378.632 378.632;" xml:space="preserve"><path style="fill:#EF8A2E;" d="M86.475,325.906l-20.08-56.48h245.92l-20.08,56.48H86.475z"/><path style="fill:#F4D22B;" d="M66.395,269.426l-58.4-164.48l107.12,62.4l74.24-114.64l74.24,114.64l107.12-62.4l-58.4,164.48	H66.395z"/><path style="fill:#23150B;" d="M366.635,98.066l-100.48,58.56l-70.08-108.32c-2.397-3.711-7.349-4.777-11.061-2.379	c-0.953,0.615-1.764,1.426-2.379,2.379l-70.08,108.32l-100.48-58.56c-3.802-2.251-8.709-0.993-10.959,2.809	c-1.216,2.055-1.451,4.545-0.641,6.791l78.48,220.96c1.118,3.199,4.131,5.346,7.52,5.36h205.76c3.389-0.013,6.402-2.161,7.52-5.36	l78.4-220.96c1.5-4.156-0.653-8.741-4.809-10.241c-2.246-0.81-4.736-0.576-6.791,0.641H366.635z M286.635,317.986H92.075	l-14.72-40.56h224L286.635,317.986z M306.635,261.426H72.075l-49.2-138.56l88,51.44c3.685,2.137,8.398,1.011,10.72-2.56l67.52-104	l67.52,104c2.322,3.571,7.035,4.697,10.72,2.56l88-51.44L306.635,261.426z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                      <span class="info">Modo pozo</span>
                    </div>
                  </div>
                  <div class="card-footer-right">
                    <a href="#!" class="more-details">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 447.243 447.243" style="enable-background:new 0 0 447.243 447.243;" xml:space="preserve"><g>	<g>		<path d="M437.883,201.174c-0.008-0.008-0.017-0.017-0.025-0.025l-160-160c-12.552-12.441-32.813-12.351-45.254,0.201			c-0.983,0.992-1.9,2.047-2.746,3.159c-8.971,13.381-7.013,31.276,4.64,42.4l88.32,88.64c4.695,4.7,10.093,8.641,16,11.68			l9.76,5.12h-314.4c-16.099-0.677-30.349,10.332-33.76,26.08c-2.829,17.445,9.019,33.881,26.465,36.71			c1.83,0.297,3.682,0.434,5.535,0.41h315.52l-6.88,3.2c-6.713,3.135-12.83,7.412-18.08,12.64l-88.48,88.48			c-11.653,11.124-13.611,29.019-4.64,42.4c10.441,14.259,30.464,17.355,44.724,6.914c1.152-0.844,2.247-1.764,3.276-2.754l160-160			C450.361,233.939,450.372,213.678,437.883,201.174z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                    </a>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="loading-section">
      <div class="spinner">
        <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve"><g><circle cx="16" cy="64" r="16" fill="#808080"/><circle cx="16" cy="64" r="16" fill="#aaaaaa" transform="rotate(45,64,64)"/><circle cx="16" cy="64" r="16" fill="#cacaca" transform="rotate(90,64,64)"/><circle cx="16" cy="64" r="16" fill="#e6e6e6" transform="rotate(135,64,64)"/><circle cx="16" cy="64" r="16" fill="#f0f0f0" transform="rotate(180,64,64)"/><circle cx="16" cy="64" r="16" fill="#f0f0f0" transform="rotate(225,64,64)"/><circle cx="16" cy="64" r="16" fill="#f0f0f0" transform="rotate(270,64,64)"/><circle cx="16" cy="64" r="16" fill="#f0f0f0" transform="rotate(315,64,64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;315 64 64;270 64 64;225 64 64;180 64 64;135 64 64;90 64 64;45 64 64" calcMode="discrete" dur="640ms" repeatCount="indefinite"></animateTransform></g></svg>
      </div>
      <div class="text-loading">
        Cargando...
      </div>
    </div>
    
  </div>
</section> 

@endsection
 
@section('footer')
  @include("fundacion.footer-fundacion")
@endsection