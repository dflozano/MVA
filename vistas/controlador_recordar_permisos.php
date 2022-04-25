<?php
 include 'conexión.php';
 //traer el id
   // trer el rol
   session_start();
   include 'funcionbitacora.php';



if (isset($_GET['CodigoPermiso'])) {
  $codigo_permiso=$_GET['CodigoPermiso'];
  $consulta_permiso=" SELECT p.CodigoPermiso, p.Permiso_Insercion ,p.Permiso_Eliminacion, p.Permiso_Actualizacion, p.Permiso_Consultar, o.Objeto ,r.CodigoRol, r.Rol FROM tbl_permisos 
  as p INNER join tbl_objetos as o ON p.CodigoObjeto=o.CodigoObjeto 
  INNER JOIN tbl_roles as r ON p.CodigoRol=r.CodigoRol where p.CodigoPermiso=$codigo_permiso ";
  $conResul1=mysqli_query($conn,$consulta_permiso);

  if (mysqli_num_rows($conResul1)==1){// si encontramos un resultado
      $fila=mysqli_fetch_array($conResul1);
      $Codigoparametro=$fila['CodigoPermiso'];
      $r_objeto=$fila['Objeto'];
      $r_rol=$fila['Rol'];
      $codigo_rol=$fila['CodigoRol'];
      $permiso_recordar_insertar=$fila['Permiso_Insercion'];
      $permiso_recordar_eliminar=$fila['Permiso_Eliminacion'];
      $permiso_recordar_actualizar=$fila['Permiso_Actualizacion'];
      $permiso_recordar_consultar=$fila['Permiso_Consultar'];
  }  

 
}
  
     
 if($codigo_rol==1)/// si el sol es el 1 osea el admin
  {

if (isset($_POST['actualizar_p'])){
    $id=$_GET['CodigoPermiso'];
   
    
    $permisos='';

if(isset($_POST['permisos1'])){
    $permisos1=$permisos.''.$_POST['permisos1'];
    $insertar=$permisos1;

}
else{
    $insertar=1;
}
if(isset($_POST['permisos2'])){
    $permisos2=$permisos.''.$_POST['permisos2'];
    $eliminar=$permisos2;
    
}
else{
    $eliminar=1;
}
if(isset($_POST['permisos3'])){
    $permisos3=$permisos.''.$_POST['permisos3'];
    $actualizar=$permisos3;
    
}
else{
    $actualizar=1;
}
if(isset($_POST['permisos4'])){
    $permisos4=$permisos.''.$_POST['permisos4'];
    $consultar=$permisos4;
    
}
else{
    $consultar=1;
}


$actualizar="UPDATE tbl_permisos SET  Permiso_Insercion='$insertar', Permiso_Eliminacion='$eliminar', Permiso_Actualizacion='$actualizar', Permiso_Consultar='$consultar' WHERE  CodigoPermiso= $id";
$ejecutar_insertar_ficha2=mysqli_query($conn,$actualizar); 
echo '<script>
alert(" Se actualizaron los permisos ");
window.location="../vistas/gestion_permisos.php";
</script>';  
 
}
}

else{
  if (isset($_POST['actualizar_p'])){
    $id=$_GET['CodigoPermiso'];
   
    
    $permisos='';

if(isset($_POST['permisos1'])){
    $permisos1=$permisos.''.$_POST['permisos1'];
    $insertar=$permisos1;

}
else{
    $insertar=0;
}
if(isset($_POST['permisos2'])){
    $permisos2=$permisos.''.$_POST['permisos2'];
    $eliminar=$permisos2;
    
}
else{
    $eliminar=0;
}
if(isset($_POST['permisos3'])){
    $permisos3=$permisos.''.$_POST['permisos3'];
    $actualizar=$permisos3;
    
}
else{
    $actualizar=0;
}
if(isset($_POST['permisos4'])){
    $permisos4=$permisos.''.$_POST['permisos4'];
    $consultar=$permisos4;
    
}
else{
    $consultar=0;
}


$actualizar="UPDATE tbl_permisos SET  Permiso_Insercion='$insertar', Permiso_Eliminacion='$eliminar', Permiso_Actualizacion='$actualizar', Permiso_Consultar='$consultar' WHERE  CodigoPermiso= $id";
$ejecutar_insertar_ficha2=mysqli_query($conn,$actualizar); 
echo '<script>
alert(" Se actualizaron los permisos ");
window.location="../vistas/gestion_permisos.php";
</script>';  
 
}
}



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
            <h1  class="m-0 ">Gestión Permisos</h1>
          </div><!-- /.col -->
          
          <div class="col-sm-6 " >
            <ol class="breadcrumb float-sm-right ">
              <li class="breadcrumb-item "><a href="principalusuarios.php">Inicio</a></li>
              <li  class="breadcrumb-item active ">Permisos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 <!-- Main content -->
    <section class="content ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">  
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Gestión Usuarios</h3>
                
              </div> 
 
 
              <!-- /.card-header ---------------------------------------------------------------------------------------------------------->
              <div class="card-body">
              <form method="POST" action="../vistas/controlador_recordar_permisos.php?CodigoPermiso=<?php echo $_GET['CodigoPermiso'];?>"> 
              <p class="text-center"> Editar permisos </p>
              <div class="container">
              <div class="row">
              <div class="form-group col-md-4">
               
              <div class="mb-3">
                        <label class="form-label">Rol: </label>
                        <input type="text" class="form-control" name="rol" value="<?php echo $r_rol; ?>" disabled="disabled"> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Objeto: </label>
                        <input type="text" class="form-control" name="objeto" value="<?php echo $r_objeto; ?>" disabled="disabled">
                    </div>     
               
            </div> <!-- fin rol-->
             <!-- PERMISOS-->
             <div class="w-100"></div>
             <label for="codigo">Permisos</label>
            
                 <div class="form-check">
                 <br>
                 <input class="form-check-input" type="checkbox" value="1"  name="permisos1" value="<?php echo $permiso_recordar_insertar;?>" <?php if ($permiso_recordar_insertar == 1) echo "checked";?> >
                 <label class="form-check-label" for="insertar">
                  Insertar
                  </label>
                  </div> 

                <div class="form-check">
                <br>
                 <input class="form-check-input" type="checkbox" value="1" name="permisos2"  value="<?php echo $permiso_recordar_eliminar;?>" <?php if ($permiso_recordar_eliminar == 1) echo "checked";?>>
                 <label class="form-check-label" for="eliminar">
                  Eliminar
                  </label>
                  </div>  

                 <div class="form-check">
                 <br>
                 <input class="form-check-input" type="checkbox" value="1" name="permisos3" value="<?php echo $permiso_recordar_actualizar;?>" <?php if ($permiso_recordar_actualizar== 1) echo "checked";?> >
                 <label class="form-check-label" for="actualizar">
                  Actualizar
               </label>
                </div>
                  
                <div class="form-check">
                <br>
                 <input class="form-check-input" type="checkbox" value="1" name="permisos4" value="<?php echo $permiso_recordar_consultar;?>" <?php if ($permiso_recordar_consultar == 1) echo "checked";?> >
                 <label class="form-check-label" for="consultar">
                  Consultar
               </label>
                </div>
               
                <div class="col-12">
                <br>
                <br>
                <button type="submit" class="btn btn-primary" name="actualizar_p">Guardar</button>
                <a href="../vistas/gestion_permisos.php" class="btn btn-danger "> Salir</a>
                </div>
               
              </form>  
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.templates.min.js"></script>





</body>
</html>
