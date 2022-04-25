<?php
session_start();
include 'conexión.php'; //conectar a la base de datos
include 'funcionBitacora.php';

$direccion=2; //codigo para direccionar Daniela


if(!empty($_POST)){
  $Nom_Usuario= $_POST ['Nom_Usuario'];
  $contra=$_POST ['contra'];
  $_SESSION['usuario']= $Nom_Usuario; ///cambio para las demas interfaces Daniela
  $_SESSION['direccion']=$direccion; //Direcciona
  $_SESSION["intentos"] = isset($_SESSION["intentos"]) ? $_SESSION["intentos"] : 1;
  $alert = "";

  /*Obtengo el parametro*/
  $consulta3="SELECT Valor from tbl_parametros where Parametro = 'ADMIN_INTENTOS_INVALIDOS'";
  $parametro = mysqli_query($conn,$consulta3);
  $valor= mysqli_fetch_array($parametro);
  $v=$valor[0];

  /*Desencripto la contrasena*/
  $consulta2="SELECT * from tbl_usuario where Usuario = '$Nom_Usuario'";
  $encriptada = mysqli_query ($conn,$consulta2);
  $contraBase= mysqli_fetch_array ($encriptada);

  if(password_verify($contra, $contraBase['Contraseña'])){
    $correcta=$contraBase['Contraseña'];
  }else{
    $correcta=$contra;
  }

  //Validar si existe usuario en la base de datos 
  $consulta = "SELECT * FROM tbl_usuario WHERE Usuario ='$Nom_Usuario' AND Contraseña = '$correcta' AND (CodigoEstadoUsuario=1 || CodigoEstadoUsuario=2 || CodigoEstadoUsuario=3)" ;
  $resultado = mysqli_query($conn, $consulta);
  $filas=mysqli_num_rows($resultado);
  
  
    if ($filas > 0) {//Es decir si hay un dato
   // si todo esta correcto volvera a ser 0

      //Obtener el codigoEstado
      $consulta1="SELECT CodigoEstadoUsuario from tbl_usuario where Usuario = '$Nom_Usuario'";
      $datos = mysqli_query ($conn,$consulta1);
      $fila= mysqli_fetch_array ($datos);
      
      
      if($fila[0]==1){
        $_SESSION["intentos"] = 0;

        //Llamada a la funcion bitacora
        $CodObjeto=1;
        $accion='Ingreso a sistema';
        $descrip='Autentificacion correcta en el login ';
        bitacora($CodObjeto,$accion,$descrip);
        header("Location:preguntasecretas.php");
}else{
        if($fila[0]==3){
          $_SESSION["intentos"] = 0;
  
          //Llamada a la funcion bitacora
          $CodObjeto=1;
          $accion='Ingreso a sistema';
          $descrip='Autentificacion correcta en el login ';
          bitacora($CodObjeto,$accion,$descrip);
          header("Location:inactivo.php");
        }else{
        $_SESSION["intentos"] = 0;
 
        //Llamada a la funcion bitacora
        $CodObjeto=1;
        $accion='Ingreso a sistema';
        $descrip='Autentificacion correcta en el login ';
        bitacora($CodObjeto,$accion,$descrip);
        header("Location:principalusuarios.php");
      }
    } 
          
    }else {
      if($contraBase['CodigoEstadoUsuario']==4){
        $alert="<p style='text-align:center; color:yellow; background-color: while;'> ERR-002 El usuario esta bloqueado.</p>";
      }else{
        if($Nom_Usuario=='ADMIN'){
          $alert="<p style='text-align:center; color:yellow; background-color: while;'> ERR-003 Usuario/Contraseña incorrectos</p>";
        }else{
          if($_SESSION["intentos"]<=$v){
            $_SESSION["intentos"]++; // aumentamos en 1 los intentos
            $alert="<p style='text-align:center; color:yellow; background-color: while;'>ERR-003 Usuario/Contraseña incorrectos</p>";
            if($_SESSION["intentos"]>$v){
              // actualizamos el campo mostrar para que no se puede iniciar session
              $consulta = "UPDATE tbl_usuario SET CodigoEstadoUsuario = 4 WHERE Usuario='$Nom_Usuario'";
              $resultado = mysqli_query($conn, $consulta);
              $_SESSION["intentos"]=0;
               $alert="<p style='text-align:center; color:yellow; background-color: while;'>ERR-004 El usuario {$Nom_Usuario} bloqueado por muchos intentos fallidos!</p>";
              
            }
          }
        }

        
      }
    }
      
    //mysqli_free_result($resultado); //Liberar el espacio de los resultados
       mysqli_close($conn); // Cerrar la conexion para que no consuma recurso.
    
}

