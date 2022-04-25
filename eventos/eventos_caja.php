<?php
   include 'conexión.php';
   include 'funcionBitacora.php';
  
   session_start();
   $usuario=$_SESSION['usuario'];
   $cod=$_GET['NumeroEvento'];

       /*BITACORA*/
       $consulta2="SELECT CodigoObjeto from tbl_objetos where Objeto = 'eventos_caja.php'";
       $consulta3 = mysqli_query($conn,$consulta2);
       $valor= mysqli_fetch_array($consulta3);
       $numero=$valor[0];
       //Llamada a la funcion bitacora
       $CodObjeto=$numero;
       $accion='Ingreso';
       $descrip='Ingresa a la pantalla de caja';
       bitacora($CodObjeto,$accion,$descrip);
   
  //VALORES
  $consulta="SELECT * from tbl_eventos where NumeroEvento = '$cod'";
  $consulta1 = mysqli_query($conn,$consulta);
  $valores= mysqli_fetch_array($consulta1);
  $precio = $valores['PrecioTotal'];

  $cambio='';

  if(isset($_POST['btnlisto'])){
    if(empty($_POST['cantidad'])){
      echo '<script>
        alert("Ingrese la cantidad");
        </script>';
    }else{
      $cantidad=$_POST['cantidad'];

      if($cantidad<$precio){
        echo '<script>
        alert("Ingrese a una cantidad adecuada");
        </script>';
      }else{

        

        $cambio=$cantidad-$precio;
        $NumOfDecimals=2;
        $decimalIndicator='.';
        $thousandSeparator=',';
        $cambio= number_format($cambio, $NumOfDecimals, $decimalIndicator, $thousandSeparator);
        $_SESSION['codigo']=$cod;
        $_SESSION['cambio']=$cambio;
        $_SESSION['billete']=$cantidad;
        header("Location:eventos_factura.php");
      }

      
    }

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
     <strong>MINUTAS VA</strong>
    </div>
    
    <div class="card-body">
      

      <form  action="" method="post">
      <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 

        <div>
        <div class="input-group mb-3">
          <div class="input-group-append">
          </div>
          <label for="">TOTAL A COBRAR &nbsp</label>
                    <input value="<?php echo $precio  ?>" id="total" name="total" type="number" class="form-control" placeholder="" disabled>
          <div class="input-group-append">
        </div>
        </div>

        <div>
        <div class="input-group mb-3">
          <div class="input-group-append">
          </div>
          <label for="">PAGO CON &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </label>
            <input value="<?php if(isset($cantidad)) echo $cantidad ?>" onkeypress="return solonumeros(event);" type="" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese la cantidad" pattern="[0-9]+">
        </div>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-append">
          </div>
          <label for="">CAMBIO &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</label>
            <input value="<?php if($cambio==''){$cambio='0.00'; echo $cambio;}else{echo $cambio;} ?>" id="cambio" name="cambio" class="form-control" disabled>
        </div>
        </div>
        

        <div class="row">
          
          <!-- /.col -->
          <div class="mb-2 col-6 text-center">
                        <input  name="btnlisto" type="submit" class="btn btn-primary btn-block"  value="Listo">

          </div>
          <div class="mb-2 col-6 text-center ">
                                    <a href="eventos_eventosdetallados.php" class="btn btn-block btn-danger" role="button" aria-pressed="true">Salir</a>

          </div>
          
          <!-- /.col -->
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
  

   /*Solo números*/
  function solonumeros(evt){
    if(window.event){
      keynum = evt.keyCode;
    }else{
      keynum = evt.which;
    }

    if((keynum > 47 && keynum < 58) || keynum == 8){
      return true;
    }else{
      return false;
    }
  }


    
</script>
