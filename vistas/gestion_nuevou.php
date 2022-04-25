<?php
include 'funcionBitacora.php';
$conexion=mysqli_connect("localhost","root","","minutasv");
session_start();

$CodObjeto=13;
$accion='Guardar';
$descrip='Se guardo un nuevo usuario, por medio de gestión de usuarios';
bitacora($CodObjeto,$accion,$descrip);

function comparar($contrasena,$rpcontrasena){
  if($contrasena == $rpcontrasena){
    return true;
  }
}

$direccion=3;

if(!empty($_POST)){

  $nombre=$_POST['nombre'];
  $numero=$_POST['numero'];
  $usuarios=$_POST['usuario'];
  $_SESSION['direccion']=$direccion;
  $correo =$_POST['correo'];
  $contrasena=$_POST['contrasena'];
  $rpcontrasena=$_POST['rpcontrasena'];
  $password= password_hash($contrasena, PASSWORD_DEFAULT, array("cost"=>10));


$alert='';
if(empty($_POST['nombre']) || empty($_POST['numero']) || empty($_POST['usuario']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['rpcontrasena']) ){
    $alert="<p style='text-align:center; color:white; background-color: red;'>Llene todos los campos</p>";
}else{

  $consulta_nombre=mysqli_query($conexion,"SELECT * FROM tbl_personas WHERE NombreCompleto ='$nombre' ");
  $resultado_nombre=mysqli_fetch_array($consulta_nombre);
  if ($resultado_nombre>0){
    $alert="<p style='text-align:center; color:white; background-color: red;'>El Nombre Completo ya existe</p>";
  }else{      

  $consulta_numero=mysqli_query($conexion,"SELECT * FROM tbl_personas WHERE NumeroIdentidad ='$numero' ");
  $resultado_numero=mysqli_fetch_array($consulta_numero);

  $id='0000000000000';

      if($numero==$id){
        $alert="<p style='text-align:center; color:white; background-color: red;'>Ingrese un número de identidad correcto</p>";
      }else{
        if($resultado_numero>0){
          $alert="<p style='text-align:center; color:white; background-color: red;'>El número de Identidad ya existe</p>";
        
  }else{

    $consulta_usuario=mysqli_query($conexion,"SELECT * FROM tbl_usuario WHERE Usuario ='$usuarios' ");
    $resultado_usuario=mysqli_fetch_array($consulta_usuario);
    if ($resultado_usuario>0){
      $alert="<p style='text-align:center; color:white; background-color: red;'>El usuario ya existe</p>";
    }else{

      $consulta_correo=mysqli_query($conexion,"SELECT * FROM tbl_usuario WHERE Correo_Electronico ='$correo' ");
      $resultado_correo=mysqli_fetch_array($consulta_correo);
      if ($resultado_correo>0){
        $alert="<p style='text-align:center; color:white; background-color: red;'>El correo electronico ya existe</p>";
      }else{


       /*Comparar contraseñas*/
      $result=comparar($contrasena,$rpcontrasena);

    
      if($result){
              /*Ingresar en la tabla personas*/
            $a="INSERT INTO tbl_personas (CodigoTipoPersona, NombreCompleto, NumeroIdentidad) VALUES (2,'$nombre','$numero')";
            $InsPersona=mysqli_query($conexion,$a);
            
            /*Obtener el ultimo codigoPersona*/
            $ultimo_codigo=mysqli_insert_id($conexion);
            
            /*Ingresar en la tabla Usuario */
            $consulta_insert=mysqli_query($conexion,"INSERT INTO tbl_usuario (CodigoPersona, Usuario, NombreUsuario, Contraseña, Correo_Electronico, Fecha_Creacion,CodigoRol, CodigoEstadoUsuario, Creado_Por) VALUES ('$ultimo_codigo','$usuarios','$nombre','$password','$correo',now(),2,1, '$usuarios')");
            
            if($consulta_insert){
              /*Obtengo el parametro*/
              $consultparametro="SELECT valor from tbl_parametros where Parametro = 'ADMIN_DIAS_VIGENCIA'";
              $parametro = mysqli_query ($conexion, $consultparametro);
              $valor= mysqli_fetch_array ($parametro);
              $v=$valor[0];

              /*Actualizo la fecha de vencimiento */
              $vencimiento=mysqli_query($conexion,"update tbl_usuario set Fecha_Vencimiento = date_add(Fecha_Creacion, interval $v day) where Usuario = '$usuarios'");

              /*Envio de correo de creacion de usuario */
              //--------------------------------------------------------------------------------------------------------------
              $destinatario = $correo; 
              $asunto = "Creación de nuevo Usuario "; 
              $cuerpo = ' 
              <html> 
              <head> 
                 <title>Nuevo Usuario </title> 
              </head> 
              <body> 
              <h3>Nuevo Usuario </h3>
              <div style="text-align:center"> 
              <p> 
              <b> Bienvenidos a Nuestro Sistema MVA
              </p> 
              <p>Bienvenidos al sistema con su usuario y contraseña podra ingresar al sistema. Siga las instrucciones para ingresar al sistema.
              </P>
              <p> 
              <b> INSTRUCCIONES:
              </p> 
              <p> 1. Ingrese al login del sistema con su Usuario:'.$usuarios.' y Contraseña:'.$contrasena.'
              </P>
              <p> 2. Luego debe de registrar las preguntas secretas por si aun dado caso se le olvide la contraseña o bloquee los intentos del sistema.
              </P>
              <p> 3. Listo ya puede entrar al sistema.
              </P>
              </div>
              </body> 
              </html> 
              '; 


              //para el envío en formato HTML 
              $headers = "MIME-Version: 1.0\r\n"; 
              $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

              //dirección del remitente 
              $headers .= "From: Minutas valle de ángeles <minutas@desarrolloweb.com>\r\n"; 

              $headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 

              $enviado=false;
              if (mail($destinatario,$asunto,$cuerpo,$headers)){
                  $enviado=true;
              }
              //--------------------------------------------------------------------------------------------------------------                
              header("Location: gestion_principal.php");
              //Llamada a la funcion bitacora
              
            }else{
              $alert="<p style='text-align:center; color:white; background-color: red;'>Error al crear el usuario</p>";
            }                    
      }else{
        $alert="<p style='text-align:center; color:white; background-color: red;'>Las contraseñas son diferentes</p>";
      }   
    }
  }
}    
}  
} 
} 
} 

