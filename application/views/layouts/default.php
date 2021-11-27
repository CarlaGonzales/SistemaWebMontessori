<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title_for_layout ?></title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.css">
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <?php echo $this->layouts->print_includes_css(); ?>
    <script>
        var base_url = "<?php echo base_url(); ?>";
    </script>
</head>

<body>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-orange navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!--<li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url(); ?>inicio" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url(); ?>personas/" class="nav-link">Personas</a>
                </li>-->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>ingreso/logout" role="button">
                        <i class="fas fa-th-large"></i>Cerrar sesión
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo base_url(); ?>index3.html" class="brand-link">
                <img src="<?php echo base_url(); ?>dist/img/montesori.png" alt="montessori Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PADPRE<sub>Padres Primerizos</sub></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $this->session->userdata('username'); ?></a>
                        <a href="#" class="d-block"><?php echo $this->session->userdata('rol'); ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Menu para el rol administrador -->
                        <?php if ($this->session->userdata('rol') == 'Administrador') { ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Inicio
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>inicio" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Inicio</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>personas/" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Personas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>contenido/" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contenidos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>curso/" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cursos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>categoria/" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Categorias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>area/" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Areas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('rol') == 'Tutor') { ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Inicio
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>inicio" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Inicio</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>contenido/listar" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Publicaciones</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Cursos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>curso/miscursos" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Mis aprendizaje</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>curso/sugerencias" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Sugerencias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>curso/tutorial" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Tutorial</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($this->session->userdata('rol') == 'Especialista') { ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Inicio
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>inicio" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Inicio</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>contenido/" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Contenido</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>curso/" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Cursos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Reportes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>curso/reporte" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Curso</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>personas/reporte" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Estudiante</p>
                                        </a>
                                    </li>
                                    <!--<li class="nav-item">
                                        <a href="<?php echo base_url(); ?>area/reporte" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Area</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url(); ?>area/categoria" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Categoria</p>
                                        </a>
                                    </li>-->
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $content_for_layout; ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.1.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>dist/js/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <?php echo $this->layouts->print_includes_js(); ?>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>