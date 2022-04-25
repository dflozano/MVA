<?php 

require 'conexión.php';
include 'funcionbitacora.php';
 session_start();


//BITACORA/
   $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'borrar_mantenimiento_tipopersona.php'";
   $consulta1 = mysqli_query($conn,$consulta);
   $valor= mysqli_fetch_array($consulta1);
   error_reporting(0);
   $numero=$valor[0];
   $CodObjeto=$numero;
   $accion='Eliminar';
   $descrip='preciono boton de eliminar rol';
   bitacora($CodObjeto,$accion,$descrip);


if (isset($_GET['CodigoTipoPersona'])){
    $id=$_GET['CodigoTipoPersona'];
    
    $borrar="DELETE * FROM tbl_tipopersona WHERE CodigoTipoPersona=$id ";
    $consultar=mysqli_query($conn, $borrar);
    if(!$consultar){
        echo '<script>
        alert(" Tipo de usuario no puede ser eliminado");
        window.location="../mantenimiento/mantenimiento_tipopersona.php";
        </script>';
    }

    echo '<script>
    alert(" Se elimino tipo de usuario");
    window.location="../mantenimiento/mantenimiento_tipopersona.php";
    </script>';

}








?>