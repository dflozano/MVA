<?php

  function bitacora($CodObjeto,$accion,$descrip){
    include 'conexión.php';

    $Usuario=$_SESSION['usuario'];
    
    //Obtenemos el codigo Usuario
    $consulta5="SELECT CodigoUsuario from tbl_usuario where Usuario = '$Usuario'";
    $datos5 = mysqli_query ($conn,$consulta5);
    $fila5= mysqli_fetch_array ($datos5);
    $codUsuario=$fila5[0];

    $consultabitacora=mysqli_query($conn,"INSERT INTO tbl_bitacora (CodigoUsuario, CodigoObjeto, Fecha, Accion, Descripcion) VALUES ('$codUsuario','$CodObjeto',now(),'$accion','$descrip')");
  }
?>