<?php
include 'conexión.php';
include 'funcionBitacora.php';
session_start();

if(isset($_GET['CodigoTemporalCatalogo'])) {
    $codigo = $_GET['CodigoTemporalCatalogo'];
    
    $consulta="SELECT CodigoCatalogoEvento  from tbl_catalogotemporal where CodigoTemporalCatalogo = '$codigo'";
    $valor = mysqli_query ($conn,$consulta);
    $valor1= mysqli_fetch_array ($valor);
    $cod=$valor1[0];

    $query1= "DELETE FROM tbl_catalogotemporal WHERE CodigoTemporalCatalogo = $codigo";
    $result= mysqli_query($conn,$query1);

    

    if (!$result) {
      die("query failed");
    }
     
    echo '<script>
    window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_agregar.php?CodigoCatalogoEvento='.$cod.'";
    </script>';


     $CodObjeto=28;
     $accion='Delete';
     $descrip='Se elimino un producto en catálago  Evento';
     bitacora($CodObjeto,$accion,$descrip);

  }

  if(isset($_GET['CodigoDetalleEvento'])) {
    $cod=$_GET['CodigoDetalleEvento'];

    $consulta2="SELECT CodigoCatalogoEvento from tbl_detalleevento where CodigoDetalleEvento = '$cod'";
    $valor2 = mysqli_query ($conn,$consulta2);
    $valor2= mysqli_fetch_array ($valor2);
    $codigo1=$valor2[0];

    //$consulta="SELECT CodigoDetalleEvento from tbl_detalleevento where CodigoCatalogoEvento = '$cod'";
    //$valor = mysqli_query ($conn,$consulta);
    //$valor1= mysqli_fetch_array ($valor);
    //$codigo=$valor1[0];

  
    $query1= "DELETE FROM tbl_detalleevento WHERE CodigoDetalleEvento ='$cod'  ";
          
    $result= mysqli_query($conn,$query1);
 
    if (!$result) {
      die("query failed");
    }
    echo '<script>
                window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_agregar.php?CodigoCatalogoEvento='.$codigo1.'";
                </script>';

    $CodObjeto=28;
    $accion='Delete';
    $descrip='Se elimino un producto en catálago  Evento';
    bitacora($CodObjeto,$accion,$descrip);

  
  }

?>