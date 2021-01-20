@extends('orsai-template')

@section('title', 'Postulación | Comunidad Orsai')
@section('description', 'Postulación')

@section('header')
    <link rel="stylesheet" href="{{url('estilos/estilos_conc.css')}}">
    <link rel="stylesheet" href="{{url('fontello_new/css/fontello.css')}}">
@endsection

@section('content')
    <div class="fondo_blanco sin_overflow">
        <div class="contenedor grilla_texto postulacion_larga">
            <section id="intro" class=" intro_gral  indice_contenidos">
                <div class="portada_concurso">
                    @if($logo)
                        <img src="{{url('storage/images/'.$logo->name.".".$logo->extension)}}" alt="">
                    @else
                        // TODO CAMBIAR IMAGEN DEFAULT DE CONCURSO
                        <img src="https://comunidadorsai.org/storage/images/15fc7e28ea8b2c.png" alt="">
                    @endif
                </div>
                <div class="participante">
                    <div class="avatar">
                        <div class="img_perfil">
                            <div class="cont_img">
                                @if($user_avatar)
                                    <img
                                        src="{{url('storage/images/'.$user_avatar->name.'.'.$user_avatar->extension)}}"
                                        alt="{{ucfirst($propuesta['owner']['name'])}}">
                                @else
                                    <img src="{{url('img/participantes/participante.jpg')}}"
                                         alt="{{ucfirst($propuesta['owner']['name'])}}"/>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="intro_datos_perfil">
                        <p class="titulo">{{ucfirst($propuesta['owner']['name'])}}</p>
                        <a href="{{url('perfil-usuario/'.$propuesta['owner']['id'])}}"
                           class="boton_redondeado resaltado_amarillo align_left">Ver perfil</a>
                    </div>
                    <div class="apostar">
                        <div class="icono resaltado_amarillo">
                            <span class="icon-ficha"></span>
                        </div>
                        <p class="titulo"><strong>{{$propuesta['votes']}}</strong> Fichas</p>
                    </div>
                </div>
                <div class="miga_orsai">
                    <a href="{{url('propuesta/'.$propuesta['id'])}}" class="text_bold"><span
                            class="icon-angle-double-right"></span>Volver a detalle de postulación</a>
                </div>
                <div class="titulo">
                    <h1 class="span_h1">{{$propuesta['title']}}</h1>
                </div>
                <div id="bt_votar_2">
                    @if($canVote)
                        <form action="{{url('votar')}}" method="POST" id="form_votacion">
                            <input type="hidden" name="cap_id"
                                   value="{{$propuesta['id']}}"/>
                            @csrf
                            <div class="quantity">
                                <input type="number" min="50" max="450" step="50"
                                       value="50" name="vote" id="voteAmount" onchange="controlVoteInput(this);false;">
                            </div>
                            <div id="bt_form_votar">
                            <span
                                class="resaltado_amarillo subrayado text_bold">Poner fichas</span>
                            </div>
                        </form>
                        <div id="pusiste_fichas" class="resaltado_gris"><span
                                class="text_bold subrayado">Ya pusiste fichas</span><span class="icon-o"></span></div>
                    @endif
                </div>
                <div class="blog_social_concurso">
                    <div class="share_redes_gral">
                        <div class="resaltado_gris">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->full()}}"
                               title="Compartir novedad"
                               target="_blank"
                               onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"
                               rel="noopener noreferrer"><span class="icono icon-fb"></span></a>
                        </div>
                        <div class="resaltado_gris">
                            <a href="https://twitter.com/intent/tweet?text={{$propuesta['title']}}&amp;url={{url()->full()}}&amp;lang=es"
                               title="Twittear novedad"
                               onclick="window.open(this.href, this.target, 'width=400,height=300'); return false;"
                               rel="noopener noreferrer"><span class="icono icon-tw"></span></a>
                        </div>
                        <div class="resaltado_gris">
                            <a href="whatsapp://send?text={{$propuesta['title']}} – {{url()->full()}}"
                               data-action="share/whatsapp/share" title="Compartir novedad"
                               rel="noopener noreferrer"><span class="icono icon-whatsapp"></span></a>
                        </div>
                    </div>
                </div>
                <div class="navegador_contenidos">
                    <div class="buscador_capitulos">

                        <div id="ordenar" class="titulo">
                                <span class="ordenar_bt">Tabla de Contenidos <span
                                        class="icon-angle-down "></span></span>
                        </div>
                        <ul class="">
                            @foreach($capitulos as $capitulo)
                                @if($concurso->type == 1)
                                    <li id="">
                                        <a href="#capitulo_{{$capitulo->orden}}" rel="noopener noreferrer">Cuento
                                            corto</a>
                                    </li>
                                @else
                                    <li id="">
                                        <a href="#capitulo_{{$capitulo->orden}}"
                                           rel="noopener noreferrer">Capítulo {{$capitulo->orden}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @foreach($capitulos as $capitulo)
                    <div class="capitulos" id="capitulo_{{$capitulo->orden}}">
                        @if($concurso->type == 1)
                            <span class="numero_capitulo">Cuento corto</span>
                        @else
                            <span class="numero_capitulo">Capítulo {{$capitulo->orden}}</span>
                        @endif
                        <h2 class="subtitulo">{{$capitulo->title}}</h2>
                        <p class="texto">{!! $capitulo->body !!}</p>
                    </div>
                @endforeach
            </section>

        </div>
    </div>
    <div id="err_msg" class="popup">
        <div>
            <div id="texto_err">
                <span>No te alcanzan las fichas</span>
            </div>
            <div class="cerrar" id="closeModal">
                <span
                    class="subrayado text_bold resaltado_amarillo">Cerrar</span>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        function controlVoteInput(elem) {
            if (elem.value < 50) {
                showAlert("La cantidad es incorrecta.  El mínimo es 50 y el máximo 450 por propuesta");
                elem.value = 50;
            }
            if (elem.value > 450) {
                showAlert("La cantidad es incorrecta.  El mínimo es 50 y el máximo 450 por propuesta");
                elem.value = 450;
            }

        }

        function stopVoting() {
            $('#pusiste_fichas').show();
            $('#form_votacion').hide();
        }

        $("#closeModal").click(() => {
            $("#err_msg").hide();
        })

        function showAlert(message) {
            $("#texto_err").empty();
            $("#texto_err").append(`<span>${message}</span>`);
            $("#err_msg").show();
            setTimeout(() => {
                $("#err_msg").hide();
            }, 5000)
        }

        $("#bt_form_votar").click(event => {
            event.preventDefault();
            axios.post('{{url('votar')}}', {
                cap_id: '{{$propuesta['id']}}',
                amount: $("#voteAmount").val()
            }).then(response => {
                const data = response.data.totalVotes;
                if (data.success) {
                    showAlert("Gracias por votar");
                    window.location.reload();
                } else {
                    console.log(data);
                    if (data.available == 0) {
                        showAlert("Llegaste al límite de votaciones por propuesta");
                    } else if (data.balance == 0) {
                        showAlert("No te alcanzan las fichas");
                    } else {
                        showAlert("La cantidad es incorrecta.  El mínimo es 50 y el máximo 450 por propuesta");
                    }
                }
                $("#totalVotes").empty().append(data.totalVotes);
            }).catch(error => {
                console.log(error);
                showAlert(error.response.data.message);
            });
        });

        $("#form_votacion").submit(function (event) {
            event.preventDefault();
        });

        const votarCall = async () => {
            const amount = $("#voteAmount").val();
            const response = await axios.post('{{url('votar')}}', {
                cap_id: '{{$propuesta['id']}}',
                amount: amount
            });
            $("#totalVotes").empty().append(response.data.totalVotes);
        };


        $('a[href*="#"]').on('click', function (e) {
            e.preventDefault()

            $('html, body').animate(
                {
                    scrollTop: $($(this).attr('href')).offset().top - 200,
                },
                500,
                'linear'
            )
        })


        if (document.getElementById("ordenar")) {
            var get_ordenar = document.getElementById("ordenar");
            get_ordenar.onclick = function () {
                var get_icon = get_ordenar.getElementsByClassName("ordenar_bt")[0].getElementsByTagName("span")[0];
                var get_lista_orden = document.getElementsByClassName("buscador_capitulos")[0].getElementsByTagName("ul")[0];
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

        if (document.getElementById("bt_votar_2")) {
            jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up icon-angle-up"></div><div class="quantity-button quantity-down icon-angle-down"></div></div>').insertAfter('.quantity input');
            const step = 50;
            jQuery('.quantity').each(function () {
                var spinner = jQuery(this),
                    input = spinner.find('input[type="number"]'),
                    btnUp = spinner.find('.quantity-up'),
                    btnDown = spinner.find('.quantity-down'),
                    min = input.attr('min'),
                    max = input.attr('max');
                btnUp.click(function () {
                    var oldValue = parseFloat(input.val());
                    if (oldValue >= max) {
                        var newVal = oldValue;
                    } else {
                        var newVal = oldValue + step;
                    }
                    if (newVal < 50) {
                        newVal = 50;
                    }
                    if (newVal > 450) {
                        newVal = 450;
                    }
                    spinner.find("input").val(newVal);
                    spinner.find("input").trigger("change");
                });
                btnDown.click(function () {
                    var oldValue = parseFloat(input.val());
                    if (oldValue <= min) {
                        var newVal = oldValue;
                    } else {
                        var newVal = oldValue - step;
                    }
                    if (newVal < 50) {
                        newVal = 50;
                    }
                    if (newVal > 450) {
                        newVal = 450;
                    }
                    spinner.find("input").val(newVal);
                    spinner.find("input").trigger("change");
                });
            });
        }

        $('.icono_up').click(function () {
            $("html, body").animate({scrollTop: 0}, 1000);
            return false;
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 300) {
                $(".icono_up").fadeIn();
            } else {
                $(".icono_up").fadeOut();
            }
            if ($(window).width() > 991) {
                if ($(this).scrollTop() > 140) {
                    $('.menu_lateral_izq ul').addClass('fixed');
                } else {
                    $('.menu_lateral_izq ul').removeClass('fixed');
                }
            }

        });


    </script>
@endsection
