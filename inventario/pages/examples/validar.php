
<?php
  $conexion=mysqli_connect("localhost","root","","minutasv");
 

  session_start();//si inicia secion
  if(isset($_SESSION['id_usuario'])){//si la variable secion no existe
    header("location:contrasena_correo.php");
  }


  if (!empty($_POST)){// SI NO ESTA BASIO REALICE 
    
    $usuario=mysqli_real_escape_string($conexion,$_POST['usuario']);//NOMBRE DEL USUARIO INGRESADO
    $sql="select NombreUsuario from usuario where NombreUsuario='$usuario'";//QUE EL USUARIO INGRESADO EXISTA DENTRO DE LA BD
    $resultado=$conexion->query($sql);// RESIVE LA CONSULTA A LA BD
    $rows=$resultado->num_rows;//CUENTA LOS REGISTRO DE LA BD
    if($rows > 0){ //SI ENCUENTA RESULTADOS EN LA BD
      $row =$resultado->fetch_assoc();
      $_SESSION['id_usuario'] = $row["NombreUsuario"];//VARABLE DE SECCION REVISA EL CAMPO NOMBREUSUARIO
      header("location:contrasena_correo.php");
    }
    else{// SI NO EXISTE
      
      echo '<script>
  alert(" El Usuario Ingresado no Existe ");
  window.location="recuperacion.php";
  </script>';
  

    }
  }
?>


