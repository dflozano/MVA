<?php 
 include 'conexión.php';

 session_start();


 if (isset($_GET['CodigoCatalogoEvento'])) {
      $cod=$_GET['CodigoCatalogoEvento'];
    $insert_detalles=mysqli_query($conn,"INSERT INTO  `tbl_catalogotemporal`( CodigoCatalogoEvento, CodigoTipoCatalogo, CantidadPersonas, Descripcion, Precio, PrecioTotal)
SELECT CodigoCatalogoEvento, CodigoTipoCatalogo, CantidadPersonas, Descripcion, Precio, PrecioTotal FROM tbl_detalleevento where CodigoCatalogoEvento = '$cod' ");

$consulta="SELECT CodigoCatalogoEvento  from tbl_detalleevento where CodigoCatalogoEvento = '$cod'";
$valor = mysqli_query ($conn,$consulta);
$valor1= mysqli_fetch_array ($valor);
$cod=$valor1[0];

echo '<script>
window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_agregar.php?CodigoCatalogoEvento='.$cod.'";
</script>';
}

//EDITAR EVENTOS DETALLADOS
if (isset($_GET['NumeroEvento'])) {
  $codi=$_GET['NumeroEvento'];
$insert=mysqli_query($conn,"INSERT INTO  `tbl_catalogotemporal`(NumeroEvento, CodigoTipoCatalogo, CantidadPersonas, Descripcion, Precio, PrecioTotal)
SELECT NumeroEvento, CodigoTipoCatalogo, CantidadPersonas, Descripcion, Precio, PrecioTotal FROM tbl_detalleevento where NumeroEvento = '$codi' ");

$consulta1="SELECT NumeroEvento from tbl_detalleevento where NumeroEvento = '$codi'";
$valor2 = mysqli_query ($conn,$consulta1);
$valor3= mysqli_fetch_array ($valor2);
$codi=$valor3[0];

echo '<script>
window.location="http://localhost/MinutasV/public/bower_components/admin-lte/eventos/eventos_editareventosdetallados.php?NumeroEvento='.$codi.'";
</script>';
}

?>