@extends('orsai-template')


@section('content')
    <section id="intro" class="contenedor intro_gral panel info_personal">
        <div class="info_per_left">
            <div class="">
                <div id="links_back">
                    <a href="panel_usuario.html">Panel de usuario</a>
                    <a href="#">Información personal</a>
                </div>
                <div id="user_alias">
                    <h1>Información <span class="span_block">personal</span></h1>
                </div>
            </div>
        </div>
        <div class="info_per_right">
            <form action="#">
                <div class="input_err">
                    <div class="in_img">
                        <div class="cont_box">
                            <div class="box">
                                <input type="file" name="" id="foto_perfil" class="inputfile_2 inputfile_per" accept="image/*"/>
                                <img src="img/participantes/participante.jpg" alt="">
                            </div>
                            <label for="foto_perfil"><span class="subrayado resaltado_amarillo cambia_avatar">Cambiar avatar</span></label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section id="panel_user_profile" class="contenedor">
        <div class="form_left">
            <form action="#">
                <div class="input_err">
                    <label>Usuario*</label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="username" value="{{$username}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Correo electrónico*</label>
                    <div class="in_sp obligatorio editar">
                        <input type="email" name="email" value="{{$email}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Nombre*</label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="name" value="{{$name}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Apellido*</label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="lastName" value="{{$lastName}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Ciudad*</label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="city" value="{{$city}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err select">
                    <label class='oculto' >País</label>
                    <div  class="in_sp editar">
                        <p class="pais_select">Argentina</p>
                        <span class="subrayado resaltado_amarillo ed_select">Editar</span>

                        <div class="arm_sel">
                            <select name='pais' id='pais_suscriptor' class='' onchange="sel_op(this)" name="country">
                                <option id="select_pais" value='ninguno' disabled selected  hidden>Elegir...</option>
                                <option value='AR'>Argentina</option>
                                <option value='BO'>Bolivia</option>
                                <option value='BR'>Brasil</option>
                                <option value='CL'>Chile</option>
                                <option value='PY'>Paraguay</option>
                                <option value='PE'>Perú</option>
                                <option value='UY'>Uruguay</option>
                                <option value='otro'>Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
        </div>
        <div class="form_right">
            <form action="#">
                <div class="input_err">
                    <label>Fecha de nacimiento*</label>
                    <div  class="in_sp obligatorio editar">
                        <input type="date" name="birthDate" value="{{$birthDate}}" disabled required>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Profesión*</label>
                    <div class="in_sp obligatorio editar">
                        <input type="text" name="profesion" value="{{$profesion}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Descripción*</label>
                    <div  class="in_sp obligatorio editar">
                        <input type="text" name="description" value="{{$description}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Facebook</label>
                    <div  class="in_sp editar">
                        <input type="text" name="facebook" value="{{$facebook}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Twitter</label>
                    <div  class="in_sp editar">
                        <input type="text" name="twitter" value="{{$twitter}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <form action="#">
                <div class="input_err">
                    <label>Instagram</label>
                    <div  class="in_sp editar">
                        <input type="text" name="instagram" value="{{$instagram}}" disabled>
                        <span class="subrayado resaltado_amarillo">Editar</span>
                    </div>
                    <div class="line_dashed"></div>
                </div>
            </form>
            <div class="info_per_nota">
                <span class="subrayado">* Obligatorios para obtener créditos extra.</span>
            </div>
        </div>

    </section>
    <div class="contenedor mg_100 number_page">
        <span>1</span>
    </div>
@endsection

@section('footer')

@endsection
