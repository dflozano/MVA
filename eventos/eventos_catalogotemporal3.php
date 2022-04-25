<?php
include 'conexión.php';
include 'funcionBitacora.php';
session_start();

if(isset($_GET['CodigoTemporalCatalogo'])) {
    $codigo = $_GET['CodigoTemporalCatalogo'];
    
    $consulta="SELECT NumeroEvento  from tbl_catalogotemporal where CodigoTemporalCatalogo = '$codigo'";
    $valor = mysqli_query ($conn,$consulta);
    $valor1= mysqli_fetch_array ($valor);
    $cod=$valor1[0];

    $query1= "DELETE FROM tbl_catalogotemporal WHERE CodigoTemporalCatalogo = $codigo";
    $result= mysqli_query($conn,$query1);

    

    if (!$result) {
      die("query failed");
    }
     
    echo '<script>
    window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_editareventosdetallados.php?NumeroEvento='.$cod.'";
    </script>';


     $CodObjeto=28;
     $accion='Delete';
     $descrip='Se elimino un producto en catálago  Evento';
     bitacora($CodObjeto,$accion,$descrip);

  }

?>