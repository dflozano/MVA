<?php 
 include 'conexión.php';
 include 'funcionBitacora.php';

 session_start();

 $cod=$_GET['CodigoUsuario'];
 if (isset($_GET['CodigoUsuario'])) {
  $consulta2="SELECT u.CodigoUsuario, u.NombreUsuario, u.Usuario, u.CodigoRol, r.Rol, u.Correo_Electronico, u.Fecha_Creacion, u.Fecha_Vencimiento, e.CodigoEstado, u.CodigoEstadoUsuario, e.Descripcion, u.Preguntas_Contestadas
  from tbl_usuario as u 
  join tbl_roles as r on r.codigorol = u.codigorol
  join tbl_estadousuario as e on e.codigoestado = u.codigoestadousuario WHERE CodigoUsuario = $cod";
  $conResul1=mysqli_query($conn,$consulta2);

  if (mysqli_num_rows($conResul1)==1){
      $fila=mysqli_fetch_array($conResul1);
      $CodigoUsuario=$fila['CodigoUsuario'];
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
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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

    <!-- Sidebar -->
    <?php include "../vistas/encabezado.php"; ?>    

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/principalusuarios.php">Inicio</a></li>
              <li class="breadcrumb-item active">Perfil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
        <!-- Main content -->    
   <section class="content">
      <div class="container-fluid">
            <div class="card">
            <div class="card-header">
        
                  
              <!-- /.card-header -->
              <div class="card-body">
             
              <div class="row">
                  <div class="col-sm-6">
                    <!-- checkbox -->
                  
                    <!-- checkbox -->

                  
                    <div class="form-group">
                    <div class="form-group">
                    <img src="dist/img/avatar5.png" class="img-circle elevation-10" height="300" width="300" alt="User Image">

                    </div>
                    <a href="../vistas/perfil_contraseña.php?CodigoUsuario=<?php echo $cod?>" class="btn btn-primary "><i class="fa fa-unlock"></i>  Cambio de Contraseña</a> 
                    <a href="../vistas/perfil_preguntas.php?CodigoUsuario=<?php echo $cod?>" class="btn btn-primary "><i class="fa fa-question-circle"></i>  Preguntas Secretas</a>

                  </div>
                </div>



                  <div class="col-sm-6">
                    <!-- radio -->
                    <div class="card card-info">
            
              <div class="card-header text-center">
              <h3 class="card-title">Información del Usuario</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="POST" autocomplete="off">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Usuario</label>
                    <input  readonly=»readonly»  onkeypress="return sololetras(event);" maxlength="50" minlength="10" OnKeyUp="this.value=this.value.toUpperCase();"  type="text" class="form-control" id="Usuario" name="Usuario" value="<?php echo $fila['Usuario']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nombre Completo</label>
                    <input readonly=»readonly» onkeypress="return sololetras(event);" maxlength="50" OnKeyUp="this.value=this.value.toUpperCase();" type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" value="<?php echo $fila['NombreUsuario']; ?>" >

                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Rol</label>
                    <input  readonly=»readonly»  onkeypress="return sololetras(event);" maxlength="50" minlength="10" OnKeyUp="this.value=this.value.toUpperCase();"  type="text" class="form-control" id="Usuario" name="Usuario" value="<?php echo $fila['Rol']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Correo Electronico</label>
                    <input type="text"  disabled=»disabled» class="form-control" id="Correo_Electronico" name="Correo_Electronico" value="<?php echo $fila['Correo_Electronico']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Preguntas Secretas Contestadas</label>
                    <input type="text"  disabled=»disabled» class="form-control" id="Correo_Electronico" name="Correo_Electronico" value="<?php echo $fila['Preguntas_Contestadas']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Estado</label>
                    <input type="text"  disabled=»disabled» class="form-control" id="Correo_Electronico" name="Correo_Electronico" value="<?php echo $fila['Descripcion']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Fecha de Vencimiento</label>
                    <input type="text" disabled=»disabled» class="form-control" id="Fecha_Vencimiento" name="Fecha_Vencimiento" value="<?php echo $fila['Fecha_Vencimiento']; ?>" >
                  </div>
                  
                </div>
                <!-- /.card-body -->

                
              </form>
           
                     
              
                   
       
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

    
  <!-- /.content-wrapper -->



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script><!-- libreria obligatoria para pdf -------------------- -->
<script src="plugins/pdfmake/vfs_fonts.js"></script><!-- libreria obligatoria para pdf -------------------- -->
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
      /*Mostart contrsenas*/
  function mostrarPassword(){
		var cambio = document.getElementById("antigua");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 

  function mostrar(){
		var cambio = document.getElementById("nueva");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	}
    function mostrar1(){
		var cambio = document.getElementById("confirmacion");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
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
</script>
<script>

window.onload = function() {
  var myInput = document.getElementById('antigua');
  myInput.onpaste = function(e) {
    e.preventDefault();
    ///alert("esta acción está prohibida");
  }
  
  myInput.oncopy = function(e) {
    e.preventDefault();
    //alert("esta acción está prohibida");
  }
}

window.onload = function() {
  var myInput = document.getElementById('nueva');
  myInput.onpaste = function(e) {
    e.preventDefault();
    ///alert("esta acción está prohibida");
  }
  
  myInput.oncopy = function(e) {
    e.preventDefault();
    //alert("esta acción está prohibida");
  }
}

window.onload = function() {
  var myInput = document.getElementById('confirmacion');
  myInput.onpaste = function(e) {
    e.preventDefault();
    ///alert("esta acción está prohibida");
  }
  
  myInput.oncopy = function(e) {
    e.preventDefault();
    //alert("esta acción está prohibida");
  }
}

</script>


</body>
</html>
