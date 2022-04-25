<?php
   include 'conexión.php';
   include 'funcionBitacora.php';
  
   session_start();
   $usuario=$_SESSION['usuario'];


   
  function comparar($contra,$rpcontra){
    if($contra == $rpcontra){
      return true;
    }
  }
  

  $consultacod="SELECT CodigoUsuario from tbl_usuario where Usuario = '$usuario'";
  $parametrocod = mysqli_query ($conn,$consultacod);
  $valorcod= mysqli_fetch_array ($parametrocod);
  $cod=$valorcod[0];


  $alert='';
  if(!empty($_POST)){
    $contra1=$_POST['0'];
    $contra=$_POST['1'];
    $rpcontra=$_POST['2'];
    $password= password_hash($contra, PASSWORD_DEFAULT, array("cost"=>10));

    if(empty($_POST['1']) || empty($_POST['2']) ){
      $alert="<p style='text-align:center; color:white; background-color: red;'>Llene los campos vacios</p>";
    }else{
      /*Comparar contraseñas*/
      $result=comparar($contra,$rpcontra);

      if($result){
         /*Actualizar la contrasena en usuario */
         $udpate=mysqli_query($conn,"update tbl_usuario set Contraseña = '$password', CodigoEstadoUsuario = '2' WHERE Usuario = '$usuario'");

         if ($usuario == 'ADMIN') {
          $CONSULTA = mysqli_query($conn, "UPDATE tbl_usuario set Fecha_Vencimiento = ' ' where Usuario = 'ADMIN'");
          echo  '<script>
          window.location="http://localhost/MinutasV/public/bower_components/admin-lte/vistas/perfil.php?CodigoUsuario='.$cod.'";

             </script>';
      }else{
      $consultparametro="SELECT valor from tbl_parametros where Parametro = 'ADMIN_DIAS_VIGENCIA'";
      $parametro = mysqli_query ($conn, $consultparametro);
      $valor= mysqli_fetch_array ($parametro);
      $v=$valor[0];  
      /*Actualizo la fecha de vencimiento */
      $vencimiento=mysqli_query($conn,"update tbl_usuario set Fecha_Vencimiento = date_add(now(), interval $v day) where Usuario = '$usuario'");
      $date = date('Y-m-d');
      $modificacion=mysqli_query($conn,"update tbl_usuario set Fecha_Modificacion = ('$date')");
      $consult=mysqli_query($conn,"UPDATE tbl_usuario SET CodigoEstadoUsuario = 2 WHERE Usuario='$usuario'");
      
 echo '<script>
  window.location="http:../vistas/perfil.php?CodigoUsuario='.$cod.'";
  </script>';
  } 



      }else{
          $alert="<p style='text-align:center; color:white; background-color: red;'>Error al ingresar contraseña</p>";
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
  <link rel="icon" type="image/png" href="../dist/img/minuta.png">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!--Bootstrap 4-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  
</head>
<body class="hold-transition register-page">
<div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="dist/img/minuta.png" alt="Minutas Valle de Ángeles" height="150" width="150">
  </div>

<div class="register-box">
<div class="col-md-100">

  <div class="card card-outline ">
  <div class="card-header text-center">
     <strong>CAMBIE LA CONTRASEÑA</strong>
    </div>
    
    <div class="card-body">
      

      <form  action="" method="post">
      <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 

        <div>

        
        <div class="form-group row">
                    <label for="inputContraseña" class="col-sm-10 col-form-label">Antigua Contraseña</label>
                    <div class="col-sm-10">
                      <div class="input-group-append">
          <input pattern="(?=.*[!@#$%&*-.()/;:_<>+])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" title="La contraseña debe tener mínimo 8 caracteres, un caracter especial, un número, un letra mayúscula y una minuscuya" onkeypress="return hola(event);"   id="0" maxlength="20" value="<?php if(isset($contrasena1)) echo $contrasena1 ?>" type="password" name='0' class="form-control" placeholder="Contraseña">
          <div class="input-group-append"><button id="show_password" class="btn btn-outline-secondary" type="button"  onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button></div>
        </div>
        </div>
        </div>
    

      

        <div class="form-group row">
                    <label for="inputContraseña" class="col-sm-10 col-form-label">Nueva Contraseña</label>
                    <div class="col-sm-10">
                      <div class="input-group-append">
          <input pattern="(?=.*[!@#$%&*-.()/;:_<>+])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" title="La contraseña debe tener mínimo 8 caracteres, un caracter especial, un número, un letra mayúscula y una minuscuya" onkeypress="return hola(event);"   id="1" maxlength="20" value="<?php if(isset($contrasena)) echo $contrasena ?>" type="password" name='1' class="form-control" placeholder="Contraseña">
          <div class="input-group-append"><button id="show_password" class="btn btn-outline-secondary" type="button"  onclick="mostrar()"> <span class="fa fa-eye-slash icon1"></span> </button></div>
        </div>
        </div>
        </div>
        </div>





        <div class="form-group row">
                    <label for="inputContraseña" class="col-sm-10 col-form-label">Confirmación de Contraseña</label>
                    <div class="col-sm-10">
                      <div class="input-group-append">
          <input pattern="(?=.*[!@#$%&*-.()/;:_<>+])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" title="La contraseña debe tener mínimo 8 caracteres, un caracter especial, un número, un letra mayúscula y una minuscuya" onkeypress="return hola(event);" id="2" maxlength="20" value="<?php if(isset($rpcontrasena)) echo $rpcontrasena ?>" type="password" name='2' class="form-control" placeholder="Confirmar contraseña">
          <div class="input-group-append"><button id="show" class="btn btn-outline-secondary" type="button"  onclick="mostrar1()"> <span class="fa fa-eye-slash icon2"></span> </button></div>
        </div>
        </div>
        </div>
        </div>
        

      
        
        
     
          
    

          <div class="row mb-2">
          <div class="col-sm-6">
          <ol class="float-sm-left">
            <input  name="btnlisto" type="submit" class="btn btn-primary btn-block"  value="Listo">
          </ol>
          </div>
        
          <div class="col-sm-5">
            <ol class="float-sm-right">
            <input  name='Salir' type="submit" class="btn btn-block bg-danger"  value="Cancelar">
            </ol>
              </div>
                  </div>
              <?php
            if (isset($_POST['Salir'])){
                if ($_POST['Salir']){
                      echo '<script>
                      window.location="../vistas/perfil.php?CodigoUsuario='.$cod.'";
                      </script>';
                }
              }
            ?>
                </div>

        
      </form>
  
      
      
      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!--Alert-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

</body>
</html>


<script>
  

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

  function mostrarPassword(){
		var cambio = document.getElementById("0");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 

  function mostrar(){
		var cambio = document.getElementById("1");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 


  function mostrar1(){
		var cambio = document.getElementById("2");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
    
    
</script>
