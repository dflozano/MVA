<?php 
  include ('conexión.php');
  include 'funcionBitacora.php';
  session_start();
  $usuario=$_SESSION['usuario'];
  $CodObjeto=31;
  $accion='Update';
  $descrip='Editar el detalle del eventos';
  bitacora($CodObjeto,$accion,$descrip);

    $cod=$_GET['NumeroEvento'];

    //VALORES
    $consulta="SELECT * from tbl_eventos where NumeroEvento = '$cod'";
    $consulta1 = mysqli_query($conn,$consulta);
    $valores= mysqli_fetch_array($consulta1);
    $estado1 = $valores['CodigoEstadoEvento'];

if($estado1==1 OR $estado1==3){
    echo '<script>
    alert("El estado del Evento debe ser No Pagado");
    window.location="eventos_eventosdetallados.php";
    </script>';
  }else{

  $consulta12="SELECT NumeroEvento from tbl_detalleevento where NumeroEvento = '$cod'";
$valor11 = mysqli_query ($conn,$consulta12);
$valor12= mysqli_fetch_array ($valor11);
$codigo1=$valor12[0];

if (isset($_GET['NumeroEvento'])) {
            $consulta2="SELECT e.NumeroEvento, e.CodigoPersona, e.CodigoEstadoEvento, es.Estado, p.NombreCompleto, e.Hora, e.Direccion, e.Telefono, e.FechaEvento, e.Transporte
            from tbl_eventos as e 
            inner join tbl_personas as p ON p.CodigoPersona = e.CodigoPersona 
            inner join tbl_estadoevento as es ON es.CodigoEstadoEvento = e.CodigoEstadoEvento
            WHERE e.NumeroEvento = '$cod'";
            $conResul1=mysqli_query($conn,$consulta2);
          
            if (mysqli_num_rows($conResul1)==1){
                $fila=mysqli_fetch_array($conResul1);
                $NumeroEvento=$fila['NumeroEvento'];
    }  
}

if (isset($_GET['NumeroEvento'])) {
  $cod=$_GET['NumeroEvento'];
  $consulta="SELECT * from tbl_detalleevento where NumeroEvento = '$cod'" ;
                     $conResul=mysqli_query($conn,$consulta);
}

$sql1 = "SELECT CodigoPersona, NombreCompleto from tbl_personas where CodigoTipoPersona = 1 ORDER BY NombreCompleto ASC";
// echo $sql . "<br>";
$query_descripcion1 = mysqli_query($conn, $sql1 );
$resultado_descripcion1 = mysqli_num_rows($query_descripcion1);
$opciones_descripcion1 = ' ';
                         
    if ( $resultado_descripcion1 > 0 ){
     while ($cliente = mysqli_fetch_array($query_descripcion1) ){
            $opciones_descripcion1 .= '<option value="'.$cliente['CodigoPersona'].'">' .$cliente['NombreCompleto'] . '</option>';
    }
}

  $consultparametro="SELECT valor from tbl_parametros where Parametro = 'ADMIN_ISV_EVENTOS'";
  $parametro11 = mysqli_query ($conn,$consultparametro);
  $valor= mysqli_fetch_array ($parametro11);
  $v=$valor[0]/100;

if (isset($_POST['btnguardar'])){
  $cod=$_GET['NumeroEvento'];
  $cantidad = $_POST['CantidadPersonas'];

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
             $catalogo="INSERT INTO tbl_detalleevento(NumeroEvento,CodigoTipoCatalogo, Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod','$codigo5','$codigo4','$cantidad','$precio3','$total')";
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
             $catalogo="INSERT INTO tbl_detalleevento(NumeroEvento,CodigoTipoCatalogo, Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod','$codigo8','$codigo7','$cantidad','$precio6','$total1')";
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
            $catalogo="INSERT INTO tbl_detalleevento(NumeroEvento,CodigoTipoCatalogo, Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod','$codigo11','$codigo10','$cantidad','$precio9','$total3')";
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
           $catalogo="INSERT INTO tbl_detalleevento(NumeroEvento,CodigoTipoCatalogo,Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod','$codigo14','$codigo13','$cantidad','$total4','$total4')";
           $resultado=mysqli_query($conn,$catalogo);
         }
       }
     }
     $precio_servicio=$acum_servicio;

    //CALCULO DE TOPPINGS
    if(empty($_POST['toppings'])){
      $extra="";
      $acum_topping=0;
      $topping1='';
    }else{
      $extra = $_POST['toppings'];
      $acum_topping=0;
      $topping1 = implode(', ', $_POST['toppings']);
      if(is_array($extra)){
        foreach($extra as $extra){
          $consulta15="SELECT Precio from tbl_toppings where Nombre = '$extra'";
          $parametro15 = mysqli_query ($conn,$consulta15);
          $valor15= mysqli_fetch_array ($parametro15);
          $precio15 = $valor15[0];

          $acum_topping=$acum_topping+$precio15;

          $consulta16="SELECT Nombre from tbl_toppings where Nombre = '$extra'";
          $parametro16 = mysqli_query ($conn,$consulta16);
          $valor16= mysqli_fetch_array ($parametro16);
          $codigo16 = $valor16[0];
                
          $total5=$precio15*$cantidad;
                         
          //INSERT
          $catalogo="INSERT INTO tbl_detalleevento(NumeroEvento,CodigoTipoCatalogo,Descripcion, CantidadPersonas, Precio, PrecioTotal) VALUES('$cod',NULL,'$codigo16','$cantidad','$precio15','$total5')";
          $resultado=mysqli_query($conn,$catalogo);
        }
      }
    }
    $precio_topping=$acum_topping*$cantidad;
    echo '<script>
    window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_editareventosdetallados.php?NumeroEvento='.$codigo1.'";
    </script>';
}
 

