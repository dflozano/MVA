<?php
include 'conexion.php';
include 'funcionBitacora.php';
session_start();

if (isset($_GET['CodigoRelacion'])) {
  $cod=$_GET['CodigoRelacion'];
 
   //Eliminar en tabla temporal
   $consulta="DELETE FROM tbl_productomateria WHERE CodigoRelacion = $cod";
   $conResul=mysqli_query($conexion,$consulta);
   
   if($conResul){
      /*BITACORA*/
      $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'editar.php'";
      $consulta1 = mysqli_query($conexion,$consulta);
      $valor= mysqli_fetch_array($consulta1);
      $numero=$valor[0];
      //Llamada a la funcion bitacora
      $CodObjeto=$numero;
      $accion='Eliminar';
      $descrip='Se elimino una relación con materia prima';
      bitacora($CodObjeto,$accion,$descrip);
      header("Location:editar.php");
  }

 
}



?>