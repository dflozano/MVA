<?php
$conexion=mysqli_connect("localhost","root","","minutasv");

$Correo=$_POST['Correo'];
$contrasena=$_POST['contrasena'];
$contrasena2=$_POST['contrasena2'];
if ($contrasena == $contrasena2){
    $contrasena= sha1($contrasena);
    $conexion->query("update usuario set Contrase�a='$contrasena' where Correo_Electronico='$Correo' ")or die($conexion->error);
    echo '<script>
    alert(" La contraseña fue cambiada exitosamente vuelve a ingresar. ");
    window.location="recuperacion.php";
    </script>';
}
else{
    echo '<script>
  alert(" La contraseña no coincide. Volver a comenzar  ");
  window.location="recuperacion.php";
  </script>';
}
?>