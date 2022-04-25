<?php


  function kardex($Producto_kardex,$CodKardex,$Cantidad){
    include 'conexion.php';

    $Usuario=$_SESSION['usuario'];
    
    //Obtenemos el codigo Usuario
    $consulta5="SELECT CodigoUsuario from tbl_usuario where Usuario = '$Usuario'";
    $datos5 = mysqli_query ($conexion,$consulta5);
    $fila5= mysqli_fetch_array ($datos5);
    $codUsuario=$fila5[0];

    $insert_Kardex=mysqli_query($conexion,"INSERT INTO tbl_kardex (CodigoMateria, CodigoTipoKardex, Cantidad, Descripcionk, Fecha, CodigoUsuario) VALUES ('$Producto_kardex','$CodKardex','$Cantidad','NUEVA COMPRA',now(), $codUsuario)");
  }

?>


