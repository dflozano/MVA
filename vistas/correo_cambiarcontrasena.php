<?php
$conexion=mysqli_connect("localhost","root","","minutasv");


$activo=2;
$Correo=$_POST['Correo'];
$contrasena=$_POST['contrasena'];
$contrasena2=$_POST['contrasena2'];
if ($contrasena == $contrasena2){
    $contrasena= password_hash($contrasena, PASSWORD_DEFAULT);
    $conexion->query("update tbl_usuario set Contraseña='$contrasena',CodigoEstadoUsuario='$activo' where Correo_Electronico='$Correo' ")or die($conexion->error);
    echo '<script>
    alert("Felicidades la contraseña fue cambiada exitosamente ");
    window.location="../vistas/login.php";
    </script>';


     /*Obtengo el parametro*/
     $consultparametro="SELECT valor from tbl_parametros where Parametro = 'ADMIN_DIAS_VIGENCIA'";
     $parametro = mysqli_query ($conexion,$consultparametro);
     $valor= mysqli_fetch_array ($parametro);
     $v=$valor[0];

    $vencimiento=mysqli_query($conexion,"update tbl_usuario set Fecha_Vencimiento = date_add(Fecha_Creacion, interval $v day) where Correo_Electronico='$Correo' ");
  

  ////////////////////////////////////////////////////////// variable de seccion
      include 'funcionbitacora.php';
     session_start();
     //bitacora
      $CodObjeto=12;
      $accion='Guardar';
      $descrip='Pantalla donde se ingresa la nueva contraseña';
      bitacora($CodObjeto,$accion,$descrip);



}




else{
  
  echo '<script>
  alert("ERR-010 Error la contraseña no coinciden ");
  history.go(-1);
  </script>';
}


?>
