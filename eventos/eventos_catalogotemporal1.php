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
     
     header("Location: eventos_nuevopaquete.php");

     $CodObjeto=28;
     $accion='Delete';
     $descrip='Se elimino un producto en catálago  Evento';
     bitacora($CodObjeto,$accion,$descrip);

  }
  
  //EDITAR CATALOGO
  if(isset($_GET['CodigoDetalleEvento'])) {
    $cod=$_GET['CodigoDetalleEvento'];

    $consulta="SELECT CodigoCatalogoEvento from tbl_detalleevento where CodigoDetalleEvento = '$cod'";
    $valor = mysqli_query ($conn,$consulta);
    $valor1= mysqli_fetch_array ($valor);
    $codigo=$valor1[0];

  
    $query1= "DELETE FROM tbl_detalleevento WHERE CodigoDetalleEvento ='$cod' ";
          
    $result= mysqli_query($conn,$query1);
 
    if (!$result) {
      die("query failed");
    }
    echo '<script>
                window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_cataeditar.php?CodigoCatalogoEvento='.$codigo.'";
                </script>';

    $CodObjeto=28;
    $accion='Delete';
    $descrip='Se elimino un producto en catálago  Evento';
    bitacora($CodObjeto,$accion,$descrip);

  
  }



?>