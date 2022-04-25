<?php
   include 'conexión.php';
   include 'funcionBitacora.php';
  
   session_start();
   $usuario=$_SESSION['usuario']; 
   $cod=$_GET['NumeroEvento'];
   /*BITACORA*/
   $consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'eventos_metodopago.php'";
   $consulta1 = mysqli_query($conn,$consulta);
   $valor= mysqli_fetch_array($consulta1);
   $numero=$valor[0];
   //Llamada a la funcion bitacora
   $CodObjeto=$numero;
   $accion='Escoger';
   $descrip='Escoge la forma de pago del pedido';
   bitacora($CodObjeto,$accion,$descrip);

    //VALORES
    $consulta="SELECT * from tbl_eventos where NumeroEvento = '$cod'";
    $consulta1 = mysqli_query($conn,$consulta);
    $valores= mysqli_fetch_array($consulta1);
    $estado = $valores['CodigoEstadoEvento'];

    if($estado==2){

    }else{
      header("Location:eventos_eventosdetallados.php");
    }

  
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MVA | Software</title>
  <link rel="icon" type="image/png" href="../dist/img/minuta.png">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!--Bootstrap 4-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  
</head>
<body class="hold-transition register-page">
<div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="dist/img/minuta.png" alt="Minutas Valle de Ángeles" height="150" width="150">
  </div>

<div class="register-box">

  <div class="card card-outline ">
  <div class="card-header text-center">
     <strong>METODO DE PAGO</strong>
    </div>
    
    <div class="card-body">
      

      <form  action="" method="post">
      <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 

        
        
        
        <div class="row">
          
          <!-- /.col -->
          <div class="mb-2 col-6 text-center">
            <a href="eventos_tarjeta.php?NumeroEvento=<?php echo $cod?>" class="btn btn-primary"><i class=""></i> TARJETA</a>
          </div>
          <div class="mb-2 col-6 text-center ">
            <a href="eventos_caja.php?NumeroEvento=<?php echo $cod?>" class="btn btn-success"><i class =""></i> EFECTIVO</a>
          </div>
          
          <!-- /.col -->
        </div>
        <div class="col-13 mb-4 text-center">
                        <a href="eventos_eventosdetallados.php" class="btn btn-block btn-danger btn-sm" role="button" aria-pressed="true">Salir</a>
                      </div>
      
      </form>
  
      
      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!--Alert-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

</body>
</html>


<script>
  

    /*No dejar espacios contrasena*/
    function hola(evt){
    if(window.event){
      keynum = evt.keyCode;
    }else{
      keynum = evt.which;
    }

    if((keynum > 32 && keynum < 166) || keynum == 8){
      return true;
    }else{

    return false;
    }
  }

  function mostrarPassword(){
		var cambio = document.getElementById("1");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 

  function mostrar(){
		var cambio = document.getElementById("2");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
    
    
</script>
