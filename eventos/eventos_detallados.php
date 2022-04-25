<?php 
  include ('conexión.php');
  include 'funcionBitacora.php';
  session_start();
  $usuario=$_SESSION['usuario'];

    $cod=$_GET['NumeroEvento'];

 
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

 





$usuariorol= $_SESSION['usuario'];//traer nombre del usuario que tiene la seccio
$sql_consulta="SELECT CodigoRol, Usuario FROM tbl_usuario where  Usuario='$usuariorol'";
$resultado_consulta=$conn->query($sql_consulta);//guarda la consulta
$row1=$resultado_consulta->fetch_assoc();//arreglo asociativo
$rol=($row1['CodigoRol']);  



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
                <div align ="center" id="modal_footer">
                      <label for="inputEmail3" class="col-sm-25 col-form-label">Datos General del Cliente</label>
                      </div>
                <div class="row">
                    <div class="col-sm-7">
                      <!-- checkbox -->
                      <div class="card-body">
                  <div class="form-group row">
                  <label for="cliente" class="col-sm-4 col-form-label">Nombre del Cliente</label>
                      <div class="col-sm-6">
                      <select name="CodigoPersona" id="CodigoPersona" disabled="disabled" name="tipo" class="form-control" autofocus>
                      <option value="<?php echo $fila['CodigoPersona']; ?>" ><?php echo $fila['NombreCompleto']; ?></option>
					                          <?php echo $opciones_descripcion1; ?>          
                      </select> 
                </div>
                </div>
                
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Fecha a Realizar</label>
                    <div class="col-sm-6">
                        <input type="date" name="FechaEvento" readonly=»readonly» id="FechaEvento" class="form-control" value="<?php echo $fila['FechaEvento']; ?>" placeholder="Ingrese la Fecha a Realizar">
                    </div>
                  </div>
                  <div class="bootstrap-timepicker">
                  <div class="form-group row">
                  <label for="cliente" class="col-sm-4 col-form-label">Hora</label>
                  <div class="col-sm-6">
                    <div class="input-group date" readonly=»readonly» id="timepicker" data-target-input="nearest">
                      <input type="text" name="Hora" id="Hora" value="<?php echo $fila['Hora']; ?>" disabled="disabled" class="form-control datetimepicker-input" data-target="#timepicker"/>
                      <div class="input-group-append" readonly=»readonly» data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text" readonly=»readonly»><i class="far fa-clock"></i></div>
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
                        <textarea type="text" name="Direccion" readonly=»readonly» onkeypress="comprobarEspacios(); return sololetras(event);"  OnKeyUp="this.value=this.value.toUpperCase();" rows="5" class="form-control" placeholder="Ingrese la Dirección del Evento"><?php echo $fila['Direccion']; ?></textarea>
                      </div>
                  </div>
                  
                
                </div>
             </div>



            <div class="row">
                  <div class="col-sm-12">
                      <!-- radio -->
                      <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Numero de Teléfono</label>
                    <div class="col-sm-6">
                        <input type="text" readonly=»readonly» name="Telefono1" pattern=".{8,8}" maxlength="9" onkeypress="return solonumeros(event);" class="form-control" value="<?php echo $fila['Telefono']; ?>" placeholder="Ingrese el Numero de Teléfono" pattern="[0-9]+">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Transporte</label>
                    <div class="col-sm-6">
                        <input type="text" readonly=»readonly» name="Transporte" class="form-control" onkeypress="return solonumeros(event);" value="<?php echo $fila['Transporte']; ?>" placeholder="Ingrese el Costo del Trans.">
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="descripcion1" class="col-sm-4 col-form-label">Descripcion del Evento</label>
                      <div class="col-sm-6">
                      <input type="text" name="Estado" class="form-control"  readonly=»readonly»  onkeypress="return solonumeros(event);" value="<?php echo $fila['Estado']; ?>" placeholder="Ingrese el Costo del Trans.">
                </div>
                </div>    
                    
              
                      
                      
                      </div>
                      </div>
                      </div>
                      
                      <div align ="center" id="modal_footer">
                      <label for="inputEmail3" class="col-sm-25 col-form-label">Información del Paquete</label>
                      </div>
              
           


 
               
        
 <div class="card-body">
 <table class="table table-condensed table-bordered table-striped">
            <thead>
            <tr>
     
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Precio Total</th>
             
            </tr>
            </thead>
            <tbody>
                <?php
                   while($fila=$conResul->fetch_array(MYSQLI_BOTH)){
                                              
                          ?>
                  <tr>
                    <td><center><?php echo $fila['CantidadPersonas'] ?></center></td>
                    <td><center><?php echo $fila['Descripcion'] ?></center></td>
                    <td><center><?php echo $fila['Precio'] ?></center></td>
                    <td><center><?php echo $fila['PrecioTotal'] ?></center></td>
                    </tr>
                    <?php } ?>
           
            
           
        
                <th colspan="3" class="text-center" class="text-letf">TOTAL DEL PAQUETE</th>
                <?php 
                  $consulta_tabla1="SELECT sum(preciototal) as PrecioTotal FROM tbl_detalleevento WHERE NumeroEvento = '$cod'" ;                            
                  $resultado_tablas1=mysqli_query($conn,$consulta_tabla1);
                  while($row1=mysqli_fetch_array($resultado_tablas1)){ 
                  ?>
                <td colspan="4"><center><?php echo $row1['PrecioTotal'] ?></center></td>
                <?php } ?>

            </tr>
            <tr>
            <?php 
                  $consulta_tabla2="SELECT * FROM tbl_eventos WHERE NumeroEvento = '$cod'" ;                            
                  $resultado_tablas2=mysqli_query($conn,$consulta_tabla2);
                  while($row2=mysqli_fetch_array($resultado_tablas2)){ 
                  ?>
                <th colspan="3" class="text-center" class="text-letf">TRANSPORTE</th>
                <td colspan="4" class="text-letf"><center><?php echo $row2['Transporte']; ?></center></td>
            </tr>
            <tr>
                <th colspan="3" class="text-center" class="text-letf">SUB TOTAL</th>
                <td colspan="4" class="text-letf"><center><?php echo $row2['SubTotal']; ?></center></td>
            </tr>
            <tr>
                <th colspan="3" class="text-center" class="text-letf">IVS</th>
                <td colspan="4" class="text-letf"><center><?php echo $row2['ISV']; ?></center></td>
            </tr>
            <tr>
                <th colspan="3" class="text-center" class="text-letf"><h4>TOTAL</h4></th>
                <td colspan="4" class="text-letf"><h4><center><?php echo $row2['PrecioTotal']; ?></center></h4></td>
            </tr>
            <?php } ?>

            </tfoot>
        </table>
            </div>
                   
                  <div class="row mb-1">
          <div class="col-sm-5">
          <ol class="float-sm-left">
          <a href="eventos_preguntarecibo.php?NumeroEvento=<?php echo $cod?>" class="btn btn-primary"><i class="fa fa-check"></i>    Listo</a>
           </ol>
           
          </div>
          <div class="col-sm-5">
            <ol class="float-sm-right">
            <button name='Salir' value="btnupdate" type="submit" class="btn btn-block bg-gradient-danger">Salir</button>
            </ol>
            <?php
            if (isset($_POST['Salir'])){
                if ($_POST['Salir']){
                      echo '<script>
                      window.location="eventos_eventosdetallados.php";
                      </script>';
                }
              }
            ?>
          </div>
          </div>
          </div>
                  </div>
            </div>
                  </div>
                  
                  </div>
                <!-- /.card-body -->
                <!-- /.card-footer -->
              </form>
              
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
			
			let input = document.getElementById('nombre');

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
