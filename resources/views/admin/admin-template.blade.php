<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Orsai | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url("admin/plugins/fontawesome-free/css/all.min.css")}}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
          href="{{url("admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url("admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url("admin/plugins/jqvmap/jqvmap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url("admin/dist/css/adminlte.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url("admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url("admin/plugins/daterangepicker/daterangepicker.css")}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{url("admin/plugins/summernote/summernote-bs4.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="{{url("admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{url("admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    @yield('header')


    @if(env('ORSAI_ENV') == 'production')
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-176303994-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-176303994-1');
        </script>
    @endif

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('dashboard')}}" class="brand-link">
            <img src="{{url('recursos/comunidad-orsai-blank.png')}}" alt="AdminLTE Logo" class="brand-image"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Dashboard</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{url('admin/usuarios')}}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/concurso')}}" class="nav-link">
                            <i class="nav-icon fas fa-vote-yea"></i>
                            <p>
                                Concurso
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/postulaciones')}}" class="nav-link">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>
                                Postulaciones
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/transacciones')}}" class="nav-link">
                            <i class="nav-icon fas fa-coins"></i>
                            <p>
                                Transacciones
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/contenidos/tipo/noticia')}}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Novedades
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{url('admin/contenidos/tipo/pagina')}}" class="nav-link">
                            <i class="nav-icon fas fa-pager"></i>
                            <p>
                                Páginas
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/notificaciones')}}" class="nav-link">
                            <i class="nav-icon fas fa-mail-bulk"></i>
                            <p>
                                Notificaciones
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('panel')}}" class="nav-link">
                            <i class="nav-icon fas fa-arrow-left"></i>
                            <p>
                                Volver
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('name')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">@yield('name')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>&copy; 2020 <a href="https://amplifica.agency">Amplifica</a></strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 0.1
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url("admin/plugins/jquery/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url("admin/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url("admin/plugins/jqvmap/jquery.vmap.min.js")}}"></script>
<script src="{{url("admin/plugins/jqvmap/maps/jquery.vmap.usa.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url("admin/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{url("admin/plugins/moment/moment.min.js")}}"></script>
<script src="{{url("admin/plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url("admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
<!-- Summernote -->
<script src="{{url("admin/plugins/summernote/summernote-bs4.min.js")}}"></script>
<!-- overlayScrollbars -->
<script src="{{url("admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{url("admin/dist/js/adminlte.js")}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url("admin/dist/js/pages/dashboard.js")}}"></script>
<script src="{{url("admin/plugins/pace-progress/pace.min.js")}}"></script>

<script src="{{url("admin/dist/js/demo.js")}}"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script
    src="{{url("admin/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script
    src="{{url("admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<script
    src="{{url("admin/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
<script
    src="{{url("admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
<script
    src="{{url("admin/plugins/datatables-buttons/js/dataTables.buttons.min.js")}}"></script>
<script
    src="{{url("admin/plugins/datatables-buttons/js/buttons.flash.min.js")}}"></script>
<script
    src="{{url("admin/plugins/datatables-buttons/js/buttons.html5.min.js")}}"></script>
<script
    src="{{url("admin/plugins/datatables-buttons/js/buttons.colVis.min.js")}}"></script>

<script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>
@yield('footer')
</body>
</html>
