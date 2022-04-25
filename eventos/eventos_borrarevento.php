<?php
include 'conexión.php';
include 'funcionBitacora.php';
  session_start();
  if(isset($_GET['NumeroEvento'])) {
    $Cod = $_GET['NumeroEvento'];
    
    $query2= "UPDATE tbl_eventos SET CodigoEstadoEvento = 3 WHERE NumeroEvento = $Cod";
    $result= mysqli_query($conn, $query2);

    if (!$result) {
      die("query failed");
    }
     
     header("Location: eventos_eventosdetallados.php");

     $CodObjeto=30;
$accion='Delete';
$descrip='Se elimino un pedido de Evento';
bitacora($CodObjeto,$accion,$descrip);
  }
?>