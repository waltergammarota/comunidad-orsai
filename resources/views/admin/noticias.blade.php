@extends('admin.admin-template')

@section('header')

@endsection


@section('name')
    Noticias
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/noticias/crear')}}" class="btn btn-primary editar float-right">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Slug</th>
                    <th>Fecha publicación</th>
                    <th>Visible</th>
                    <th>Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('footer')

    <script>
        $(function () {
            const table = $('#example2').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{url('admin/noticias-json')}}",
                "columns": [
                    { "data": "id" },
                    { "data": "title" },
                    { "data": "slug" },
                    { "data": "fecha_publicacion" },
                    {
                        "data": "visible",
                        "render": function (data) {
                            return data == 1? "SI":"NO"
                        }
                    },
                    {
                        "data": "acciones",
                        "render": function (data) {
                            return `<button type="button" class="btn btn btn-success editar">
                                        <i class="fa fa-edit"></i>
                                    </button>`;
                        }
                    },
                ]
            });

            table.on('click', '.editar', function () {
                const data = table.row($(this).parents('tr')).data();
                const id = data.id;
                window.location.href = `{{url('admin/noticias')}}/${id}`;
            });
        });
    </script>
@endsection