///codigo que asocia el rol del usuario y asiga el permiso
$usuariorol= $_SESSION['usuario'];//traer nombre del usuario que tiene la seccio
$sql_consulta="SELECT CodigoRol, Usuario FROM tbl_usuario where  Usuario='$usuariorol'";
$resultado_consulta=$conexion->query($sql_consulta);//guarda la consulta
$row1=$resultado_consulta->fetch_assoc();//arreglo asociativo
$rol=($row1['CodigoRol']);  

//--------------------------------------------------PERMISO
$permiso="SELECT CodigoPermiso, CodigoObjeto, CodigoRol, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion,Permiso_Consultar FROM tbl_permisos where CodigoObjeto ='$CodObjeto' AND CodigoRol=' $rol' ";
$datos56 = mysqli_query ($conexion,$permiso);
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
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

    <!-- Main content -->
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
      
   <div class="col-md-10">
   
            <!-- Horizontal Form -->
            <div class="card card-info">
            
              <div class="card-header text-center">
                <h3 class="card-title">Gestión de Usuarios</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="POST" autocomplete="off">
              <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 
              <div class="card-body">
                <form >
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nombre Completo</label>
                    <div class="col-sm-8">
                    <input onkeypress="comprobarEspacios(); return sololetras(event);" maxlength="50" minlength="10" OnKeyUp="this.value=this.value.toUpperCase();" value="<?php if(isset($nombre)) echo $nombre  ?>" type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre completo" >
          </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Numero de Identidad</label>
                    <div class="col-sm-8">
          <input  onkeypress="return solonumeros(event);" pattern=".{13,13}" maxlength="13" value="<?php if(isset($numero)) echo $numero ?>" type="text" name="numero" class="form-control" placeholder="Numero Identidad" pattern="[0-9]+">
          </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nombre de Usuario</label>
                    <div class="col-sm-8">
          <input  onkeypress="return sololetrasUsuario(event);" id="bloquear" pattern=".{3,10}" maxlength="30" OnKeyUp="this.value=this.value.toUpperCase();" value="<?php if(isset($usuarios)) echo $usuarios ?>" type="text" name="usuario" class="form-control" placeholder="Usuario">
          </div>
                  </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Correo electrónico</label>
                    <div class="col-sm-8">
          <input  maxlength="35" value="<?php if(isset($correo)) echo $correo ?>" type="email" name="correo" class="form-control" placeholder="Correo electronico">
          </div>
                  </div>
                  
                  <div class="form-group row">
                    <label for="inputContraseña" class="col-sm-4 col-form-label">Contraseña</label>
                    <div class="col-sm-8">
                      <div class="input-group-append">
          <input pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" title="La contraseña debe tener mínimo 8 caracteres, un número y un letra mayúscula" onkeypress="return hola(event);"  id="contrasena" maxlength="20" value="<?php if(isset($contrasena)) echo $contrasena ?>" type="password" name='contrasena' class="form-control" placeholder="Contraseña">
          <div class="input-group-append"><button id="show_password" class="btn btn-primary" type="button"   onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span></button></div> 
        </div>
                  </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputContraseña" class="col-sm-4 col-form-label">Contraseña</label>
                    <div class="col-sm-8">
                    <div class="input-group-append">
                    <input pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" title="La contraseña debe tener mínimo 8 caracteres, un número y un letra mayúscula" onkeypress="return hola(event);"  id="rpcontrasena" maxlength="20" value="<?php if(isset($rpcontrasena)) echo $rpcontrasena ?>" type="password" name='rpcontrasena' class="form-control" placeholder="Confirmar contraseña">
                    <div class="input-group-append"><button id="show" class="btn btn-primary" type="button"  onclick="mostrar()"> <span class="fa fa-eye-slash icon1"></span> </button></div>
          </div>
                  </div>
                  <div>
        </div>
                </div>
                <div class="row mb-2">
          <div class="col-sm-6">
          <ol class="float-sm-left">
          <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
                        <input  name="btnregistrar" type="submit" class="btn btn-primary btn-block"  value="Registrar">

            <?php } ?>
            </ol>
          </div>
        
          <div class="col-sm-5">
            <ol class="float-sm-right">
            <input  name='Salir' type="submit" class="btn btn-block bg-gradient-danger"  value="Cancelar">
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
                  </div>
                  
                  </div>
                  
                  </div>
                <!-- /.card-body -->
                <!-- /.card-footer -->
              </form>
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
       <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
             
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
   $con=0;
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
 

    /*Solo letras Usuario*/
    function sololetrasUsuario(e){
       key = e.KeyCode || e.which;
       tecla = String.fromCharCode(key).toString();
       letras = "ABCDEFGHIJCLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

       especiales = [8];
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

    alert("Ingrese solo números");
    return false;
    }
  }

  /*Mostart contrsenas*/
  function mostrarPassword(){
		var cambio = document.getElementById("contrasena");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 

  function mostrar(){
		var cambio = document.getElementById("rpcontrasena");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	}

  function comprobarEspacios() {
			
			let input = document.getElementById('nombre');

			let remplazar = input.value.replace(/(\s{1,})/g, ' ');

			input.value = remplazar;
		}
	
    
</script>
<script>

window.onload = function() {
  var myInput = document.getElementById('bloquear');
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
