<?php
$conexion=mysqli_connect("localhost","root","","minutasv");

$Correo=$_POST['Correo'];
$bytes=random_bytes(5);
$Token= bin2hex($bytes);

include "mail_contrasena.php" ;
 if($enviado){
    $conexion->query("insert into contrase�a (Correo, Token, Codigo) values ('$Correo','$Token','$Codigo')") or die($conexion->error);
   
    echo'<script type="text/javascript"> alert("Revisa tu correo");</script>';

 }





?>
