@extends('orsai-template')

@section('title', 'Concurso finalizado | Comunidad Orsai')
@section('description', 'Concurso Logo finalizado')
@section('header')
    <link rel="stylesheet" href="{{url('estilos/estilos_conc.css')}}">
@endsection

@section('content')


@endsection

@section('footer')
    <script>
        $(".contenedor_concursos").fadeIn(600).css("display", "inline-block");

        if (document.getElementById("ordenar")) {
            var get_ordenar = document.getElementById("ordenar");
            get_ordenar.onclick = function () {
                var get_icon = get_ordenar.getElementsByClassName("ordenar_bt")[0].getElementsByTagName("span")[0];
                var get_lista_orden = document.getElementsByClassName("buscador_links_filtros")[0].getElementsByTagName("ul")[0];
                if (get_lista_orden.classList.contains("orden_abierto")) {
                    get_icon.classList.remove("icon-angle-up");
                    get_icon.classList.add("icon-angle-down");
                    get_lista_orden.classList.remove("orden_abierto");
                } else {
                    get_icon.classList.remove("icon-angle-down");
                    get_icon.classList.add("icon-angle-up");
                    get_lista_orden.classList.add("orden_abierto");
                }
            }
        }

        function goTo(location, filtro) {
            let busqueda = "";
            if (filtro != null && filtro != "") {
                busqueda = `&busqueda=${filtro}`
            }
            window.location = `{{url('concursos?filtro=')}}${location}${busqueda}`;
        }
    </script>
@endsection
