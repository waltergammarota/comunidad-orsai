@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')

@section('content')
    @include('concursos.concurso-header')
    <section class="pd_20_">
        <div class="contenedor titulo_leit_motivs">
            <div class="cont_card_leitmotiv_">
            @foreach($cpas as $cpa)
                <!-- Card -->
                    <div class="card_leitmotiv_{{$currentRonda->order}}">
                        <div
                            class="card-leitmotiv__ @if($cpa->hasBeenVoted) card-leitmotiv-animate color-1 @endif"
                            href="#">
                            <span class="id_card">{{str_pad($cpa->order, 3, 0 ,STR_PAD_LEFT)}}</span>
                            @foreach($currentRonda->inputs as $key => $input)
                                @if($key == 0)
                                    <h3 class="title_card">{{$cpa->getAnswerByRonda($currentRonda->order, $key)}}</h3>
                                @else
                                    <span
                                        class="cat_card">{{$cpa->getAnswerByRonda($currentRonda->order, $key)}}</span>
                            @endif
                        @endforeach
                        <!-- <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="desc_boton">Destrabar cuento completo</span><span class="cant_fichas"><span class="icon icon_flip icon-ficha"></span><span class="icon icon-ficha"></span> <span class="num_fichas">2</span></span></a> -->
                            <div class="button_card">
                                <a href="#"
                                   class="tip-button boton_redondeado resaltado_amarillo width_100 @if($cpa->hasBeenVoted) button_card-animate clicked shrink-landing coin-landed @endif"
                                   data-cap_id="{{$cpa->id}}">
                                    @if($cpa->hasBeenVoted)
                                        <span class="tip-button__text">Destrabar cuento completo</span>
                                        <span class="icon icon-flecha_leitmotiv"></span>
                                    @else
                                        <span class="tip-button__text">Leer descripción</span>
                                    @endif
                                    <span class="icon"></span>
                                    <div class="coin-wrapper">
                                        <div class="coin">
                                            <div class="coin__middle"></div>
                                            <div class="coin__back"></div>
                                            <div class="coin__front"></div>
                                        </div>
                                    </div>
                                    <span class="num_coins">{{$currentRonda->cost}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    </main>

    <!-- Ventanas modales -->

    <div id="ex1" class="modal">
        <div class="modal_flex">
            <div>
                <img src="src/assets/svg/modal_star.svg" alt="">
            </div>
            <div>
                <p><strong>¡Convertite en Jurado VIP!</strong> <br/>
                    Te faltan apostar [50 fichas] para ver las estadísticas del concurso.</p>
            </div>
        </div>
        <div class="form_ctrl input_">
            <div class="align_center">
                <a href="#" class="boton_redondeado resaltado_amarillo width_100" rel="modal:close">Seguir apostando</a>
            </div>
        </div>
    </div>


    <div id="ex2" class="modal">
        <div class="modal_flex">
            <div>
                <img src="src/assets/svg/modal_exc.svg" alt="">
            </div>
            <div>
                <p><strong>No te alcanzan las fichas.</strong></br>
                    Hacé una donación para seguir.</p>
            </div>
        </div>

        <div class="form_ctrl input_">
            <div class="align_center">
                <a href="{{url('donar')}}" class="boton_redondeado resaltado_amarillo width_100">Donar</a>
            </div>
        </div>
        <div class="form_ctrl input_">
            <div class="align_center">
                <a href="#" id="custom-close" class="pd_25_lf_rg subrayado" rel="modal:close">Ahora no</a>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include("fundacion.footer-fundacion")
    <script>

        function showModalJuradoVip() {
            $('#ex1').show();
        }

        function filtrar() {
            const url = '{{$baseUrl}}';
            const busqueda = $('#busqueda').val();
            const wordDestrabados = 'Destrabados';
            const filteredTags = tags.filter(item => item != wordDestrabados)
            const destrabados = tags.includes(wordDestrabados);
            const params = new URLSearchParams({
                busqueda: busqueda,
                etiquetas: filteredTags.join(';'),
                destrabados: destrabados
            });
            location.href = `${url}?${params}`;
        }

        $('#form_filtro').on('keyup keypress', function (e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                filtrar();
                return false;
            }
        });

        /* Submenu de busqueda */
        $("#form_filtro .icon-cancel").on("click", function () {
            $("#form_filtro").removeClass("abierto");
        })
        $("#open_menu").on("click", function () {
            if ($("#form_filtro").hasClass("abierto")) {
                $("#form_filtro").removeClass("abierto");
            } else {
                $("#form_filtro").addClass("abierto");
            }
        })
        const tagContainer = document.querySelector('.tag-container');
        const input = document.querySelector('input');
        const input_check = document.querySelectorAll('.check_cond');
        const select = document.querySelector('#categorias');
        let tags = [];

        function createTag(label) {
            const div = document.createElement('div');
            div.setAttribute('class', 'tag');
            const span = document.createElement('span');
            span.innerHTML = label;
            const closeIcon = document.createElement('i');
            closeIcon.innerHTML = 'cancel';
            closeIcon.setAttribute('class', 'material-icons');
            closeIcon.setAttribute('data-item', label);
            div.appendChild(span);
            div.appendChild(closeIcon);
            return div;
        }

        function clearTags() {
            document.querySelectorAll('.tag').forEach(tag => {
                tag.parentElement.removeChild(tag);
            });
        }

        function addTags() {
            clearTags();
            tags.slice().reverse().forEach(tag => {
                tagContainer.prepend(createTag(tag));
            });
        }

        select.addEventListener('change', (e) => {
            const consulta_tag = e.target.value;
            console.log(tags.indexOf(consulta_tag));
            if (tags.indexOf(consulta_tag) == -1) {
                if (e.target.value != 0) {
                    tags.push(e.target.value);
                    addTags();
                }
            }
        });

        for (var x = 0; x < input_check.length; x++) {
            input_check[x].addEventListener('change', (e) => {
                e.preventDefault();
                if (e.target.checked == true) {
                    e.target.value.split(',').forEach(tag => {
                        tags.push(tag);
                    });
                    addTags();
                } else {
                    const tagLabel = e.target.value;
                    const index = tags.indexOf(tagLabel);
                    tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
                    addTags();
                }
            });
        }

        document.addEventListener('click', (e) => {
            if (e.target.tagName === 'I') {
                const tagLabel = e.target.getAttribute('data-item');
                const index = tags.indexOf(tagLabel);
                tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
                addTags();
            }
        })

        input.focus();


        /*Agrega el click a las solapas a medida que se van desbloqueando funcion*/
        function add_click(x) {
            $(x).not(".cd-filters li.bloqued a").on("click", function () {
                if (!$(this).hasClass("selected")) {
                    $(".cd-filters li a.selected").find(".icon").removeClass("icon-carpeta_abierta").addClass("icon-carpeta_cerrada");

                    $(".cd-filters li a.selected").removeClass("selected");

                    $(this).addClass("selected");
                    $(this).find(".icon").addClass("icon-carpeta_abierta");
                    if ($(this).data('type') === "all") {
                        $(".cd-gallery li").fadeIn(100, "swing");
                    } else {
                        var variable = "." + $(this).data('type');
                        $(".cd-gallery li" + variable).fadeIn(100, "swing");
                        $(".cd-gallery li").not(variable).fadeOut();

                    }
                }
            });
        }

        add_click(".cd-filters li a");

        // Boton de tarjeta
        $('.button_card a').on('click', function (e) {

            const rondaOrder = {{$currentRonda->order}};
            const amount = {{$currentRonda->cost}};
            const cap_id = $(this).data('cap_id');
            votar(cap_id, rondaOrder, amount, e, $(this));
        });

        function changeCardState(e, element) {
            if (!element.hasClass("clicked")) {
                e.preventDefault();
                element.attr("href", {{$currentRonda->order + 1}})
            }
            element.find(".tip-button__text").text("Leer descripción");
            element.find(".num_fichas").text("");
            element.find(".icon").not(".icon_flip").addClass("icon-flecha_leitmotiv");
            element.find(".num_coins").css("display", "none");

            element.parent().parent().addClass("card-leitmotiv-animate");
            if (element.parent().parent($(".cd-gallery li.color-1")) && $(this).parent().parent($(".cd-gallery li.color-1"))) {
                element.parent().parent().addClass("color-1")
            }

            element.addClass("button_card-animate");

            element.animate({
                left: "+=50"
            }, 5, function () {
            });

        }


        function votar(cap_id, rondaOrder, amount, event, element) {
            axios.post('{{url('votar')}}', {
                cap_id: cap_id,
                amount: amount,
                rondaOrder: rondaOrder
            }).then(response => {
                changeCardState(event, element);
                console.log(response.data)
            }).catch(error => {
                console.log(error);
                if (error.response.data.error == 100) {
                    $("#ex2").show();
                }
            });
        }


        //Animacion de boton ficha
        const tip_Buttons = document.querySelectorAll('.button_card')
        tip_Buttons.forEach((button) => {
            button.addEventListener('click', () => {
                if (button.clicked) return
// button.find(".tip-button").classList.add('clicked')
            })
        })

        $('.btn-postulacion').on('click', function (e) {

            /*Si se hace por php cambiar link */

            if (!$(this).parent().hasClass(".bloqued .btn-postulacion")) {
                e.preventDefault();
            }
        });


        $(".desp_mobile_tab .tabs_cli").on("click", function () {

            if ($(".desp_mobile_tab .tabs_cli").hasClass("icon-angle-down")) {
                $(".cd-tab-filter ul.cd-filters").css("maxHeight", "450px");
                $(".desp_mobile_tab .tabs_cli").removeClass("icon-angle-down");
                $(".desp_mobile_tab .tabs_cli").addClass("icon-angle-up");
            } else {
                $(".cd-tab-filter ul.cd-filters").css("maxHeight", "60px");
                $(".desp_mobile_tab .tabs_cli").removeClass("icon-angle-up");
                $(".desp_mobile_tab .tabs_cli").addClass("icon-angle-down");
            }
        });


        $(".hero-nav-content").owlCarousel({
            responsiveClass: true,
            dots: false,
            navText: ["<i class='icon-left_arrow'></i>", "<i class='icon-right_arrow'></i>"],
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    loop: true
                },
                1100: {
                    items: 5,
                    nav: false,
                    loop: false,
                    mouseDrag: false,
                    autoWidth: true
                }
            }
        });
        if (window.matchMedia("(max-width: 1100px)").matches) {
            $('.hero-nav-content').owlCarousel('remove', 4).owlCarousel('update');
        }
    </script>

    <script>
        const tipButtons = document.querySelectorAll('.tip-button')

        // Loop through all buttons (allows for multiple buttons on page)
        tipButtons.forEach((button) => {
            let coin = button.querySelector('.coin')

// The larger the number, the slower the animation
            coin.maxMoveLoopCount = 90

            button.addEventListener('click', () => {
                if (button.clicked) return

                button.classList.add('clicked')

// Wait to start flipping the coin because of the button tilt animation
                setTimeout(() => {
// Randomize the flipping speeds just for fun
                    coin.sideRotationCount = Math.floor(Math.random() * 5) * 90
                    coin.maxFlipAngle = (Math.floor(Math.random() * 4) + 3) * Math.PI
                    button.clicked = true
                    flipCoin()
                }, 50)
            })

            const flipCoin = () => {
                coin.moveLoopCount = 0
                flipCoinLoop()
            }

            const resetCoin = () => {
                coin.style.setProperty('--coin-x-multiplier', 0)
                coin.style.setProperty('--coin-scale-multiplier', 0)
                coin.style.setProperty('--coin-rotation-multiplier', 0)
                coin.style.setProperty('--shine-opacity-multiplier', 0.4)
                coin.style.setProperty('--shine-bg-multiplier', '50%')
                coin.style.setProperty('opacity', 1)
// Delay to give the reset animation some time before you can click again
                setTimeout(() => {
                    button.clicked = false
                }, 300)
            }

            const flipCoinLoop = () => {
                coin.moveLoopCount++
                let percentageCompleted = coin.moveLoopCount / coin.maxMoveLoopCount
                coin.angle = -coin.maxFlipAngle * Math.pow((percentageCompleted - 1), 2) + coin.maxFlipAngle

// Calculate the scale and position of the coin moving through the air
                coin.style.setProperty('--coin-y-multiplier', -11 * Math.pow(percentageCompleted * 2 - 1, 4) + 11)
                coin.style.setProperty('--coin-x-multiplier', percentageCompleted)
                coin.style.setProperty('--coin-scale-multiplier', percentageCompleted * 0.6)
                coin.style.setProperty('--coin-rotation-multiplier', percentageCompleted * coin.sideRotationCount)

// Calculate the scale and position values for the different coin faces
// The math uses sin/cos wave functions to similate the circular motion of 3D spin
                coin.style.setProperty('--front-scale-multiplier', Math.max(Math.cos(coin.angle), 0))
                coin.style.setProperty('--front-y-multiplier', Math.sin(coin.angle))

                coin.style.setProperty('--middle-scale-multiplier', Math.abs(Math.cos(coin.angle), 0))
                coin.style.setProperty('--middle-y-multiplier', Math.cos((coin.angle + Math.PI / 2) % Math.PI))

                coin.style.setProperty('--back-scale-multiplier', Math.max(Math.cos(coin.angle - Math.PI), 0))
                coin.style.setProperty('--back-y-multiplier', Math.sin(coin.angle - Math.PI))

                coin.style.setProperty('--shine-opacity-multiplier', 4 * Math.sin((coin.angle + Math.PI / 2) % Math.PI) - 3.2)
                coin.style.setProperty('--shine-bg-multiplier', -40 * (Math.cos((coin.angle + Math.PI / 2) % Math.PI) - 0.5) + '%')

// Repeat animation loop
                if (coin.moveLoopCount < coin.maxMoveLoopCount) {
                    if (coin.moveLoopCount === coin.maxMoveLoopCount - 6) button.classList.add('shrink-landing')
                    window.requestAnimationFrame(flipCoinLoop)
                } else {
                    button.classList.add('coin-landed')
                    coin.style.setProperty('opacity', 0)
                    setTimeout(() => {
// button.classList.remove('shrink-landing', 'coin-landed')
                        setTimeout(() => {
                            resetCoin()
                        }, 300)
                    }, 1500)
                }
            }
        })
    </script>
    <script>
        var distance = $('.cd-main-content').offset().top;

        $(window).scroll(function () {
            if ($(window).width() >= 1101) {
                if ($(this).scrollTop() >= distance) {
                    $(".cd-tab-filter").css("padding-top", "0px");
                } else {
                    $(".cd-tab-filter").css("padding-top", "40px");
                }
            }
        });
    </script>
@endsection
