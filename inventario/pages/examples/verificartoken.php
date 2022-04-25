<?php
$conexion=mysqli_connect("localhost","root","","minutasv");

$Correo=$_POST['Correo'];
$Token=$_POST['Token'];
$Codigo=$_POST['Codigo'];
$res=$conexion->query("SELECT * FROM contrase�a where
 Correo='$Correo'and Token='$Token' and Codigo= '$Codigo' ")or die($conexion->error);
$correcto=false;
if(mysqli_num_rows($res) > 0){
    $fila=mysqli_fetch_row($res);
    $Fecha_Modificacion=$fila[9];
    $fecha_actual=date("y-m-d h:m:s");
    $segundos=strtotime($fecha_actual)-strtotime($Fecha_Modificacion);
    $minutos=$segundos/60;
   // if ($minutos>40){
   //     echo"contraseña vencida vuelva a enviar un correo";
   // }
   // else{
   //     echo"exitoso";
   // }
  
   $correcto=true;


}
else {
  $correcto=false;

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
    <a href="../../index2.html"><b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Está a solo un paso de su nueva contraseña, recupere su contraseña ahora.</p>
      
       <?php if($correcto){ ?>
      <form action="./cambiarcontrasena.php" method="post">
        <div class="input-group mb-3">
        
          <input type="Password" class="form-control" placeholder="contraseña" name="contrasena" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="Password" class="form-control" placeholder="Confirmar contraseña" name="contrasena2" >
          <input type="hidden" class="form-control" id="c" name="Correo" value="<?php echo $Correo ?>" >

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"> Cambiar contraseña</button>
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
<?php } else{ ?>
        <div class="alert alert-danger">contraseña incorrecta o  esta vencida por favor vuelve a intentar</div>
        <?php } ?>  

     