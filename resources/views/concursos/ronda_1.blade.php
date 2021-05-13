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
                                    <h3 class="title_card">{{$cpa->getAnswerByRonda($currentRonda, $key)}}</h3>
                                @else
                                    <span
                                        class="cat_card input_{{$key}}">{{$cpa->getAnswerByRonda($currentRonda, $key)}}</span>
                            @endif
                        @endforeach
                        <!-- <a href="#" class="button_card boton_redondeado resaltado_amarillo width_100"><span class="desc_boton">Destrabar cuento completo</span><span class="cant_fichas"><span class="icon icon_flip icon-ficha"></span><span class="icon icon-ficha"></span> <span class="num_fichas">2</span></span></a> -->
                            <div class="button_card">
                                <a @if($cpa->hasBeenVoted) href="{{$currentRonda->order+1}}?id={{$cpa->id}}" @else href="#" @endif
                                class="tip-button boton_redondeado resaltado_amarillo width_100 @if($cpa->hasBeenVoted) button_card-animate clicked shrink-landing coin-landed @endif"
                                   data-cap_id="{{$cpa->id}}" order="{{$currentRonda->order}}">
                                    @if($cpa->hasBeenVoted)
                                        @if($currentRonda->order == 1)
                                            <span class="tip-button__text">Leer descripción</span>
                                        @else
                                            <span class="tip-button__text">Leer cuento</span>
                                        @endif
                                        <span class="icon icon-flecha_leitmotiv"></span>
                                    @else
                                        <span class="tip-button__text">Destrabar</span>
                                    @endif
                                    <span class="icon icon-flecha_leitmotiv"></span>
                                    <div class="num_coins"><span class="coin">
                                        <img src="{{url('recursos/coin.svg')}}" /></span> <span class="coin_price">{{$currentRonda->cost}}</span></div>
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
    <div id="jurado_vip" class="modal">
        <div class="title_modal">
            <img src="{{url('estilos/front2021/assets/icon_warning.svg')}}"/>
            <h5>¡Convertite en Jurado VIP!</h5>
        </div>
        <div class="content_modal">
            <p>Te faltan apostar {{$toBeJury}} fichas para ver las estadísticas del concurso.</p>
        </div>
        <div class="align_center">
            <a href="#" class="boton_redondeado resaltado_amarillo text_bold width_100" rel="modal:close">Seguir
                apostando</a>
        </div>
    </div>


    <div id="sin_fichas" class="modal modal_sinfichas">
        <div class="title_modal">
            <img src="{{url('estilos/front2021/assets/icon_warning.svg')}}"/>
            <h5>No te alcanzan las Fichas</h5>
        </div>
        <div class="content_modal">
            <p>Hacé una donación para conseguir más.</p>
        </div>
        <div class="align_center">
            <a href="{{url('donar')}}" class="boton_redondeado resaltado_amarillo text_bold width_100">Donar</a>
            <a href="#" rel="modal:close" class="boton_decline width_100">Ahora no</a>
        </div>
    </div>
@endsection

