<?php
    include 'conexión.php';
    include 'funcionBitacora.php';

    session_start();
    //Llamada a la funcion bitacora
    $CodObjeto=5;
    $accion='Ingreso';
    $descrip='Usuario con acceso ingreso a la pantalla principal del sistema';
    bitacora($CodObjeto,$accion,$descrip);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MVA | Principal</title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
</head>
<body  class="hold-transition  sidebar-mini layout-fixed" >
<div class="wrapper">

 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake"  src="dist/img/minuta.png" alt="AdminLTELogo" height="150" width="150">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-info ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars "></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block ">
        <a href="login.php" class="nav-link text-white ">Login</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!--<li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
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
      </li>-->

      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      <!--</li>-->
      <!--<li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>-->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "../vistas/encabezado.php"; ?>    

    

  <!-- Content Wrapper. Contains page content -->
  <div  class="content-wrapper">
    <!-- Content Header (Page header) -->
   <!-- <section   class="content-header">
      <div class="container-fluid">
        <div  class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Principal</li>
            </ol>
          </div>
        </div>
      </div>< /.container-fluid -->
<!--</section>-->

    <!-- Main content --> 
    <section  class="content bg-warning" >
       <!-- Default box  agregado por brayan--> 
       <div  class="card card-solid bg-maroon disabled" > <!--Todo el fondo-->
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6  "> <!--color donde esta la minu-->
              <h3 class="d-inline-block d-sm-none" >LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
              <div class="col-12 ">
                <img src="dist/img/min.jpg" height="300px" width="400px" class="product-image" alt="MVA no hay que mostrar">
               
              
              </div>
              <div class="col-12 product-image-thumbs" >
                <div class=""><img src="dist/img/a.png" height="100px" width="150px"alt="MVA no hay que mostrar"></div>
                <div class=""><img src="dist/img/infla.jpg" height="100px" width="150px" HSPACE="10"alt="MVA no hay que mostrar"></div>
                <div class=""><img src="dist/img/pal.jpg" height="100px" width="130px" HSPACE="10"alt="MVA no hay que mostrar"></div>
                <div class=""><img src="dist/img/fondo1.png" height="100px" width="130px" HSPACE="10"alt="MVA no hay que mostrar"></div>
                <div class=""><img src="dist/img/m.jpg" height="100px" width="130px" HSPACE="10"alt="MVA no hay que mostrar"></div>
                <div class=""><img src="dist/img/minuta.png" height="100px" width="120px" HSPACE="10"alt="MVA no hay que mostrar"></div>
              </div>
            </div>
            <div class="col-12 col-sm-6 ">
              <h3 class="my-3" >MINUTAS VALLE DE ANGELES</h3>
              <p>Nuestra misión ofrecerle a sus clientes la más alta calidad, tanto en alimentos, golosinas y entretenimiento infantil así como en atención, para crear eventos inolvidables y seguir creando sonrisas en los niños.</p>
              <img src="dist/img/imag.png" height="300px" width="400px">
              <hr>
              
              <div class="btn-group btn-group-toggle  " data-toggle="buttons">
               
                
              </div>

              <div class="mt-4 ">
                
                
              </div>


            </div>
          </div>
          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    
       <!-- Main content -->
      
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
</body>
</html>
