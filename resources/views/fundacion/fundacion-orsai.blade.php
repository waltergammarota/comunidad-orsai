@extends('orsai-template')


@section('content')
    <section class="contenedor sobre_fundacion">
        @include('fundacion.menu-fundacion',["activo" => "fundacion"])
        <div class="contenido_menu_lateral_dcha">
            <h1>Fundación Orsai</h1>
            <article id="sobrefund">
                <h2>#Sobre la fundación</h2>
                <p>La Fundación Orsai recibe donaciones de la comunidad para premiar proyectos, becar estudiantes y financiar investigaciones sobre una disciplina única: la narrativa <sup class="mouse_over">(1)</sup>, es decir: una apuesta sin fines de lucro para contar mejores historias.</p>
                <div  class="mouse_over_modal">
                    <sup>(1)Relato, novela, dramaturgia, radioteatro, guión de cine e historieta, unipersonal de comedia, crónica periodística, poesía y narrativa online.</sup>
                </div>
                <br/>
                <div class="box_border">
                    <p>Desde 2020, la Fundación Orsai y su comunidad le ponemos fichas a la mejor narrativa en español. Podemos hacerlo porque hace más de quince años que apostamos a contar historias.</p><br/>
                    <a href="{{url('historia')}}" class="resaltado_amarillo">Ir a Historia &raquo;</a>
                </div>
            </article>
        </div>
    </section>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')
    @include("fundacion.footer-fundacion")
@endsection
