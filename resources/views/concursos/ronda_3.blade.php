@extends('2021-orsai-template')

@section('title', 'Linea de tiempo Orsai | Comunidad Orsai')
@section('description','Linea de tiempo Orsai | Comunidad Orsai')

@section('content')
    @include('concursos.concurso-header')
    <section class="pd_20_">
        <div class="contenedor titulo_leit_motivs ">
            <div class="cont_card_leitmotiv">
            @foreach($cpas as $cpa)
                <!-- Card -->
                    <div class="card_leitmotiv_2 card_rn_3">
                        <div class="card-leitmotiv__" href="#">
                            <span class="id_card">{{str_pad($cpa->order, 3, 0 ,STR_PAD_LEFT)}}</span>
                            @foreach($currentRonda->inputs as $key => $input)
                                @if($key == 0)
                                    <h3 class="title_card">{{$cpa->getAnswerByRonda($currentRonda, $key)}}</h3>
                                @else
                                    @if($key == 2 )
                                        <span class="cat_card input_{{$key}}"> {{substr($cpa->getAnswerByRonda($currentRonda, $key), 0,  300) }}...</span>
                                    @else 
                                        <span class="cat_card input_{{$key}}">{{$cpa->getAnswerByRonda($currentRonda, $key)}}</span>
                                    @endif
                                @endif
                            @endforeach
                            <div class="rn_3 selecc_fichas">
                                @if($cpa->votesAmount == $currentRonda->cost)
                                <p>Ya apostaste el máximo de fichas</p>
                                @else
                                <p>Ponele fichas</p>
                                @endif
                                <div class="rn_flex_fichas">
                                    <div class="fichas_">
                                        @for($i=0;$i < $cpa->votesAmount; $i++)
                                            <div class="fichin apostado">
                                                <span class="icon-ficha"></span>
                                            </div>
                                        @endfor  
                                        @for($i=0;$i < $currentRonda->cost - $cpa->votesAmount; $i++)
                                            <div class="fichin">
                                                <span class="icon-ficha"></span>
                                            </div>
                                        @endfor
                                    </div>
                                    @if($currentRonda->cost != $cpa->votesAmount)
                                    <div class="btn_fichas">
                                        <form action="#" method="POST">
                                            <input type="hidden" name="apostar_fichas" id="ap_fichas">
                                            <div class="form_ctrl input_">
                                                <div class="align_center">
                                                    <button
                                                        class="boton_redondeado     resaltado_black color_amarillo  pd_25_lf_rg apostarBtn"
                                                        data-cap_id="{{$cpa->id}}"
                                                        disabled>Apostar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                    <div>
                                        <a href="{{url('cuentos/'.$cpa->id)}}" class="">Leer cuento <span
                                                class="icon-flecha_leitmotiv"></span></a>
                                    </div>
                                </div>
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
            <a href="#" class="boton_redondeado resaltado_amarillo text_bold width_100"  rel="modal:close">Seguir apostando</a> 
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
    <script src="{{url('js/front2021/jquery.modal/jquery.modal.min.js')}}"></script>
    <script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
    <script>
 
        $("#countdown_concurso").countdown("{{$diferencia}}", function (event) {
            $(this).text(
                event.strftime('%-D día%!D %H:%M:%S')
            ); 
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
 

        function removeCoins(event, element, rondaOrder){
            //('.fichin').remove();
        }

        //Animacion de boton ficha
        // const tip_Buttons = document.querySelectorAll('.button_card')
        // tip_Buttons.forEach((button) => {
        //     button.addEventListener('click', () => {
        //         if (button.clicked) return
        //         // button.find(".tip-button").classList.add('clicked')
        //     })
        // }) 


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

         $(".apostarBtn").click(function (event) {
             event.preventDefault(); 
             
             const fichas = $(this).closest('.rn_flex_fichas').find('.activo').length;
             $("#ap_fichas").val(fichas); 

             const rondaOrder = {{$currentRonda->order}};
             const amount = fichas;
             const cap_id = $(this).data('cap_id');
             votar(cap_id, rondaOrder, amount, $(this));
         });

        function votar(cap_id, rondaOrder, amount, element) {
            axios.post('{{url('votar')}}', {
                cap_id: cap_id,
                amount: amount,
                rondaOrder: rondaOrder
            }).then(function (response) {
                $(element).closest('.rn_flex_fichas').find('.activo').addClass('apostado');
                $(element).closest('.rn_flex_fichas').find('.activo').removeClass('activo');  
                console.log(response.data.result.cap_id);
                if (response.data.result.cap_id == {{$currentRonda->cost}}) {
                    removeButtonApostar(element)
                }else{
                    resetButtonApostar(element);
                }

                // console.log(response.data);
            }).catch(error => {
                if (error.response.data.error == 100) {
                    $("#sin_fichas").show();
                }
            });
        } 

 
    //     $("#form_filtro .icon-cancel").on("click", function () {
    //         $("#form_filtro").removeClass("abierto");
    //     })
    //     $("#open_menu").on("click", function () {
    //         if ($("#form_filtro").hasClass("abierto")) {

    //             $("#form_filtro").removeClass("abierto");
    //         } else {
    //             $("#form_filtro").addClass("abierto");
    //         }
    //     })
    //     const tagContainer = document.querySelector('.tag-container');
    //     const input = document.querySelector('input');
    //     const input_check = document.querySelectorAll('.check_cond');
    //     const select = document.querySelector('#categorias');
    //     let tags = [];

    //     function createTag(label) {
    //         const div = document.createElement('div');
    //         div.setAttribute('class', 'tag');
    //         const span = document.createElement('span');
    //         span.innerHTML = label;
    //         const closeIcon = document.createElement('i');
    //         closeIcon.innerHTML = 'cancel';
    //         closeIcon.setAttribute('class', 'material-icons');
    //         closeIcon.setAttribute('data-item', label);
    //         div.appendChild(span);
    //         div.appendChild(closeIcon);
    //         return div;
    //     }

    //     function clearTags() {
    //         document.querySelectorAll('.tag').forEach(tag => {
    //             tag.parentElement.removeChild(tag);
    //         });
    //     }

    //     function addTags() {
    //         clearTags();
    //         tags.slice().reverse().forEach(tag => {
    //             tagContainer.prepend(createTag(tag));
    //         });
    //     }

    //     input.addEventListener('keyup', (e) => {
    //         e.preventDefault();
    //         if (e.key === 'Enter') {
    //             e.target.value.split(',').forEach(tag => {
    //                 tags.push(tag);
    //             });
    //             addTags();
    //             input.value = '';
    //         }
    //     });

    //     select.addEventListener('change', (e) => {

    //         const consulta_tag = e.target.value;
    //         if (tags.indexOf(consulta_tag) == -1) {
    //             e.target.value.split(',').forEach(tag => {
    //                 tags.push(tag);

    //             });
    //             addTags();
    //         }
    //     });

    //     for (var x = 0; x < input_check.length; x++) {
    //         input_check[x].addEventListener('change', (e) => {
    //             e.preventDefault();
    //             if (e.target.checked == true) {
    //                 e.target.value.split(',').forEach(tag => {
    //                     tags.push(tag);
    //                 });
    //                 addTags();
    //             } else {
    //                 const tagLabel = e.target.value;
    //                 const index = tags.indexOf(tagLabel);
    //                 tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    //                 addTags();
    //             }
    //         });
    //     }

    //     document.addEventListener('click', (e) => {

    //         if (e.target.tagName === 'I') {
    //             const tagLabel = e.target.getAttribute('data-item');
    //             const index = tags.indexOf(tagLabel);
    //             tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    //             addTags();
    //         }
    //     })

    //     input.focus();


    //     // Boton de tarjeta
    //     $('.button_card').on('click', function (e) {
    //         /*Si se hace por php cambiar link */

    //         if (!$(this).hasClass("clicked")) {
    //             e.preventDefault();
    //             $(this).attr("href", "cuento_corto_")
    //         }
    //         $(this).find(".desc_boton").text("Leer cuento");
    //         $(this).find(".num_fichas").text("");
    //         $(this).find(".icon").not(".icon_flip").removeClass("icon-ficha");
    //         $(this).find(".icon").not(".icon_flip").addClass("icon-flecha_leitmotiv");

    //         +$(this).parent().parent().addClass("card-leitmotiv-animate");
    //         if ($(this).parent().parent($(".cd-gallery li.color-1")) && $(this).parent().parent($(".cd-gallery li.color-1"))) {
    //             $(this).parent().parent().addClass("color-1")
    //         }


    //         $(this).addClass("button_card-animate");

    //         $(this).animate({
    //             // left: "+=50"
    //         }, 5, function () {
    //         });
    //     });


    //     //Animacion de boton ficha
    //     const tip_Buttons = document.querySelectorAll('.button_card')
    //     tip_Buttons.forEach((button) => {
    //         button.addEventListener('click', () => {
    //             if (button.clicked) return
    //             button.classList.add('clicked')
    //         })
    //     })
 


        // /*Agregar o quitar fichas Si el usuario ya agrego con anteriorida van con la clase apostadas*/
        // $(".card_rn_3").each(function (index) {
        //     if (($(".card_rn_3").eq(index).find(".fichin.apostado").length) + ($(".card_rn_3").eq(index).find(".fichin.activo").length) == 5) {
        //         $(".card_rn_3").eq(index).find(".selecc_fichas").addClass("max_apostado");
        //         $(".card_rn_3").eq(index).find(".selecc_fichas p").text("Ya apostaste el máximo de fichas");
        //     }
        // });

        function removeButtonApostar(element){  
            console.log("entro removeButtonApostar");
            $(element).closest('.selecc_fichas').find("p").text("Ya apostaste el máximo de fichas");
            $(element).remove(); 
        }
        function resetButtonApostar(element){ 
            console.log("entro resetButtonApostar");
            $(element).closest('.selecc_fichas').find("p").text("Ponele fichas");
            $(element).text("Apostar");
            $(element).attr("disabled", true);
           // $(element).parent().find("form").val(cantidad);
        }
        $(".fichin").on("click", function () { 
            var indice_click_ = $(this).parent().find(".fichin").index(this);
            var obj_fichin = $(this).parent();
            $(obj_fichin).find(".fichin.activo").removeClass("activo");
            for (var x = 0; x <= indice_click_; x++) {
                if (!$(obj_fichin).find(".fichin").eq(x).hasClass("apostado")) {
                    $(obj_fichin).find(".fichin").eq(x).addClass("activo")
                }
            }

            var cantidad = $(obj_fichin).find(".fichin.activo").length;
            $("#ap_fichas").val(cantidad); 
            if (cantidad > 0) {
                $(obj_fichin).parent().find(".form_ctrl button").attr("disabled", false);
                $(obj_fichin).parent().parent().find("p").text("Vas a sumar " + cantidad + " fichas");
                $(obj_fichin).parent().find(".form_ctrl button").text("Apostar " + cantidad + " fichas");
                $(obj_fichin).parent().find("form").val(cantidad);
            } else {
                $(obj_fichin).parent().parent().find("p").text("Ponele fichas");
                $(obj_fichin).parent().find(".form_ctrl button").text("Apostar");
                $(obj_fichin).parent().find(".form_ctrl button").attr("disabled", true);
                $(obj_fichin).parent().find("form").val(cantidad);
            }
        });


    //     $(".desp_mobile_tab .tabs_cli").on("click", function () {

    //         if ($(".desp_mobile_tab .tabs_cli").hasClass("icon-angle-down")) {
    //             $(".cd-tab-filter ul.cd-filters").css("maxHeight", "450px");
    //             $(".desp_mobile_tab .tabs_cli").removeClass("icon-angle-down");
    //             $(".desp_mobile_tab .tabs_cli").addClass("icon-angle-up");
    //         } else {
    //             $(".cd-tab-filter ul.cd-filters").css("maxHeight", "60px");
    //             $(".desp_mobile_tab .tabs_cli").removeClass("icon-angle-up");
    //             $(".desp_mobile_tab .tabs_cli").addClass("icon-angle-down");
    //         }
    //     });

    //     $(".hero-nav-content").owlCarousel({
    //         responsiveClass: true,
    //         dots: false,
    //         navText: ["<i class='icon-left_arrow'></i>", "<i class='icon-right_arrow'></i>"],
    //         responsive: {
    //             0: {
    //                 items: 1,
    //                 nav: true,
    //                 loop: true
    //             },
    //             1100: {
    //                 items: 5,
    //                 nav: false,
    //                 loop: false,
    //                 mouseDrag: false,
    //                 autoWidth: true
    //             }
    //         }
    //     });
    //     if (window.matchMedia("(max-width: 1100px)").matches) {
    //         $('.hero-nav-content').owlCarousel('remove', 4).owlCarousel('update');
    //     }
    //     if ($(window).width() < 1170) {
    //         var orden_tabs_mobile = $(".selected").parent();
    //         $(".cd-filters").prepend(orden_tabs_mobile);
    //     }
    //     $(window).resize(function () {
    //         if ($(window).width() < 1170) {
    //             var orden_tabs_mobile = $(".selected").parent();
    //             $(".cd-filters").prepend(orden_tabs_mobile);
    //         }
    //     }); 


    //     var distance = $('.cd-main-content').offset().top;

    //     $(window).scroll(function () {
    //         if ($(window).width() >= 1101) {
    //             if ($(this).scrollTop() >= distance) {
    //                 $(".cd-tab-filter").css("padding-top", "0px");
    //             } else {
    //                 $(".cd-tab-filter").css("padding-top", "40px");
    //             }
    //         }
    //     });
    // </script>
@endsection
