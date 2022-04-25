<?php
// variable de seccion
session_start();
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
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
<div class="wrapper">
<div class="preloader flex-column justify-content-center align-items-center">
<img class="animation__wobble" src="../dist/img/minuta.png" alt="Minutas Valle de Ángeles" height="150" width="150">
</div>
  <!-- --------------------------------------------------Content Wrapper. Contains page content----------------------------------------------------------- -->
  
    <!-- Content Header (Page header) ------------------------------------------------------------------------------------------------->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
          <div class="col-sm-12">

          </div>
          
        </div>
      </div>
    </section>
    
 <!-- /.container-fluid -------------------------------------------------------------------------------------------------------------------------->

    <!-- Main content -->
  
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-outline card-primary">
              <div class="card-footer">
                <h3 class="card-title">¿Olvidaste tu contraseña? <small>Selecciona un metodo de recuperacion. </small></h3>
              </div>
              <!-- /.card-header ----------------------------------------------------------------------------------------------------------------------->
              <!-- form start -->

              <form action="" method="post">
                <!----------------------------------------------------------------------------- /.card-body -->
                <div class="card-header">
                <div class="col-12">
                 <br>
                <div class="input-group mb-8">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Selecciona un metodo de recuperacion
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="pregunta_usuariopregunta.php">Pregunta de seguridad</a>
                      <a class="dropdown-item" href="correo_recuperacion.php">Enviar contraseña a mi correo</a>
                    </div>
                  </div>
                         
                </div>
                </div>
</br>
                <div>
                  
                       <p class="mt-3 mb-1">
                         <a href="../vistas/login.php">Inicio</a>
                      </p>


                </div>
                <!-- /.col--------------------------------------------------------------------------------------------------------- -->
              </form>
              </div>
              </div>

      
            
          
        
        
        
          

      
        
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>


<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<!-- jQuery 3 -->
<script src="../public/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- Bootstrap 3.3.7 -->
<script src="../public/js/bootstrap.min.js"></script>
<script src="../public/js/bootbox.min.js"></script>
<script src="scripts/login.js"></script>
<!-- iCheck -->
 
</body>
</html>
