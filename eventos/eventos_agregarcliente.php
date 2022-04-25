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
  

   if(isset($_POST['btnguardar'])){
    $alert='';
		if(empty($_POST['CodigoPersona']) || empty($_POST['fechaevento']) || empty($_POST['hora']) || empty($_POST['direccion']) || empty($_POST['telefono']) || empty($_POST['transporte']) )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
    $Cliente = $_POST['CodigoPersona'];
    $Fecha = $_POST['fechaevento'];
    $Hora  = $_POST['hora'];
    $Ubicacion  = $_POST['direccion'];
    $telefono  = $_POST['telefono'];
    $transporte  = $_POST['transporte'];
      $codigo=$_SESSION['cod'];


      $consulta = mysqli_query($conn,"SELECT PrecioTotal FROM tbl_detalleevento where NumeroEvento = '$codigo' ");
      $total = 0; // total declarado antes del bucle
      while($row = mysqli_fetch_array($consulta))
      {
        $total = $total + $row['PrecioTotal']; // Sumar variable $total + resultado de la consulta
      }
    
   $consultparametro="SELECT valor from tbl_parametros where Parametro = 'ADMIN_ISV_EVENTOS'";
    $parametro11 = mysqli_query ($conn,$consultparametro);
    $valor= mysqli_fetch_array ($parametro11);
    $v=$valor[0]/100;

    $tot = $total + $transporte;

    $subtotal =  $tot * $v;

    $totalpaquete = $tot + $subtotal;
    
    //Ultimo codigo
    $ultimo_codigo=mysqli_insert_id($conn); 

             //Actualizamos pedido temporal
        $consul=mysqli_query($conn,"UPDATE tbl_eventos SET CodigoPersona='$Cliente', Direccion='$Ubicacion', Hora='$Hora', Telefono='$telefono', FechaEvento='$Fecha', ISV='$subtotal', PrecioTotal='$totalpaquete', Transporte='$transporte', SubTotal='$tot' WHERE NumeroEvento ='$codigo'");

        if($consul){
          echo '<script>
window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_detallados.php?NumeroEvento='.$codigo.'";
</script>';
  }else{
      echo '<script>
    alert(" Vuelva a ingresar los datos. Volver a comenzar  ");
    window.location="eventos_agregar.php";
    </script>';
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

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

 
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
      
   <div class="form-group row">
   
            <!-- Horizontal Form -->
            <div class="card card-info">
            
              <div class="card-header text-center" >
                <h3 class="card-title" align ="center" >Datos General del Cliente</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form class="form-horizontal" method="POST" autocomplete="off">
              <div class="card-body">
 
                      <!-- checkbox -->
                      <div class="card-body">
                  <div class="form-group row">
                  <label for="cliente" class="col-sm-4 col-form-label">Nombre del Cliente</label>
                      <div class="col-sm-8">
                      <select name="CodigoPersona" id="CodigoPersona" class="form-control" autofocus>
                        <option selected>Ingrese el Cliente....</option>
                        <?php
                             $query_cliente = mysqli_query($conn,"SELECT CodigoPersona, NombreCompleto from tbl_personas where CodigoTipoPersona = 1 ORDER BY NombreCompleto ASC");
                             $result_cliente = mysqli_num_rows($query_cliente);
                 
                        ?>   
                           <?php 
                                if($result_cliente > 0)
                                {
                                  while ($Cliente = mysqli_fetch_array($query_cliente)) {
                             ?> 
                                <option value="<?php echo $Cliente["CodigoPersona"]; ?>"><?php echo $Cliente["NombreCompleto"] ?></option>     
                          <?php 
                            }       
                          }   
                          ?>  
                      </select> 
                </div>
                </div>
                
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Fecha a Realizar</label>
                    <div class="col-sm-8">
                        <input type="date" name="fechaevento" id="fechaevento" class="form-control" value="" placeholder="Ingrese la Fecha a Realizar">
                    </div>
                  </div>
                  <div class="bootstrap-timepicker">
                  <div class="form-group row">
                  <label for="cliente" class="col-sm-4 col-form-label">Hora</label>
                  <div class="col-sm-8">
                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                      <input type="text" name="hora" id="hora" class="form-control datetimepicker-input" data-target="#timepicker"/>
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
                    <div class="col-sm-8">
                        <textarea onkeypress="comprobarEspacios(); return sololetras(event);" type="text" name="direccion" id="direccion"  OnKeyUp="this.value=this.value.toUpperCase();" rows="5" class="form-control" value="" placeholder="Ingrese la Dirección del Evento"></textarea>

                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Numero de Teléfono</label>
                    <div class="col-sm-8">
                        <input type="text" onkeypress="return solonumeros(event);" pattern=".{8,8}" maxlength="8" name="telefono" class="form-control" value="" placeholder="Ingrese el Numero de Teléfono" pattern="[0-9]+">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Transporte</label>
                    <div class="col-sm-5">
                        <input type="text" onkeypress="return solonumeros(event);" name="transporte" class="form-control" value="" placeholder="Ingrese el Costo del Trans.">
                    </div>
                  </div>

                  </div>
   
            
             
            
                  
                      
                    

               
           
                  <div class="">
                      <button type="" id='btnguardar' name='btnguardar' type="" class="btn btn-block btn-info md-3">Realizar</button>
                    </div>
                  </div>
                    <div class="form-group">
                    <div class="row">
                      
                    </div>
            </div>
                  </div>
                  
                  </div>
               
                <!-- /.card-footer -->
              </form>
  </div>
            </div>
            <!-- /.card -->

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

  function comprobarEspacios() {
			
			let input = document.getElementById('direccion');

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
