<?php
include 'conexión.php';
include 'funcionBitacora.php';
  session_start();
//Llamada a la funcion bitacora
    
$consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'eventos_borrarcatalogo.php'";
$consulta1 = mysqli_query($conn,$consulta);
$valor= mysqli_fetch_array($consulta1);
$numero=$valor[0];
//Llamada a la funcion bitacora
$CodObjeto=$numero;
$accion='Ingreso';
$descrip='Pantalla de MAntenimiento Estado Evento';
bitacora($CodObjeto,$accion,$descrip);

//fin bitacora

  $cod=$_GET['CodigoCatalogoEvento'];

  if(isset($_POST['Aceptar'])) {
    if ('Aceptar'){
      $query = "DELETE FROM tbl_detalleevento WHERE CodigoCatalogoEvento  = $cod";
      $result= mysqli_query($conn,$query);

      $query1 = "DELETE FROM tbl_catalogoeventospredeterminados WHERE CodigoCatalogoEvento = $cod";
      $result1= mysqli_query($conn,$query1);
    echo '<script>
        window.location="eventos_cata.php";
        </script>';
    }
    else{
        echo '<script>
      alert(" Verifique si lo elimino bien  ");
      window.location="eventos_cata.php";
      </script>';
    }
  }
  
  if (isset($_POST['Salir'])){
    if ($_POST['Salir']){
        echo '<script>
        window.location="eventos_cata.php";
        </script>';
    }
  }
  
  
  if (isset($_GET['CodigoCatalogoEvento'])) {
    $Cod = $_GET['CodigoCatalogoEvento'];
    $consulta="SELECT CodigoCatalogoEvento, CantidadPersonas, GROUP_CONCAT(CONCAT_WS(',  ', Descripcion)) as Descripcion, sum(preciototal) as PrecioTotal FROM tbl_detalleevento 
    where CodigoCatalogoEvento='$cod'
    group by CodigoCatalogoEvento, CantidadPersonas ";
    $conResul=mysqli_query($conn,$consulta);
    $valores= mysqli_fetch_array ($conResul);
    $c=$valores['CantidadPersonas'];
    $d=$valores['Descripcion'];
    $p=$valores['PrecioTotal'];
  }
  
       ///codigo que asocia el rol del usuario y asiga el permiso
       $usuariorol= $_SESSION['usuario'];//traer nombre del usuario que tiene la seccio
       $sql_consulta="SELECT CodigoRol, Usuario FROM tbl_usuario where  Usuario='$usuariorol'";
       $resultado_consulta=$conn->query($sql_consulta);//guarda la consulta
       $row1=$resultado_consulta->fetch_assoc();//arreglo asociativo
       $rol=($row1['CodigoRol']);  
       
       //--------------------------------------------------PERMISO
       $permiso="SELECT CodigoPermiso, CodigoObjeto, CodigoRol, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion,Permiso_Consultar FROM tbl_permisos where CodigoObjeto ='$CodObjeto' AND CodigoRol=' $rol' ";
       $datos56 = mysqli_query ($conn,$permiso);
       $fila56= mysqli_fetch_array ($datos56);
       error_reporting(0);//oculta el error cuando no se ha otrogado el permiso
       $codigopermiso=$fila56[0];
       $permiso_insertar=$fila56[3];
       $permiso_eliminar=$fila56[4];
       $permiso_actualizar=$fila56[5];
       $permiso_consultar=$fila56[6];
       //--------------------------------------------------PERMISO
     
   ?>
  
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MVA | Software</title>
    <link rel="icon" type="image/png" href="dist/img/minuta.png">
  
  
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake"  src="dist/img/minuta.png" alt="AdminLTELogo" height="150" width="150">
    </div>
  
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="" class="nav-link">Inicio</a>
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
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
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
    <!-- Main Sidebar Container -->
    <?php include "../vistas/encabezado.php"; ?>    
  
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href=".php">Inicio</a></li>
                <li class="breadcrumb-item active">Eliminar</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
    
      
      <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->
      
  
  
  
  
      <div class="content-wrapper">
  <section id="content-header">
    <div class="data_delete">
    <div class="col-md-8">
    <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">¿Está seguro de eliminar Catalago?</h3>
                </div>
               <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="POST" autocomplete="off">
  
                <div class="card-body">
                <div class="card-body">
                    <p>Cantidad Personas:<span> <?php echo $c; ?></span></p>
                    <p>Descripción:<span> <?php echo $d; ?></span></p>
                    <p>Precio Total:<span> <?php echo $p; ?></span></p>
                    </div>
                    </div>
                  <!-- /.card-body -->
                  <div class="row mb-2">
            <div class="col-sm-6">
            <ol class="float-sm-left">
            <?php  if($permiso_eliminar==1){?><!-- ejemplo quitar permiso de eliminar------------------------------------------------------------->
                         <button name='Aceptar' value="btnupdate" type="submit" class="btn btn-danger">Borrar</button>
  
               <?php } ?>
              </ol>
            </div>
            <div class="col-sm-5">
              <ol class="float-sm-right">
              <button name='Salir' value="btnupdate" type="submit" class="btn btn-danger">Salir</button>
              </ol>
            </div>
                    </div>
                    
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
  
  
            <!-- /.row -->
            </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  
  <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
               
               <?php } ?>
  
  
             <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
               
               <?php } ?>               
               <?php } ?> <!--  finn ocultat permiso de ocultar ------------------------------------------------------------->
      <!-- /.content -->
      <?php  if($permiso_consultar==0){?> <!--si lo hay permiso de consultar  ------------------------------------------------------------->
       
        <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡Error!</strong> <strong>005</strong> Contacta con el administrador.
  </div>
  
        <?php } ?> <!---------------------------  fin mensaje de oculto----------------------------------->
    
              
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
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
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


