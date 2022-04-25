<?php 
  include 'conexión.php';
  include 'funcionBitacora.php';

  session_start();
  $usuario=$_SESSION['usuario'];
  
  if(!empty($_POST)){
    $respuestas=$_POST['respuesta'];
    $pregunta=$_POST['pregunta'];

    if(empty($_POST['respuesta']) || empty($_POST['pregunta'])) {
      $alert="<p style='text-align:center; color:white; background-color: red;'>Debe de escoger una pregunta y responderla</p>";
    }else{
      //Obtengo el codigo Usuario
      $consulta="SELECT CodigoUsuario from tbl_usuario where Usuario = '$usuario'";
      $dato = mysqli_query ($conn,$consulta);
      $codigo= mysqli_fetch_array ($dato);

      ///
      $consulta = "SELECT * FROM tbl_preguntausuario WHERE Usuario ='$usuario' AND Pregunta = '$pregunta' AND Respuesta = '$respuestas'" ;
      $resultado = mysqli_query($conn, $consulta);
      $filas=mysqli_num_rows($resultado);

      if ($filas > 0){
        //Llamada a la funcion bitacora
        $CodObjeto=7;
        $accion='Contestación';
        $descrip='Responde a preguntas secretas para para recuperar contraseña';
        bitacora($CodObjeto,$accion,$descrip);
        header("Location:pregunta_cambiarcontrasena.php");
      }else{
        echo '<script>
        alert(" Pregunta o Respuesta incorrecta ");
        window.location="pregunta_secretasrecuperar.php";
        </script>';
      }
     
    } 
   } 
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Preguntas Secretas </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b></a>
  </div>
  <!-- /.login-logo -->
  
  <div class="card">
  <div class="card-header text-center">
     <strong>ESCOGA UNA PREGUNTA SECRETA  </strong>
    </div>
    <div class="card-body login-card-body">
      <form action="" method="post">
      <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 
      <input type="text"  class="form-control"style="visibility:hidden"  placeholder="" name="pregunta" id="pregunta" require value="<?php echo utf8_decode($row['pregunta']); ?>">

  <!------------------------------------------------------------------AQUI TRAE LAS PREGUNTAS PREDETERMINADAS DE LA BD--------------------------------------------------------------------------- /.login-logo -->

        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-shield"type="button" ></span>
            </div>
          </div>
          
        
        <select name="pregunta" id="pregunta"  class="custom-select">
        <option selected>Escoge una pregunta...</option>
          <?php
          $consulta="SELECT * FROM  tbl_preguntapredeterminada ";
          $ejecutar=mysqli_query($conn, $consulta) or die (mysqli_error($conn));
          ?>
          <?php foreach ($ejecutar as $opciones ):  ?>
          <option value="<?php echo $opciones['Pregunta'] ?>"> <?php echo $opciones['Pregunta'] ?> </option>
            <?php endforeach ?>
        </select>
    <!-------------------------------------------------------------------------------------------------------------------------------- /.login-logo -->

          
        </div>
        <div class="input-group mb-3">
        <input minlength="4" OnKeyUp="this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="respuesta" name="respuesta" id="respuesta" require style="text-transform:uppercase" >
                  
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div>
    
        
       
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Siguiente</button>
          </div>
          <!-- /.col -->
        </div>
       
        
      </form>
    
       

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<input type="text" class="form-control" style="visibility:hidden" placeholder="respuesta" name="respuesta" id="respuesta" require value="<?php echo utf8_decode($row['respuesta']); ?>">
<input type="text" class="form-control" style="visibility:hidden" placeholder="usuario" name="usuario" id="usuario" require value="<?php echo utf8_decode($row['usuario']); ?>">
       


<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>



       