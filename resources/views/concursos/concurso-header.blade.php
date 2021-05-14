<section class="inscripcion-cuento">
    <div class="contenedor">
        <div class="hero" 
            @if($logo)
            style="background-image:url('{{url('storage/images/'.$logo->name.".".$logo->extension)}}')"
            @else
            style="background-image:url('{{'/recursos/front2021/fichas-donaciones.jpg'}}')"
            @endif
        >
            <div class="content-hero">  
                    <p class="pills">Votación</p> 
                <h2 class="title">{{$concurso->name}}</h2> 
                    <p class="subtitle"><strong class="color_amarillo">¿Estás ok para ser jurado?</strong> Solo tenés
                        que tener fichas disponibles y muchas ganas de apostarle a las historias que creas mejores. Ya
                        podés empezar.</p>
                    <p><strong class="color_amarillo">Recordá que los primeros clics son gratis, pero para seguir
                            avanzando en tus veredictos vas a necesitar fichas.</strong></p> 
                <div id="hero_fixed"></div>
            </div> 
        </div>
        <nav class="hero-nav concurso_nav">
            <div class="hero-nav-content  owl-carousel owl-theme">
                <div class="hero-nav-item linea">
                    <div class="icon">
                        <img src="{{url('estilos/front2021/assets/reloj.svg')}}" alt="Cierre de votación">
                    </div>
                    <div class="content-nav column">
                        <div>
                            <span><small>Cierre de votación</small><span id="countdown_concurso"></span></span>
                        </div>
                    </div>
                </div>
                <div class="hero-nav-item linea">
                    <div class="icon">
                        <img src="{{url('estilos/front2021/assets/fichas.svg')}}" alt="Pozo acumulado">
                    </div>
                    <div class="content-nav column">

                        <div>
                            <div class="numero_dividido"> 
                                <span class="big-number_2">{{$cantidadDineroEnJuego}} USD</span>
                                <small>Pozo total</small>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="hero-nav-item linea">
                    <div class="icon">
                        <img src="{{url('estilos/front2021/assets/modo_pozo.svg')}}" alt="Modo Pozo">
                    </div>
                    <div class="content-nav">
                        <span class="medio">Modo <br/> <strong>{{$modo}}</strong></span>
                    </div>
                </div> --}}
                <div class="hero-nav-item linea">
                    <div class="content-nav column bajar">
                        <div class="numero_dividido">
                            <span class="big-number_3">{{$cantidadPostulacionesAprobadas}}</span>
                            <span>Cuentos <br/>enviados</span>
                        </div>
                    </div>
                    <div class="content-nav column  bajar">

                        <div class="numero_dividido">
                            
                            <span class="big-number_3">{{$usuariosqueVotaron}}</span>
                            <span>@if($usuariosqueVotaron > 1) Jurados @else Jurado @endif</span>
                        </div>
                    </div>
                </div>
                <div class="hero-nav-item">
                    @if($isJuradoVip)
                        <div class="content-nav center">
                            <a href="{{url('ranking')}}" class="btn-postulacion">Estadísticas</a>
                        </div>
                    @else
                        <div class="content-nav center bloqued">
                            <a href="#" class="btn-postulacion" onclick="showModalJuradoVip()"> <span
                                    class="icon-candado"></span> Estadísticas
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</section>
<main class="cd-main-content resaltado_gris">
    <div class="cd-tab-filter-wrapper">
        <div class="cd-tab-filter">
            <ul class="filtro_menu">
                <li class="color_blanco"><span id="open_menu"> <span class="icon icon-filtro"></span><span
                            class="text_tit_submenu">Filtros </span>
                            {{-- 
                                @if(hayfiltrosaplicados)
                                <span class="color_amarillo cant_filtros_aplicados">(4)</span> 
                                @endif
                            --}}
                        </span>
                    <form action="#" id="form_filtro" autocomplete="off">
                        <ul class="sub_menu">
                            <li class="cont_icon_cancel">
                                <span class="icon icon-cancel cerrar"></span>
                            </li>
                            @if($categories)
                                <li>
                                    <div class="form_ctrl input_">
                                        <div class="input_err">
                                            <label class="text_medium">Categorias</label>
                                            <div class="select">
                                                <select id="categorias" name="categorias">
                                                        <option value="0" disabled selected>Sin categoría</option>
                                                    @foreach($categories as $item)
                                                        <option value="{{$item}}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="select__arrow"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <div class="form_ctrl input_">
                                    <div class="input_err">
                                        <label class="text_medium">Buscar</label>
                                        <input type="text" name="palabras_buscar" placeholder="palabra"
                                               class="obligatorio" id="busqueda">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="grilla_form sin_margin">
                                    <div class="form_ctrl input_ col_6">
                                        <div class="align_left">
                                            <div class="input_err">
                                                <div class="check_div input_err obligatorio">
                                                    <label class="checkbox-container letra_chica text_bold">
                                                        Ver destrabados
                                                        <input type="checkbox" value="Destrabados" id="cbox3"
                                                               name="filtro3" class="check_cond">
                                                        <span class="crear_check"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="input_err tag-container">
                                </div>
                            </li>
                            <li class="cont_btn_filtro">
                                <div class="form_ctrl input_">
                                    <div class="align_right">
                                        <a class="boton_redondeado resaltado_amarillo pd_50_lf_rg" onclick="filtrar()">Filtrar</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </li>
            </ul>
            <ul class="cd-filters">
                @foreach($counterRondas as $ronda)
                <li class="filter filter_{{$ronda->order}}"> 
                        @if($ronda->order == 1) 
                            <a href="{{$ronda->order}}" data-type="all" @if($currentRonda->order == $ronda->order) class="selected" @endif>
                            <span class="icon icon-carpeta_abierta"></span>
                        @else
                            @if($counterRondas->get($loop->index - 1)->cpas > 0)
                                <a href="{{$ronda->order}}{{$queryParams}}" data-type="all" @if($currentRonda->order == $ronda->order) class="selected" @endif>
                                <span class="icon icon-carpeta_abierta"></span>
                            @else  
                            <div class="bloqued">
                                <span class="icon icon-carpeta_cerrada"></span>
                            @endif
                        @endif
                        {{$rondas->get($loop->index)->solapa}}
                        @if($ronda->order == 1)
                            <span class="counter_">(<small>{{$cantidadPostulacionesAprobadas}}</small>)</span>
                        @else
                            <span class="counter_">(<small>{{$counterRondas->get($loop->index - 1)->cpas}}</small>)</span>
                        @endif
                        
                        @if($ronda->order == 1) 
                            </a>
                        @else
                            @if($counterRondas->get($loop->index - 1)->cpas > 0) 
                            </a>
                            @else   
                        </div>
                            @endif
                        @endif
                    </li> 
                    @endforeach 
            </ul> <!-- cd-filters -->
            
            <div class="desp_mobile_tab">
                <span class="icon  icon-angle-down tabs_cli"></span>
            </div> 
        </div> <!-- cd-tab-filter -->
    </div> <!-- cd-tab-filter-wrapper -->
    <section class="resaltado_gris pd_20_ pd_20_tp_bt ">
        <div class="contenedor titulo_leit_motivs"> 
            <h2>{{$currentRonda->title}}</h2>
            <p class="">{{$currentRonda->bajada}}</p>  
            <span class="">{{$currentRonda->body}}</span>    
        </div>  

        @php
       //  var_dump(request()->all());   
        @endphp
            @empty(!request()->all())
                <div class="contenedor filtros_aplicados">
                    <div style="width:100%;">
                        <span> 
                            @if($filters>1)
                            {{$filters}} filtros aplicados
                            @else
                            {{$filters}} filtro aplicado 
                            @endif  
                            @if($cpas->count()>1)
                            / {{$cpas->count()}} postulaciones encontradas
                            @else
                            / {{$cpas->count()}} postulacion encontrada 
                            @endif 
                        </span>
                        <div class="tag-container"> 
                            @foreach ($categoriasSeleccionadas as $cat)  
                                    <span class="tag">{{$cat}}</span> 
                            @endforeach 
                        </div>  
                    </div>
                    <div class="cleanfilters">
                        <a href="{{$baseUrl}}" id="borrar_filtro"><span class="icon icon-borrar_filtro"></span> Limpiar filtros</a>
                    </div>
                </div> 
            @endempty
    </section>
