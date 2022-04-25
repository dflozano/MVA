<?php
   include 'conexión.php';
   include 'funcionBitacora.php';

   session_start();

   $nombre=$_SESSION['producto'];

   $consulta_producto=mysqli_query($conn,"SELECT Nombre FROM tbl_producto");
   $consulta_materia=mysqli_query($conn,"SELECT NombreProducto FROM tbl_catalogomateriaprima");

   if(isset($_POST['btn_guardar'])){

      //VALIDAR
      $consulta1="SELECT * from tbl_relaciontemporal";
      $datos = mysqli_query ($conn,$consulta1);
      $fila= mysqli_fetch_array ($datos);
  
      ///CONDICION
      if($fila==0){
        echo '<script>
        alert("Agregue alguna relación");
        </script>';
      }else{

          $Usuario=$_SESSION['usuario']; 

          //Insertamos en detalles pedidos
          $insert=mysqli_query($conn,"INSERT INTO tbl_productomateria (CodigoProducto, CodigoMateria, Cantidad)
          SELECT CodigoProducto, CodigoMateria, Cantidad FROM tbl_relaciontemporal");
    
          //Eliminar los datos de la tabla temporal
          $consulta1= mysqli_query($conn, "TRUNCATE TABLE tbl_relaciontemporal");

          if($insert AND $consulta1){
            /*BITACORA*/
            $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'agregarRelacion.php'";
            $consulta1 = mysqli_query($conn,$consulta);
            $valor= mysqli_fetch_array($consulta1);
            $numero=$valor[0];
            //Llamada a la funcion bitacora
            $CodObjeto=$numero;
            $accion='Agregar';
            $descrip='Se creo la relación producto y materia prima';
            bitacora($CodObjeto,$accion,$descrip);
            echo '<script>
            alert("Relación creada exitosamente");
            window.location="cata_productoRestaurante.php";
            </script>';
          }else{
            echo '<script>
            alert("Error, intente de nuevo");
            </script>';
          }

  
      }
 
  }
   
  if(isset($_POST['btn_agregar'])){

    //Validar que tenga registros
    $consulta2 = "SELECT * FROM tbl_relaciontemporal" ;
    $resultado = mysqli_query($conn, $consulta2);
    $filas=mysqli_num_rows($resultado);
 
      $materia = $_POST['materia'];
      $cantidad=$_POST['cantidad'];
     
      if($_POST['materia']=="ESCOGA UNA MATERIA PRIMA" AND ($filas==0)){
        echo '<script>
                 alert("Llene todos los campos");
              </script>';
      }else{
        //Codigo del producto
      $consultparametro="SELECT CodigoProducto from tbl_producto where Nombre = '$nombre'";
      $parametro = mysqli_query ($conn,$consultparametro);
      $valor= mysqli_fetch_array ($parametro);
      $codnombre=$valor[0];

      //Codigo de la materia
      $consultparametro="SELECT CodigoMateria from tbl_catalogomateriaprima where NombreProducto = '$materia'";
      $parametro = mysqli_query ($conn,$consultparametro);
      $valor= mysqli_fetch_array ($parametro);
      $codmateria=$valor[0];

         //Insertar en la tabla temporal
         $insert_relacion=mysqli_query($conn,"INSERT INTO tbl_relaciontemporal (CodigoProducto, CodigoMateria, Cantidad) VALUES ('$codnombre','$codmateria','$cantidad')");
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


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
  <!--  
<script src="dist/js/multiple-select.js"></script>-->

<!-- Include plugin -->
<script src="dist/js/multiple-select.js"></script>

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
    <!-- Include the default stylesheet -->
<!-- Include plugin -->
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
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Pedidos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    <section class="content">
    <div class="mb-0" class="alert">
      <div class="container-fluid">
     
      

        <div class="row">
          <!-- left column -->

          <div class="col-md-3">

         </div>
          
          <div class="col-md-5">
        
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Agregue relación entre Producto/Materia Prima</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body">
                  
                  <form  action="" method="POST">
                  
                  <div class="form-group">
                  <div class="row">
                  <div class="col-lg-12">
                  <label for="">PRODUCTO</label>
                    <input value='<?php echo $nombre?>' min="" id="producto" name="producto" type="" class="form-control" placeholder="" disabled>
                  </div>
                  </div>
                  </div>

                  <div class="form-group">
                  <div class="row">
                    <div class="col-lg-8">
                      <label for="">MATERIA PRIMA</label>
                      <select id="materia" name="materia" class="form-control" autofocus>
                        <option selected>ESCOGA UNA MATERIA PRIMA</option>
                        <?php
                            while($materias=mysqli_fetch_array($consulta_materia))
                            {
                          ?>    
                        <option> <?php echo $materias['NombreProducto']?> </option>     
                          <?php 
                            }         
                          ?>   
                      </select>
                    </div>
                    <div class="col-lg-4">
                      <label for="">Cantidad</label>
                      <input value='1' min="" id="cantidad" name="cantidad" type="" class="form-control" placeholder="Ingrese" required>
                    </div>
                    </div>
                          </div>

                  <div class="row">
                  <div class="col-lg-8">
                  

                         
    
        
    

<script src="dist/js/bootstrap-multiselect.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<!-- Page specific script -->

                      
                 </div> 
                  </div> 
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-8">
                      
                                 <button type="" id='btn_agregar' name='btn_agregar' type="" class="btn btn-primary btn-block md-3">Agregar</button>

                      </div>
                      <div class="col-md-1">
                      </div>
                      <div class="col-md-2">
                        <a href="cata_productoRestaurante.php" class="btn btn-danger " role="button" aria-pressed="true">Salir</a>
                      </div>
                    </div>
                  </div> 
                    <div class="">
                    
                               <button type="" id='btn_guardar' name='btn_guardar' type="" class="btn btn-warning btn-block md-3">Guardar</button>
         
                    </div>
                  </div> 


                  
                  
                  
                  
                <!-- /.card-body -->
                
                
              
             
                 
             </form>
             </section>
             <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>No.</th>
                    <th>Materia Prima</th>
                    <th>Cantidad </th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody> 
                  <?php 
                  
                    $consulta_tablas="SELECT a.CodigoTemporal, a.CodigoProducto, a.CodigoMateria, a.Cantidad,
                    b.CodigoProducto, b.Nombre, c.CodigoMateria, c.NombreProducto FROM tbl_relaciontemporal as a INNER JOIN 
                    tbl_producto as b ON b.CodigoProducto=a.CodigoProducto INNER JOIN tbl_catalogomateriaprima as c ON c.CodigoMateria=a.CodigoMateria";                            
                    $resultado_tablas=mysqli_query($conn,$consulta_tablas);
                    while($row=mysqli_fetch_array($resultado_tablas)){ ?>
                    <tr>
                    <td><?php echo $row['CodigoTemporal'] ?></td>
                    <td><?php echo $row['NombreProducto'] ?></td>
                    <td><?php echo $row['Cantidad'] ?></td>
                    <td class="text-center"> <div class="text-center">
                    <div class="btn-group">
                       <a href="eliminarPedidoProducto.php?CodigoTemporal=<?php echo $row['CodigoTemporal']?>"  class="btn btn-danger"> 
                         <i class ="fas fa-trash-alt"></i>
                       </a>  
                   </div>
                        </td>
                    </tr>



                 <?php } ?>
                 </tbody>
                  
                </table>
              </div>
        
              </div>
              
              </div>
              
            </div>
            <!-- /.card -->
       
 
  

 
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

<script>
  /*Solo letras Nombre Completo*/
  
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

		function comprobarEspacios() {
			
			let input = document.getElementById('nombre');

			let remplazar = input.value.replace(/(\s{1,})/g, ' ');

			input.value = remplazar;
		}
	
</script>




