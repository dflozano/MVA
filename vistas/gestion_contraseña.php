<?php
include('conexión.php');
include 'funcionBitacora.php';
session_start();
if (isset($_POST['Cambiar'])){
    $Usuarios=$_POST['Usuario'];
    $_SESSION['Usuario']=$Usuarios;
    $contraseña=$_POST['Contraseña'];
    $correo=$_POST['Correo_Electronico'];
    if ($contraseña){
        $contrasena= password_hash($contraseña, PASSWORD_DEFAULT);
        $conn->query("update tbl_usuario set Contraseña='$contrasena' where Usuario='$Usuarios' ") or die($conn->error);
        mail("$correo","Confirmación de Cambio de Contraseña", "$Usuarios", "$contraseña" );
        
        if ($Usuarios == 'ADMIN') {
           // $CONSULTA = mysqli_query($conn, "UPDATE tbl_usuario set Fecha_Vencimiento = '0'");
            echo  '<script>
            alert(" Guardado Correctamente ");
               window.location="../vistas/gestion_principal.php";
               </script>';
        }else{
        $consultparametro="SELECT valor from tbl_parametros where Parametro = 'ADMIN_DIAS_VIGENCIA'";
        $parametro = mysqli_query ($conn, $consultparametro);
        $valor= mysqli_fetch_array ($parametro);
        $v=$valor[0];  
        /*Actualizo la fecha de vencimiento */
        $vencimiento=mysqli_query($conn,"update tbl_usuario set Fecha_Vencimiento = date_add(Fecha_Creacion, interval $v day) where Usuario = '$Usuarios'");
        $date = date('Y-m-d');
        $modificacion=mysqli_query($conn,"update tbl_usuario set Fecha_Modificacion = ('$date')");
        $consult=mysqli_query($conn,"UPDATE tbl_usuario SET CodigoEstadoUsuario = 2 WHERE Usuario='$Usuarios'");
        //Llamada a la funcion bitacora
        $CodObjeto=14;
        $accion='Actualizar';
        $descrip='Se gestiono un cambio de contraseña';
        bitacora($CodObjeto,$accion,$descrip);
    }
        echo '<script>
        alert(" La contraseña fue cambiada exitosamente vuelve a ingresar. ");
        window.location="gestion_principal.php";
        </script>';
    }
}


if (isset($_POST['actualizar'])){
    $Usuarios=$_POST['Usuario'];
    $NombreUsuario=$_POST['NombreUsuario'];
    $correo=$_POST['Correo_Electronico'];
    $rol=$_POST['CodigoRol'];
    $estadou=$_POST['CodigoEstado'];
    if ($Usuarios == 'ADMIN') {
        $CONSULTA = mysqli_query($conn, "UPDATE tbl_usuario set CodigoEstadoUsuario = 2");
        
        echo  '<script>
        alert(" Guardado Correctamente ");
           window.location="gestion_principal.php";
           </script>';
    }else{
        $consul=mysqli_query($conn,"UPDATE tbl_Usuario SET CodigoRol = '$rol' , CodigoEstadoUsuario='$estadou', NombreUsuario='$NombreUsuario', Correo_Electronico='$correo' WHERE Usuario='$Usuarios'");
$CodObjeto=14;
        $accion='Actualizar';
        $descrip='Se gestiono un cambio el Nombre, Correo, Rol o el Estado de Usuario';
        bitacora($CodObjeto,$accion,$descrip);
}
   echo  '<script>
     alert(" Guardado Correctamente ");
        window.location="gestion_principal.php";
        </script>';
    }
     
    


?>