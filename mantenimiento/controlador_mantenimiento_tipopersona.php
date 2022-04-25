<?php
include 'conexión.php';
if(isset($_POST['guardar'])){
$persona=$_POST['persona'];
$consulta="INSERT INTO tbl_tipopersona(TipoPersona) VALUES ('$persona')";
$ejecutar_insertar_ficha1=mysqli_query($conn,$consulta); 
echo '<script>
    alert(" Se ingreso un nuevo tipo de persona ");
    window.location="../mantenimiento/mantenimiento_tipopersona.php";
    </script>';

}
else{
    echo '<script>
    alert(" Error al ingresar un nuevo tipo de persona ");
    window.location="../mantenimiento/mantenimiento_tipopersona.php";
    </script>';
}




?>