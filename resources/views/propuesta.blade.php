@extends('orsai-template')

@section('title', 'Propuesta')

@section('content')
    <section id="intro" class="contenedor intro_propuesta">
        <div>
            <h1>{{$propuesta['title']}}</h1>
            <div class="user_prop">
                <div>
                    <div class="gris">
                        <a href="{{url('perfil-usuario/'.$propuesta['owner']['id'])}}">
                            <div class="user_img">
                                @if($user_avatar)
                                    <img
                                        src="{{url('storage/images/'.$user_avatar->name.'.'.$user_avatar->extension)}}" alt="{{ucfirst($propuesta['owner']['name'])}}">
                                @else
                                    <img src="{{url('img/participantes/participante.jpg')}}"
                                         alt="{{ucfirst($propuesta['owner']['name'])}}"/>
                                @endif
                            </div> {{ucfirst($propuesta['owner']['name'])}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contenedor">
        <div class="global_prop">
            <div class="prop_logos">
                <div id="logo_lg">
                    <img
                        src="{{url('storage/logo/'.$propuesta['logos'][0]['name'].".".$propuesta['logos'][0]['extension'])}}"
                        alt="Imagen Logo large">
                </div>
                <div id="logo_sm">
                    @foreach($propuesta['images'] as $key => $image)
                        @if($key > 2)
                            @continue
                        @endif
                        <div>
                            <img
                                src="{{url('storage/images/'.$image['name'].".".$image['extension'])}}"
                                alt="{{$image['name']}} ">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="prop_datos">
                <div class="descripcion">
                    <p> {{$propuesta['description']}}
                        <br>
                    </p>
                    @if(!empty($propuesta['pdfs']))
                    <div id="links_descarga">
                        <div>
                                <a href="{{url('storage/pdf/'.$propuesta['pdfs'][0]['name'].".".$propuesta['pdfs'][0]['extension'])}}" target="_blank" class="subrayado gris">Descargar
                                    PDF</a>
                        </div>
                    </div>
                    @endif
                    @if($propuesta['link'] != "")
                    <div id="links_descarga">
                        <div>
                                <a href="{{$propuesta['link']}}" target="_blank"
                                   class="subrayado gris">Más información</a>
                        </div>
                    </div>
                            @endif
                </div>
                <div id="bt_votar">
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

                </div>
                <div id="prop_info">
                    <div>
                        <div>
                            <div class="prop_info_number">
                                <span class="text_bold"
                                      id="totalVotes">{{$propuesta['votes']}}</span>
                            </div>
                            <div class="prop_info_text">
                                <span class="gris">Fichas:</span>
                                <span id="btn_ver_quien"
                                      class="resaltado_amarillo">Ver</span>

                                <div id="quien_fichas_modal" class="popup">
                                    <div id="quien_fichas">
                                        <div class="contenedor_quien_fichas">
                                            <div class="cerrar">
                                                <span>(X)</span>
                                            </div>
                                            <div class="quien_fichas_header">
                                                <span>Pusieron fichas:</span>
                                            </div>
                                            <div id="content-ltn"
                                                 class="content pusieron_listas">
                                                <ul id="ul_listas">
                                                    @foreach($txs as $tx)
                                                        <li>
                                                            <img
                                                                src="{{url($tx->avatar)}}"
                                                                alt="{{$tx->userName}}">
                                                            <span
                                                                class="nombre_puso">{{$tx->userName}}</span>
                                                            <span
                                                                class="fichas_puso">{{$tx->amount}}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="prop_info_vistos">
                                <span class="gris text_bold">{{$propuesta['views']}} vistos</span>
                            </div>

                        </div>
                    </div>
                    <div>
                        <div>
                            <div class="prop_info_text_share">
                                <span class="gris">Compartir:</span>
                            </div>
                            <div class="prop_info_share">
                                <span
                                    class="twitter subrayado resaltado_amarillo"
                                    title="compartir esta propuesta por Twitter">Twitter</span>
                                <span
                                    class="facebook subrayado resaltado_amarillo"
                                    title="compartir esta propuesta por Facebook">Facebook</span>
                                <span
                                    class="whatsapp_share subrayado resaltado_amarillo"><a
                                        href="whatsapp://send?text=https://orsai.piensamono.com/propuesta.html"
                                        data-action="share/whatsapp/share"
                                        title="compartir esta propuesta por whatsapp">Whatsapp</a></span>
                                <span class="subrayado resaltado_amarillo"><a
                                        href="mailto:?subject=Votá esta propuesta de logo&amp;body=Esta es una propuesta de logo para la Fundación Orsai, Votala.
                                    https://orsai.piensamono.com/propuesta.html"
                                        title="compartir esta propuesta por email">Email</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="line_dashed"></div>
    </section>
    @if(count($related))
        <section class="contenedor otras_prop">
            <div class="titulo">
                <h2>Otras propuestas</h2>
            </div>
            <div class="carrousel_cont_prop">
                <div class="carrousel_prop">
                    <div class="owl-carousel items">
                        @foreach($related as $item)
                            <div class="logo_particantes">
                                <a href="{{url('propuesta/'.$item->id)}}">
                                    <div class="logo_img">
                                        <img
                                            src="{{url('storage/logo/'.$item['logos'][0]['name'].".".$item['logos'][0]['extension'])}}"
                                            alt="{{$item->title}}">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <div class="contenedor">
        <div id="back_listado">
            <a href="{{url('participantes')}}"
               class="subrayado resaltado_amarillo">Volver</a>
        </div>
    </div>

    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>

    <div id="modal_image" class="popup">
        <div class="cerrar">
            <span>(X)</span>
        </div>
        <div id="img_amp">
            <div class="laterales">
                <span class="icon-left"></span>
                <span class="icon-right"></span>
            </div>
            <img src="" alt="">
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
                showAlert("La votación no ha comenzado");
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
    </script>
    <script src="{{url('owlcarousel/js/owl.carousel.js')}}"></script>
    <script src="{{url('custom/jquery.mCustomScrollbar.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel();
        });
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            dots: false,
            autoplay: false,
            autowidth: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    autoplay: true,
                    nav: false,
                    items: 1
                },
                600: {
                    nav: false,
                    items: 2
                },
                768: {
                    nav: true,
                    items: 2
                },
                1000: {
                    items: 5,
                    loop: false,
                    nav: false,
                    mouseDrag: false
                }
            }
        });


        $('.prop_info_share .twitter').click(function (e) {
            e.preventDefault();
            window.open("https://twitter.com/intent/tweet?url=" + escape(window.location.href) + "&text=" + document.title + " Metele fichas", '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
            return false;
        });

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        window.fbAsyncInit = function () {
            FB.init({
                appId: '1985003975066834',
                xfbml: true,
                version: 'v2.5'
            });
        };


        $('.prop_info_share .facebook').click(function (e) {
            e.preventDefault();
            FB.ui({
                method: 'share',
                href: location.href,
            }, function (response) {
            });
        });
    </script>
@endsection
