<?php
include ('conexión.php');
include ('funcionKardex.php');
include 'funcionBitacora.php';

session_start();
$cod=$_GET['CodigoCompras'];

$CodObjeto=45;
$accion='Update';
$descrip='Se hizo un Update Compras';
bitacora($CodObjeto,$accion,$descrip);


    //VALORES
    $consulta="SELECT * from tbl_compras where CodigoCompras = '$cod'";
    $consulta1 = mysqli_query($conn,$consulta);
    $valores= mysqli_fetch_array($consulta1);
    $estado1 = $valores['CodigoEstadoCompras'];

if($estado1==2){
    echo '<script>
    alert("El estado de la Compra debe ser Registrada");
    window.location="compras.php";
    </script>';
  }else{
if (isset($_GET['CodigoCompras'])) {
  $cod=$_GET['CodigoCompras'];
  $consulta2="SELECT a.CodigoCompras, p.NombreCompleto, c.NombreProducto, a.Unidades,  a.CostoUnitario, a.PrecioTotal, a.FechaCompra, e.CodigoEstadoCompras , e.Estado from tbl_compras as a 
  join tbl_estadocompras as e on e.CodigoEstadoCompras=a.CodigoEstadoCompras
  join tbl_catalogomateriaprima as c on c.CodigoMateria = a.CodigoMateria
  join tbl_personas as p on p.CodigoPersona = a.CodigoPersona where CodigoCompras= $cod";
  $conResul1=mysqli_query($conn,$consulta2);

  if (mysqli_num_rows($conResul1)==1){
      $fila=mysqli_fetch_array($conResul1);
      $CodigoCompras=$fila['CodigoCompras'];
  }  
}
    

if(!empty($_POST['aumentar'])){
      $cod=$_GET['CodigoCompras'];
			$unidades  = $_POST['unidades'];
      $costo  = $_POST['CostoUnitario'];

        if ($_POST['unidades']){
        //Valores de la compra
        $consulta="SELECT * from tbl_compras where CodigoCompras = '$cod'";
        $valor = mysqli_query ($conn,$consulta);
        $valores= mysqli_fetch_array ($valor);
        $cod_materia=$valores['CodigoMateria'];
        $unidades_compra=$valores['Unidades'];
        $fecha_compra=$valores['FechaCompra'];

          $total=$unidades_compra + $unidades;

          $precio = $costo * $total;
  
  
          //Unidades en inventario
          $consulta1="SELECT Unidades from tbl_inventarioexistente where CodigoMateriaPrima = '$cod_materia'";
          $valor1 = mysqli_query ($conn,$consulta1);
          $unidades_inventario= mysqli_fetch_array ($valor1);
          $suma=$unidades_inventario[0]+$unidades;
  
          /*Actualizo inventario */
          $inventario=mysqli_query($conn,"update tbl_inventarioexistente set Unidades = '$suma' where CodigoMateriaPrima = '$cod_materia'");
  
          $consula=mysqli_query($conn,"UPDATE tbl_compras SET Unidades= '$total', CostoUnitario ='$costo', PrecioTotal='$precio' where CodigoCompras= '$cod' ");
          
          $udpate_kardex=mysqli_query($conn,"UPDATE tbl_kardex SET Cantidad = '$total' where Fecha = '$fecha_compra' ");
  
  
          echo '<script>
            alert(" Guardado Correctamente ");
            window.location="compras.php";
            </script>';
         
      }else{
        echo '<script>
        alert(" Guardado Correctamente ");
        window.location="compras.php";
        </script>';
          }   
        } 
          
          if(!empty($_POST['disminuir'])){
            $cod=$_GET['CodigoCompras'];
            $unidades  = $_POST['unidades'];
            $costo  = $_POST['CostoUnitario'];
      
              if ($_POST['unidades']){
              //Valores de la compra
              $consulta="SELECT * from tbl_compras where CodigoCompras = '$cod'";
              $valor = mysqli_query ($conn,$consulta);
              $valores= mysqli_fetch_array ($valor);
              $cod_materia=$valores['CodigoMateria'];
              $unidades_compra=$valores['Unidades'];
              $fecha_compra=$valores['FechaCompra'];
      
              $total1=$unidades_compra - $unidades;

              $precio1 = $costo * $total1;
      
      
              //Unidades en inventario
              $consulta1="SELECT Unidades from tbl_inventarioexistente where CodigoMateriaPrima = '$cod_materia'";
              $valor1 = mysqli_query ($conn,$consulta1);
              $unidades_inventario= mysqli_fetch_array ($valor1);
              $resta=$unidades_inventario[0]-$unidades;
      
              /*Actualizo inventario */
              $inventario=mysqli_query($conn,"update tbl_inventarioexistente set Unidades = '$resta' where CodigoMateriaPrima = '$cod_materia'");
      
              $consula=mysqli_query($conn,"UPDATE tbl_compras SET Unidades= '$total1', CostoUnitario ='$costo', PrecioTotal='$precio1' where CodigoCompras= '$cod' ");
              
              $udpate_kardex=mysqli_query($conn,"UPDATE tbl_kardex SET Cantidad = '$total1' where CodigoMateria = '$cod_materia' ");
      
              echo '<script>
              alert(" Guardado Correctamente ");
              window.location="compras.php";
              </script>';
  
               
            }else{
              echo '<script>
              alert(" Guardado Correctamente ");
              window.location="compras.php";
              </script>';
                }
}


if(!empty($_POST['btnguardar'])){
  $cod=$_GET['CodigoCompras'];
  $costo  = $_POST['CostoUnitario'];

    if ($_POST['CostoUnitario']){
    //Valores de la compra
    $consulta1="SELECT * from tbl_compras where CodigoCompras = '$cod'";
    $valor1 = mysqli_query ($conn,$consulta1);
    $valores1= mysqli_fetch_array ($valor1);
    $cod_materia1=$valores1['CodigoMateria'];
    $unidades_compra1=$valores1['Unidades'];
    $fecha_compra1=$valores1['FechaCompra'];


    $preciocom = $costo * $unidades_compra1;


    $consula=mysqli_query($conn,"UPDATE tbl_compras SET  CostoUnitario ='$costo', PrecioTotal='$preciocom' where CodigoCompras= '$cod' ");


   echo '<script>
   alert(" Guardado Correctamente ");
   window.location="compras.php";
   </script>';

     
  }else{
    echo '<script>
    alert(" Guardado Correctamente ");
    window.location="compras.php";
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
//------------------------------

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MVA | Software</title>
  <link rel="icon" type="image/png" href="dist/img/minuta.png">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

 <!-- DataTables -->
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
              <li class="breadcrumb-item active">Compras</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <section class="content-header">
    <div class="container-fluid">
     
    <div class="card card-info">
            
            <div class="card-header text-center">
              <h3 class="card-title">Compras</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="POST" autocomplete="off">
              <form>
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                  <label>Nombre del Proveedor</label>
                    <input type="text" onkeypress="return solonumeros(event);" value="<?php echo $fila['NombreCompleto']; ?>" name="CodigoPersona" id="CodigoPersona" class="form-control" id="exampleInputEmail1"  placeholder="Ingrese las Unidades" disabled>
                  </div>
                  <div class="col-4">
                  <label>Nombre del Producto</label>
                    <input type="text" onkeypress="return solonumeros(event);" name="CodigoMateria" id="CodigoMateria" value="<?php echo $fila['NombreProducto']; ?>" class="form-control" id="exampleInputEmail1"  placeholder="Ingrese las Unidades" disabled>
                  </div>
                  <div class="col-4">
                  <label>Estado</label>
                  <input type="text" onkeypress="return solonumeros(event);" name="CodigoEstadoCompras" id="CodigoEstadoCompras" value="<?php echo $fila['Estado']; ?>" class="form-control" id="exampleInputEmail1"  placeholder="Ingrese las Unidades" disabled>

                  </div>
                </div>


                <div class="row">
                  <div class="col-4">
                  <label>Unidades</label>
                     <input type="text" onkeypress="return solonumeros(event);" name="" class="form-control" id="exampleInputEmail1" value="<?php echo $fila['Unidades']; ?>" placeholder="Ingrese las Unidades" disabled>
                  </div>
                  <div class="col-4">

                  <label>Ingrese las Unidades</label>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-default dropdown-toggle" type="submit" data-toggle="dropdown">
                      Acción
                    </button>
                    <div class="dropdown-menu">
                      <button class="dropdown-item" name="aumentar" value="btnupdate" type="submit"> Aumentar </button>
                      <button class="dropdown-item" name="disminuir" value="btnupdate" type="submit"> Disminuir </button>
                    </div>
                  </div>
                  <!-- /btn-group -->
                  <input type="number" min="0" onkeypress="return solonumeros(event);" name="unidades" class="form-control" id="exampleInputEmail1" placeholder="Ingrese las Unidades">
                </div>
                  </div>
                  <div class="col-4">
                  <label>Costo</label>
                    <input type="text" name="CostoUnitario" onkeypress="return solonumeros(event);" class="form-control" id="costo" value="<?php echo $fila['CostoUnitario']; ?>" placeholder="Ingrese el Costo del Producto">
                  </div>
                </div>
                </div>

              
                  
                  
                   
                     
                  <div class="row mb-1">
                      <div align ="center" class="col-sm-5">
                        <ol class="float-sm-left"><?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
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
                      window.location="compras.php";
                      </script>';
                }
              }
            ?>
                        </div>
                        </div>
                        </div>
                        </div>




                <!-- /.card-footer -->
              </form>
            <!-- /.card -->
  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  
              <!-- /.card-body -->
            </div>
            </div> 
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

       <!-- Main content -->

       
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
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
</script>

</body>
</html>