if (isset($_POST['btnpersona'])){
  /*Obtengo valores de la minuta*/
  $consulta17="SELECT * from tbl_detalleevento where NumeroEvento = '$cod'";
  $valor17 = mysqli_query ($conn,$consulta17);
  $variable= mysqli_fetch_array ($valor17);
  $persona1=$variable['CantidadPersonas'];
  $precio1=$variable['Precio'];
  
$persona1=$_POST['CantidadP'];
$Fecha = $_POST['FechaEvento'];
  $Hora  = $_POST['Hora'];
  $Ubicacion  = $_POST['Direccion'];
  $telefono  = $_POST['Telefono1'];
   $transporte  = $_POST['Transporte'];
if ($_POST['CantidadP']){
  


  $consula17=mysqli_query($conn,"UPDATE tbl_detalleevento SET CantidadPersonas='$persona1', PrecioTotal=round(CantidadPersonas*Precio) where NumeroEvento = '$cod'");
  $consula18=mysqli_query($conn,"UPDATE tbl_detalleevento SET PrecioTotal=round(Precio) where NumeroEvento = '$cod' AND CodigoTipoCatalogo =3");


  $consulta1 = mysqli_query($conn,"SELECT PrecioTotal FROM tbl_detalleevento where NumeroEvento='$cod'");
  $total = 0; // total declarado antes del bucle
  while($row = mysqli_fetch_array($consulta1))
  {
    $total = $total + $row['PrecioTotal']; // Sumar variable $total + resultado de la consulta
  }  
  $tot = $total + $transporte;

  $subtotal =  $tot * $v;

  $totalpaquete = $tot + $subtotal;

  $consul=mysqli_query($conn,"UPDATE tbl_eventos SET  ISV='$subtotal', PrecioTotal='$totalpaquete', SubTotal='$tot' WHERE NumeroEvento ='$cod'");


  $consulta12="SELECT NumeroEvento from tbl_detalleevento where NumeroEvento = '$cod'";
$valor11 = mysqli_query ($conn,$consulta12);
$valor12= mysqli_fetch_array ($valor11);
$codigo1=$valor12[0];

    echo '<script>
    alert(" Guardo Correctamente ");
    window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_editareventosdetallados.php?NumeroEvento='.$codigo1.'";

    </script>';
}
else{
    echo '<script>
  window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_editareventosdetallados.php?NumeroEvento='.$codigo1.'";
  </script>';
}
}



