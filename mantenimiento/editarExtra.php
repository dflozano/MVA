<?php
   include 'conexion.php';
   include 'funcionBitacora.php';
   session_start();
 
   $usuario=$_SESSION['usuario'];
   $cod = $_GET['CodigoExtra'];
   $consulta_materia=mysqli_query($conexion,"SELECT NombreProducto FROM tbl_catalogomateriaprima");

   /*Obtengo valores del estado*/
   $consulta="SELECT * from tbl_extra where CodigoExtra = '$cod'";
   $valor = mysqli_query ($conexion,$consulta);
   $variable= mysqli_fetch_array ($valor);
   $nombre=$variable['Nombre'];
   $precio=$variable['Precio'];
   $codmateria=$variable['CodigoMateria'];

   if(empty($codmateria)){
     $materia='';
   }else{
      /*Obtengo el codigo*/
      $consult_materia="SELECT NombreProducto from tbl_catalogomateriaprima where CodigoMateria = '$codmateria'";
      $cod1 = mysqli_query ($conexion,$consult_materia);
      $cod1= mysqli_fetch_array ($cod1);
      $materia=$cod1[0]; 
   }

   if(!empty($_POST)){

    if(empty($_POST['materia'])){
      $nombre=$_POST['nombre'];
      $precio=$_POST['precio'];
      if(empty($_POST['nombre']) OR empty($_POST['precio'])){
        echo '<script>
        alert("Llene todo los campos");
        </script>';
      }else{
           //Autualizamos
           $update=mysqli_query($conexion,"update tbl_extra set Nombre = '$nombre',Precio = '$precio' where CodigoExtra = '$cod'");
   
            if($update){
              echo '<script>
              alert(" Editado exitosamente");
              window.location="extras.php";
              </script>';
            }
      }
    }else{
      $nombre=$_POST['nombre'];
    $materia=$_POST['materia'];
    $precio=$_POST['precio'];

    /*Obtengo el codigo*/
    $consult_materia="SELECT CodigoMateria from tbl_catalogomateriaprima where NombreProducto = '$materia'";
    $cod1 = mysqli_query ($conexion,$consult_materia);
    $cod1= mysqli_fetch_array ($cod1);
    $cod_materia=$cod1[0]; 

    
    if(empty($_POST['nombre']) OR empty($_POST['precio'])){
      echo '<script>
      alert("Llene todo los campos");
      </script>';
    }else{
         //Autualizamos
         $update=mysqli_query($conexion,"update tbl_extra set Nombre = '$nombre', CodigoMateria = '$cod_materia' ,Precio = '$precio' where CodigoExtra = '$cod'");
 
          if($update){
            echo '<script>
            alert(" Editado exitosamente");
            window.location="extras.php";
            </script>';
          }
    }
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
  <script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">

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
  <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
  <?php include "../vistas/encabezado.php"; ?>    

  <!-- Main Sidebar Container -->
 

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    <section class="content">
    <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-3">
          </div>
          <div class="col-md-5">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Extra</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
                <div class="card-body">
                  <div class="form-group">
                  <form  action="" method="POST">
                    <label for="">Nombre</label>
                    <input value='<?php echo $nombre?>' OnKeyUp="this.value=this.value.toUpperCase();" onkeypress="comprobarEspacios(); return sololetras(event);" id="nombre" name='nombre' type="text" class="form-control" placeholder="INGRESE LA DESCRIPCION" >
                  </div>
                  <div class="form-group">
                  <div class="row">
                  <div class="col-lg-6">
                  <label for="">Materia Prima</label>
                    <?php if($materia==''){?>
                      <select id="materia" name="materia" class="form-control" aria-label="Disabled select example" disabled >
                    <?php }else{?>
                      <select id="materia" name="materia" class="form-control" autofocus >
                          <option selected><?php echo $materia?></option>
                          <?php
                            while($materias=mysqli_fetch_array($consulta_materia))
                            {
                          ?>    
                        <option> <?php echo $materias['NombreProducto']?> </option>     
                          <?php 
                              } }        
                          ?>   
                      </select>

                  </div>

                  <div class="col-lg-6">
                  <label for="">Precio</label>
                  <input value='<?php echo $precio?>' onkeypress="return solonumeros(event);" id="precio" name='precio' type="text" class="form-control" placeholder="INGRESE EL PRECIO" >
                  </div>

                  
                  </div>
                      
                  </div>
                  <div class="form-group">
                  <div class="row">
                  <div class="col-lg-7">
                  
                 
    
        
    

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
                  <button type="" id='btn_agregar' name='btn_agregar' type="" class="btn btn-primary btn-block md-3">Editar</button>
                  </div>
                  <div class="col-md-1">
                  </div>
                  <div class="col-md-2">
                  <a href="extras.php" class="btn btn-danger " role="button" aria-pressed="true">Salir</a>
                  </div>
                  </div>
                  </div> 
                  </div> 
                  </div>
                  </div>
                  </div>
                  
                  
                <!-- /.card-body -->
                
                
              
              
                
             </form>

  </div>
              </div>
              </div>
            </div>
            <!-- /.card -->
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
			
			let input = document.getElementById('descripcion');

			let remplazar = input.value.replace(/(\s{1,})/g, ' ');

			input.value = remplazar;
		}
	
  /*Solo números*/
  function solonumeros(evt){
    if(window.event){
      keynum = evt.keyCode;
    }else{
      keynum = evt.which;
    }

    if((keynum > 47 && keynum < 58) || keynum == 8 ){
      return true;
    }else{
      return false;
    }
  }
</script>




