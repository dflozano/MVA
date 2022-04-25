<?php

 include 'conexión.php';

 session_start();
 include 'funcionbitacora.php';

 $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'mantenimiento.php'";
 $consulta1 = mysqli_query($conn,$consulta);
 $valor= mysqli_fetch_array($consulta1);
 $numero=$valor[0];
 //Llamada a la funcion bitacora
 $CodObjeto=$numero;
 $accion='Ingreso';
 $descrip='Pantalla de Mantenimiento';
 bitacora($CodObjeto,$accion,$descrip);
 
 //fin bitacora
 //permisos-----------------------------------------------------------------------------------------------------------------
 
 ///codigo que asocia el rol del usuario y asiga el permiso
 $usuariorol= $_SESSION['usuario'];//traer nombre del usuario que tiene la seccion
 $sql_consulta="SELECT CodigoRol, Usuario FROM tbl_usuario where  Usuario='$usuariorol'";
 $resultado_consulta=$conn->query($sql_consulta);//guarda la consulta
 $row1=$resultado_consulta->fetch_assoc();//arreglo asociativo
 $rol=($row1['CodigoRol']);  
 
 //PERMISO
 $permiso="SELECT CodigoPermiso, CodigoObjeto, CodigoRol, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion,Permiso_Consultar FROM tbl_permisos where CodigoObjeto ='$CodObjeto' AND CodigoRol=' $rol' ";
 $datos56 = mysqli_query ($conn,$permiso);
 $fila56= mysqli_fetch_array ($datos56);
 error_reporting(0);//oculta el error cuando no se ha otrogado el permiso
 $codigopermiso=$fila56[0];
 $permiso_insertar=$fila56[3];
 $permiso_eliminar=$fila56[4];
 $permiso_actualizar=$fila56[5];
 $permiso_consultar=$fila56[6];
 //fin permisos--------------------------------------------------------------------------------------------------------------------
 $parametro1="SELECT Valor from tbl_parametros where Parametro = 'ADMIN_NOMBRE_REPORTE'";
 $datos1 = mysqli_query ($conn,$parametro1);
 $fila1= mysqli_fetch_array ($datos1);
 $codigo_nombre_empresa=$fila1['Valor'];
 
 

?>

  <!-- Main Sidebar Container -->
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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <?php include "../vistas/encabezado.php"; ?>    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mantenimiento</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/principalusuarios.php">Inicio</a></li>
              <li class="breadcrumb-item active">Mantenimiento</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Descripcion from tbl_estadousuario";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Estado de Usuario</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:person-circle-outline"></span>
              </div>
              <a href="../mantenimiento/Man_Estado_Usuario.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Rol from tbl_roles";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Roles</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:sync-outline"></span>
              </div>
              <a href="../mantenimiento/mantenimiento_roles.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gray-dark">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT TipoPersona from tbl_tipopersona";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Tipo de Personas</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:people"></span>
              </div>
              <a href="../mantenimiento/mantenimiento_tipopersona.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Descripcion from tbl_estadopedido";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Estado de los Pedido</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:logo-usd"></span>
              </div>
              <a href="../mantenimiento/estadopedido.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-lightblue">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Nombre from tbl_extra";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Extras</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:logo-usd"></span>
              </div>
              <a href="../mantenimiento/extras.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Estado from tbl_estadoevento";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Estado de los Evento</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:logo-usd"></span>
              </div>
              <a href="../mantenimiento/Man_Estado_Evento.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Descripcion from tbl_tipocatalogoevento";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Tipo Catálago Evento</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:restaurant"></span>
              </div>
              <a href="../mantenimiento/mantenimiento_tipo_catalogo_eventos.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Estado from tbl_estadocompras";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Estado de Compras</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:cart-sharp"></span>
              </div>
              <a href="../mantenimiento/mantenimiento_estado_compras.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Descripcion from tbl_tipokardex";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Tipo de Kardex</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:repeat"></span>
              </div>
              <a href="../mantenimiento/tipokardex.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-pink">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Pregunta from tbl_preguntapredeterminada";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Preguntas Secretas</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:help"></span>
              </div>
              <a href="../mantenimiento/gestion_preguntas.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Parametro from tbl_parametros";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Parámetros</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:scale"></span>
              </div>
              <a href="../mantenimiento/gestion_parametros.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
              <?php
                require 'conexión.php';

               $query = "SELECT Rol from tbl_roles";
               $query_run = mysqli_query($conn,$query);

               $row1 = mysqli_num_rows($query_run);
               echo "<h3>".$row1."</h3>"
            ?>
                <p>Mesas</p>
              </div>
              <div class="icon">
              <span class="iconify" data-icon="ion:sync-outline"></span>
              </div>
              <a href="../mantenimiento/mesas.php" class="small-box-footer">Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
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


             <?php  if($permiso_eliminar==1){?><!-- ejemplo quitar permiso de eliminar------------------------------------------------------------->
             
             <?php } ?>
             <?php } ?> <!--  finn ocultat permiso de ocultar ------------------------------------------------------------->
    <!-- /.content -->
    <?php  if($permiso_consultar==0){?> <!--si lo hay permiso de consultar  ------------------------------------------------------------->
     
      <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Error!</strong> <strong>005</strong> Contacta con el administrador.
</div>

      <?php } ?> <!---------------------------  fin mensaje de oculto----------------------------------->
  
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
<script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>

</body>
</html>


 