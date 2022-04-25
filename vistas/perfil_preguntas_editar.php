<?php
   include 'conexión.php';
   include 'funcionBitacora.php';
  
   session_start();
   $usuario=$_SESSION['usuario'];
   $codigo=$_GET['CodigoPregunta'];

  $consultacod="SELECT CodigoUsuario from tbl_usuario where Usuario = '$usuario'";
  $parametrocod = mysqli_query ($conn,$consultacod);
  $valorcod= mysqli_fetch_array ($parametrocod);
  $cod=$valorcod[0];

  if (isset($_GET['CodigoPregunta'])) {
    $sql="SELECT CodigoUsuario, CodigoPregunta, Pregunta, Respuesta FROM `tbl_preguntausuario` as p WHERE p.CodigoPregunta='$codigo'";
    $conResul1=mysqli_query($conn,$sql);
  
    if (mysqli_num_rows($conResul1)==1){
        $fila=mysqli_fetch_array($conResul1);
        $CodigoPregunta=$fila['CodigoPregunta'];
    }  
  }

  $preguntaspredeterminadas=mysqli_query($conn,"SELECT Pregunta FROM tbl_preguntapredeterminada");

  $alert='';
  if (isset($_POST['guardar'])){
    $pre=$_POST['pregunta'];
    $res=$_POST['respuesta'];
        
        $insert=mysqli_query($conn,"UPDATE tbl_preguntausuario SET Pregunta='$pre', Respuesta='$res' WHERE CodigoPregunta='$codigo'");

 echo '<script>
  window.location="http:../vistas/perfil_preguntas.php?CodigoUsuario='.$cod.'";
  </script>';
  } 


  $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'perfil_preguntas_editar.php'";
  $consulta1 = mysqli_query($conn,$consulta);
  $valor= mysqli_fetch_array($consulta1);
  $numero=$valor[0];
  //Llamada a la funcion bitacora
  $CodObjeto=$numero;
  $accion='Ingreso';
  $descrip='Pantalla de parametros';
  bitacora($CodObjeto,$accion,$descrip);
  ///codigo que asocia el rol del usuario y asiga el permiso
   $usuariorol= $_SESSION['usuario'];//traer nombre del usuario que tiene la seccio
   $sql_consulta="SELECT CodigoRol, Usuario FROM tbl_usuario where  Usuario='$usuariorol'";
   $resultado_consulta=$conn->query($sql_consulta);//guarda la consulta
   $row1=$resultado_consulta->fetch_assoc();//arreglo asociativo
   $rol=($row1['CodigoRol']);  
   
   //--------------------------------------------------PERMISO
   $permiso="SELECT CodigoPermiso, CodigoObjeto, CodigoRol, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion,Permiso_Consultar FROM tbl_permisos where CodigoObjeto ='$CodObjeto' AND CodigoRol=' $rol' ";
   $datos56 = mysqli_query ($conn,$permiso);
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
  <link rel="icon" type="image/png" href="dist/img/minuta.png">


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
     <strong>AGREGAR UNA NUEVA PREGUNTA</strong>
    </div>
    
    <div class="card-body">
      

      <form  action="" method="post">
      <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 

        <div>
        <div class="form-row">
      <div class="form-group col-md-11">
      <label for="rol">Pregunta:</label>
      <input  readonly=»readonly»  minlength="4" OnKeyUp="this.value=this.value.toUpperCase();" type="text" class="form-control" value="<?php echo $fila['Pregunta']; ?>"  name="pregunta" autofocus required>
    </select>
    </div>
    <div class="form-group col-md-11">
                        <label class="form-label">Respuesta: </label>
                        <input minlength="4" OnKeyUp="this.value=this.value.toUpperCase();" type="text" class="form-control" value="<?php echo $fila['Respuesta']; ?>"  name="respuesta" autofocus required>
                    </div>
  </div>


          <div class="row mb-1">
          <div class="col-sm-5">
          <ol class="float-sm-left"> <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
                                    <button name='guardar' type="submit" class="btn btn-success">Guardar</button>

             <?php } ?>
            </ol>
          </div>
          <div class="col-sm-5">
            <ol class="float-sm-right">
            <a href="../vistas/perfil_preguntas.php?CodigoUsuario=<?php echo $cod?>" class="btn btn-block bg-danger" value="">Cancelar</a>
            </ol>
              </div>
                  </div>
                </div>
                  </div>
                  
                  </div>
                  
                  </div>
                <!-- /.card-body -->
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

            </div></div>
          <!--/.col (left) -->
          <!-- right column -->
          <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
             
             <?php } ?>


           


             <?php  if($permiso_eliminar==1){?><!-- ejemplo quitar permiso de eliminar------------------------------------------------------------->
            
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