<?php
include 'conexión.php';
if(isset($_POST['pregunta_i'])){
$guardar_pregunta=$_POST['pregunta_i'];
$consulta="INSERT INTO tbl_preguntapredeterminada (Pregunta) VALUES ('$guardar_pregunta')";
$ejecutar_insertar_ficha1=mysqli_query($conn,$consulta); 
echo '<script>
    alert(" Se ingreso una nueva pregunta de seguridad. ");
    window.location="../mantenimiento/gestion_preguntas.php";
    </script>';

}
else{
    echo '<script>
    alert(" Eror al ingresar pregunta de seguridad. ");
    window.location="../mantenimiento/gestion_preguntas.php";
    </script>';
}

?>