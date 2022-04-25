
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


  <!-- --------------------------------------------------Content Wrapper. Contains page content -->
  

      
            <div class="card card-outline card-primary">

              <div class="card-footer">
              <div class="col-sm-12">
                <h3 class="card-title">¿Olvidaste tu contraseña? <small>Ingresa tu nombre de usuario para recuperarla. </small></h3>
              </div>
              </div>
          
            
          
              <form action="correo_validar.php" method="post">
              <div class="card-header">
              <div class="col-sm-7">
              <input type="text" style="text-transform:uppercase" class="form-control " pattern="[A-Z a-z]+" placeholder="Nombre de usuario" name="usuario" id="usuario" required>
              

              
                <br> 
                <div class="col-9">
                   <button onclick="" type="submit" class="btn btn-primary btn-block" value="verificar datos">Enviar a mi correo</button>
                </div>
                </br>

                <div>
                       <p class="mt-3 mb-1">
                         <a href="../vistas/login.php">Inicio</a>
                      </p>
                </div>

             </div>
             </div>
             </form>
            
          
            </div>
            
          <div class="col-md-6">
          </div>


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

<!-- libreria para alert2
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../plugins/ion-rangeslider/sweetalert2.js"></script>-->



</body>
</html>