@section('footer')
    @include("fundacion.footer-fundacion")
    <script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
    <script src="{{url('js/front2021/jquery.modal/jquery.modal.min.js')}}"></script>
    <script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
    <script>
        @if($currentRonda->order == 2) 
            $('html, body').animate({
                scrollTop: $("#hero_fixed").offset().top
            }, 1);
        @endif
        $("#countdown_concurso").countdown("{{$diferencia}}", function (event) {
            if(event.offset['days'] != 0){
                $(this).text(
                    event.strftime('%-D día%!D %H:%M')
                ); 
            }else{
                $(this).text(
                    event.strftime('%H:%M:%S')
                ); 
            }
        });
          
        // Modal Jurado VIP
        function showModalJuradoVip() {
            $('#jurado_vip').modal();
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

        $("#borrar_filtro").on("click", function (e) {
            e.preventDefault();
            window.location = window.location.href.split("?")[0];
        })
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

        // Boton de tarjeta
        $('.button_card a').on('click', function (e) {
            if (!$(this).hasClass('clicked')) {
                e.preventDefault();
                const rondaOrder = {{$currentRonda->order}};
                const amount = {{$currentRonda->cost}};
                const cap_id = $(this).data('cap_id');
                votar(cap_id, rondaOrder, amount, e, $(this));
            }
        });

        function updateVotes(element, order) {

            norder = order + 1;
            filter_update = $('.filter_' + norder);
            filter_counter = $('.filter_' + norder + ' .counter_');
            destrabados = parseInt(filter_counter.find('small').html());

            if (filter_update.find('div').hasClass('bloqued')) {

                link = $("<a>");
                link.attr("href", norder);
                link.html(filter_update.find('div').html());

                filter_update.html(link);

                filter_update.find('div').remove();

                filter_update.find('span.icon').removeClass('icon-carpeta_cerrada');
                filter_update.find('span.icon').addClass('icon-carpeta_abierta');

                link.find('.counter_ small').html(destrabados + 1);

            } else {
                filter_counter.find('small').html(destrabados + 1);
            }

        }
        function animateCoin(element){   
            element.find('.coin img').css('position','absolute');    
            element.find('.coin img').first().animate({
                    width: "102%", 
                    opacity: 0,  
                    top: "-=100px",
                    deg: 360}, 
                    {
                    duration: 500,
                    step: function(now){ 
                        element.find('.coin img').css({
                            transform: "rotate(" + now + "deg)"
                        });
                    }
                });

            element.find('.coin img').clone().appendTo(element.find('.coin'));

            setTimeout(function () { 
                element.find('.coin img').last().animate({ 
                    width: "102%", 
                    opacity: 0,  
                    top: "-=100px",
                    deg: 360}, 
                    {
                    duration: 500,
                    step: function(now){ 
                        element.find('.coin img').last().css({
                            transform: "rotate(" + now + "deg)"
                        });
                    }
                });
            }, 200)
        }

        // $('.coin').animate({
        //     width: "toggle",
        //     height: "toggle"
        // }, {
        //     duration: 5000,
        //     specialEasing: {
        //     width: "linear",
        //     height: "easeOutBounce"
        //     },
        //     complete: function() {
        //   //  $( this ).after( "<div>Animation complete.</div>" );
        //     }
        // });

        function changeCardState(e, element, order) {

            //Actualiza el valor en los filtros
            updateVotes(element, order);
            
            animateCoin(element);

                element.attr("href", {{$currentRonda->order + 1}})

                if (order == 1) {
                    element.find(".tip-button__text").text("Leer descripción");
                } else {
                    element.find(".tip-button__text").text("Leer cuento completo");
                }
 
            
            element.addClass("clicked"); 
            setTimeout(function () { 
                element.addClass("button_card-animate"); 
                element.parent().parent().addClass("card-leitmotiv-animate");

            }, 400)

            setTimeout(function () { 
                element.find(".num_fichas").text("");
                if (element.parent().parent($(".cd-gallery li.color-1")) && $(this).parent().parent($(".cd-gallery li.color-1"))) {
                    element.parent().parent().addClass("color-1")
                }
                element.find(".num_coins .coin_price").hide(); 
                coin.hide();
            }, 500)

        }


        function votar(cap_id, rondaOrder, amount, event, element) {
            axios.post('{{url('votar')}}', {
                cap_id: cap_id,
                amount: amount,
                rondaOrder: rondaOrder
            }).then(response => {
                changeCardState(event, element, rondaOrder);
                console.log(response.data)
            }).catch(error => {
                console.log(error);
                if (error.response.data.error == 100) {
                    $("#sin_fichas").modal();
                }
            });
        }
 


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
        // if (window.matchMedia("(max-width: 1100px)").matches) {
        //     $('.hero-nav-content').owlCarousel('remove', 4).owlCarousel('update');
        // }

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
