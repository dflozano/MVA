<?php
   include 'conexión.php';
   include 'funcionBitacora.php';

   session_start();

    /*BITACORA*/
    $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'agregar.php'";
    $consulta1 = mysqli_query($conn,$consulta);
    $valor= mysqli_fetch_array($consulta1);
    $numero=$valor[0];
    //Llamada a la funcion bitacora
    $CodObjeto=$numero;
    $accion='Ingreso';
    $descrip='Ingreso en la pantalla para agregar un movimiento';
    bitacora($CodObjeto,$accion,$descrip);
   

   if(!empty($_POST)){

    if(empty($_POST['materia']) || empty($_POST['unidades']) || empty($_POST['movimiento']) || empty($_POST['descrip'])){
      echo '<script>
      alert("Llene todos los campos");
      </script>';
    }else{
      $materia=$_POST['materia'];
      $unidades=$_POST['unidades'];
      $movimiento=$_POST['movimiento'];
      $descrip=$_POST['descrip'];
      $usuario=$_SESSION['usuario'];

      /*Obtengo el codigo materia*/
      $consulta="SELECT * from tbl_catalogomateriaprima where NombreProducto = '$materia'";
      $valor = mysqli_query ($conn,$consulta);
      $variable= mysqli_fetch_array ($valor);
      $codigoMateria=$variable['CodigoMateria'];

      //Obtengo el codigo movimiento
      $consultparametro="SELECT CodigoTipoKardex from tbl_tipokardex where Descripcion = '$movimiento'";
      $parametro = mysqli_query ($conn,$consultparametro);
      $valor= mysqli_fetch_array ($parametro);
      $codigoMov=$valor[0];

      //Obtengo el codigo usuario
      $consultparametro="SELECT CodigoUsuario from tbl_usuario where Usuario = '$usuario'";
      $parametro = mysqli_query ($conn,$consultparametro);
      $valor= mysqli_fetch_array ($parametro);
      $codigoUsuario=$valor[0];

      //Insertar en kardex
      $insert=mysqli_query($conn,"INSERT INTO tbl_kardex (CodigoMateria, CodigoTipoKardex, Descripcionk, CodigoUsuario, Cantidad, Fecha) 
      VALUES ('$codigoMateria','$codigoMov','$descrip',' $codigoUsuario','$unidades', now())");

       //Obtengo las unidades
       $consulta1="SELECT * from tbl_inventarioexistente where CodigoMateriaPrima = '$codigoMateria'";
       $valor1 = mysqli_query ($conn,$consulta1);
       $variable1= mysqli_fetch_array ($valor1);
       $inventario=$variable1['Unidades'];

       if($codigoMov==1){
         $operacion=$inventario+$unidades;
       }else{
        $operacion=$inventario-$unidades;
       }

       /*Actualizo el inventario */
      $update=mysqli_query($conn,"update tbl_inventarioexistente set Unidades = '$operacion' where CodigoMateriaPrima = '$codigoMateria'");

      if($insert AND $update){
        /*BITACORA*/
        $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'agregar.php'";
        $consulta1 = mysqli_query($conn,$consulta);
        $valor= mysqli_fetch_array($consulta1);
        $numero=$valor[0];
        //Llamada a la funcion bitacora
        $CodObjeto=$numero;
        $accion='Agregar';
        $descrip='Se agrego un movimiento en kardex';
        bitacora($CodObjeto,$accion,$descrip);


        echo '<script>
        alert(" Se agrego exitosamente. ");
        window.location="inventario_kardex.php";
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
              <li class="breadcrumb-item active">Kardex</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <!-- Main content -->

      <div class="container-fluid">
     
      

        <div class="row">
          <!-- left column -->

          <div class="col-md-2">

         </div>
          
          <div class="col-md-7">
        
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Registro un movimiento</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body">
                  <div class="form-group">
                  <form  action="" method="POST">
                  </div>
                  <div class="form-group">
                  <div class="row">
                  <div class="col-lg-8">
                  <label for="">Materia Prima</label>
                    <select id="materia" name="materia" class="form-control" autofocus>
                      <?php $materia=mysqli_query($conn,"SELECT NombreProducto FROM tbl_catalogomateriaprima");?>
                        <option selected>Escoga la materia prima...</option>
                        <?php
                            while($nombre=mysqli_fetch_array($materia))
                            {
                          ?>    
                        <option> <?php echo $nombre['NombreProducto']?> </option>     
                          <?php 
                            }         
                          ?>   
                      </select>
                  </div>

                  <div class="col-lg-4">
                  <label for="">Unidades</label>
                    <input value=1 min="1" id="unidades" name="unidades" type="number" class="form-control" placeholder="Ingrese" required>
                  </div>
                  </div>
                      
                  </div>
                  <div class="form-group">

                  <div class="row">
                  <div class="col-lg-6">


                  <label for="toppings" class="col-sm-5 col-form-label">Movimiento</label>
                  <?php $tipo=mysqli_query($conn,"SELECT Descripcion FROM tbl_tipokardex"); ?>
                  <select id="movimiento" name="movimiento" class="form-control" autofocus>
                        <option selected>Escoga el tipo de movimiento...</option>
                        <?php
                            while($movimientos=mysqli_fetch_array($tipo))
                            {
                          ?>    
                        <option> <?php echo $movimientos['Descripcion']?> </option>     
                          <?php 
                            }         
                          ?>   
                      </select>
                  

                          
                          </div>
                          <div class="col-lg-6">
                          <label for="toppings" class="col-sm-5 col-form-label">Descripcion</label>
                            <textarea onkeyup="this.value=this.value.toUpperCase();" class="form-control" id="descrip" name="descrip" rows="1" placeholder="Descripa el movimiento"></textarea>
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
                      <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
                                     <button type="" id='btn_agregar' name='btn_agregar' class="btn btn-primary btn-block md-3">Realizar</button>

             <?php } ?>

        
                      </div>
                      <div class="col-md-1">
                      </div>
                      <div class="col-md-2">
                        <a href="inventario_kardex.php" class="btn btn-danger " role="button" aria-pressed="true">Salir</a>
                      </div>
                    </div>
                  </div> 
                    <div class="">
                    
                    </div>
                  </div> 


                  
                  
                  
                  
                <!-- /.card-body -->
                
                
              
             
                 
             </form>
             </section>
             
        
              </div>
              
              </div>
              
            </div>
            <!-- /.card -->
       <!-- Main content -->
       
       <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
             
             <?php } ?>


             <?php  if($permiso_eliminar==1){?><!-- ejemplo quitar permiso de eliminar------------------------------------------------------------->
             
             <?php } ?>
<!-- ./wrapper -->
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




