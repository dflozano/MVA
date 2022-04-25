<?php
 include("conexión.php");
 include 'funcionBitacora.php';

 session_start();
if (isset($_GET['CodigoUsuario'])) {
  $CodigoU = $_GET['CodigoUsuario'];

  $parametro1="SELECT Usuario from tbl_usuario where CodigoUsuario = '$CodigoU'";
$datos1 = mysqli_query ($conn,$parametro1);
$fila1= mysqli_fetch_array ($datos1);
$admin=$fila1[0];

  if ($admin == 'ADMIN') {

    header("Location:gestion_principal.php");

}else{
  $query2= "UPDATE tbl_usuario SET CodigoEstadoUsuario  = 3 WHERE CodigoUsuario = $CodigoU";
  $result= mysqli_query($conn, $query2);



  header("Location:gestion_principal.php");

}
}
$CodObjeto=15;
  $accion='Borrar';
  $descrip='Se borro un nuevo usuario';
  bitacora($CodObjeto,$accion,$descrip);
 
 ?>
 

