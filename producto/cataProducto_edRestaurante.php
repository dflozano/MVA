<?php
require 'conexión.php';
include 'funcionBitacora.php';
session_start();

      /*BITACORA*/
      $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'cataProducto_edRestaurante.php'";
      $consulta1 = mysqli_query($conn,$consulta);
      $valor= mysqli_fetch_array($consulta1);
      $numero=$valor[0];
      //Llamada a la funcion bitacora
      $CodObjeto=$numero;

if (isset($_GET['CodigoProducto'])) {
  $cod=$_GET['CodigoProducto'];
  $consulta2="SELECT * from tbl_producto WHERE CodigoProducto = $cod";
  $conResul1=mysqli_query($conn,$consulta2);

  if (mysqli_num_rows($conResul1)==1){
      $fila=mysqli_fetch_array($conResul1);
      $CodigoMateria=$fila['CodigoProducto'];
  }  
}

if (isset($_POST['btnguardar'])){
  $cod=$_GET['CodigoProducto'];
	$nombre = $_POST['NombreProducto'];
  $descripcion = $_POST['Descrip'];
  $precio=$_POST['precio'];

  if(empty($_POST['NombreProducto']) || empty($_POST['Descrip']) || empty($_POST['precio'])){
    echo  '<script>
    alert("Llene todos los campos");
    </script>';
  }else{
    
    //Update en producto
    $consula=mysqli_query($conn,"UPDATE tbl_producto SET Nombre = '$nombre', Descripcion = '$descripcion', Precio = '$precio'  where CodigoProducto = '$cod' ");
    
    if($consula){
            /*BITACORA*/
            $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'cataProducto_edRestaurante.php'";
            $consulta1 = mysqli_query($conn,$consulta);
            $valor= mysqli_fetch_array($consulta1);
            $numero=$valor[0];
            //Llamada a la funcion bitacora
            $CodObjeto=$numero;
            $accion='Editar';
            $descrip='Se edito información de un producto';
            bitacora($CodObjeto,$accion,$descrip);
      echo  '<script>
      alert(" Editado correctamente ");
      window.location="cata_productoRestaurante.php";
      </script>';
    }else{
      echo '<script>
      alert("Error, vuelva a ingresar los datos.");
      window.location="cataProducto_edRestaurantephp";
      </script>';
    }
  

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
  <link rel="icon" type="image/png" href="../dist/img/minuta.png">


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
              <li class="breadcrumb-item active">Catalago Producto</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
       <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <!-- Main content -->
       <!-- Main content -->
       <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
     
   <div class="col-md-9">
   
            <!-- Horizontal Form -->
            <div class="card card-info">
            
              <div class="card-header text-center">
                <h3 class="card-title">Catalogo de Producto</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="POST" autocomplete="off">
              <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 
              <div class="card-body">
                <form >
            
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nombre</label>
                    <div class="col-sm-8">
                      <input onkeypress="comprobarEspacios(); return sololetras(event);" maxlength="50" minlength="10" OnKeyUp="this.value=this.value.toUpperCase();"  type="text" class="form-control" id="NombreProducto" name="NombreProducto" value="<?php echo $fila['Nombre']; ?>" placeholder="Update"> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Descripción</label>
                    <div class="col-sm-8">
                      <input onkeypress="comprobarEspacios(); return sololetras(event);" maxlength="50" minlength="10" OnKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $fila['Descripcion']; ?>" type="text" name="Descrip" id="Descrip" class="form-control" placeholder="Nombre del Producto" >
                </div>
          </div>
                  <div class="form-group row">
            <label for="" class="col-sm-4 col-form-label">Precio</label>
            <div class="col-sm-3">
             <input onkeypress="return solonumeros(event);" value="<?php echo $fila['Precio']; ?>" min="1" id="precio" name="precio" type="" class="form-control" placeholder="Ingrese" required>
            </div>
          </div>
                  <div class="row mb-2">
          <div class="col-sm-6">
          <ol class="float-sm-left">
          <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
             <button name='btnguardar' value="btnupdate" type="submit" class="btn btn-success">Guardar</button>
          <?php } ?>
            </ol>
          </div>
          
            <div class="col-sm-5">
            <ol class="float-sm-right">
            <input  name='Salir' type="submit" class="btn btn-block bg-gradient-danger"  value="Salir">
              <?php 
                if (isset($_POST['Salir'])){
                  if ($_POST['Salir']){
                      echo '<script>
                      window.location="cata_productoRestaurante.php";
                      </script>';
                  }
              }
              ?>
                  </div>
                  
                </div>               
                <!-- /.card-body -->
                <!-- /.card-footer -->
              
            </div>
            <!-- /.card -->

            </div></div>
          <!--/.col (left) -->
          <!-- right column -->
         
         </form>
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
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
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
<script>
   /*Solo letras Nombre Completo*/
  function sololetras(e){
       key = e.KeyCode || e.which;
       tecla = String.fromCharCode(key).toString();
       letras = "ABCDEFGHIJCLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

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


    function sololetras(e){
       key = e.KeyCode || e.which;
       tecla = String.fromCharCode(key).toString();
       letras = "ABCDEFGHIJCLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

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




   /*Solo letras Descripcion producto*/
   function sololetras(e){
       key = e.KeyCode || e.which;
       tecla = String.fromCharCode(key).toString();
       letras = "ABCDEFGHIJCLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

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

    function comprobarEspacios() {
			
			let input = document.getElementById('NombreProducto');

			let remplazar = input.value.replace(/(\s{1,})/g, ' ');

			input.value = remplazar;
		}
</script>
</body>
</html>

