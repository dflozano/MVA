<?php
include ('conexion.php');
include ('funcionkardex.php');
include 'funcionBitacora.php';
session_start();
$CodObjeto=44;
$accion='Insert';
$descrip='Se Inserto una Compra';
bitacora($CodObjeto,$accion,$descrip);

if(!empty($_POST['btnguardar'])){
		$alert='';
		if(empty($_POST['CodigoPersona']) || empty($_POST['producto']) || empty($_POST['unidades']) || empty($_POST['costo']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$proveedor = $_POST['CodigoPersona'];
			$producto = $_POST['producto'];
			$unidades  = $_POST['unidades'];
      $costo  = $_POST['costo'];

      $precio = $unidades * $costo;

				$query_insert = mysqli_query($conexion,"INSERT INTO `tbl_compras` (`CodigoPersona`, `CodigoMateria`, `Unidades`, `CostoUnitario`, `PrecioTotal`, `CodigoEstadoCompras`, `FechaCompra`) 
																	VALUES('$proveedor','$producto','$unidades', '$costo', '$precio', 1, now())");
      
      //Funcion Kardex
      $Producto_kardex=$producto;
      $CodKardex=1;
      $Cantidad=$unidades;
      kardex($Producto_kardex,$CodKardex,$Cantidad);

      //Unidades
      $consulta="SELECT Unidades from tbl_inventarioexistente where CodigoMateriaPrima = '$producto'";
      $valor = mysqli_query ($conexion,$consulta);
      $unidades_inventario= mysqli_fetch_array ($valor);
      $suma=$unidades_inventario[0]+$unidades;

      $update_inventario=mysqli_query($conexion,"update tbl_inventarioexistente set Unidades = '$suma' where CodigoMateriaPrima = '$producto'");
      
      if($query_insert){
          echo '<script>
          alert("Listo la compra.");
          window.location="compras.php";
          </script>';
          
				}else{
					$alert='<p class="msg_error">.</p>';
          echo '<script>
                alert("Error al crear el paquete.");
                window.location="compras_nueva.php";
                </script>';
				}

			}
    }
 ///codigo que asocia el rol del usuario y asiga el permiso
 $usuariorol= $_SESSION['usuario'];//traer nombre del usuario que tiene la seccio
 $sql_consulta="SELECT CodigoRol, Usuario FROM tbl_usuario where  Usuario='$usuariorol'";
 $resultado_consulta=$conexion->query($sql_consulta);//guarda la consulta
 $row1=$resultado_consulta->fetch_assoc();//arreglo asociativo
 $rol=($row1['CodigoRol']);  
 
 //--------------------------------------------------PERMISO
 $permiso="SELECT CodigoPermiso, CodigoObjeto, CodigoRol, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion,Permiso_Consultar FROM tbl_permisos where CodigoObjeto ='$CodObjeto' AND CodigoRol=' $rol' ";
 $datos56 = mysqli_query ($conexion,$permiso);
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
   <!-- DataTables -->
   <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Include the default stylesheet -->
<!-- Include plugin -->
<script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
    <!-- Include the default stylesheet -->
<!-- Include plugin -->
</head>
<body class="hold-transition sidebar-mini layout-fixed" >
<div class="wrapper">
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake"  src="dist/img/minuta.png" alt="AdminLTELogo" height="150" width="150">
  </div>
 <!-- Preloader -->

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
              <li class="breadcrumb-item active">Compras</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <section class="content-header">

    <div class="card card-info">
    <div class="container-fluid">

   


         
            <div class="card-header text-center">
              <h3 class="card-title">Compras</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="POST" autocomplete="off">
            <div class="card-body">
              <form >
              <div class="row">
                  <div class="col-sm-6">
                    <!-- checkbox -->
                    <!-- checkbox -->
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nombre del Proveedor</label>
                    <div class="col-sm-15">
                    <select name="CodigoPersona" id="CodigoPersona" class="form-control" autofocus>
                        <option selected>Ingrese el Nombre del Proveedor...</option>
                        <?php
                             $query_proveedor = mysqli_query($conexion,"SELECT CodigoPersona, NombreCompleto from tbl_personas 
                             where CodigoTipoPersona = 3 ORDER BY NombreCompleto ASC");
                             $result_proveedor = mysqli_num_rows($query_proveedor);
                 
                        ?>   
                           <?php 
                                if($result_proveedor > 0)
                                {
                                  while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                             ?> 
                                <option value="<?php echo $proveedor["CodigoPersona"]; ?>"><?php echo $proveedor["NombreCompleto"] ?></option>     
                          <?php 
                            }       
                          }   
                          ?>  
                      </select> 
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Unidades</label>
                    <input type="number" min="1" name="unidades" onkeypress="return solonumeros(event);" class="form-control" id="exampleInputEmail1" value="<?php if(isset($unidades)) echo $unidades ?>" placeholder="Ingrese las Unidades">
                  </div>
                    </div>
              
                  
                



                  <div class="col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nombre del Producto</label>
                    <div class="col-sm-15">
                    <select name="producto" id="producto" class="form-control" autofocus>
                        <option selected>Ingrese el Nombre del Producto...</option>
                        <?php
                             $query_producto = mysqli_query($conexion,"SELECT * FROM `tbl_catalogomateriaprima` ORDER BY NombreProducto ASC");
                             $result_producto = mysqli_num_rows($query_producto);
                 
                        ?>   
                           <?php 
                                if($result_producto > 0)
                                {
                                  while ($producto = mysqli_fetch_array($query_producto)) {
                             ?> 
                                <option value="<?php echo $producto["CodigoMateria"]; ?>"><?php echo $producto["NombreProducto"] ?></option>     
                          <?php 
                            }       
                          }   
                          ?>  
                      </select> 
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Costo</label>
                    <input type="number" min="1" onkeypress="return solonumeros(event);" name="costo" class="form-control" id="costo" value="<?php if(isset($costo)) echo $costo ?>" placeholder="Ingrese el Costo del Producto">
                  </div>
                    </div>
                  
                  
                   
                      </div> 
                  <div class="row mb-1">
                      <div align ="center" class="col-sm-5">
                        <ol class="float-sm-left"> <?php  if($permiso_insertar==1){?>
                                <button name='btnguardar' value="btnupdate" type="submit" class="btn btn-success">Guardar</button>

             <?php } ?>
                        </ol>
                      </div>
                      <div align ="center" class="col-sm-5">
                        <ol class="float-sm-right">
                        <button name='Salir' value="btnupdate" type="submit" class="btn btn-block bg-gradient-danger">Salir</button>
                        </ol>
                        <?php
            if (isset($_POST['Salir'])){
                if ($_POST['Salir']){
                      echo '<script>
                      window.location="../compras/compras.php";
                      </script>';
                }
              }
            ?>
                        </div>
                        </div>
                        </div>
                    


                <!-- /.card-footer -->
            
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  
              <!-- /.card-body -->
            </div>
            </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
   <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
             
             <?php } ?>


             <?php  if($permiso_eliminar==1){?><!-- ejemplo quitar permiso de eliminar------------------------------------------------------------->
            
             <?php } ?>
             
  <!-- /.control-sidebar -->
</div>
<?php } ?> <!--  finn ocultat permiso de ocultar ------------------------------------------------------------->
    <!-- /.content -->
    <?php  if($permiso_consultar==0){?> <!--si lo hay permiso de consultar  ------------------------------------------------------------->
     
      <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Error!</strong> <strong>005</strong> Contacta con el administrador.
</div>

      <?php } ?> <!---------------------------  fin mensaje de oculto----------------------------------->
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
<script src="dist/js/bootstrap-multiselect.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

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
<script>////funcion de buscar
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, 
      
      language: {//traducir
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "",
        "print":"Impresion",
        "infoEmpty": "",
        "infoFiltered": "(Filtrado de MAX total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar MENU Entradas",
        "loadingRecords": "Cargando...",
       
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        
        

    },
  
    

    
  });
  
  
</script>
</body>
</html>
