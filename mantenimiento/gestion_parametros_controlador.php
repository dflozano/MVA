<?php 

include 'conexión.php';

if(isset($_POST['Registrar'])){
    $parametro_nuevo=$_POST['parametro'];
    $valor_nuevo=$_POST['valor'];

    $guardar_consulta="INSERT INTO tbl_parametros ( Parametro, Valor) VALUES ('$parametro_nuevo','$valor_nuevo')";
    $resultado_consulta=mysqli_query($conn,$guardar_consulta);
   if(!$resultado_consulta){
    echo '<script>
    alert(" Error al ingresar nuevo parámetro");
    window.location="../mantenimiento/gestion_parametros.php";
    </script>';
   }
   else {
    echo '<script>
    alert(" se ha creado un nuevo parámetro ");
    window.location="../mantenimiento/gestion_parametros.php";
    </script>';
   }
    
} 
?>