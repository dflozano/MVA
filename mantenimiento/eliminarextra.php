<?php
include 'conexion.php';
include 'funcionBitacora.php';
 session_start();

 $cod=$_GET['CodigoExtra'];
 
if (isset($_GET['CodigoExtra'])) {
  $cod=$_GET['CodigoExtra'];
  
  $consulta="DELETE FROM tbl_extra WHERE CodigoExtra = $cod";
  $conResul=mysqli_query($conexion,$consulta);

  if($conResul){
   echo '<script>
   alert(" Se elimino exitosamente. ");
   window.location="../mantenimiento/extras.php";
   </script>';
  }
 
}



?>