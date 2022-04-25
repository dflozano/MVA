<?php 
  include ('conexión.php');
  include 'funcionBitacora.php';
session_start();
$usuario=$_SESSION['usuario'];
$CodObjeto=26;
$accion='Insert';
$descrip='Se registro un pedido de Evento';
bitacora($CodObjeto,$accion,$descrip);


  $usuario=$_SESSION['usuario'];

    $cod=$_GET['CodigoCatalogoEvento'];

  /*Obtengo valores de la minuta*/
  $consulta19="SELECT CantidadPersonas from tbl_catalogotemporal where CodigoCatalogoEvento ='$cod'";
  $valor19 = mysqli_query ($conn,$consulta19);
  $vari= mysqli_fetch_array ($valor19);
  $cantidad=$vari['CantidadPersonas'];
 
    
  if(isset($_POST['btn_paquete']) ){ 

    $consulta = mysqli_query($conn,"SELECT PrecioTotal FROM tbl_catalogotemporal");
    $total = 0; // total declarado antes del bucle
    while($row = mysqli_fetch_array($consulta))
    {
      $total = $total + $row['PrecioTotal']; // Sumar variable $total + resultado de la consulta
    }


  
    ///CONDICION
    if(($total==0)){
      echo '<script>
      alert("Realize algún Paquete");
      </script>';
    }else{
      $consulta18="SELECT CodigoUsuario from tbl_usuario where Usuario = '$usuario'";
      $parametro18 = mysqli_query ($conn,$consulta18);
      $codigo18= mysqli_fetch_array ($parametro18);
  
       
  
    //Insertamos el numero del paquete
    $insert_pedido=mysqli_query($conn,"INSERT INTO `tbl_eventos`(`CodigoUsuario`, `CodigoEstadoEvento`, `SubTotal`) VALUES ('$codigo18[0]',4,'$total')");
  
    //Ultimo codigo
    $ultimo_codigo=mysqli_insert_id($conn); 
  
    
    
    $_SESSION['cod']=$ultimo_codigo;
  
    //Asignación del numero del paquete
    //$updatepaquete=mysqli_query($conn,"UPDATE tbl_paquete SET Descripcion = 'PAQUETE #$ultimo_codigo'");
  
         //Insertamos en Catalago eventos predeterminados

    $update=mysqli_query($conn,"UPDATE tbl_catalogotemporal SET NumeroEvento = '$ultimo_codigo'");
    $update=mysqli_query($conn,"UPDATE tbl_catalogotemporal SET  CodigoCatalogoEvento= '$cod'");


    if($update){
  //Actualizamos paquete temporal
   
      //Insertamos en Catalago eventos predeterminados
      $insert_detalles=mysqli_query($conn,"INSERT INTO `tbl_detalleevento`(NumeroEvento,CodigoTipoCatalogo, CantidadPersonas, Descripcion, Precio, PrecioTotal)
      SELECT NumeroEvento, CodigoTipoCatalogo, CantidadPersonas, Descripcion, Precio, PrecioTotal FROM tbl_catalogotemporal");
  
    
    
      //Eliminar los datos de la tabla temporal
       $consulta1= mysqli_query($conn, "TRUNCATE TABLE tbl_catalogotemporal");
  echo '<script>
           alert("Creado exitosamente");
           </script>';
  
           header("Location:eventos_agregarcliente.php");
    }
  
    }
  
  }
  
  
  if(isset($_POST['btnguardar'])){
  
  $cantidad=$_POST['CantidadPersonas'];
  
  if(empty($_POST['CantidadPersonas'])){
      echo '<script>
               alert("Ingrese el número de Personas");
            </script>';
    }else{

                //CALCULO DE COMIDA
                if(!isset($_POST['comida'])){
                  $comida='';
                  $acum_comida=0;
                  $comida1='';
               }else{
                 $comida = $_POST['comida'];
                 $acum_comida= '0';
                 $comida1 = implode(', ', $_POST['comida']);
                 if(is_array($comida)){
                   foreach($comida as $comida){
                     $consulta3="SELECT PrecioTotal from tbl_catalogoproductoeventos where NombreProducto = '$comida'";
                     $parametro3 = mysqli_query ($conn,$consulta3);
                     $valor3= mysqli_fetch_array ($parametro3);
                     $precio3 = $valor3[0];
           
                     $consulta4="SELECT NombreProducto from tbl_catalogoproductoeventos where NombreProducto = '$comida'";
                     $parametro4 = mysqli_query ($conn,$consulta4);
                     $valor4= mysqli_fetch_array ($parametro4);
                     $codigo4 = $valor4[0];
       
                     $consulta5="SELECT CodigoTipoCatalogo from tbl_catalogoproductoeventos where NombreProducto = '$comida'";
                     $parametro5 = mysqli_query ($conn,$consulta5);
                     $valor5= mysqli_fetch_array ($parametro5);
                     $codigo5 = $valor5[0];
           
                     $total=$precio3*$cantidad;
           
                     //INSERT
                     $catalogo="INSERT INTO tbl_catalogotemporal(CodigoCatalogoEvento, CodigoTipoCatalogo, Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod','$codigo5','$codigo4','$cantidad','$precio3','$total')";
                     $resultado=mysqli_query($conn,$catalogo);
           
                     $acum_comida=$acum_comida+$precio3;
                   }
           
                 }  
               }
               $precio_comida=$acum_comida*$cantidad;
           
               //CALCULO DE GOLOSINAS
               if(empty($_POST['golosina'])){
                 $golosina='';
                 $acum_golosina=0;
                 $golosina1='';
               }else{
                 $golosina =  $_POST['golosina'];
                 $acum_golosina=0;
                 $golosina1 = implode(', ', $_POST['golosina']);
                 if(is_array($golosina)){
                   foreach($golosina as $golosina){
                     $consulta6="SELECT PrecioTotal from tbl_catalogoproductoeventos where NombreProducto = '$golosina'";
                     $parametro6 = mysqli_query ($conn,$consulta6);
                     $valor6= mysqli_fetch_array ($parametro6);
                     $precio6 = $valor6[0];
             
                     $consulta7="SELECT NombreProducto from tbl_catalogoproductoeventos where NombreProducto = '$golosina'";
                     $parametro7 = mysqli_query ($conn,$consulta7);
                     $valor7= mysqli_fetch_array ($parametro7);
                     $codigo7 = $valor7[0];
       
                     $consulta8="SELECT CodigoTipoCatalogo from tbl_catalogoproductoeventos where NombreProducto = '$golosina'";
                     $parametro8 = mysqli_query ($conn,$consulta8);
                     $valor8= mysqli_fetch_array ($parametro8);
                     $codigo8 = $valor8[0];
           
                     $total1=$precio6*$cantidad;
                    
                     //INSERT
                     $catalogo="INSERT INTO tbl_catalogotemporal(CodigoCatalogoEvento, CodigoTipoCatalogo, Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod','$codigo8','$codigo7','$cantidad','$precio6','$total1')";
                     $resultado=mysqli_query($conn,$catalogo);
           
                     $acum_golosina=$acum_golosina+$precio6;
                   }
                 }
               }
               $precio_golosina=$acum_golosina*$cantidad;
           
               //CALCULO DE POSTRES
               if(empty($_POST['postres'])){
                 $postres='';
                 $acum_postres=0;
                 $postres1='';
              }else{
                $postres = $_POST['postres'];
                $acum_postres=0;
                $postres1 = implode(', ', $_POST['postres']);
                if(is_array($postres)){
                  foreach($postres as $postres){
                    $consulta9="SELECT PrecioTotal from tbl_catalogoproductoeventos where NombreProducto = '$postres'";
                    $parametro9 = mysqli_query ($conn,$consulta9);
                    $valor9= mysqli_fetch_array ($parametro9);
                    $precio9 = $valor9[0];
            
                    $acum_postres=$acum_postres+$precio9;
           
                    $consulta10="SELECT NombreProducto from tbl_catalogoproductoeventos where NombreProducto = '$postres'";
                    $parametro10 = mysqli_query ($conn,$consulta10);
                    $valor10= mysqli_fetch_array ($parametro10);
                    $codigo10 = $valor10[0];
       
                    $consulta11="SELECT CodigoTipoCatalogo from tbl_catalogoproductoeventos where NombreProducto = '$postres'";
                    $parametro11 = mysqli_query ($conn,$consulta11);
                    $valor11= mysqli_fetch_array ($parametro11);
                    $codigo11 = $valor11[0];
           
                    $total3=$precio9*$cantidad;
                    
                    //INSERT
                    $catalogo="INSERT INTO tbl_catalogotemporal(CodigoCatalogoEvento,CodigoTipoCatalogo, Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod','$codigo11','$codigo10','$cantidad','$precio9','$total3')";
                    $resultado=mysqli_query($conn,$catalogo);
                  }
                }
              }
              $precio_postres=$acum_postres*$cantidad;
              
           
              //CALCULO DE SERVICIOS
              if(empty($_POST['servicio'])){
               $servicio="";
               $acum_servicio=0;
               $servicio1='';
             }else{
               $servicio = $_POST['servicio'];
               $acum_servicio=0;
               $servicio1 = implode(', ', $_POST['servicio']);
               if(is_array($servicio)){
                 foreach($servicio as $servicio){
                   $consulta12="SELECT PrecioTotal from tbl_catalogoproductoeventos where NombreProducto = '$servicio'";
                   $parametro12 = mysqli_query ($conn,$consulta12);
                   $valor12= mysqli_fetch_array ($parametro12);
                   $precio12 = $valor12[0];
           
                   $acum_servicio=$acum_servicio+$precio12;
           
                   $consulta13="SELECT NombreProducto from tbl_catalogoproductoeventos where NombreProducto = '$servicio'";
                   $parametro13 = mysqli_query ($conn,$consulta13);
                   $valor13= mysqli_fetch_array ($parametro13);
                   $codigo13 = $valor13[0];
       
                   $consulta14="SELECT CodigoTipoCatalogo from tbl_catalogoproductoeventos where NombreProducto = '$servicio'";
                   $parametro14 = mysqli_query ($conn,$consulta14);
                   $valor14= mysqli_fetch_array ($parametro14);
                   $codigo14 = $valor14[0];
           
                   $total4=$precio12;
                    
                   //INSERT
                   $catalogo="INSERT INTO tbl_catalogotemporal(CodigoCatalogoEvento,CodigoTipoCatalogo, Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod','$codigo14','$codigo13', '$cantidad','$precio12','$total4')";
                   $resultado=mysqli_query($conn,$catalogo);
                 }
               }
             }
             $precio_servicio=$acum_servicio;
           
                  //CALCULO DE TOPPINGS
                  if(empty($_POST['topping'])){
                   $topping="";
                   $acum_topping=0;
                   $topping1='';
                 }else{
                   $topping = $_POST['topping'];
                   $acum_topping=0;
                   $topping1 = implode(', ', $_POST['topping']);
                   if(is_array($topping)){
                     foreach($topping as $topping){
                       $consulta15="SELECT Precio from tbl_toppings where Nombre = '$topping'";
                       $parametro15 = mysqli_query ($conn,$consulta15);
                       $valor15= mysqli_fetch_array ($parametro15);
                       $precio15 = $valor15[0];
               
                       $acum_topping=$acum_topping+$precio15;
           
                       $consulta16="SELECT Nombre from tbl_toppings where Nombre = '$topping'";
                       $parametro16 = mysqli_query ($conn,$consulta16);
                       $valor16= mysqli_fetch_array ($parametro16);
                       $codigo16 = $valor16[0];
               
                       $total5=$precio15*$cantidad;
                        
                       //INSERT
                       $catalogo="INSERT INTO tbl_catalogotemporal(CodigoCatalogoEvento,CodigoTipoCatalogo,Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod',NULL,'$codigo16','$cantidad','$precio15','$total5')";
                       $resultado=mysqli_query($conn,$catalogo);
                     }
                   }
                 }
                 $precio_topping=$acum_topping*$cantidad;
             
               
          
          

    
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

    <!-- Main content -->
    <section class="content-header">

   
            <!-- Horizontal Form -->
            <div class="card card-info">
            <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

              <div class="card-header text-center" >
                <h3 class="card-title" align ="center" >Evento a Realizar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="eventos_agregar.php?CodigoCatalogoEvento=<?php echo $_GET['CodigoCatalogoEvento']; ?>" method="POST" autocomplete="off">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                      <div align ="center" id="modal_footer">
                      <label for="inputEmail3" class="col-sm-8 col-form-label">Si desea agregar un complemento más para su evento</label>
                      </div>
                
                      <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Cantidad Extra</label>
                    <div class="col-sm-6">
                        <input type="text" name="CantidadPersonas" onkeypress="return solonumeros(event);" id="CantidadPersonas" value="<?php if(isset($cantidad)) echo $cantidad ?>"  class="form-control" placeholder="N° de Personas" >
                    </div>
                  </div>
                    
                





                
                      <div class="form-group row">
                <label  for="golosina" class="col-sm-4 col-form-label">Comida</label>
                   
                    <select  class="col-sm-6" name="comida[]" id="comida" multiple="multiple" >
                      <?php
                           $query_comida = mysqli_query($conn,"SELECT * FROM tbl_catalogoproductoeventos where CodigoTipoCatalogo = 1");
                           $result_comida = mysqli_num_rows($query_comida);
               
                        ?>   
                         <?php 
            if($result_comida > 0)
            {
              while ($comida = mysqli_fetch_array($query_comida)) {
          ?> 
                      <option value="<?php echo $comida["NombreProducto"]; ?>"><?php echo $comida["NombreProducto"] ?></option>     
                        <?php 
                          }       
                        }   
                        ?>  
                    </select> 
                    <script>
     // Initialize multiple select on your regular select
     $("#comida").multipleSelect({
        filter: true
    });
</script>

                    </div>


        
                    
                    <div class="form-group row">
                <label for="golosina" class="col-sm-4 col-form-label">Golosina</label>
                   
                    <select class="col-sm-6" name="golosina[]" id="golosina" multiple="multiple">
                      <?php
                           $query_golosina = mysqli_query($conn,"SELECT * FROM tbl_catalogoproductoeventos where CodigoTipoCatalogo = 2");
                           $result_golosina = mysqli_num_rows($query_golosina);
               
                        ?>   
                         <?php 
            if($result_golosina > 0)
            {
              while ($golosina = mysqli_fetch_array($query_golosina)) {
          ?> 
                <option value="<?php echo $golosina["NombreProducto"] ?>"><?php echo $golosina["NombreProducto"]; ?></option>     

                        <?php 
                          }       
                        }   
                        ?>  
                    </select> 
                    <script>
     // Initialize multiple select on your regular select
     $("#golosina").multipleSelect({
        filter: true
    });
</script>
                    </div>
         
                    <div class="form-group row">
                <label for="postre" class="col-sm-4 col-form-label">Postre</label>
                    <select class="col-sm-6" name="postres[]" id="postres" multiple="multiple">
                      <?php
                           $query_postre = mysqli_query($conn,"SELECT * FROM tbl_catalogoproductoeventos where CodigoTipoCatalogo = 4");
                           $result_postre = mysqli_num_rows($query_postre);
               
                        ?>   
                         <?php 
            if($result_postre > 0)
            {
              while ($postre = mysqli_fetch_array($query_postre)) {
          ?> 
           <option value="<?php echo $postre["NombreProducto"] ?>"><?php echo $postre["NombreProducto"]; ?></option>     

                        <?php 
                          }       
                        }   
                        ?>  
                      </select>
                      <script>
     // Initialize multiple select on your regular select
     $("#postres").multipleSelect({
        filter: true
    });
</script>
                    </div>    
              <div class="form-group row">
                <label for="servicio" class="col-sm-4 col-form-label">Servicio</label>
                    <select class="col-sm-6" name="servicio[]" id="servicio" multiple="multiple">
                      <?php
                           $query_servicio = mysqli_query($conn,"SELECT * FROM tbl_catalogoproductoeventos where CodigoTipoCatalogo = 3");
                           $result_servicio = mysqli_num_rows($query_servicio);
               
                        ?>   
                         <?php 
            if($result_servicio > 0)
            {
              while ($servicio = mysqli_fetch_array($query_servicio)) {
          ?> 
           <option value="<?php echo $servicio["NombreProducto"] ?>"><?php echo $servicio["NombreProducto"]; ?></option>     

                        <?php 
                          }       
                        }   
                        ?>  
                    </select> 
                    <script>
     // Initialize multiple select on your regular select
     $("#servicio").multipleSelect({
        filter: true
    });
</script>
              </div>
              <div class="form-group row">
                <label for="extra" class="col-sm-4 col-form-label">Toppings de Minutas</label>
                    <select class="col-sm-6" name="topping[]" id="topping" multiple="multiple">
                      <?php
                           $query_extra = mysqli_query($conn,"SELECT * FROM tbl_toppings");
                           $result_extra = mysqli_num_rows($query_extra);
               
                        ?>   
                         <?php 
            if($result_extra > 0)
            {
              while ($extra = mysqli_fetch_array($query_extra)) {
          ?> 
           <option value="<?php echo $extra["Nombre"] ?>"><?php echo $extra["Nombre"]; ?></option>     

                        <?php 
                          }       
                        }   
                        ?>  
                    </select> 
                    <script>
     // Initialize multiple select on your regular select
     $("#topping").multipleSelect({
        filter: true
    });
</script>
              </div>
              <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
                      <button name='btnguardar' value="btnguardar" type="submit" class="btn btn-success">Cargar</button>
            <?php } ?>
              </div>
              
              <div class="col-sm-6">
                    <!-- radio -->
                    <div class="row">
                  <div class="col-sm-6">
                    <!-- checkbox -->
                    <div class="form-group">
                        <img  src="dist/img/evento4.png" height="250" width="250">
                    </div>
                    <div class="form-group">
                        <img  src="dist/img/evento8.png" height="250" width="250">
                    </div>
                    </div>
                  <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group">
                        <img  src="dist/img/evento9.png" height="250" width="250">
                    </div>
                    <div class="form-group">
                        <img  src="dist/img/evento10.png" height="250" width="250">
                    </div>
                  </div>
                  </div>
                
              </div>
              </div>
               
                      
                      <div align ="center" id="modal_footer">
                      <label for="inputEmail3" class="col-sm-25 col-form-label">Información del Paquete</label>
                      </div>
                 <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <td class="text-center">Numero</td>
                  <td class="text-center">N° de Personas</td>
                  <td class="text-center">Descripcion</td>
                  <td class="text-center">Precio unidad</td>
                  <td class="text-center">Precio Total</td>
                  <td class="text-center">Action</td>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <?php
                          $sql="SELECT * from tbl_catalogotemporal";
                          $result=mysqli_query($conn,$sql);
                          while($mostrar=mysqli_fetch_array($result)){
                          ?>
                                 <td class="text-center"><?php echo $mostrar['CodigoTemporalCatalogo']?></td>
                                 <td class="text-center"><?php echo $mostrar['CantidadPersonas']?></td>
                                 <td class="text-center"><?php echo $mostrar['Descripcion']?></td>
                                <td class="text-center"><?php echo $mostrar['Precio']?></td>
                                <td class="text-center"><?php echo $mostrar['PrecioTotal']?></td>
                            <td class="text-center"> <div class="text-center">
                    <div class="btn-group">
                    <a href="../eventos/eventos_catalogotemporal2.php?CodigoTemporalCatalogo=<?php echo $mostrar['CodigoTemporalCatalogo']?>" class="btn btn-danger">
                      <i class="fa fa-trash"></i> 
                    </a>
                  </div>
              </div>
          </td>
                  </tr>
                  </tfoot>
                  <?php
    }
   ?>

                </table>
                </div>

                  <div class="row mb-1">
          <div class="col-sm-5">
          <ol class="float-sm-left">
          <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
                  <button type="" id='btn_paquete' name='btn_paquete' type="" class="btn btn-block btn-info">Realizar</button>
            <?php } ?>
            </ol>
          </div>
          <div class="col-sm-5">
            <ol class="float-sm-right">
            <button name='Salir' value="btnupdate" type="submit" class="btn btn-block bg-gradient-danger">Salir</button>
            </ol>
            <?php
            if (isset($_POST['Salir'])){
                if ($_POST['Salir']){
                  $consul= mysqli_query($conn, "TRUNCATE TABLE tbl_catalogotemporal");
                      echo '<script>
                      alert(" Salir con éxito. ");
                      window.location="eventos_eventosdetallados.php";
                      </script>';
                }
              }
            ?>
          </div>
                  
                </div>
                
                <div class="">
                
                    </div>
                  </div>
            
              
          
                <!-- /.card-body -->

            </div>
        
             </div>
              
           

            </div>       <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
            
             <?php } ?>


           <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
            
             <?php } ?>


             <?php  if($permiso_eliminar==1){?><!-- ejemplo quitar permiso de eliminar------------------------------------------------------------->
             
             <?php } ?></div>
          <!-- right column -->
          <?php } ?> <!--  finn ocultat permiso de ocultar ------------------------------------------------------------->
    <!-- /.content -->
    <?php  if($permiso_consultar==0){?> <!--si lo hay permiso de consultar  ------------------------------------------------------------->
     
      <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Error!</strong> <strong>005</strong> Contacta con el administrador.
</div>

      <?php } ?> <!---------------------------  fin mensaje de oculto----------------------------------->
  </div>

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
<script src="dist/js/bootstrap-multiselect.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
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
</script>

</body>
</html>
