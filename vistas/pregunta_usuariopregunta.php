<?php
include 'conexión.php';
include 'funcionBitacora.php';
session_start();


if(!empty($_POST)){
  
  $usuario=$_POST['usuario'];
  
    //Validar si existe usuario en la base de datos 
    $consulta = "SELECT * FROM tbl_usuario WHERE Usuario ='$usuario' " ;
    $resultado = mysqli_query($conn, $consulta);
    $filas=mysqli_num_rows($resultado);

    $_SESSION['usuario']=$usuario;

    if ($filas > 0){
      header("Location:pregunta_secretasrecuperar.php");
       //Llamada a la funcion bitacora
      $CodObjeto=6;
      $accion='Responde';
      $descrip='Usuario responde preguntas secretas para recuperar contraseña';
      bitacora($CodObjeto,$accion,$descrip);
    }else{
      echo '<script>
      alert(" El Usuario Ingresado no Existe ");
      window.location="pregunta_usuariopregunta.php";
      </script>';
    }
  
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
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">

<div class="r2egister-box">

  <!-- --------------------------------------------------Content Wrapper. Contains page content -->
  
    
    <!-- Main content -->
          <!-- left column -->
        
            <!-- jquery validation -->
            <div class="card card-outline card-primary">
              <div class="card-footer">
                <h3 class="card-title">¿Olvidaste tu contraseña? </h3>
                
                <h3 class="card-title" ><small>Ingresa tu nombre de usuario </small></h3>
              </div>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
              <div class="card-header">
              <input type="text" style="text-transform:uppercase" class="form-control " pattern="[A-Z a-z]+" placeholder="Nombre de usuario" name="usuario" id="usuario" required>
              

                <!----------------------------------------------------------------------------- /.card-body -->
                <br>
                 
                <div class="">
                   <button onclick="" type="submit" class="btn btn-primary btn-block" value="verificar datos"> Siguiente </button>
                </div>
                
                </br>
                       
                <a href="../vistas/login.php">Inicio</a>
                      
                <!-- /.col -->
             </div>
                


              </form>
            </div>
            
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
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
