<?php
include 'conexión.php';
if(isset($_POST['EstadoE'])){
$guardar_EstadoE=$_POST['EstadoE'];
$consulta="INSERT INTO tbl_estadoevento (Estado) VALUES ('$guardar_EstadoE')";
$ejecutar_insertar_ficha1=mysqli_query($conn,$consulta); 
echo '<script>
    alert(" Se ingreso un Nuevo Estado de evento. ");
    window.location="../mantenimiento/Man_Estado_Evento.php";
    </script>';

}
else{
    echo '<script>
    alert(" Eror al ingresar Estado de evento. ");
    window.location="../mantenimiento/Man_Estado_Evento.php";
    </script>';
}




?>