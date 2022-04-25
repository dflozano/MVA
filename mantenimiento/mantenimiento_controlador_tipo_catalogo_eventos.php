<?php
include 'conexión.php';
if(isset($_POST['guardar'])){
$complemento=$_POST['complemento'];
$consulta="INSERT INTO tbl_tipocatalogoevento(Descripcion) VALUES ('$complemento')";
$ejecutar_insertar_ficha1=mysqli_query($conn,$consulta); 
echo '<script>
    alert(" Se ingreso un nuevo tipo de complemento ");
    window.location="../mantenimiento/mantenimiento_tipo_catalogo_eventos.php";
    </script>';

}
else{
    echo '<script>
    alert(" Error al ingresar un nuevo tipo de complemento ");
    window.location="../mantenimiento/mantenimiento_tipo_catalogo_eventos.php";
    </script>';
}




?>