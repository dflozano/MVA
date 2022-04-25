<?php 

require 'conexión.php';
include 'funcionbitacora.php';
 session_start();


//BITACORA/
   $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'borrar_mantenimiento_roles.php'";
   $consulta1 = mysqli_query($conn,$consulta);
   $valor= mysqli_fetch_array($consulta1);
   error_reporting(0);
   $numero=$valor[0];
   $CodObjeto=$numero;
   $accion='Eliminar';
   $descrip='preciono boton de eliminar rol';
   bitacora($CodObjeto,$accion,$descrip);


if (isset($_GET['CodigoRol'])){
    $id=$_GET['CodigoRol'];
    
    $borrar="DELETE * FROM tbl_roles WHERE CodigoRol=$id ";
    $consultar=mysqli_query($conn, $borrar);
    if(!$consultar){
        echo '<script>
        alert(" Rol no puede ser eliminado");
        window.location="../mantenimiento/mantenimiento_roles.php";
        </script>';
    }

    echo '<script>
    alert(" Se elimino el rol");
    window.location="../mantenimiento/mantenimiento_roles.php";
    </script>';

}








?>