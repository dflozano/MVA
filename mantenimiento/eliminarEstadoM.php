<?php
   include 'conexion.php';
   include 'funcionBitacora.php';
  
   session_start();

   $usuario=$_SESSION['usuario'];

   $cod=$_GET['CodigoEstado'];

   /*Obtengo valores del estado*/
   $consulta="SELECT * from tbl_estadomesa where CodigoEstado = '$cod'";
   $valor = mysqli_query ($conexion,$consulta);
   $variable= mysqli_fetch_array ($valor);
   $descrip1=$variable['Descripcion'];
   
 /*BITACORA*/
 $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'eliminarEstadoM.php'";
 $consulta1 = mysqli_query($conexion,$consulta);
 $valor= mysqli_fetch_array($consulta1);
 $numero=$valor[0];
 //Llamada a la funcion bitacora
 $CodObjeto=$numero;

   if(isset($_POST['Aceptar'])) {
    if ('Aceptar'){

    if($descrip1=="DISPONIBLE" OR $descrip1=="OCUPADO"){
      echo '<script>
        alert("No se puede eliminar predeterminados");
        window.location="estadosMesas.php";
        </script>';
    }else{
      $consulta="DELETE FROM tbl_estadomesa WHERE CodigoEstado = $cod";
      $conResul=mysqli_query($conexion,$consulta);
  
      if($conResul){
        //Llamada a la funcion bitacora
        $CodObjeto=$numero;
        $accion='Eliminar';
        $descrip='Se elimino un estado';
        bitacora($CodObjeto,$accion,$descrip);
         echo '<script>
          alert(" Se elimino exitosamente. ");
          window.location="estadosMesas.php";
          </script>';
      }else{
        echo '<script>
          alert("Error de dependencia");
          window.location="estadosMesas.php";
          </script>';
      }
    }
      
    
      
    }
    
  }

   


       ///codigo que asocia el rol del usuario y asiga el permiso
       $usuariorol= $_SESSION['usuario'];//traer nombre del usuario que tiene la seccio
       $sql_consulta="SELECT CodigoRol, Usuario FROM tbl_usuario where  Usuario='$usuariorol'";
       $resultado_consulta=$conexion->query($sql_consulta);//guarda la consulta
       $row1=$resultado_consulta->fetch_assoc();//arreglo asociativo
       $rol=($row1['CodigoRol']);  
       
       //--------------------------------------------------PERMISO
       $permiso="SELECT CodigoPermiso, CodigoObjeto, CodigoRol, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion,Permiso_Consultar FROM tbl_permisos where CodigoObjeto ='$CodObjeto' AND CodigoRol=' $rol' ";
       $datos56 = mysqli_query ($conexion,$permiso);
       $fila56= mysqli_fetch_array ($datos56);
       error_reporting(0);//oculta el error cuando no se ha otrogado el permiso
       $codigopermiso=$fila56[0];
       $permiso_insertar=$fila56[3];
       $permiso_eliminar=$fila56[4];
       $permiso_actualizar=$fila56[5];
       $permiso_consultar=$fila56[6];
       //--------------------------------------------------PERMISO
     
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MVA | Software</title>
  <link rel="icon" type="image/png" href="../dist/img/minuta.png">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!--Bootstrap 4-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  
</head>
<body class="hold-transition register-page">
<div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="dist/img/minuta.png" alt="Minutas Valle de Ángeles" height="150" width="150">
  </div>
  <?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

<div class="register-box">

  <div class="card card-outline ">
  <div class="card-header text-center">
     <strong>¿Desea eliminar el estado <?php echo " '".$descrip1."'"?> ?</strong>
    </div>
    
    <div class="card-body">
      

      <form  action="" method="post">
      <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 

        
        <div class="row">
          
          <!-- /.col -->
          <div class="mb-2 col-6 text-center">
          <?php if($permiso_eliminar==1){?>
                      <button name='Aceptar' value="btnupdate" type="submit" class="btn btn-danger"><i class=""></i>SÍ</button>

<?php } ?>
          </div>
          <div class="mb-2 col-6 text-center ">
            <a href="estadosMesas.php" class="btn btn-success"><i class =""></i>NO</a>
          </div>
          <!-- /.col -->
        </div>

        
      </form>
  
      
      
      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->


<?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
               
               <?php } ?>
  
  
             <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
               
               <?php } ?>               
               <?php } ?> <!--  finn ocultat permiso de ocultar ------------------------------------------------------------->
      <!-- /.content -->
      <?php  if($permiso_consultar==0){?> <!--si lo hay permiso de consultar  ------------------------------------------------------------->
       
        <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡Error!</strong> <strong>005</strong> Contacta con el administrador.
  </div>
  
        <?php } ?> <!---------------------------  fin mensaje de oculto----------------------------------->
    
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!--Alert-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

</body>
</html>


<script>
  

    /*No dejar espacios contrasena*/
    function hola(evt){
    if(window.event){
      keynum = evt.keyCode;
    }else{
      keynum = evt.which;
    }

    if((keynum > 32 && keynum < 166) || keynum == 8){
      return true;
    }else{

    return false;
    }
  }

  function mostrarPassword(){
		var cambio = document.getElementById("1");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 

  function mostrar(){
		var cambio = document.getElementById("2");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
    
    
</script>
