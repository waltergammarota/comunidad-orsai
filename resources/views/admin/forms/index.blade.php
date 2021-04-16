@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    Formularios
@endsection

@section('content')
    <style>
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        table {
            font-size: 14px;
        }

    </style>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card card-warning card-outline">
        <div class="card-header">
            <a href="{{ route('forms.create') }}" class="btn btn-warning editar float-right">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="card-body">
            <table id="form-table" class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th class="text-center">Concursos</th>
                        <th>Creado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($forms as $form)
                        <tr>
                            <td class="text-right">
                                {{ $form->id }}
                            </td>
                            <td>
                                {{ $form->name }}
                            </td>
                            <td>
                                {{ $form->title }}
                            </td>
                            <td>
                                {{ $form->description }}
                            </td>
                            <td class="text-center">
                                {{ $form->contests }}
                            </td>
                            <td>
                                {{ date('j/m/Y G:i', strtotime($form->created_at)) }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('forms.edit', $form->id) }}" class="btn btn-xs btn-success editar" data-toggle="tooltip" title="Editar formulario">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if ($form->contests == 0)
                                    <a href="{{ route('forms.delete', $form->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Editar formulario">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection



@section('footer')
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {

            const formDataTable = $('#form-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,

                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],

                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ entradas",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando _START_ al _END_ de un total de _TOTAL_ entradas",
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
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                }
            });


        });

    </script>
@endsection
