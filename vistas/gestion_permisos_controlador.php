<?php
include 'conexión.php';
$rol= $_POST['rol'];// trae el rol
$objeto= $_POST['objeto'];//trae el objeto a restringir 

// trer el rol
$sql_rol="SELECT CodigoRol , Rol FROM tbl_roles where  Rol='$rol'";
$resultado_rol=$conn->query($sql_rol);//guarda la consulta
$row_rol=$resultado_rol->fetch_assoc();//arreglo asociativo
$codigo_rol=($row_rol['CodigoRol']);  // variable con el rol del usuario

//traer el codigo objeto es decir la pagina
  $sql="SELECT CodigoObjeto , Objeto FROM tbl_objetos where  Objeto='$objeto'";
  $resultado=$conn->query($sql);//guarda la consulta
  $row=$resultado->fetch_assoc();//arreglo asociativo
  $codigoobjeto=($row['CodigoObjeto']);  // variable con el rol del usuario
 
  if($codigo_rol==1)/// si el sol es el 1 osea el admin
  {
   //trae valor checkboox
$permisos='';

if(isset($_POST['permisos1'])){
    $permisos1=$permisos.''.$_POST['permisos1'];
    $insertar=$permisos1;

}
else{
    $insertar=1;
}
if(isset($_POST['permisos2'])){
    $permisos2=$permisos.''.$_POST['permisos2'];
    $eliminar=$permisos2;
    
}
else{
    $eliminar=1;
}
if(isset($_POST['permisos3'])){
    $permisos3=$permisos.''.$_POST['permisos3'];
    $actualizar=$permisos3;
    
}
else{
    $actualizar=1;
}
if(isset($_POST['permisos4'])){
    $permisos4=$permisos.''.$_POST['permisos4'];
    $consultar=$permisos4;
    
}
else{
    $consultar=1;
}
 





 //PERMISO INsertar o actualizar permisos
 $permiso="SELECT CodigoPermiso, CodigoObjeto, CodigoRol, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion,Permiso_Consultar FROM tbl_permisos where CodigoRol=' $codigo_rol' AND CodigoObjeto ='$codigoobjeto'  ";
 $datos5 = mysqli_query ($conn,$permiso);
 $fila5= mysqli_fetch_array ($datos5);
 error_reporting(0);
 $codigopermiso=$fila5[0];


 if(isset($codigopermiso) )
    {
      // Existe
    $ficha2="UPDATE tbl_permisos SET  Permiso_Insercion='$insertar', Permiso_Eliminacion='$eliminar', Permiso_Actualizacion='$actualizar', Permiso_Consultar='$consultar' WHERE  CodigoRol=' $codigo_rol' AND CodigoObjeto='$codigoobjeto'";
    $ejecutar_insertar_ficha2=mysqli_query($conn,$ficha2); 
    echo '<script>
    alert(" Se actualizaron los permisos ");
    window.location="../vistas/gestion_permisos.php";
    </script>';

    }
    else
    {
      // No existe
    $ficha2=" INSERT INTO tbl_permisos ( CodigoRol, CodigoObjeto, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion, Permiso_Consultar) VALUES ( '$codigo_rol', '$codigoobjeto', '$insertar', '$eliminar', '$actualizar', '$consultar')";
    $ejecutar_insertar_ficha2=mysqli_query($conn,$ficha2); 
  
    echo '<script>
    alert(" Se agrego un nuevo permiso ");
    window.location="../vistas/gestion_permisos.php";
    </script>';
    }

  }// si el sol es el 1 osea el admin



/// si es usuario normal
  else {
//trae valor checkboox
$permisos='';

if(isset($_POST['permisos1'])){
    $permisos1=$permisos.''.$_POST['permisos1'];
    $insertar=$permisos1;

}
else{
    $insertar=0;
}
if(isset($_POST['permisos2'])){
    $permisos2=$permisos.''.$_POST['permisos2'];
    $eliminar=$permisos2;
    
}
else{
    $eliminar=0;
}
if(isset($_POST['permisos3'])){
    $permisos3=$permisos.''.$_POST['permisos3'];
    $actualizar=$permisos3;
    
}
else{
    $actualizar=0;
}
if(isset($_POST['permisos4'])){
    $permisos4=$permisos.''.$_POST['permisos4'];
    $consultar=$permisos4;
    
}
else{
    $consultar=0;
}
 





 //PERMISO INsertar o actualizar permisos
 $permiso="SELECT CodigoPermiso, CodigoObjeto, CodigoRol, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion,Permiso_Consultar FROM tbl_permisos where CodigoRol=' $codigo_rol' AND CodigoObjeto ='$codigoobjeto'  ";
 $datos5 = mysqli_query ($conn,$permiso);
 $fila5= mysqli_fetch_array ($datos5);
 error_reporting(0);
 $codigopermiso=$fila5[0];


 if(isset($codigopermiso) )
    {
      // Existe
    $ficha2="UPDATE tbl_permisos SET  Permiso_Insercion='$insertar', Permiso_Eliminacion='$eliminar', Permiso_Actualizacion='$actualizar', Permiso_Consultar='$consultar' WHERE  CodigoRol=' $codigo_rol' AND CodigoObjeto='$codigoobjeto'";
    $ejecutar_insertar_ficha2=mysqli_query($conn,$ficha2); 
    echo '<script>
    alert(" Se actualizaron los permisos ");
    window.location="../vistas/gestion_permisos.php";
    </script>';

    }
    else
    {
      // No existe
    $ficha2=" INSERT INTO tbl_permisos ( CodigoRol, CodigoObjeto, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion, Permiso_Consultar) VALUES ( '$codigo_rol', '$codigoobjeto', '$insertar', '$eliminar', '$actualizar', '$consultar')";
    $ejecutar_insertar_ficha2=mysqli_query($conn,$ficha2); 
  
    echo '<script>
    alert(" Se agrego un nuevo permiso ");
    window.location="../vistas/gestion_permisos.php";
    </script>';
    }

  }

 
?>