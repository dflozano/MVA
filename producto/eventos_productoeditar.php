<?php 
include ('conexión.php');
include 'funcionBitacora.php';
  session_start();
       $CodObjeto=23;
  $accion='Update';
  $descrip='Se hizo un Update en catálago de Producto Evento';
  bitacora($CodObjeto,$accion,$descrip);
 
if (isset($_GET['CodigoCatalogoProductoEvento'])) {
    $cod=$_GET['CodigoCatalogoProductoEvento'];
    $consulta2="SELECT c.CodigoCatalogoProductoEvento, t.CodigoTipoCatalogo, t.Descripcion, c.NombreProducto, c.PrecioTotal 
    FROM tbl_catalogoproductoeventos as c INNER JOIN tbl_tipocatalogoevento as t on c.CodigoTipoCatalogo = t.CodigoTipoCatalogo where CodigoCatalogoProductoEvento= $cod";
    $conResul1=mysqli_query($conn,$consulta2);
  
    if (mysqli_num_rows($conResul1)==1){
        $fila=mysqli_fetch_array($conResul1);
        $CodigoCatalogoProductoEvento=$fila['CodigoCatalogoProductoEvento'];
    }  
  }
  
$sql = "SELECT * FROM tbl_tipocatalogoevento";
    // echo $sql . "<br>";
    $query_descripcion = mysqli_query($conn, $sql );
    $resultado_descripcion = mysqli_num_rows($query_descripcion);
    $opciones_descripcion = ' ';

if ( $resultado_descripcion > 0 ){
      while ($descripcion = mysqli_fetch_array($query_descripcion) ){
        $opciones_descripcion .= '<option value="'.$descripcion['CodigoTipoCatalogo'].'">' .$descripcion['Descripcion'] . '</option>';
      }
    }


      if (isset($_POST['btnguardar'])){
        $cod=$_GET['CodigoCatalogoProductoEvento'];
        $descripcion = $_POST['CodigoTipoCatalogo'];
        $nombre = $_POST['NombreProducto'];
        $precio  = $_POST['PrecioTotal'];
        if ($_POST['CodigoTipoCatalogo']){
            $consula=mysqli_query($conn,"UPDATE tbl_catalogoproductoeventos SET CodigoTipoCatalogo = '$descripcion', NombreProducto = '$nombre', PrecioTotal= '$precio' where CodigoCatalogoProductoEvento= '$cod' ");

            echo  '<script>
         alert(" Guardado Correctamente ");
            window.location="eventos_producto.php";
            </script>';
        }else{
            echo '<script>
          alert(" Vuelva a ingresar los datos. Volver a comenzar  ");
          window.location="eventos_productoeditar.php";
          </script>';
        }
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/principalusuarios.php">Inicio</a></li>
              <li class="breadcrumb-item active">Creación</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <!-- Main content -->
    <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
     
   <div class="col-md-8">
   
            <!-- Horizontal Form -->
            <div class="card card-info">
            
              <div class="card-header text-center">
                <h3 class="card-title">Creación de nuevo Producto</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal"  action="eventos_productoeditar.php?CodigoCatalogoProductoEvento=<?php echo $_GET['CodigoCatalogoProductoEvento']; ?>"  method="POST" autocomplete="off">
              <div class="card-body">
                <form >
                <div class="form-group row">
                  <label for="descripcion1" class="col-sm-4 col-form-label">Descripcion</label>
                      <div class="col-sm-8">
                      <input onkeypress="comprobarEspacios();  return sololetras(event);" value="<?php echo $fila['Descripcion']; ?>" type="text" name="NombreProducto"  OnKeyUp="this.value=this.value.toUpperCase();" id="NombreProducto"   class="form-control" placeholder="Nombre del Producto" disabled>
                </div>
                </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nombre de Producto</label>
                    <div class="col-sm-8">
                    <input onkeypress="comprobarEspacios(); return sololetras(event);" type="text" name="NombreProducto"  OnKeyUp="this.value=this.value.toUpperCase();" id="NombreProducto" value="<?php echo $fila['NombreProducto']; ?>"  class="form-control" placeholder="Nombre del Producto" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Precio Total del Producto</label>
                    <div class="col-sm-8">
                        <input  type="text" name="PrecioTotal" onkeypress="return solonumeros(event);" id="PrecioTotal" value="<?php echo $fila['PrecioTotal']; ?>"  class="form-control" placeholder="Precio Total">
                    </div>
                  </div>
                  <div class="row mb-1">
          <div class="col-sm-5">
          <ol class="float-sm-left">
            <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
                       <button name='btnguardar' value="btnupdate" type="submit" class="btn btn-success">Guardar</button>

             <?php } ?>
            </ol>
          </div>
          <div class="col-sm-5">
            <ol class="float-sm-right">
            <button name='Salir' value="btnupdate" type="submit" class="btn btn-block bg-gradient-danger">Salir</button>
            <?php
            if (isset($_POST['Salir'])){
                if ($_POST['Salir']){
                      echo '<script>
                      window.location="eventos_producto.php";
                      </script>';
                }
              }
            ?>
            </ol>
          </div>
                  
                </div>
                  </div>
                  
                  </div>
                  
                  </div>
                <!-- /.card-body -->
                <!-- /.card-footer -->
              </form>
            </div> <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
             
             <?php } ?>


           


             <?php  if($permiso_eliminar==1){?><!-- ejemplo quitar permiso de eliminar------------------------------------------------------------->
             <div class="form-group col-md-2">   
             
             <?php } ?>
            
            <!-- /.card -->
            <?php } ?> <!--  finn ocultat permiso de ocultar ------------------------------------------------------------->
    <!-- /.content -->
    <?php  if($permiso_consultar==0){?> <!--si lo hay permiso de consultar  ------------------------------------------------------------->
     
      <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Error!</strong> <strong>005</strong> Contacta con el administrador.
</div>

      <?php } ?> <!---------------------------  fin mensaje de oculto----------------------------------->
  </div>
            </div></div>
          <!--/.col (left) -->
          <!-- right column -->
         

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

       <!-- Main content -->

       
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
<script>
      function sololetras(e){
      
      key = e.KeyCode || e.which;
      tecla = String.fromCharCode(key).toString();
      letras = 'ABCDEFGHIJCLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú';

      especiales = [8,32];
      tecla_especial = false
      for(var i in especiales){
        if (key==especiales[i]){
          tecla_especial = true;
          break;
        } 
      }
      
      if (letras.indexOf(tecla) == -1 && !tecla_especial){ 
        return false;
      }
      
   }


  /*Solo números*/
  function solonumeros(evt){
    if(window.event){
      keynum = evt.keyCode;
    }else{
      keynum = evt.which;
    }

    if((keynum > 47 && keynum < 58) || keynum == 8){
      return true;
    }else{
      return false;
    }
  }

  function comprobarEspacios() {
			
			let input = document.getElementById('NombreProducto');

			let remplazar = input.value.replace(/(\s{1,})/g, ' ');

			input.value = remplazar;
		}
</script>
</body>
</html>
