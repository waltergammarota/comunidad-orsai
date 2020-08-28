@extends('orsai-template')

@section('title', 'Areas | Comunidad Orsai')
@section('description','Areas | Comunidad Orsai')


@section('content')
    <section class="contenedor sobre_fundacion">
        @include('fundacion.menu-fundacion',["activo" => "areas"])
        <div class="contenido_menu_lateral_dcha">
            <h1>Fundación Orsai</h1>
            <article id="areas">
                <h2>#Áreas</h2>
                <h3>Área de Educación</h3>
                <p>Es la que nuclea las actividades presenciales, virtuales o semi presenciales de capacitación formal,
                    actualización o promoción vinculadas al desarrollo de la cultura y la comunicación en todas sus
                    formas y en particular al área de las letras, los estudios literarios y lingüísticos en habla
                    hispana, incluidas las becas de formación, el fortalecimiento de las bibliotecas escolares y/o
                    populares y las actividades desarrolladas en instituciones educativas de distintos niveles.</p><br/>
                <h4>Proyectos</h4>
                <ul>
                    <li>Curso intensivo de formación docente (con puntaje).</li>
                    <li>Becas para profesores extranjeros (con jurado abierto).</li>
                    <li>Cursos virtuales de formación docente.</li>
                    <li>Escritores leyendo sus cuentos en escuelas.</li>
                    <li>Congreso virtual de experiencias docentes.</li>
                </ul>
                <br/><br/>
                <h3>Área de Investigación</h3>
                <p>Es la que nuclea las actividades destinadas a desarrollar la investigación sobre cultura y la
                    comunicación en general y las letras, los estudios literarios y lingüísticos en habla hispana, en
                    particular.</p>
                <h4>Proyectos</h4>
                <ul>
                    <li>Convocatoria para financiar proyectos de investigación con jurado abierto.</li>
                    <li>Curso de metodología de investigación.</li>
                    <li>Congreso virtual de investigación.</li>
                    <li>Revista científica digital.</li>
                </ul>
                <br/><br/>
                <h3>Área de Comunidad</h3>
                <p>Es la que nuclea las actividades dirigidas al público en general cuyo objetivo es desarrollar la
                    cultura y la comunicación en todas sus formas y en particular al área de las letras, los estudios
                    literarios y lingüísticos en habla hispana.</p>
                <h4>Proyectos</h4>
                <ul>
                    <li>Concurso de cuentos con jurado abierto.</li>
                    <li>Evento literario “Encuentro Nacional de Escritores”.</li>
                    <li>Revista digital.</li>
                    <li>Librería de escritores vivos.</li>
                    <li>Conferencias y disertaciones.</li>
                </ul>
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
