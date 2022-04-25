<?php
   $conexion=mysqli_connect("localhost","root","","minutasv");

   session_start();//si inicia secion
   if(!isset($_SESSION['id_usuario'])){//si la variable secion no existe
     header("location: recuperacion.php");
   }

   $iduser=$_SESSION['id_usuario'];//corresponde al NombreUsuario
   $sql="select NombreUsuario, Correo_Electronico from usuario where
                NombreUsuario='$iduser'";
  $resultado=$conexion->query($sql);//guarda la consulta
  $row=$resultado->fetch_assoc();//arreglo asociativo
 
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recuperacion de contraseña</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////-->
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">¿Olvidaste tu contraseña? A este correo se te enviara un código para recuperarla.</p>

      <form   action="restablecer.php" method="post" >
        <div class="input-group mb-3">
          <input type="email" style="text-transform:uppercase" class="form-control " placeholder="Correo" name="Correo" id="" value="<?php echo utf8_decode($row['Correo_Electronico']); ?>" readonly="readonly" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-"></span>
            </div>
          </div>
        </div>
       

        <div class="row">
          <div class="col-12">
            <button onclick="" type="submit" class="btn btn-success btn-block">Enviar contraseña a mi correo</button>
          </div>
          <!-- /.col -->
        </div>
<!--////////////////////////////////////////////////////////////////////////////////////////////////-->
      <p class="mt-3 mb-1">
        <a href="login.html">Inicio </a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Registrase </a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box////////////////////////////////////////////////////////////////////////////////////// -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>







</body>
</html>
