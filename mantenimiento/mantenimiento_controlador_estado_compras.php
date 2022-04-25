<?php
include 'conexión.php';
if(isset($_POST['guardar'])){
$compras=$_POST['compras'];
$consulta="INSERT INTO tbl_estadocompras(Estado) VALUES ('$compras')";
$ejecutar_insertar_ficha1=mysqli_query($conn,$consulta); 
echo '<script>
    alert(" Se ingreso un nuevo tipo de compras ");
    window.location="../mantenimiento/mantenimiento_estado_compras.php";
    </script>';

}
else{
    echo '<script>
    alert(" Error al ingresar un nuevo tipo de compras ");
    window.location="../mantenimiento/mantenimiento_estado_compras.php";
    </script>';
}

?>