@extends('orsai-template')

≈


@section('content')
    <section class="contenedor sobre_fundacion">
        @include('fundacion.menu-fundacion',["activo" => "consejo"])
        <div class="contenido_menu_lateral_dcha">
            <h1>Fundación Orsai</h1>
            <article id="consejo">
                <h2>#Consejo Directivo</h2>
                <p>El Consejo de la Fundación está integrado por cinco miembros: Presidente, Secretario, Tesorero y dos Consejeros.<br/><br/> En cada reunión del Consejo uno de sus integrantes propone iniciativas denominadas &laquo;Proyectos&raquo; que, en caso de resultar autorizadas, contarán con un responsable y objetivos definidos. Desde ese momento estarán bajo la supervisión directa del Director de Área con la que se corresponda la actividad. <br/><br/>El Consejo autorizará &laquo;Proyectos&raquo; siempre y cuando se enmarquen en una de las tres áreas de su competencia: educación, investigación o comunidad.</p>
            </article>
        </div>
    </section>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
    </div>
    <div class="icono_up">
        <span class="icon-angle-up"></span>
    </div>
@endsection

@section('footer')
    @include("fundacion.footer-fundacion")
@endsection
