<?php
if(isset($_GET['Correo']) && isset($_GET['Token'])){
  $Correo=$_GET['Correo'];
  $Token=$_GET['Token'];
}
else{
 // header("location:contrasena_correo.php"); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restablecienso contraseñ<a href="http://" target="_blank" rel="noopener noreferrer"></a></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
   <!-- <a href="../../index2.html"><b></a> -->
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Está a solo un paso de su nueva contraseña, ingresa el código que se envió por correo aquí..</p>
      <form action="./verificartoken.php" method="post">
        <div class="input-group mb-12">
          <label for="c" class="forn-laber">Codigo </label>
          <div class="card">
          
          <input type="text" class="form-control" id="c"  name="Codigo" >
        
         </div>

          <input type="hidden" class="form-control" id="c"  name="Correo" value="<?php echo $Correo;?>">
          <input type="hidden" class="form-control" id="c"  name="Token" value="<?php echo $Token;?>">
        </div>
                  <!--------------------------------------------------------------------------------------------------- /.col -->
        <div class="row">
        <div class="card-footer">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Restablecer</button>
          </div>
</div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.html">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
