@extends('2021-orsai-template')

@section('title', 'Mis postulaciones | Comunidad Orsai')
@section('description', 'Mis postulaciones')

@section('content')

    <section class="resaltado_gris pd_20_tp_bt ">
        <div class="contenedor ft_size form_rel">
            <div class="grilla_perfil ">
                <div class="miga_pan">
                    <ul>
                        <li><a href="{{url('panel')}}" rel="noopener noreferrer">Panel de usuario <span
                                    class="icon-right-open"></span></a></li>
                        <li><a href="#" class="activo" rel="noopener noreferrer">Mis Postulaciones</a></li>
                    </ul>
                    <div class="height_20"></div>
                </div>
            </div>
        </div>
        <article class="contenedor ft_size form_rel pd_15_extra">
            <div class="interna_panel_blanco">
                <div class="form_central_3">
                    <div class="border_bt_form">
                        <div class="titulo titulo_sin_mg">
                            <h1 class="text_regular">Mis Postulaciones</h1>
                         </div>
                         @if($postulaciones)
                         <div class="subtitle">
                            <p>Revisá tu correo electrónico para hacer un seguimiento de tus postulaciones enviadas.<br/>Si tenés alguna rechazada, no olvides hacer los cambios que te pedimos.</p>
                         </div>
                         @endif
                    </div>
                    <div class="height_20"></div>
                </div> 
                <div class="form_central_3 "> 
                    <div class="tran_creditos">
                        @if($postulaciones)
                            <div class="cont_tabla">
                                <table class="light-3" id="mis_postulaciones_table">
                                    <thead>
                                        <tr> 
                                            <th>Postulación</th>
                                            <th>Concurso</th>
                                            <th>Fecha y hora de postulación</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($postulaciones as $postulacion)
                                        <tr> 
                                            <td>{{$postulacion->title}}</td>
                                            {{-- TODO DEFINIR IMAGEN DE CADA TIPO--}}
                                            <td>{{$postulacion->contest()->first()->name}}</td>
                                            <td>{{$postulacion->created_at->subHours(3)->format('d/m/Y H:i')}}</td>
                                            <?php $status = $postulacion->status()->first(); ?>
                                            @if($status->status  == 'approved')
                                                <td><a href="{{url('postulacion/'.$postulacion->id)}}"
                                                    class="estado_postulacion estado_aprobado"><p>Aprobada</p><span class="icon-check"></span></a></td>
                                            @elseif($status->status == "rejected")
                                                <td><a href="{{url('postulacion/'.$postulacion->id)}}"
                                                    class="estado_postulacion estado_rechazado"><p>Rechazada</p><span class="icon-times-solid"></span></a></td>
                                            @elseif($status->status== "draft")
                                                <td><a href="{{url('postulacion/'.$postulacion->id)}}"
                                                    class="estado_postulacion"><p>Borrador</p><span class="icon-pencil-alt-solid"></span></a></td>
                                            @elseif($status->status== "sent")
                                                <td><a href="{{url('postulacion/'.$postulacion->id)}}"
                                                    class="estado_postulacion"><p>En revisión</p><span class="icon-eye-regular"></span></a></td>
                                            @endif
                                        </tr>
                                    @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="sin_postulaciones">
                                <img src="{{url('estilos/front2021/assets/sin_postulaciones.svg')}}" alt="No tenes postulaciones" />
                                <h3>No tenés postulaciones.</h3>
                                <p>Mirá si hay concursos activos y empezá a participar.</p>
                                <div class="form_ctrl buttons">
                                    <div class="input_err">
                                        <div class="label-centers">
                                            <a class="boton_redondeado resaltado_amarillo" href="#sin_fichas" rel="modal:open">Ver concursos</a> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </article>

    </section>
@endsection

@section('footer')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
    <script>
        const lang = {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "No hay datos disponibles.",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        };

        $(document).ready(function () {
            $('#mis_postulaciones_table').DataTable({
                "searching": false,
                "lengthChange": false,
                "paging": true,
                "info": false,
                "ordering": true,
                "order": [[0, "desc"]],
                language: lang,
            });
        });
    </script>
@endsection