if (isset($_POST['btnpersona'])){
  /*Obtengo valores de la minuta*/
  $consulta17="SELECT * from tbl_detalleevento where NumeroEvento = '$cod'";
  $valor17 = mysqli_query ($conn,$consulta17);
  $variable= mysqli_fetch_array ($valor17);
  $persona1=$variable['CantidadPersonas'];
  $precio1=$variable['Precio'];
  
$persona1=$_POST['CantidadP'];
$Fecha = $_POST['FechaEvento'];
  $Hora  = $_POST['Hora'];
  $Ubicacion  = $_POST['Direccion'];
  $telefono  = $_POST['Telefono1'];
  $catalogodes=$_POST['CodigoEstadoEvento'];
   $transporte  = $_POST['Transporte'];
if ($_POST['CantidadP']){
  


  $consula17=mysqli_query($conn,"UPDATE tbl_detalleevento SET CantidadPersonas='$persona1', PrecioTotal=round(CantidadPersonas*Precio) where NumeroEvento = '$cod'");
  $consula18=mysqli_query($conn,"UPDATE tbl_detalleevento SET PrecioTotal=round(Precio) where NumeroEvento = '$cod' AND CodigoTipoCatalogo =3");


  $consulta1 = mysqli_query($conn,"SELECT PrecioTotal FROM tbl_detalleevento where NumeroEvento='$cod'");
  $total = 0; // total declarado antes del bucle
  while($row = mysqli_fetch_array($consulta1))
  {
    $total = $total + $row['PrecioTotal']; // Sumar variable $total + resultado de la consulta
  }  
  $tot = $total + $transporte;

  $subtotal =  $tot * $v;

  $totalpaquete = $tot + $subtotal;

  $consul=mysqli_query($conn,"UPDATE tbl_eventos SET  ISV='$subtotal', PrecioTotal='$totalpaquete', SubTotal='$tot' WHERE NumeroEvento ='$cod'");


 

    echo '<script>
    alert(" Guardo Correctamente ");
    window.location="../eventos/eventos_eventosdetallados.php";

    </script>';
}
else{
    echo '<script>
  alert("ERR-011 Vuelva escribir la contraseña  ");
  window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_editareventosdetallados.php?NumeroEvento='.$codigo1.'";
  </script>';
}
}


