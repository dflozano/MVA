<?php
include 'conexión.php';
if(isset($_POST['Estado'])){
$guardar_Estado=$_POST['Estado'];
$consulta="INSERT INTO tbl_estadoUsuario (Descripcion) VALUES ('$guardar_Estado')";
$ejecutar_insertar_ficha1=mysqli_query($conn,$consulta); 
echo '<script>
    alert(" Se ingreso un Nuevo Estado. ");
    window.location="../mantenimiento/Man_Estado_Usuario.php";
    </script>';

}
else{
    echo '<script>
    alert(" Eror al ingresar Estado. ");
    window.location="../mantenimiento/Man_Estado_Usuario.php";
    </script>';
}




?>