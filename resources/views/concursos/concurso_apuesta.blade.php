@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')

@section('content')
    <section class="inscripcion-cuento">
        <div class="contenedor">
            <div class="hero">
                <div class="content-hero">
                    <p class="pills">Inscripción</p>
                    <h2 class="title">CONCURSO INTERNACIONAL DE CUENTO CORTO CON JURADO POPULAR Y PREMIO INCALCULABLE EN DÓLARES</h2>
                    <p class="subtitle">¿Escribís? Estamos buscando relatos infantiles para nuestra colección Orsai. ¡Animate!</p>
                    <a href="#" class="link">Leer bases y condiciones</a> 
                </div>
                <img src="https://dev.comunidadorsai.org/recursos/front2021/fichas-donaciones.jpg" class="img_fondo" alt="">
            </div> 
            
            <nav class="hero-nav concurso_nav"> 
                <div class="hero-nav-content  owl-carousel owl-theme">
                    <div class="hero-nav-item">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/reloj.svg')}}" alt="insertar SVG con la etiqueta image">
                        </div>
                        <div class="content-nav">
                            <span>Tenes tiempo hasta el<br/><strong>4 de Abril</strong></span>
                        </div>
                    </div>
                    <div class="hero-nav-item">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="insertar SVG con la etiqueta image">
                        </div>
                        <div class="content-nav column">
                            <span class="big-number">4502</span>
                            <span>Fichas de<br> pozo acumulado</span>
                        </div>
                    </div>
                    <div class="hero-nav-item">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/ficha.svg')}}" alt="insertar SVG con la etiqueta image">
                        </div>
                        <div class="content-nav column">
                            <span class="big-number">42</span>
                            <span>Fichas de<br> costo de inscripcion</span>
                        </div>
                    </div>
                    <div class="hero-nav-item">
                        <div class="icon">
                            <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}" alt="insertar SVG con la etiqueta image">
                        </div>
                        <div class="content-nav">
                            <span>Modo</span>
                            <span class="strong">Pozo</span>
                        </div>
                    </div> 
                    <div class="hero-nav-item">
                        <div class="content-nav center">
                            <a href="#" class="btn-postulacion">Subir mi postulación</a>
                        </div>
                    </div> 
                </div>
            </nav>
            <div class="subir_postulacion"> 
                <a href="#" class="btn-postulacion">Subir mi postulación</a> 
            </div>
        </div>
    </section>
    
<main class="cd-main-content resaltado_gris">
    <div class="cd-tab-filter-wrapper"> 
			<div class="cd-tab-filter">
			   <ul class="cd-filters">
				  <li class="placeholder"> 
					 <a data-type="all" href="#0">All</a> <!-- selected option on mobile -->
				  </li> 
				  <li class="filter"><a class="selected" href="#0" data-type="all">Leit motivs</a></li>
				  <li class="filter" data-filter=".color-1"><a href="#0" data-type="color-1">Descripciones</a></li>
				  <li class="filter" data-filter=".color-2"><a href="#0" data-type="color-2">Cuentos</a></li>
			   </ul> <!-- cd-filters -->
			</div> <!-- cd-tab-filter --> 
    </div> <!-- cd-tab-filter-wrapper -->
 
    <section class="cd-gallery">
       <ul>
            <li class="mix color-1 check1 radio2 option3">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                    </div>
                </div>
            </li>
            <li class="mix color-2 check2 radio2 option2">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span> 
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                </div>
            </li>
            <li class="mix color-2 check2 radio2 option2">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                </div>
            </li>
            <li class="mix color-2 check2 radio2 option2">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                </div>
            </li>
            <li class="mix color-1 check1 radio2 option3">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                    </div>
                </div>
            </li>
            <li class="mix color-2 check2 radio2 option2">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                </div>
            </li>
            <li class="mix color-2 check2 radio2 option2">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                </div>
            </li>
            <li class="mix color-2 check2 radio2 option2">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                </div>
            </li>
            <li class="mix color-1 check1 radio2 option3">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                    </div>
                </div>
            </li>
            <li class="mix color-2 check2 radio2 option2">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">000</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                </div>
            </li>
            <li class="mix color-2 check2 radio2 option2">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                </div>
            </li>
            <li class="mix color-2 check2 radio2 option2">
                <div class="card-leitmotiv" href="#">
                    <span class="id_card">005</span>
                    <h3 class="title_card">El hombre desciende del moono y el mono suspira aliviado</h3>
                    <span class="cat_card">tragedia</span>
                    <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="">Destrabar descripción 2</span></a>
                </div>
            </li>
       </ul> 
    </section> <!-- cd-gallery -->
 
    <div class="cd-filter">
       <form>
          <div class="cd-filter-block">
             <h4>Block title</h4>
         
             <div class="cd-filter-content">
                <!-- filter content -->
             </div> <!-- cd-filter-content -->
          </div> <!-- cd-filter-block -->
       </form>
 
       <a href="#0" class="cd-close">Cerrar</a>
    </div> <!-- cd-filter -->
 
    <a href="#0" class="cd-filter-trigger">Filtros</a>
 </main>
@endsection

@section('footer')
  @include("fundacion.footer-fundacion")
  <link rel="stylesheet" href="{{url('estilos/front2021/concursos/cuento_corto.css')}}" /> 
  <script src="{{url('js/front2021/concursos/jquery.mixitup.min.js')}}"></script>
  <script src="{{url('js/front2021/concursos/cuento_corto.js')}}"></script>
@endsection