if (isset($_POST['btnpaquete'])){
  $cod=$_GET['NumeroEvento'];
  $cliente = $_POST['CodigoPersona'];
  $Fecha = $_POST['FechaEvento'];
  $Hora  = $_POST['Hora'];
  $Ubicacion  = $_POST['Direccion'];
  $telefono  = $_POST['Telefono1'];
  $transporte  = $_POST['Transporte'];

  $consulta1 = mysqli_query($conn,"SELECT PrecioTotal FROM tbl_detalleevento where NumeroEvento='$cod'");
  $total = 0; // total declarado antes del bucle
  while($row = mysqli_fetch_array($consulta1))
  {
    $total = $total + $row['PrecioTotal']; // Sumar variable $total + resultado de la consulta
  }  
  $tot = $total + $transporte;

  $subtotal =  $tot * $v;

  $totalpaquete = $tot + $subtotal;

  $consul=mysqli_query($conn,"UPDATE tbl_eventos SET CodigoPersona='$cliente', Direccion='$Ubicacion', Hora='$Hora', Telefono='$telefono', FechaEvento='$Fecha' WHERE NumeroEvento ='$cod'");
  $consul=mysqli_query($conn,"UPDATE tbl_eventos SET  ISV='$subtotal', PrecioTotal='$totalpaquete', SubTotal='$tot' WHERE NumeroEvento ='$cod'");


if ($_POST['CodigoPersona']){
$consulta1 = mysqli_query($conn,"SELECT PrecioTotal FROM tbl_detalleevento where NumeroEvento='$cod'");
$total = 0; // total declarado antes del bucle
while($row = mysqli_fetch_array($consulta1))
{
 $total = $total + $row['PrecioTotal']; // Sumar variable $total + resultado de la consulta
}  
$tot = $total + $transporte;

$subtotal =  $tot * $v;

$totalpaquete = $tot + $subtotal;

$consul=mysqli_query($conn,"UPDATE tbl_eventos SET CodigoPersona='$cliente', Direccion='$Ubicacion', Hora='$Hora', Telefono='$telefono', FechaEvento='$Fecha' WHERE NumeroEvento ='$cod'");
  $consul=mysqli_query($conn,"UPDATE tbl_eventos SET  ISV='$subtotal', PrecioTotal='$totalpaquete', SubTotal='$tot' WHERE NumeroEvento ='$cod'");

echo  '<script>
alert("Guardo Correctamente");
window.location="eventos_eventosdetallados.php";
</script>';
}else{
echo '<script>
alert(" Vuelva a ingresar los datos. Volver a comenzar  ");
window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_editareventosdetallados.php?NumeroEvento='.$codigo1.'";
</script>';
}
if ($_POST['Transporte']){
$consulta1 = mysqli_query($conn,"SELECT PrecioTotal FROM tbl_detalleevento where NumeroEvento='$cod'");
$total = 0; // total declarado antes del bucle
while($row = mysqli_fetch_array($consulta1))
{
$total = $total + $row['PrecioTotal']; // Sumar variable $total + resultado de la consulta
}  
$tot = $total + $transporte;

$subtotal =  $tot * $v;

$totalpaquete = $tot + $subtotal;

$consul=mysqli_query($conn,"UPDATE tbl_eventos SET CodigoPersona='$cliente', Direccion='$Ubicacion', Hora='$Hora', Telefono='$telefono', FechaEvento='$Fecha' WHERE NumeroEvento ='$cod'");
  $consul=mysqli_query($conn,"UPDATE tbl_eventos SET  ISV='$subtotal', PrecioTotal='$totalpaquete', SubTotal='$tot' WHERE NumeroEvento ='$cod'");

echo  '<script>
alert("Guardo Correctamente");
window.location="eventos_eventosdetallados.php";
</script>';
}else{
echo '<script>
alert(" Vuelva a ingresar los datos. Volver a comenzar  ");
window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_editareventosdetallados.php?NumeroEvento='.$codigo1.'";
</script>';
}

}
}

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
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
    <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <section class="content-header">

   
            <!-- Horizontal Form -->
            <div class="card card-info">
            
              <div class="card-header text-center" >
                <h3 class="card-title" align ="center" >Evento a Realizar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="eventos_editareventosdetallados.php?NumeroEvento=<?php echo $_GET['NumeroEvento']; ?>" method="POST" autocomplete="off">
              <div class="card-body">
                <form >
                <div class="row">
                    <div class="col-sm-7">
                      <!-- checkbox -->
                      <div align ="center" id="modal_footer">
                      <label for="inputEmail3" class="col-sm-5 col-form-label">Datos General del Cliente</label>
                      </div>
                      <div class="card-body">
                  <div class="form-group row">
                  <label for="cliente" class="col-sm-4 col-form-label">Nombre del Cliente</label>
                      <div class="col-sm-6">
                      <select name="CodigoPersona" id="CodigoPersona" name="tipo" class="form-control" autofocus>
                      <option value="<?php echo $fila['CodigoPersona']; ?>" ><?php echo $fila['NombreCompleto']; ?></option>
					                          <?php echo $opciones_descripcion1; ?>          
                      </select> 
                </div>
                </div>
                
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Fecha a Realizar</label>
                    <div class="col-sm-6">
                        <input type="date" name="FechaEvento" id="FechaEvento" class="form-control" value="<?php echo $fila['FechaEvento']; ?>" placeholder="Ingrese la Fecha a Realizar">
                    </div>
                  </div>
                  <div class="bootstrap-timepicker">
                  <div class="form-group row">
                  <label for="cliente" class="col-sm-4 col-form-label">Hora</label>
                  <div class="col-sm-6">
                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                      <input type="text" name="Hora" id="Hora" value="<?php echo $fila['Hora']; ?>" class="form-control datetimepicker-input" data-target="#timepicker"/>
                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                      </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Ubicación del Evento</label>
                    <div class="col-sm-6">
                        <textarea onkeypress="comprobarEspacios(); return sololetras(event);" type="text" name="Direccion" id="Direccion"  OnKeyUp="this.value=this.value.toUpperCase();" rows="5" class="form-control" placeholder="Ingrese la Dirección del Evento"><?php echo $fila['Direccion']; ?></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Numero de Teléfono</label>
                    <div class="col-sm-6">
                        <input type="text" name="Telefono1" pattern=".{8,8}" maxlength="8" onkeypress="return solonumeros(event);" class="form-control" value="<?php echo $fila['Telefono']; ?>" placeholder="Ingrese el Numero de Teléfono" pattern="[0-9]+">
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Transporte</label>
                    <div class="col-sm-6">
                        <input type="text" name="Transporte" class="form-control" onkeypress="return solonumeros(event);" value="<?php echo $fila['Transporte']; ?>" placeholder="Ingrese el Costo del Trans.">
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="descripcion1" class="col-sm-4 col-form-label">Descripcion del Evento</label>
                      <div class="col-sm-6">
                      <input type="text" name="Estado" class="form-control"  readonly=»readonly»  onkeypress="return solonumeros(event);" value="<?php echo $fila['Estado']; ?>" placeholder="Ingrese el Costo del Trans.">
                </div>
                </div>
                <label for="extra" class="col-sm-4 col-form-label">N° de Personas</label>
                <div class="col-sm-5">
                <div class="input-group mb-3">
                  <div class="input-group-prepend" >
                    <button type="submit" class="btn btn-primary" name='btnpersona' value="btnpersona">Guardar</button>
                  </div>
                  <!-- /btn-group -->
                  <input type="text" class="form-control" name="CantidadP" id="CantidadP" value="">
                </div>
                </div>
                  </div>
                  </div>



            <div class="row">
                  <div class="col-sm-12">
                      <!-- radio -->
                      <div align ="center" id="modal_footer">
                      <label for="inputEmail3" class="col-sm-25 col-form-label">       Agregar nuevos Complemento de Evento   </label>
                      </div>
                      <div class="card-body">
                      <div class="form-group row">
                  <label for="" class="col-sm-4 col-form-label">N° Personas</label>
                    <div class="col-sm-8">
                    <input type="text" name="CantidadPersonas" id="CantidadPersonas" class="form-control" value="" placeholder="Ingrese un N° de Personas">
                    </div>
                  </div>
                      <div class="form-group row">
                <label for="comida" class="col-sm-4 col-form-label">Comida</label>
                
                    <select class="col-sm-8" name="comida[]" id="comida" multiple="multiple" >
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
                   
                    <select class="col-sm-8" name="golosina[]" id="golosina" multiple="multiple">
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
                    <select class="col-sm-8" name="postres[]" id="postres" multiple="multiple">
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
                    <select class="col-sm-8" name="servicio[]" id="servicio" multiple="multiple">
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
                    <select class="col-sm-7" name="toppings[]" id="toppings" multiple="multiple">
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
     $("#toppings").multipleSelect({
        filter: true
    });
