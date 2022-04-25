<?php 
include 'conexión.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MVA | Software</title>
    <link rel="icon" type="image/png" href="dist/img/minuta.png">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/minuta.png" alt="AdminLTELogo" height="150" width="150">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../vistas/principalusuarios.php" class="nav-link">Inicio</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>


                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include "../vistas/encabezado.php"; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Restaurar</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../vistas/principalusuarios.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Restarar</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-dark"> Respaldo de Base de Datos</h3>
                                </div>

                                <div class="card-body">

                                </div>
                                <div class="content-wrapper text-dark">
                                    <section id="content-header">
                                        <div class="data_delete">
                                            <div class="col-md-8">
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Respaldos</h3>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <!-- form start -->
                                                    <?php

                                                    if (! empty($response)) {
                                                        ?>
                                                    <div class="response <?php echo $response["type"]; ?>
                                                                               ">
                                                        <?php echo nl2br($response["message"]); ?>
                                                    </div>
                                                    <?php
                                                      }
                                                      ?>
                                                    <form method="post" action="" enctype="multipart/form-data"
                                                        id="frm-restore">
                                                        <br>
                                                        <div class="form-row">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<div class="text-dark"> Elija el
                                                                Respaldo </div>
                                                            <div>
                                                                <input type="file" name="backup_file"
                                                                    class="input-file" />
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
                                                                type="submit" name="restore" value="Restaurar"
                                                                class="btn-action btn btn-success" />

                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#myModal">
                                                                Respaldar
                                                            </button>
                                                        </div>
                                                    </form>

                                                    <?php
                            $conn = mysqli_connect("localhost", "root", "", "minutasv");
                            if (! empty($_FILES)) {
                                // Validating SQL file type by extensions
                                if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
                                    "sql"
                                ))) {
                                    echo "<script> alert('El archivo seleccionado no es correcto ');
                                              Windows:location ='../vistas/administracion.php'
                                                        </script> ";
                                    
                                } else {
                                    if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
                                        move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
                                        $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
                                    }
                                }
                            }

                            function restoreMysqlDB($filePath, $conn)
                            {
                                $sql = '';
                                $error = '';
                                
                                if (file_exists($filePath)) {
                                    $lines = file($filePath);
                                    
                                    foreach ($lines as $line) {
                                        
                                        // Ignoring comments from the SQL script
                                        if (substr($line, 0, 2) == '--' || $line == '') {
                                            continue;
                                        }
                                        
                                        $sql .= $line;
                                        
                                        if (substr(trim($line), - 1, 1) == ';') {
                                            $result = mysqli_query($conn, $sql);
                                            if (! $result) {
                                                $error .= mysqli_error($conn) . "n";
                                            }
                                            $sql = '';
                                        }
                                    } // end foreach
                                    
                                    if ($error) {
                                        echo "<script> alert('La restauración de la base de datos se completó correctamente. :)');
                                                    Windows:location ='../vistas/administracion.php'
                                              </script> ";
                                    } else {
                                        $response = array(
                                            "type" => "success",
                                            "message" => "Error al hacer la restauración."
                                        );
                                    }
                                } // end if file exists
                                return $response;
                            }
                            ?>
                                                    <br>

                                                    <p class="mb-1 ">
                                                    <form>
                                                        <div>

                                                        </div>


                                                        <div style="text-align: right;width:420px">
                                                            <p class="mb-1 ">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;<a
                                                                    href="../vistas/principalusuarios.php" <i
                                                                    class="btn btn-danger"></i>
                                                                    Salir</a>
                                                            <p></p>
                                                    </form>

                                                    </ol>
                                                </div>
                                            </div>
                                            <!-- /.card-footer -->
                                            </form>
                                            <!-- The Modal -->
                                            <div class="modal" id="myModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Respaldar</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <form action="database_backup.php" method="post" id="">

                                                                <div class="form-group">
                                                                    <label class=" control-label mb-10">Servidor</label>
                                                                    <?php
                                                                        $sql = "SELECT valor FROM tbl_parametros WHERE Parametro = 'SERVIDOR_BD'";
                                                                        $res = mysqli_query($conn, $sql);
                                                                        $ser = mysqli_fetch_array($res);
                                                                        ?>
                                                                    <input type="text"
                                                                        style="margin:auto; width : 400px; heigth : 1px"
                                                                        class="form-control"
                                                                        placeholder="Ingrese Nombre del Servidor"
                                                                        value="<?php echo $ser[0]; ?>" name="server"
                                                                        id="server" required="" autocomplete="on">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label mb-10">Nombre de usuario
                                                                        de
                                                                        la Base de Datos </label>
                                                                    <?php
                                                                          $sql = "SELECT valor FROM tbl_parametros WHERE Parametro = 'USUARIO_BD'";
                                                                          $resU = mysqli_query($conn, $sql);
                                                                          $usu = mysqli_fetch_array($resU);
                                                                          ?>
                                                                    <input type="text"
                                                                        style="margin:auto; width : 400px; heigth : 1px"
                                                                        class="form-control"
                                                                        placeholder="Ingrese el Nombre de Usuario "
                                                                        value="<?php echo $usu[0];  ?>" name="username"
                                                                        id="username" required="" autocomplete="on">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="pull-left control-label mb-10">Contraseña
                                                                        del Servidor</label>
                                                                    <?php
                                                                          $sql = "SELECT valor FROM tbl_parametros WHERE Parametro = 'CONTRASEÑA_BD'";
                                                                          $resC = mysqli_query($conn, $sql);
                                                                          $con = mysqli_fetch_array($resC);
                                                                          ?>
                                                                    <input type="password"
                                                                        style="margin:auto; width : 400px; heigth : 1px"
                                                                        class="form-control"
                                                                        placeholder="Ingrese Contraseña "
                                                                        name="password" value="<?php echo $con[0]; ?>"
                                                                        id="password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="pull-left control-label mb-10">Nombre
                                                                        de
                                                                        la Base de datos que desea Respaldar</label>
                                                                    <?php
                                                                        $sql = "SELECT valor FROM tbl_parametros WHERE Parametro = 'NOMBRE_BD_RESPALDAR'";
                                                                        $resN = mysqli_query($conn, $sql);
                                                                        $nom = mysqli_fetch_array($resN);
                                                                        ?>
                                                                    <input type="text"
                                                                        style=" margin:auto; width : 400px; heigth : 1px"
                                                                        class="form-control"
                                                                        placeholder="Ingrese Nombre de la Base de Datos"
                                                                        value="<?php echo $nom[0];   ?>" name="dbname"
                                                                        id="dbname" required="" autocomplete="on">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="pull-left control-label mb-10">Nombre
                                                                        del
                                                                        Respaldo</label>

                                                                    <input type="text"
                                                                        style=" margin:auto; width : 400px; heigth : 1px"
                                                                        class="form-control"
                                                                        placeholder="Ingrese Nombre del Respaldo"
                                                                        value="" name="dbnombre" id="dbnombre"
                                                                        required="" autocomplete="on">
                                                                </div>





                                                                <div class="form-group text-center">
                                                                    <button type="submit" name="backupnow"
                                                                        class="btn btn-info btn-rounded">Iniciar
                                                                        Respaldo</button>
                                                                    <!-- <button type="submit" name="backupnow"
        class="btn btn-danger btn-rounded">Salir</button> -->
                                                                </div>

                                                            </form>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Salir</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.container-fluid -->
                                    </section>



                                    <!-- /.content-wrapper -->

                                    <!-- Control Sidebar -->
                                    <aside class="control-sidebar control-sidebar-dark">
                                        <!-- Control sidebar content goes here -->
                                    </aside>
                                    <!-- /.control-sidebar -->
                                </div>
                                <!-- ./wrapper -->

                                <!-- jQuery -->
                                <script src="plugins/jquery/jquery.min.js"></script>
                                <!-- jQuery UI 1.11.4 -->
                                <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
                                <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
                                <script>
                                $.widget.bridge('uibutton', $.ui.button)
                                </script>
                                <!-- Bootstrap 4 -->
                                <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                                <!-- ChartJS -->
                                <script src="plugins/chart.js/Chart.min.js"></script>
                                <!-- Sparkline -->
                                <script src="plugins/sparklines/sparkline.js"></script>
                                <!-- JQVMap -->
                                <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
                                <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
                                <!-- jQuery Knob Chart -->
                                <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
                                <!-- daterangepicker -->
                                <script src="plugins/moment/moment.min.js"></script>
                                <script src="plugins/daterangepicker/daterangepicker.js"></script>
                                <!-- Tempusdominus Bootstrap 4 -->
                                <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
                                </script>
                                <!-- Summernote -->
                                <script src="plugins/summernote/summernote-bs4.min.js"></script>
                                <!-- overlayScrollbars -->
                                <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
                                <!-- AdminLTE App -->
                                <script src="dist/js/adminlte.js"></script>
                                <!-- AdminLTE for demo purposes -->
                                <script src="dist/js/demo.js"></script>
                                <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
                                <script src="dist/js/pages/dashboard.js"></script>
                                <!-- DataTables  & Plugins -->
                                <script src="plugins/datatables/jquery.dataTables.min.js"></script>
                                <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                                <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                                <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                                <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
                                <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
                                <script src="plugins/jszip/jszip.min.js"></script>
                                <script src="plugins/pdfmake/pdfmake.min.js"></script>
                                <script src="plugins/pdfmake/vfs_fonts.js"></script>
                                <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
                                <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
                                <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
                                <script>
                                windows.onload = function ejemple1() {
                                    alert('prueba :)');
                                }
                                </script>
</body>

</html>