<?php
$conexion=mysqli_connect("localhost","root","","minutasv");
// variable de seccion
include 'funcionbitacora.php';// llamado a la bitacora
session_start();
////////////////////////////////////////////////bitacora
$CodObjeto=11;
$accion='Actualizar';
$descrip='Pantalla donde se ingresa la nueva contraseña';
bitacora($CodObjeto,$accion,$descrip);


$Correo=$_POST['Correo'];
$Token=$_POST['Token'];
$Codigo=$_POST['Codigo'];
$res=$conexion->query("SELECT * FROM tbl_contraseña where
 Correo='$Correo'and Token='$Token' and Codigo= '$Codigo' ")or die($conexion->error);
$correcto=false; 
if(mysqli_num_rows($res) > 0){
    $fila=mysqli_fetch_row($res);
   // $Fecha_Modificacion=$fila[9];
  //  $fecha_actual=date("y-m-d h:m:s");
    //$segundos=strtotime($fecha_actual)-strtotime($Fecha_Modificacion);
    //$minutos=$segundos/60;
  // if ($minutos>40){
   //    echo"";
   //}
   //else{
  ///  echo"";
    //}
  
   $correcto=true;
   

}
else {
  $correcto=false;
  echo '<script>
    alert("ERR-009 Error vuelve a intertar / código expiro");
      window.location="login.php";
    </script>';
 
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Minutas Valle de Ángeles | Usuario</title>
  
  <link rel="icon" type="image/png" href="../dist\img\minuta.png">

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
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
          <div class="col-sm-12">
            
          </div>
        </div>
      </div>
    </section>
    <div class="card card-outline card-primary">
    <div class="card-footer">
      <div class="col-sm-12">
       <h3 class="card-title">Introduzca la nueva contraseña.</h3>
      </div>
      </div>  
 
  <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="../dist/img/minuta.png" alt="Minutas Valle de Ángeles" height="150" width="150">
  </div>

    <div class="card-header">
    
      
       <?php if($correcto){ ?>
      <form action="correo_cambiarcontrasena.php" method="post">
        <br>
        <div class="input-group mb-3">
        <input type="Password" class="form-control" placeholder="contraseña" name="contrasena" id="contrasena" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{8,}" title=" Su contraseña debe tener mínimo 8 caracteres, al menos 1 número, al menos 1 letra mayúscula" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-eye"type="button" onclick="mostrar()"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="Password" class="form-control" placeholder="Confirmar contraseña" name="contrasena2" id="contrasena2" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{8,}" title=" Su contraseña debe tener mínimo 8 caracteres, al menos 1 número, al menos 1 letra mayúscula">
          <input type="hidden" class="form-control" id="c" name="Correo" value="<?php echo $Correo ?>" >

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-eye" type="button" onclick="mostrar2()"></span>
            </div>
          </div>
        </div>
        <div>
        

      
        
       <br>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"> Cambiar contraseña</button>
          </div>
          <!-- /.col -->
        </div>
       </br>
       <p class="mt-3 mb-1">
        <a href="login.php">Inicio</a>
        </p>
        
      </form>
    
       

      
    </div>
    <!-- /.login-card-body -->
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
        <div class="alert alert-danger">contraseña incorrecta o  esta vencida por favor vuelve a intentar </div>
        <p class="mt-3 mb-1">
        <a href="metodo.php">Volver al inicio</a>
        </p>
        </div>
                <?php } ?>  
        


        <script>
          function mostrar2() {
         var x = document.getElementById("contrasena2");
         if (x.type === "password") {
            x.type = "text";
            } else {
           x.type = "password";
  }
}
          </script>
          
          
          <script>
          function mostrar() {
         var x = document.getElementById("contrasena");
         if (x.type === "password") {
            x.type = "text";
            } else {
           x.type = "password";
  }
}
          </script>
 
 <script>
 
</script>