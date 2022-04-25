<?php
require 'conexión.php';
session_start();
 include 'funcionbitacora.php';
 // llamado a la bitacor
  /*BITACORA*/
  $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'editar_parametro.php'";
  $consulta1 = mysqli_query($conn,$consulta);
  $valor= mysqli_fetch_array($consulta1);
  $numero=$valor[0];
  //Llamada a la funcion bitacora
  $CodObjeto=$numero;
  $accion='Ingreso';
  $descrip='Pantalla de parametros';
  bitacora($CodObjeto,$accion,$descrip);

//fin bitacora

if (isset($_GET['CodigoParametro'])) {
  $codigo=$_GET['CodigoParametro'];
  $consulta="SELECT * FROM tbl_parametros  WHERE CodigoParametro = $codigo";
  $conResul1=mysqli_query($conn,$consulta);

  if (mysqli_num_rows($conResul1)==1){// si encontramos un resultado
      $fila=mysqli_fetch_array($conResul1);
      $Codigoparametro=$fila['CodigoParametro'];
      $Parametro=$fila['Parametro'];
      $valor=$fila['Valor'];

  }  

 /*
 session_start();

 if (isset($_GET['CodigoUsuario'])) {
  $codigousuario=$_GET['CodigoUsuario'];
  $sql="SELECT CodigoRol, Usuario FROM tbl_usuario where  CodigoUsuario='$codigousuario'";
  $resultado=$conn->query($sql);//guarda la consulta
  $row=$resultado->fetch_assoc();//arreglo asociativo
  $rol=($row['CodigoRol']);  // variable con el rol del usuario
  $nombre=($row['Usuario']);
 }

*/
}
  
     


if (isset($_POST['actualizar'])){
    $id=$_GET['CodigoParametro'];
    $c_valor=$_POST['valor'];
    
    $actualizar="UPDATE  tbl_parametros set  Valor='$c_valor' WHERE CodigoParametro=$id ";
    mysqli_query($conn, $actualizar);
    echo '<script>
    alert(" Se actualizo el parámetro");
    window.location="../mantenimiento/gestion_parametros.php";
    </script>';

}

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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style <link rel="stylesheet" href="../vistas/estilo.css">-->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  <script src="https://kit.fontawesome.com/a1e2fc3c3a.js" crossorigin="anonymous"></script>
<!-- jsGrid -->
<link rel="stylesheet" href="plugins/jsgrid/jsgrid.min.css">
<link rel="stylesheet" href="plugins/jsgrid/jsgrid-theme.min.css">
<link rel="stylesheet" href="../vistas/estilo.css">

  <!-- Theme style -->
  </head>
<body class="hold-transition sidebar-mini layout-fixed" >
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
  <?php include "../vistas/encabezado.php"; ?>    

  <!-- Content Wrapper. Contains page content---------------------------------------------------------------------------------------- -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">  
        <div class="row mb-2">   
          <div class="col-sm-6 ">  
            <h1  class="m-0 ">Gestión parámetros</h1>
          </div><!-- /.col -->
          
          <div class="col-sm-6 " >
            <ol class="breadcrumb float-sm-right ">
              <li class="breadcrumb-item "><a href="principalusuarios.php">Inicio</a></li>
              <li  class="breadcrumb-item active ">Parámetros</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 <!-- Main content -->
 <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <section class="content ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">  
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Gestión mantenimiento</h3>
              </div> 
 
 
 <!-- /.card-header ---------------------------------------------------------------------------------------------------------->
 <div class="form-row">
   

    <div class="form-group col-md-6">
      
    <div class="col-12 my-5">
      <div class="card-header">
                    <h5 class="card-title"> Ingresar nuevo parámetro:</h5>
                </div>
                <form class="p-4" method="POST" action="editar_parametro.php?CodigoParametro=<?php echo $_GET['CodigoParametro'];?>">
                    <div class="mb-3">
                        <label class="form-label">Nuevo parámetro </label>
                        <input type="text" class="form-control" name="parametro1" value="<?php echo $Parametro;?>" disabled="disabled"> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Valor del parámetro: </label>
                        <input type="text" class="form-control" name="valor" value="<?php echo $valor;?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
                          <input type="submit" class="btn btn-primary" value="Guardar" name="actualizar">
                   <?php } ?>
                        <a href="../vistas/gestion_parametros.php" class="btn btn-danger "> Salir</a>
                    </div>
                </form>
            </div>
    </div>
  </div>
  </div>
    </div>


 
 


            
            
              </div>
            </div>
              </div>
             </div>
            </div> <!-- fin rol-->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
             
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script><!-- libreria crud -->
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script><!-- libreria crud -->
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script><!-- libreria crud -->
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script><!-- libreria crud -->
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script><!-- libreria pdf -->
<script src="plugins/pdfmake/vfs_fonts.js"></script><!-- libreria pdf -->
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- jsGrid ------------>
<script src="plugins/jsgrid/demos/db.js"></script>
<script src="plugins/jsgrid/jsgrid.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.templates.min.js"></script>

<script>
 
    

</script>



</body>
</html>