?>
<!DOCTYPE html>
<html lang="es">
<head>

  
 

<script>
function sololetras(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();
    Nom_Usuario="abcdefghijklmnñopqrstuvwxyz";
    especiales="8-37-38-46-164";
    teclado_especial =false;
    for(var i in especiales){
      if(key==especiales[i]){
        teclado_especial=true;break; 
      }
    }
    if(Nom_Usuario.indexOf(teclado)==-1 && !teclado_especial){
      return false;
    }
  }
</script>
<script type="text/javascript">
function validar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return tecla!=32;
}


</script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MV | Login</title>
  
  <link rel="icon" type="image/png" href="dist\img\minuta.png">
<!-- Libreria agradas por brayan -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<div> <!-- Div agregador por brayan -->
<body background="dist\img\a.png"  class=" sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">                    <!-- lo cambio brayan "hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" -->

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="dist/img/minuta.png" alt="Minutas Valle de Ángeles" height="150" width="150">
  </div>

  
    <!-- Main content --> 
    <section class="content">
        <div id="layoutAuthentication_content">
            <main>
            
                <div class="container  ">
                    <div class="row justify-content-center  ">
                        <div class="col-lg-5  ">
                            <div class="card shadow-lg border-0 rounded-lg mt-5 bg-gradient-info ">
                            <div class="card-header text-center bg-gradient-info">
                               <a href="login.php" class="h1"><b>Minutas Valle de Ángeles </a></div>
                                <div class="card-body bg-maroon disabled">
                                         <form action=""  method="post">
                                         <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div>

                                            <div class="form-group "><label class="small mb-1 " for="inputUsuario">Usuario</label><input class="form-control py-4 bg-light"  onkeypress="return sololetras(event);" type="text" id="bloquear"  placeholder="Ingrese su Usuario" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" name="Nom_Usuario" required/></div>
                                          
                                        <!--<div class="form-group"><label class="small mb-1" for="inputContraseña">Contraseña</label><input class="form-control py-4 bg-light"  type="password" placeholder="Ingrese su Contraseña"  maxlength="10" name="Contra_Usuario" /></div>-->
                                            <div class="form-group "><label class="small mb-1" for="inputContraseña">Contraseña</label><div class="input-group"><input  id="contra" required onkeypress="return validar(event)"  type="Password" maxlength="30" Placeholder="Ingrese su Contraseña" name="contra" Class="form-control"><div class="input-group-append"><button id="show_password" class="btn btn-primary" type="button"  onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button></div>
                                                </div>
                                                <div class="form-group form-chek my-2">
                                                  <input type="submit" value="Ingresar" name="btningresar" class="bg-warning ">
                                                 </div>
                                                <!-- LO CAMBIO BRAYAN <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0  "><input class="bg-info" type="submit" value="Ingresar"></div> -->
                                         </form>
                                           <p class="mb-1 ">
                                                  <a href="metodo.php">Olvide mi Contraseña</a>
                                           </p>
                                              <p class="mb-0">
                                                   <a href="autoregistro.php" class="text-center">Registrar una nuevo Usuario</a>
                                              </p>
                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
      <!--/. container-fluid -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark ">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
</div>
<!-- Mostar Contraseña -->

<script type="text/javascript">
function mostrarPassword(){
		var cambio = document.getElementById("contra");
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

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</div> <!-- Div agregador por brayan -->
</html>

