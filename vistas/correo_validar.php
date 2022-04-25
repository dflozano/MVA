
<?php
  $conexion=mysqli_connect("localhost","root","","minutasv");


  session_start();//si inicia secion
   if(!isset($_SESSION['usuario'])){//si la variable secion no existe
     header("location: ../vistas/correo_recuperacion.php");
   }


  if (!empty($_POST)){// SI NO ESTA BASIO REALICE 
  
    $usuario=mysqli_real_escape_string($conexion,$_POST['usuario']);//NOMBRE DEL USUARIO INGRESADO
    $sql="select Usuario, Correo_Electronico from tbl_usuario where Usuario='$usuario'";//QUE EL USUARIO INGRESADO EXISTA DENTRO DE LA BD
    $resultado=$conexion->query($sql);// RESIVE LA CONSULTA A LA BD
    $rows=$resultado->num_rows;//CUENTA LOS REGISTRO DE LA BD
    
    if($rows > 0){ //SI ENCUENTA RESULTADOS EN LA BD
      $row =$resultado->fetch_assoc();
      $_SESSION['usuario'] = $row["Usuario"];//VARABLE DE SECCION REVISA EL CAMPO NOMBREUSUARIO
      //header("location:contrasena_correo.php");//en caso de existir lo direcciona a esta pagina
      $Correo=($row['Correo_Electronico']);
      $bytes=random_bytes(5);
      $Token= bin2hex($bytes);

     include "correo_mail_contrasena.php" ;
     if($enviado){
      $conexion->query("insert into  tbl_contraseña (Correo, Token, Codigo,Creado_Por ,Modificado_Por) values ('$Correo','$Token','$Codigo','$usuario','$usuario')") or die($conexion->error);
   





     //////////////////////////////////////////////////////////bitacora //usuario envia correo de recuperacion
    include 'funcionbitacora.php';
     $CodObjeto=9;
     $accion='Ingreso';
     $descrip='Pantalla de recuperacion de contraseña por correo, ingresa el correo';
     bitacora($CodObjeto,$accion,$descrip);

  
    echo '<script>
    alert(" Revisa tu correo para continuar con la recuperación de tu contraseña ");
      window.location="../vistas/login.php";
    </script>';
    
 }

    }
    else{// SI NO EXISTE
    //bitacora//////////////////////////////////////////////////////////////////// //usuario vuelve al login
    $CodObjeto=9;
    $accion='Insert';
    $descrip='Pantalla de recuperacion de contraseña por correo, ingresa el correo';
    bitacora($CodObjeto,$accion,$descrip);

      
      echo '<script>
  alert("ERR-8 El Usuario Ingresado no Existe,vuelve a intentar ");
  window.location="../vistas/correo_recuperacion.php";
  </script>';
  

    }
  }
?>


