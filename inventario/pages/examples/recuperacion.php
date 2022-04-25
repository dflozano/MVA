
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Minutas valle de ángeles </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini" style="background-color:#FFFFFF">
<div class="wrapper">
  <!-- --------------------------------------------------Content Wrapper. Contains page content -->
  <div class="content-wrapper"style="background-color:#FFFFFF">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Opciones de recuperación de contraseña   </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.html">Inicio </a></li>
              <li class="breadcrumb-item active">Recuperación de contraseña </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">¿Olvidaste tu contraseña? <small>Ingresa tu nombre de usuario y selecciona una opción de recuperación. </small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="./examples/validar.php" method="post">
              <div class="card-footer">
              <input type="text" style="text-transform:uppercase" class="form-control " placeholder="Nombre de usuario" name="usuario" id="usuario"required>
              </div>

                <!----------------------------------------------------------------------------- /.card-body -->
                <div class="card-footer">
                <div class="col-6">

                  <a type="submit"class="btn btn-warning" href="#">Recuperar mediante pregunta secreta</a>
                </div>
                </div>


                <div class="card-footer">
                <div class="col-6">
                   <button onclick="" type="submit" class="btn btn-success btn-block" value="verificar datos">Enviar contraseña a mi correo</button>
                </div>
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