</script>
              </div>
              <div class="col-sm-0">
                <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
                       <button name='btnguardar' value="btnguardar" type="submit" class="btn btn-success">Cargar</button>

             <?php } ?>
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
                   while($fila=$conResul->fetch_array(MYSQLI_BOTH)){
                                              
                          ?>
                          <td class="text-center"><?php echo $fila['CantidadPersonas']?></td>
                                 <td class="text-center"><?php echo $fila['Descripcion']?></td>
                                <td class="text-center"><?php echo $fila['Precio']?></td>
                                <td class="text-center"><?php echo $fila['PrecioTotal']?></td>
                                <td class="text-center"> <div class="text-center">
                    <div class="btn-group">
                    <a href="../eventos/eventos_catalogotemporal.php?CodigoDetalleEvento=<?php echo $fila['CodigoDetalleEvento']?>" class="btn btn-danger"> 
                      <i class="fa fa-trash" ></i>
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
          <ol class="float-sm-left"><?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
                       <button name='btnpaquete' value="btnpaquete" type="submit" class="btn btn-success">Guardar</button>

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
                  $cod=$_GET['NumeroEvento'];
  $cliente = $_POST['CodigoPersona'];
  $Fecha = $_POST['FechaEvento'];
  $Hora  = $_POST['Hora'];
  $Ubicacion  = $_POST['Direccion'];
  $telefono  = $_POST['Telefono1'];
  $transporte  = $_POST['Transporte'];

  $consulta1 = mysqli_query($conn,"SELECT PrecioTotal FROM tbl_detalleevento where NumeroEvento='$cod'");
  $total = 0; // total declarado antes del bucle
  while($row = mysqli_fetch_array($consulta1))
  {
    $total = $total + $row['PrecioTotal']; // Sumar variable $total + resultado de la consulta
  }  
  $tot = $total + $transporte;

  $subtotal =  $tot * $v;

  $totalpaquete = $tot + $subtotal;

  $consul=mysqli_query($conn,"UPDATE tbl_eventos SET CodigoPersona='$cliente', Direccion='$Ubicacion', Hora='$Hora', Telefono='$telefono', FechaEvento='$Fecha' WHERE NumeroEvento ='$cod'");
  $consul=mysqli_query($conn,"UPDATE tbl_eventos SET  ISV='$subtotal', PrecioTotal='$totalpaquete', SubTotal='$tot' WHERE NumeroEvento ='$cod'");

                      echo '<script>
                      window.location="eventos_eventosdetallados.php";
                      </script>';
                }
              }
            ?>
          </div>
                  


           


             <?php  if($permiso_eliminar==1){?><!-- ejemplo quitar permiso de eliminar------------------------------------------------------------->
             
             <?php } ?>
             </div>
            </form>
                </div>
                  </div>
            </div>
                  </div>
                  
                  </div>
                <!-- /.card-body -->
                <!-- /.card-footer -->
              </form>
              <?php } ?> <!--  finn ocultat permiso de ocultar ------------------------------------------------------------->
    <!-- /.content -->
    <?php  if($permiso_consultar==0){?> <!--si lo hay permiso de consultar  ------------------------------------------------------------->
     
      <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Error!</strong> <strong>005</strong> Contacta con el administrador.
</div>

      <?php } ?> <!---------------------------  fin mensaje de oculto----------------------------------->
  </div>
            </div>
            <!-- /.card -->

            </div>
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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
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

     /*No dejar espacios contrasena*/
     function hola(evt){
    if(window.event){
      keynum = evt.keyCode;
    }else{
      keynum = evt.which;
    }

    if((keynum > 32 && keynum < 166) || keynum == 8){
      return true;
    }else{

    return false;
    }
  }

  function comprobarEspacios() {
			
			let input = document.getElementById('Direccion');

			let remplazar = input.value.replace(/(\s{1,})/g, ' ');

			input.value = remplazar;
		}
</script>
<script>
  $(function () {
    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    }) 
  })
</script>
</body>
</html>
