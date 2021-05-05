@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')

@section('header')
    <link rel="stylesheet" href="{{url('js/front2021/mCustomScrollbar/jquery.mCustomScrollbar.css')}}">
@endsection

@section('content')

    <div id="mv_apostar" class="cont_mobile_apostar">

        <aside id="md_apostar" class="modulo_apostar_cuento">
            <div class="cerrar">
                <span class="icon icon-cancel-circle"></span>
            </div>
            <div class="titulo">
                <p>Recuerda que este concurso permite un máximo de <strong
                        class="color_amarillo">{{$currentRonda->cost}} fichas por
                        postulación.</strong></p>
            </div>
            @include('concursos.fichas-apostadas')
        </aside>
    </div>

    <section class="resaltado_gris pd_20 pd_20_tp_bt ">

        @if($isJuradoVip)
            <div id="mv_mobile_pro" class="cont_mobile_pro">
                <aside id="md_pro" class="modulo_pro">
                    <div class="pro_star abierto">
                        <img src="{{url('estilos/front2021/assets/svg/estrella.svg')}}" alt="">
                        <span class="icon icon-down-open"></span>
                    </div>
                    <div class="_autor">
                        <div class="img_autor">
                            <img src="{{$avatar}}" alt="">
                        </div>
                        <div class="datos_autor">
                            <span class="text_medium">Autor</span>
                            <span>{{$author->name}} {{$author->lastName}}</span>
                        </div>
                    </div>
                    <div class="numeros_">
                        <div>
                            <span class="_barlow_text">{{$cpa->views}}</span>
                            <span class="_barlow_text">Visualizaciones</span>
                        </div>
                        <div>
                            <span class="_barlow_text">{{$cpa->getTotalVotes()}}</span>
                            <span class="_barlow_text">Fichas</span>
                        </div>
                    </div>
                    <!-- Meter la lista de apostadores                                     -->
                    <div id="quien_fichas_modal" class="popup">
                        <div id="quien_fichas">
                            <div class="contenedor_quien_fichas ">
                                <div class="header_lista">
                                    <ul>
                                        <li>
                                            <span class="text_medium">Apostador</span>
                                            <span class="text_medium">Fichas</span>
                                        </li>
                                    </ul>
                                </div>
                                <div id="content-ltn" class="content pusieron_listas">
                                    <ul id="ul_listas">
                                        @foreach($txs as $tx)
                                            <li>
                                                <span
                                                    class="nombre_puso">{{$tx->getFromUser->name}} {{$tx->getFromUser->lastName}}</span>
                                                <span class="fichas_puso"><span
                                                        class="icon-ficha"></span> {{$tx->amount}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        @endif



        <div class="contenedor cuento_">
            
            <article class="cuento_texto">
                <div class="cuerpo_interna">
                    <div class="blog_social">
                        <span class="numero _barlow_text">{{str_pad($cpa->order,3, 0,STR_PAD_LEFT)}}</span>
                        <h1 class="titulo_blog">{{$cpa->getAnswerByRonda($currentRonda->order, 0)}}</h1>
                    </div>

                    <div class="blog_texto">
                        <p>{{$cpa->getAnswerByRonda($currentRonda->order, 1)}}</p>
                    </div>
                </div>
                <div class="grilla_form">
                    <div class="form_ctrl col_3">
                        <div class="align_left">
                            <a href="{{$backUrl}}"
                               class="boton_redondeado btn_transparente_negro pd_50_lf_rg">Volver</a>
                        </div>
                    </div>
                </div>
            </article>

            <article id="md_laterales" class="modulos_laterales"> 
                <aside class="modulo_texto">
                    @foreach($cpa->answers as $key => $answer)
                        @if($key < 3)
                            <div class="leit_motive">
                                <span class="text_bold">{{$answer->input->title}}</span>
                                <span>{!!  $answer->input->toUserHtml($answer) !!}</span>
                            </div>
                        @endif
                    @endforeach
                </aside>
            </article>

            <div class="grilla_form fuera_texto">
                <div class="form_ctrl col_3">
                    <div class="align_left">
                        <a href="#" class="boton_redondeado btn_transparente_negro pd_50_lf_rg">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include("fundacion.footer-fundacion")
    <script src="{{url('js/front2021/mCustomScrollbar/jquery.mCustomScrollbar.js')}}"></script>
    <script>
        let _contador = 1;

        function apostar() {
            const cap_id = {{$cpa->id}};
            const rondaOrder = 3;
            const amount = $(".modulos_laterales .fichin.activo").length;
            votar(cap_id, rondaOrder, amount);

        }

        function votar(cap_id, rondaOrder, amount) {
            axios.post('{{url('votar')}}', {
                cap_id: cap_id,
                amount: amount,
                rondaOrder: rondaOrder
            }).then(response => {
                if (response.data.result.cap_id == {{$currentRonda->cost}}) {
                    $(".modulos_laterales .selecc_fichas p").text("Ya apostaste el máximo de fichas");
                    $('.form_ctrl').hide();
                } else {
                    $(".modulos_laterales .selecc_fichas p").text("Ponele fichas");
                }
                console.log(response.data)
            }).catch(error => {
                console.log(error);
                if (error.response.data.error == 100) {
                    $("#ex2").show();
                }
            });
        }

        /* Efecto hover en fichas */
        $(".fichin")
            .mouseenter(function () {
                var indice_ = $(".fichin").index(this);

                for (var x = 0; x <= indice_; x++) {
                    $(".fichin").eq(x).css("backgroundColor", "#ffe600");

                }
            })
            .mouseleave(function () {
                var indice_ = $(".fichin").index(this);
                for (var x = 0; x <= indice_; x++) {
                    if (!$(".fichin").eq(x).hasClass("activo")) {
                        if (!$(".fichin").eq(x).hasClass("apostado")) {
                            $(".fichin").eq(x).css("backgroundColor", "");
                        }
                    }

                }
            });

        /*Agregar o quitar fichas Si el usuario ya agrego con anteriorida van con la clase apostadas*/
        $(".fichin").on("click", function () {
            var indice_click_ = $(".fichin").index(this);
            $(".fichin.activo").css("backgroundColor", "");

            if ($(this).hasClass("activo")) {
                var cant_fichas_apostar = $(".fichin.activo").length
                $(".fichin.activo").removeClass("activo");
                for (var x = 0; x < $(".fichin").length; x++) {
                    if (!$(".fichin").eq(x).hasClass("apostado") && _contador < cant_fichas_apostar) {
                        $(".fichin").eq(x).addClass("activo");
                        _contador++;
                    }
                }
            } else {
                for (var x = 0; x <= indice_click_; x++) {
                    if (!$(".fichin").eq(x).hasClass("apostado")) {
                        $(".fichin").eq(x).addClass("activo");
                    }
                }

            }
            if ($(".fichin").hasClass("activo")) {
                $(".modulo_apostar_cuento .form_ctrl button").attr("disabled", false);
            } else {
                $(".modulo_apostar_cuento .form_ctrl button").attr("disabled", true);
            }

            if (window.matchMedia("(max-width: 992px)").matches) {
                var cantidad = $(".cont_mobile_apostar .fichin.activo").length;
                $(".cont_mobile_apostar .selecc_fichas p").text("Vas a sumar " + cantidad + " fichas");
                $(".cont_mobile_apostar .modulo_apostar_cuento").css("max-height", "600px");
                $(".cont_mobile_apostar .modulo_apostar_cuento .titulo").css("display", "block");
                $(".cont_mobile_apostar .cerrar").css("display", "block");
                $(".cont_mobile_apostar .cerrar").css("display", "block");
                $(".cont_mobile_apostar .form_ctrl").css("display", "block");
                $(".cont_mobile_apostar .modulo_apostar_cuento .selecc_fichas p").css("display", "block");
            } else {
                var cantidad = $(".modulos_laterales .fichin.activo").length;
                $(".modulos_laterales .selecc_fichas p").text("Vas a sumar " + cantidad + " fichas");
            }
        });

        /*Evita avanzar si el usuario no realiza una nueva apuesta*/


        $(".modulo_apostar_cuento .form_ctrl a").on("click", function (e) {
            if (!$(".fichin").hasClass("activo")) {
                e.preventDefault();
            }
        })

        // /*Agregar o quitar fichas Si el usuario ya agrego con anteriorida van con la clase apostadas*/
        // $(".fichin").each(function (index) {
        // if (($(".card_rn_3").eq(index).find(".fichin.apostado").length) + ($(".card_rn_3").eq(index).find(".fichin.activo").length) == 5) {
        //     $(".card_rn_3").eq(index).find(".selecc_fichas").addClass("max_apostado");
        //     $(".card_rn_3").eq(index).find(".selecc_fichas p").text("Ya apostaste el máximo de fichas");
        // }
        // });

        /*Abre y cierra desplegables en mobile de fichas y modulo pro*/
        $(".cont_mobile_apostar .cerrar").on("click", function () {

            $(".cont_mobile_apostar .modulo_apostar_cuento").css("max-height", "80px");
            setTimeout(function () {
                $(".cont_mobile_apostar .modulo_apostar_cuento .titulo").css("display", "none");
                $(".cont_mobile_apostar .cerrar").css("display", "none");
                $(".cont_mobile_apostar .modulo_apostar_cuento .selecc_fichas p").css("display", "none");
                $(".cont_mobile_apostar .fichin.activo").css("backgroundColor", "");
                $(".cont_mobile_apostar .fichin.activo").removeClass("activo");
                $(".cont_mobile_apostar .selecc_fichas p").text("Ponele fichas");
                $(".cont_mobile_apostar .form_ctrl").css("display", "none");
            }, 300);

        });

        $(".cont_mobile_pro .modulo_pro .pro_star").on("click", function () {

            if ($("#mv_mobile_pro .modulo_pro .pro_star").hasClass("abierto")) {
                $("#mv_mobile_pro .modulo_pro").css("max-height", "70px");
                $(".cont_mobile_pro .modulo_pro .pro_star .icon").removeClass("icon-up-open").addClass("icon-down-open");

                $(".cont_mobile_pro .modulo_pro .pro_star").removeClass("abierto");
                $(".cont_mobile_pro .modulo_pro .pro_star").addClass("cerrado");
            } else if ($("#mv_mobile_pro .modulo_pro .pro_star").hasClass("cerrado")) {
                $(".cont_mobile_pro .modulo_pro").css("max-height", "700px")
                $(".cont_mobile_pro .modulo_pro .pro_star .icon").removeClass("icon-down-open").addClass("icon-up-open");
                $(".cont_mobile_pro .modulo_pro .pro_star").removeClass("cerrado");
                $(".cont_mobile_pro .modulo_pro .pro_star").addClass("abierto");

            }
        });


        /*Mueve elementos nativos en mobile de apuesta de fichas y modulo pro al lateral*/
        $(window).resize(function () {
            if (window.matchMedia("(max-width: 992px)").matches) {

                if (!$("#mv_mobile_pro").find("#md_pro").length > 0) {
                    $("#mv_mobile_pro").append($("#md_pro"));
                }
                if (!$("#mv_apostar").find("#md_apostar").length > 0) {
                    $("#mv_apostar").append($("#md_apostar"));
                    $("#md_apostar.modulo_apostar_cuento").css("max-height", "80px");
                }
            } else {
                if ($("#mv_mobile_pro").find("#md_pro").length > 0) {
                    $("#md_laterales").prepend($("#md_pro"));
                    $("#md_laterales .modulo_pro").css("max-height", "none");
                }
                if ($("#mv_apostar").find("#md_apostar").length > 0) {
                    $("#md_laterales").prepend($("#md_apostar"));
                    $("#md_laterales .modulo_apostar_cuento").css("max-height", "none");
                }

            }
        });
        if (window.matchMedia("(max-width: 992px)").matches) {
            if (!$("#mv_mobile_pro").find("#md_pro").length > 0) {
                $("#mv_mobile_pro").append($("#md_pro"));
            }
            if (!$("#mv_apostar").find("#md_apostar").length > 0) {
                $("#mv_apostar").append($("#md_apostar"));
                $("#md_apostar.modulo_apostar_cuento").css("max-height", "80px");
            }
        } else {

            if ($("#mv_apostar").find("#md_apostar").length > 0) {
                $("#md_laterales").prepend($("#md_apostar"));
                $("#md_laterales .modulo_apostar_cuento").css("max-height", "none");
            }
            if ($("#mv_mobile_pro").find("#md_pro").length > 0) {
                $("#md_laterales").prepend($("#md_pro"));
                $("#md_laterales .modulo_pro").css("max-height", "none");
            }
        }
        ;
    </script>
@endsection
