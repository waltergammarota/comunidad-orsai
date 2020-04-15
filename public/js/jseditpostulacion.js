
var pat_text = new RegExp( /[a-z]{3}/ );
var pat_text_area = new RegExp( /([a-z ]){30,}/ );
var pat_mail = new RegExp( /[\w-\.]{3,}@([\w-]{2,}\.)([\w-]{2,4}\.)?[\w-]{2,4}$/ );
var pat_img = new RegExp( /\.(jpg|png|gif)$/i );
var pat_pdf = new RegExp( /\.(pdf)$/i );


var in_sp= document.getElementsByClassName("input_err");

var btn_editar = [];
for (var x = 0; x < in_sp.length; x++){
    btn_editar [x] = in_sp[x].getElementsByTagName("label")[0].getElementsByTagName("span")[0];
    btn_editar[x].numerito = x;
    in_sp[x].error=false;
    btn_editar[x].onclick=function (){


        if (in_sp[this.numerito].classList.contains("editar")){
            if (in_sp[this.numerito].getElementsByTagName("input")[0]){
          
            if(in_sp[this.numerito].getElementsByTagName("input")[0].type=="text"){
                in_sp[this.numerito].getElementsByTagName("input")[0].disabled=false;
                in_sp[this.numerito].getElementsByTagName("input")[0].focus();
            }
            }


            if (in_sp[this.numerito].getElementsByTagName("input")[0]){
            if(in_sp[this.numerito].getElementsByTagName("input")[0].type=="file"){

                in_sp[this.numerito].getElementsByTagName("input")[0].disabled=false;
                var get_span = in_sp[this.numerito].getElementsByClassName("box")[0].getElementsByTagName("label")[0].getElementsByTagName("span")[0];
                    if (in_sp[this.numerito].getElementsByTagName("input")[0].id=="file-1"){
                        get_span.innerHTML="Cambiar logo";
                    }
                    if(in_sp[this.numerito].getElementsByTagName("input")[0].id=="file-2"){
                        var get_input_into = in_sp[this.numerito].getElementsByTagName("input");
                        for (var z=0; z < get_input_into.length; z++){
                            
                            get_input_into[z].disabled=false;
                            if(get_input_into[z].parentElement.getElementsByTagName("img")[0].getAttribute('src') != ""){
                                crear_span_basura = document.createElement("span");
                                crear_span_basura.classList.add("icon-trash-empty");
                                if (!get_input_into[z].parentElement.getElementsByClassName("icon-trash-empty")[0]){
                                    // get_input_into[z].parentElement.appendChild(crear_span_basura);


                                    get_input_into[z].num=z;
                                    
                                    var create_span = get_input_into[z].parentElement.appendChild(crear_span_basura);
                                    create_span.onclick= function(z){
                                        console.log(create_span.parentElement);
                                    if (create_span.parentElement.getElementsByTagName("img")[0].getAttribute('src') != ""){
                                        var guardar_span = create_span; 
                                        guardar_span.parentElement.getElementsByTagName("img")[0].src ="";
                                        guardar_span.parentElement.getElementsByTagName("input")[0].value="";
                                        guardar_span.parentElement.getElementsByTagName("label")[0].getElementsByTagName("span")[0].innerHTML="&#x0002B;"
                                        create_span.parentElement.removeChild(guardar_span);
                                    }

                                    }

                                }
                            }
                            
                        }
                        // console.log(in_sp[this.numerito].getElementsByTagName("input")[0]);
                        get_span.innerHTML ="&#x0002B;";
                    }
            }
        }
        if(in_sp[this.numerito].getElementsByTagName("input")[0]){
        if(in_sp[this.numerito].getElementsByTagName("input")[0].id=="file-7"){
                if(in_sp[this.numerito].getElementsByClassName("icon-trash-empty")[0]){
                    in_sp[this.numerito].getElementsByClassName("icon-trash-empty")[0].style.display = "inline-block";
                }
            }
        }
            if(in_sp[this.numerito].getElementsByTagName("textarea")[0]){
                in_sp[this.numerito].getElementsByTagName("textarea")[0].disabled=false;
            }
            btn_editar[this.numerito].innerHTML ="Guardar";
            in_sp[this.numerito].classList.remove("editar");
            in_sp[this.numerito].classList.add("guardar");




            
        }else if(in_sp[this.numerito].classList.contains("guardar")){

        if (in_sp[this.numerito].getElementsByTagName("textarea")[0]){


            if (pat_text_area.test(in_sp[this.numerito].getElementsByTagName("textarea")[0].value)){
                in_sp[this.numerito].getElementsByTagName("textarea")[0].disabled=true;
                    btn_editar[this.numerito].innerHTML ="Editar";
                    in_sp[this.numerito].classList.remove("guardar");
                    in_sp[this.numerito].classList.add("editar");
                    in_sp[this.numerito].error=false;

                        if(in_sp[this.numerito].getElementsByClassName("error")[0]){
                            in_sp[this.numerito].removeChild(in_sp[this.numerito].getElementsByClassName("error")[0]);
                        }
                        var get_modal_exito = document.getElementById("exito_msg");
						open_modal(get_modal_exito);
						var efecto1 = setTimeout(close(get_modal_exito), 600);

                        // hacer submit

                }else{
                    in_sp[this.numerito].getElementsByTagName("textarea")[0].focus();
                    if(in_sp[this.numerito].error==false){
                        if (!in_sp[this.numerito].getElementsByClassName("error")[0]){
                            crear_span_error (in_sp[this.numerito], "Ingrese un 30 caracteres minimo")
                        }
                        in_sp[this.numerito].error=true;
                }}
        }    
        if(in_sp[this.numerito].getElementsByTagName("input")[0]){
            var value_input =in_sp[this.numerito].getElementsByTagName("input")[0].value;

            if (in_sp[this.numerito].getElementsByTagName("input")[0].type =="text" && in_sp[this.numerito].getElementsByTagName("input")[0].classList.contains("obligatorio")){
                
                if (pat_text.test(value_input)){
                    in_sp[this.numerito].getElementsByTagName("input")[0].disabled=true;
                    btn_editar[this.numerito].innerHTML ="Editar";
                    in_sp[this.numerito].classList.remove("guardar");
                    in_sp[this.numerito].classList.add("editar");
                    in_sp[this.numerito].error=false;

                        if(in_sp[this.numerito].getElementsByClassName("error")[0]){
                            in_sp[this.numerito].removeChild(in_sp[this.numerito].getElementsByClassName("error")[0]);
                        }
                        var get_modal_exito = document.getElementById("exito_msg");
						open_modal(get_modal_exito);
						var efecto1 = setTimeout(close(get_modal_exito), 600);

                        // hacer submit

                }else{
                    in_sp[this.numerito].getElementsByTagName("input")[0].focus();
                    if(in_sp[this.numerito].error==false){
                        if (!in_sp[this.numerito].getElementsByClassName("error")[0]){
                            crear_span_error (in_sp[this.numerito], "Ingrese un error valido")
                        }
                        in_sp[this.numerito].error=true;
                }}
            }else if(in_sp[this.numerito].getElementsByTagName("input")[0].type =="text"){
                    in_sp[this.numerito].getElementsByTagName("input")[0].disabled=true;
                    btn_editar[this.numerito].innerHTML ="Editar";
                    in_sp[this.numerito].classList.remove("guardar");
                    in_sp[this.numerito].classList.add("editar");
                    in_sp[this.numerito].error=false;
                        var get_modal_exito = document.getElementById("exito_msg");
						open_modal(get_modal_exito);
                        var efecto1 = setTimeout(close(get_modal_exito), 600);
                        
                        // hacer submit (envia input no obligatorios)

                }else if(in_sp[this.numerito].getElementsByTagName("input")[0].type =="file"){
                    if (in_sp[this.numerito].getElementsByTagName("input")[0].id=="file-1"){
                        if(in_sp[this.numerito].getElementsByTagName("img")[0]){
                            if(in_sp[this.numerito].getElementsByTagName("img")[0].getAttribute('src') == ""){

                                checkear_input_file (in_sp[this.numerito], "file-1");
                            }else{
                                if (in_sp[this.numerito].getElementsByTagName("input")[0].files[0]){
                                    checkear_input_file (in_sp[this.numerito], "file-1");
                                }
                                if (!in_sp[this.numerito].getElementsByClassName("error")[0]){
                                in_sp[this.numerito].getElementsByTagName("input")[0].disabled=true;
                                btn_editar[this.numerito].innerHTML ="Editar";
                                in_sp[this.numerito].classList.remove("guardar");
                                in_sp[this.numerito].classList.add("editar");
                                in_sp[this.numerito].error=false;
                                var get_modal_exito = document.getElementById("exito_msg");
						        open_modal(get_modal_exito);
                                var efecto1 = setTimeout(close(get_modal_exito), 600);
                                // hacer submit 
                            }
                            }
                        }
                    }else if (in_sp[this.numerito].getElementsByTagName("input")[0].id=="file-2"){
                        var get_input_into = in_sp[this.numerito].getElementsByTagName("input");
                        for (var z=1; z < get_input_into.length; z++){
                            get_input_into[z].numerito=z;
                            if (get_input_into[z].files[0]){
                                console.log(get_input_into[z]);
                                if (pat_img.test(get_input_into[z].files[0].name)){
                                    var size_file = get_input_into[z].files[0].size / 1024;        
                                    if (size_file <= 25000){
                                        if (in_sp[this.numerito].getElementsByClassName("error")[0]){
                                            in_sp[this.numerito].removeChild(in_sp[this.numerito].getElementsByClassName("error")[0]);
                                        }

                                    }else{
                                        get_input_into[z].value="";
                                        if (in_sp[this.numerito].getElementsByClassName("error")[0]){
                                            in_sp[this.numerito].getElementsByClassName("error")[0].innerHTML="El archivo es pesado";
                                        }else{
                                            crear_span_error (in_sp[this.numerito], "El archivo es pesado");
                                        }
                                        get_input_into[z].parentElement.getElementsByTagName("img")[0].src ="";
                                        var eliminar_tacho = get_input_into[z].parentElement.getElementsByClassName("icon-trash-empty")[0];
                                        get_input_into[z].parentElement.removeChild(eliminar_tacho);
                                        get_input_into[z].parentElement.getElementsByTagName("label")[0].getElementsByTagName("span")[0].innerHTML="&#x0002B;";
                                }
                                }else{
                                    get_input_into[z].value="";
                                    if (!in_sp[this.numerito].getElementsByClassName("error")[0]){
                                        crear_span_error (in_sp[this.numerito],"El formato debe ser JPG / PNG");
                                    }else{
                                        in_sp[this.numerito].getElementsByClassName("error")[0].innerHTML="El formato debe ser JPG / PNG";
                                    }
                                    
                                    get_input_into[z].parentElement.getElementsByTagName("img")[0].src ="";
                                }
                            }
                        }
                        if(in_sp[this.numerito].getElementsByTagName("img")[0]){
                            if(in_sp[this.numerito].getElementsByTagName("img")[0].getAttribute('src') == ""){
                                checkear_input_file (in_sp[this.numerito], "file-2");
                            }else{
                                if (in_sp[this.numerito].getElementsByTagName("input")[0].files[0]){
                                    checkear_input_file (in_sp[this.numerito], "file-2");
                                }
                                if (!in_sp[this.numerito].getElementsByClassName("error")[0]){
                                in_sp[this.numerito].getElementsByTagName("input")[0].disabled=true;
                                btn_editar[this.numerito].innerHTML ="Editar";
                                in_sp[this.numerito].classList.remove("guardar");
                                in_sp[this.numerito].classList.add("editar");
                                in_sp[this.numerito].error=false;
                                var get_modal_exito = document.getElementById("exito_msg");
						        open_modal(get_modal_exito);
                                var efecto1 = setTimeout(close(get_modal_exito), 600);
                                var get_input_into = in_sp[this.numerito].getElementsByTagName("input");
                                    for (var z=0; z < get_input_into.length; z++){
                                        get_input_into[z].disabled=true;
                                        if (get_input_into[z].parentElement.getElementsByClassName("icon-trash-empty")[0]){
                                            var borrar_basura= get_input_into[z].parentElement.getElementsByClassName("icon-trash-empty")[0];
                                            get_input_into[z].parentElement.removeChild(borrar_basura);
                                            get_input_into[z].parentElement.getElementsByTagName("label")[0].getElementsByTagName("span")[0].innerHTML="&#x0002B;"

                                        }
                                    }



                                // hacer submit 
                            }
                            }
                        }

                    }else if(in_sp[this.numerito].getElementsByTagName("input")[0].id=="file-7"){

if (in_sp[this.numerito].getElementsByTagName("input")[0].files[0]){
if (pat_pdf.test(in_sp[this.numerito].getElementsByTagName("input")[0].files[0].name)){
    var size_file = in_sp[this.numerito].getElementsByTagName("input")[0].files[0].size / 1024;
    if (size_file <= 25000){
        if (in_sp[this.numerito].getElementsByClassName("error")[0]){
            in_sp[this.numerito].removeChild(in_sp[this.numerito].getElementsByClassName("error")[0]);
        }
    }else{
        in_sp[this.numerito].getElementsByTagName("input")[0].value="";
        if (in_sp[this.numerito].getElementsByClassName("error")[0]){
            in_sp[this.numerito].getElementsByClassName("error")[0].innerHTML="El archivo es pesado";
        }else{
            crear_span_error (in_sp[this.numerito], "El archivo es pesado");
        }
    }                        
}else{
    in_sp[this.numerito].getElementsByTagName("input")[0].value="";
    if (!in_sp[this.numerito].getElementsByClassName("error")[0]){
        crear_span_error (in_sp[this.numerito], "El formato del archivo debe ser PDF");
    }else{
        in_sp[this.numerito].getElementsByClassName("error")[0].innerHTML="El formato del archivo debe ser PDF";
    }
    var delete_span= in_sp[this.numerito].getElementsByClassName("adj_span_del")[0];
    in_sp[this.numerito].removeChild(delete_span);
        var change_span_label =in_sp[this.numerito].getElementsByTagName("label")[0].getElementsByTagName("span");
        in_sp[this.numerito].getElementsByTagName("label")[0].classList.remove("seleccion");
        change_span_label[0].innerHTML="Adjuntar...";
        change_span_label[1].innerHTML="&#x0002B;";
}

}                    

if (!in_sp[this.numerito].getElementsByClassName("error")[0]){
            in_sp[this.numerito].getElementsByTagName("input")[0].disabled=true;
            btn_editar[this.numerito].innerHTML ="Editar";
            in_sp[this.numerito].classList.remove("guardar");
            in_sp[this.numerito].classList.add("editar");
            in_sp[this.numerito].error=false;
            var get_modal_exito = document.getElementById("exito_msg");
            open_modal(get_modal_exito);
            var efecto1 = setTimeout(close(get_modal_exito), 600);
            if(in_sp[this.numerito].getElementsByClassName("icon-trash-empty")[0]){
                in_sp[this.numerito].getElementsByClassName("icon-trash-empty")[0].style.display = "none";
            }
        }         















}

























                }

        
        }}
    }
	}