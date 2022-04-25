<?php
require 'conexión.php';
include 'funcionBitacora.php';

session_start();
$CodObjeto=14;
$accion='Actualizar';
$descrip='Se gestiono un cambio el Nombre, Correo, Rol o el Estado de Usuario';
bitacora($CodObjeto,$accion,$descrip);

if (isset($_GET['CodigoUsuario'])) {
  $cod=$_GET['CodigoUsuario'];
  $consulta2="SELECT u.CodigoUsuario, u.NombreUsuario, u.Usuario, u.CodigoRol, r.Rol, u.Correo_Electronico, u.Contraseña,u.Fecha_Creacion, u.Fecha_Vencimiento, e.CodigoEstado, u.CodigoEstadoUsuario, e.Descripcion	
  from tbl_usuario as u 
  join tbl_roles as r on r.codigorol = u.codigorol
  join tbl_estadousuario as e on e.codigoestado = u.codigoestadousuario WHERE CodigoUsuario = $cod";
  $conResul1=mysqli_query($conn,$consulta2);

  if (mysqli_num_rows($conResul1)==1){
      $fila=mysqli_fetch_array($conResul1);
      $CodigoUsuario=$fila['CodigoUsuario'];
  }  
}

$sql = "SELECT * FROM tbl_roles";
// echo $sql . "<br>";
$query_roles = mysqli_query($conn, $sql );
$resultado_roles = mysqli_num_rows($query_roles);
$opciones_roles = ' ';

if ( $resultado_roles > 0 ){
  while ( $rol = mysqli_fetch_array($query_roles) ){
    $opciones_roles .= '<option value="'.$rol['CodigoRol'].'">' . $rol['Rol'] . '</option>';
  }
}	

   $sqlu = "SELECT * FROM tbl_estadousuario";
// echo $sql . "<br>";
$query_estadou = mysqli_query($conn, $sqlu);
$resultado_estadou = mysqli_num_rows($query_estadou);
$opciones_estadou = ' ';

if ( $resultado_estadou > 0 ){
  while ( $estadou = mysqli_fetch_array($query_estadou) ){
    $opciones_estadou .= '<option value="'.$estadou['CodigoEstado'].'">' . $estadou['Descripcion'] . '</option>';
  }
}	


if (isset($_POST['Cambiar'])){
    $Usuarios=$_POST['Usuario'];
    $_SESSION['Usuario']=$Usuarios;
    $contraseña=$_POST['Contraseña'];
    $correo=$_POST['Correo_Electronico'];
    if ($contraseña){
        $contrasena= password_hash($contraseña, PASSWORD_DEFAULT);
        $conn->query("update tbl_usuario set Contraseña='$contrasena' where Usuario='$Usuarios' ") or die($conn->error);
        mail("$correo","Confirmación de Cambio de Contraseña", "$Usuarios", "$contraseña" );
        
        if ($Usuarios == 'ADMIN') {
            $CONSULTA = mysqli_query($conn, "UPDATE tbl_usuario set Fecha_Vencimiento = 'NULL' where Usuario = 'ADMIN'");
            echo  '<script>
            alert(" Guardado Correctamente ");
               window.location="../vistas/gestion_principal.php";
               </script>';
        }else{
        $consultparametro="SELECT valor from tbl_parametros where Parametro = 'ADMIN_DIAS_VIGENCIA'";
        $parametro = mysqli_query ($conn, $consultparametro);
        $valor= mysqli_fetch_array ($parametro);
        $v=$valor[0];  
        /*Actualizo la fecha de vencimiento */
        $vencimiento=mysqli_query($conn,"update tbl_usuario set Fecha_Vencimiento = date_add(Fecha_Creacion, interval $v day) where Usuario = '$Usuarios'");
        $date = date('Y-m-d');
        $modificacion=mysqli_query($conn,"update tbl_usuario set Fecha_Modificacion = ('$date')");
        $consult=mysqli_query($conn,"UPDATE tbl_usuario SET CodigoEstadoUsuario = 2 WHERE Usuario='$Usuarios'");
        
    }
        echo '<script>
        alert(" La contraseña fue cambiada exitosamente vuelve a ingresar. ");
        window.location="gestion_principal.php";
        </script>';
    }
}


