<?php
include 'conexion.php';
include 'funcionBitacora.php';
session_start();

if (isset($_GET['CodigoTemporal'])) {
  $cod=$_GET['CodigoTemporal'];
 
   //Eliminar en tabla temporal
   $consulta="DELETE FROM tbl_relaciontemporal WHERE CodigoTemporal = $cod";
   $conResul=mysqli_query($conexion,$consulta);
   
   if($conResul){
     //Llamada a la funcion bitacora
     $CodObjeto=32;
     $accion='Eliminar';
     $descrip='Se elimino pedido';
     bitacora($CodObjeto,$accion,$descrip);
     header("Location:agregarRelacion.php");
  }

 
}



?>