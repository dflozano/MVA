<?php
// variable de seccion
include 'funcionbitacora.php';// llamado a la bitacora
session_start();
//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''bitacora
$CodObjeto=10;
$accion='Escribir';
$descrip='Pantalla de recuperacion de contaseña ingresando el codigo de recupercion que se envio por correo';
bitacora($CodObjeto,$accion,$descrip);

if(isset($_GET['Correo']) && isset($_GET['Token'])){
  $Correo=$_GET['Correo'];
  $Token=$_GET['Token'];
}
else{
  
 echo '<script>
    alert(" Error vuelve a intentar ");
      window.location="../vistas/login.php";
    </script>';
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MVA | Software</title>
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
<div class="wrapper">
<div class="preloader flex-column justify-content-center align-items-center">
<img class="animation__wobble" src="../dist/img/minuta.png" alt="Minutas Valle de Ángeles" height="150" width="150"></div>

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
                <h1 class="card-title">Ingresa el código que se envió por correo.</h1>
              </div>
   

      <div class="login-box">

        <form action="correo_verificartoken.php" method="post">

        <div class="card-header">
          <div class="col-sm-9">
          <label for="c" class="label">Codigo de recuperación</label>   
          <input type="text" class="form-control" id="c"  name="Codigo" >
         </div>
        
        
          <input type="hidden" class="form-control" id="c"  name="Correo" value="<?php echo $Correo;?>">
          <input type="hidden" class="form-control" id="c"  name="Token" value="<?php echo $Token;?>">


          <div class="col-sm-7">
          <br> 
            <button type="submit" class="btn btn-primary btn-block ">Restablecer</button>
          </br> 
            <br>
            <a href="./login.php">Inicio</a>
         </br>
        

   <!--------------------------------------------------------------------------------------------------------------------- /.col -->
            
            

            

          <!---------------------------------------------------------------------------------------------------------- /.col -->
        </div>
      </div>

      </form>
    
      </div></div></div> 
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