if (isset($_POST['actualizar'])){
    $Usuarios=$_POST['Usuario'];
    $NombreUsuario=$_POST['NombreUsuario'];
    $correo=$_POST['Correo_Electronico'];
    $rol=$_POST['CodigoRol'];
    $estadou=$_POST['CodigoEstado'];
    if ($Usuarios == 'ADMIN') {
        $CONSULTA = mysqli_query($conn, "UPDATE tbl_usuario set CodigoEstadoUsuario = 2");
        $CONSULTA1 = mysqli_query($conn, "UPDATE tbl_usuario set CodigoRol = 1");
        echo  '<script>
        alert(" Guardado Correctamente ");
           window.location="gestion_principal.php";
           </script>';
    }else{
        $consul=mysqli_query($conn,"UPDATE tbl_Usuario SET CodigoRol = '$rol' , CodigoEstadoUsuario='$estadou', NombreUsuario='$NombreUsuario', Correo_Electronico='$correo' WHERE Usuario='$Usuarios'");

}
   echo  '<script>
     alert(" Guardado Correctamente ");
        window.location="gestion_principal.php";
        </script>';
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
  <link rel="icon" type="image/png" href="../dist/img/minuta.png">


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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <!-- Main content -->
       <!-- Main content -->
       <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
      
   <div class="form-group row">
   
            <!-- Horizontal Form -->
            <div class="card card-info">
            
              <div class="card-header text-center">
                <h3 class="card-title">Gestión de Usuarios</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="POST" autocomplete="off">
                <div class="card-body card-footer">
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Usuario</label>
                    <div class="col-sm-8">
                      <input  readonly=»readonly»  onkeypress="return sololetras(event);" maxlength="50" minlength="10" OnKeyUp="this.value=this.value.toUpperCase();"  type="text" class="form-control" id="Usuario" name="Usuario" value="<?php echo $fila['Usuario']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nombre de Usuario</label>
                    <div class="col-sm-8">
                      <input onkeypress="return sololetras(event);" maxlength="50" OnKeyUp="this.value=this.value.toUpperCase();" type="text" class="form-control" id="NombreUsuario" name="NombreUsuario" value="<?php echo $fila['NombreUsuario']; ?>" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="rol" class="col-sm-4 col-form-label">Rol de Usuario</label>
                    <div class="col-sm-8">
                    <select name="CodigoRol" id="CodigoRol" class="form-control" autofocus>
                    <option value="<?php echo $fila['CodigoRol']; ?>" ><?php echo $fila['Rol']; ?></option>
					                          <?php echo $opciones_roles; ?>
                      </select> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Correo electrónico</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="Correo_Electronico" name="Correo_Electronico" value="<?php echo $fila['Correo_Electronico']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="">Contraseña</label>
                    <div class="input-group col-sm-7">
                    <ol class="float-sm-left">
                       <div class="container-fluid">
                      <div class="input-group-append">
                        <input pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" title="La contraseña debe tener mínimo 8 caracteres, un número y un letra mayúscula" value="<?php echo $fila['Contraseña']; ?>" ID="txtPassword" required onkeypress="return validar(event)" type="Password" maxlength="30" Placeholder="Ingrese su Contraseña" id="Contraseña" name="Contraseña" Class="form-control">
                        <button id="show_password" class="btn btn-primary" type="button"  onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                        </div>
                        </ol>
                        </div>
                        <div class="col-sm-2">
                          <ol class="float-sm-right">
                          <button name='Cambiar' value="btnupdate" type="submit" class="btn btn-success">Resetear</button>
                          </ol>
                        </div>
                    
                        </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Fecha Creación</label>
                    <div class="col-sm-8">
                      <input type="text" disabled=»disabled» class="form-control" id="Fecha_Creacion" name="Fecha_Creacion" value="<?php echo $fila['Fecha_Creacion']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Fecha Vencimiento</label>
                    <div class="col-sm-8">
                      <input type="text" disabled=»disabled» class="form-control" id="Fecha_Vencimiento" name="Fecha_Vencimiento"value="<?php echo $fila['Fecha_Vencimiento']; ?>" >
                    </div>
                  </div>
                  <div class="form-group row">
                  <label for="estado" class="col-sm-4 col-form-label">Estado de Usuario</label>
                    <div class="col-sm-8">
                    <select name="CodigoEstado" id="CodigoEstado" name="tipo" class="form-control" autofocus>
                    <option value="<?php echo $fila['CodigoEstado']; ?>" ><?php echo $fila['Descripcion']; ?></option>
					                          <?php echo $opciones_estadou; ?>
                      </select> 
                    </div>
                </div>
          <div class="row mb-2">
          <div class="col-sm-6">
          <ol class="float-sm-left">
          <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
           <button name='actualizar' value="btnupdate" type="submit" class="btn btn-success">Guardar</button>
             <?php } ?>
            </ol>
          </div>
          <div class="col-sm-5">
            <ol class="float-sm-right">
            <button name='Salir' value="btnupdate" type="submit" class="btn btn-block bg-gradient-danger">Cancelar</button>
            </ol>
          </div>
                  </div>
                  <?php
            if (isset($_POST['Salir'])){
                if ($_POST['Salir']){
                      echo '<script>
                      window.location="../vistas/gestion_principal.php";
                      </script>';
                }
              }
            ?>
                </div>
                <!-- /.card-body -->
                <!-- /.card-footer -->
              
            </div>
            <!-- /.card -->

            </div></div>
          <!--/.col (left) -->
          <!-- right column -->
         </form>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
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
<script>
   /*Solo letras Nombre Completo*/
  function sololetras(e){
       key = e.KeyCode || e.which;
       tecla = String.fromCharCode(key).toString();
       letras = "ABCDEFGHIJCLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

       especiales = [8,32];
       tecla_especial = false
       for(var i in especiales){
         if (key==especiales[i]){
           tecla_especial = true;
           break;
         }
       }

       
       if (letras.indexOf(tecla) == -1 && !tecla_especial){
         alert('Ingrese solo letras');
         return false;
       }
    }
$(function () {
  bsCustomFileInput.init();
});
</script>
<script type="text/javascript">
function mostrarPassword(){
		var cambio = document.getElementById("txtPassword");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
	
	$(document).ready(function () {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function () {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});

function espacios(evt){
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
</body>
</html>

