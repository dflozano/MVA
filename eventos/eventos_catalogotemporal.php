<?php
include 'conexión.php';
include 'funcionBitacora.php';
session_start();

if(isset($_GET['CodigoTemporalCatalogo'])) {
    $Cod = $_GET['CodigoTemporalCatalogo'];

    $query1= "DELETE FROM tbl_catalogotemporal WHERE CodigoTemporalCatalogo = $Cod";
    $result= mysqli_query($conn,$query1);

    if (!$result) {
      die("query failed");
    }
     
     header("Location: eventos_nuevoe.php");

     $CodObjeto=28;
     $accion='Delete';
     $descrip='Se elimino un producto en catálago  Evento';
     bitacora($CodObjeto,$accion,$descrip);

  }

  if(isset($_GET['CodigoDetalleEvento'])) {
    $cod=$_GET['CodigoDetalleEvento'];

    $consulta2="SELECT NumeroEvento from tbl_detalleevento where CodigoDetalleEvento = '$cod'";
    $valor2 = mysqli_query ($conn,$consulta2);
    $valor5= mysqli_fetch_array ($valor2);
    $codigo1=$valor5[0];
  

    $query2= "DELETE FROM tbl_detalleevento WHERE CodigoDetalleEvento ='$cod'  ";
          
    $result2= mysqli_query($conn,$query2);
 
    if (!$result2) {
      die("query failed");
    }
    echo '<script>
                window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_editareventosdetallados.php?NumeroEvento='.$codigo1.'";
                </script>';

    $CodObjeto=28;
    $accion='Delete';
    $descrip='Se elimino un producto en catálago  Evento';
    bitacora($CodObjeto,$accion,$descrip);

  
  }


  

?>