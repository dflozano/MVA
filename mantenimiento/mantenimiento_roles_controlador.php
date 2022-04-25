<?php
include 'conexión.php';
if(isset($_POST['guardar'])){
$nuevo_rol=$_POST['rol_nuevo'];
$descripcion=$_POST['descripcion'];
$consulta="INSERT INTO  tbl_roles (Rol,Descripcion,Fecha_Creacion)VALUES ('$nuevo_rol','$descripcion', CURTIME() )";
$ejecutar_insertar_ficha1=mysqli_query($conn,$consulta); 
echo '<script>
    alert(" Se ingreso un nuevo rol ");
    window.location="../mantenimiento/mantenimiento_roles.php";
    </script>';

}
else{
    echo '<script>
    alert(" Eror al ingresar un nuevo rol ");
    window.location="../mantenimiento/mantenimiento_roles.php";
    </script>';
}




?>