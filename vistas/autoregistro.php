<?php
   include 'conexión.php';
   include 'funcionBitacora.php';
  
   session_start();
   
  function comparar($contrasena,$rpcontrasena){
    if($contrasena == $rpcontrasena){
      return true;
    }
  }

  $direccion=1;
  
  if(!empty($_POST)){
      $nombre=$_POST['nombre'];
      $numero=$_POST['numero'];
      $usuario=$_POST['usuario'];
      $_SESSION['usuario']=$usuario;
      $_SESSION['direccion']=$direccion;
      $correo=$_POST['correo'];
      $contrasena=$_POST['contrasena'];
      $rpcontrasena=$_POST['rpcontrasena'];
      $password= password_hash($contrasena, PASSWORD_DEFAULT, array("cost"=>10));

    $alert='';
    if(empty($_POST['nombre']) || empty($_POST['numero']) || empty($_POST['usuario']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['rpcontrasena']) ){
        $alert="<p style='text-align:center; color:white; background-color: red;'>Llene todos los campos</p>";
    }else{      

      $consulta_numero=mysqli_query($conn,"SELECT * FROM tbl_personas WHERE NumeroIdentidad ='$numero' ");
      $resultado_numero=mysqli_fetch_array($consulta_numero);
      $id='0000000000000';

      if($numero==$id){
        $alert="<p style='text-align:center; color:white; background-color: red;'>Ingrese un número de identidad correcto</p>";
      }else{
        if($resultado_numero>0){
          $alert="<p style='text-align:center; color:white; background-color: red;'>El número de Identidad ya existe</p>";
        
     

      }else{


        $consulta_usuario=mysqli_query($conn,"SELECT * FROM tbl_usuario WHERE Usuario ='$usuario' ");
        $resultado_usuario=mysqli_fetch_array($consulta_usuario);
        if ($resultado_usuario>0){
          $alert="<p style='text-align:center; color:white; background-color: red;'>El usuario ya existe</p>";
        }else{

          $consulta_correo=mysqli_query($conn,"SELECT * FROM tbl_usuario WHERE Correo_Electronico ='$correo' ");
          $resultado_correo=mysqli_fetch_array($consulta_correo);
          if ($resultado_correo>0){
            $alert="<p style='text-align:center; color:white; background-color: red;'>El correo electronico ya existe</p>";
          }else{
              /*Comparar contraseñas*/
              $result=comparar($contrasena,$rpcontrasena);
      
              if($result){
                  /*Ingresar en la tabla personas*/
                $a="INSERT INTO tbl_personas (CodigoTipoPersona, NombreCompleto, NumeroIdentidad) VALUES (2,'$nombre','$numero')";
                $InsPersona=mysqli_query($conn,$a);
                
                /*Obtener el ultimo codigoPersona*/
                $ultimo_codigo=mysqli_insert_id($conn);  
          
                /*Ingresar en la tabla Usuario */
                $consulta_insert=mysqli_query($conn,"INSERT INTO tbl_usuario (CodigoPersona, Usuario, NombreUsuario, Contraseña, Correo_Electronico, Fecha_Creacion,CodigoRol, CodigoEstadoUsuario) VALUES ('$ultimo_codigo','$usuario','$nombre','$password','$correo',now(),2,1)");

                if($consulta_insert){
                  /*Obtengo el parametro*/
                  $consultparametro="SELECT valor from tbl_parametros where Parametro = 'ADMIN_DIAS_VIGENCIA'";
                  $parametro = mysqli_query ($conn,$consultparametro);
                  $valor= mysqli_fetch_array ($parametro);
                  $v=$valor[0];
    
                  /*Actualizo la fecha de vencimiento */
                  $vencimiento=mysqli_query($conn,"update tbl_usuario set Fecha_Vencimiento = date_add(Fecha_Creacion, interval $v day) where Usuario = '$usuario'");

                  /*Envio de correo de creacion de usuario */
                  mail("$correo","Correo de confirmacion","¡Enhorabuena! $usuarios Ya puedes acceder con tu atentificacion.","Sistema, te damos la bienvenida a MinutasVA.");
                  
                  //Llamada a la funcion bitacora
                  $CodObjeto=2;
                  $accion='Guardar';
                  $descrip='Registro exitoso de un nuevo usuario';
                  bitacora($CodObjeto,$accion,$descrip);


                  header("Location:preguntasecretas.php");
                  
                }else{
                  $alert="<p style='text-align:center; color:white; background-color: red;'>ERR-05 Error al crear el usuario</p>";
                }                    
              }else{
                $alert="<p style='text-align:center; color:white; background-color: red;'>ERR-06 Las contraseñas son diferentes</p>";
              }  
          }

          
          //// 
        }
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
  <!-- Preloader -->
  
<body class="hold-transition register-page">
<div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="dist/img/minuta.png" alt="Minutas Valle de Ángeles" height="150" width="150">
  </div>

<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Minutas</b>VA</a>
    </div>
    <div class="card-body">
      <p style="text-align:center; font-size:18px; font-style:cursives;" >Registra un nuevo usuario</p>

      <form  action="" method="post">
      <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input onkeypress="comprobarEspacios(); return sololetras(event);" maxlength="50" minlength="10" OnKeyUp="this.value=this.value.toUpperCase();" value="<?php if(isset($nombre)) echo $nombre  ?>" type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre completo" >
          
        </div>
      

        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input onkeypress="return solonumeros(event);" pattern=".{13,13}" maxlength="13" value="<?php if(isset($numero)) echo $numero ?>" type="text" name="numero" class="form-control" placeholder="Numero Identidad" pattern="[0-9]+">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input onkeypress="return sololetrasUsuario(event);" pattern=".{3,20}" maxlength="20" OnKeyUp="this.value=this.value.toUpperCase();" value="<?php if(isset($usuario)) echo $usuario ?>" type="text" name="usuario" class="form-control" placeholder="Usuario">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input maxlength="35" value="<?php if(isset($correo)) echo $correo ?>" type="email" name="correo" class="form-control" placeholder="Correo electronico">
        </div>

        <div>
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input pattern="(?=.*[!@#$%&*-.()/;:_<>+])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" title="La contraseña debe tener mínimo 8 caracteres, un caracter especial, un número, un letra mayúscula y una minuscuya" onkeypress="return hola(event);"   id="contrasena" maxlength="20" value="<?php if(isset($contrasena)) echo $contrasena ?>" type="password" name='contrasena' class="form-control" placeholder="Contraseña">
          <div class="input-group-append"><button id="show_password" class="btn btn-outline-secondary" type="button"  onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button></div>
        </div>
        </div>

        <div>
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input pattern="(?=.*[!@#$%&*-.()/;:_<>+])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" title="La contraseña debe tener mínimo 8 caracteres, un caracter especial, un número, un letra mayúscula y una minuscuya" onkeypress="return hola(event);" id="rpcontrasena" maxlength="20" value="<?php if(isset($rpcontrasena)) echo $rpcontrasena ?>" type="password" name='rpcontrasena' class="form-control" placeholder="Confirmar contraseña">
          <div class="input-group-append"><button id="show" class="btn btn-outline-secondary" type="button"  onclick="mostrar()"> <span class="fa fa-eye-slash icon1"></span> </button></div>
        </div>
        </div>
        
        
        <div class="row">
          
          <!-- /.col -->
          <div class="mb-2 col-12 text-center">
            <input  name="btnregistrar" type="submit" class="btn btn-primary btn-block"  value="Registrar">
          </div>
          <!-- /.col -->
        </div>

        
      </form>
  
      
      
      <a href="login.php" class="text-center">Ya tengo un usuario</a>
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
      return false;
    }
  }



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
