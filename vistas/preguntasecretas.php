<?php 
include 'conexión.php';
include 'funcionBitacora.php';

session_start();
$usuario=$_SESSION['usuario'];
$direccion=$_SESSION['direccion'];


//Obtengo el parametro
$consulta1="SELECT Valor from tbl_parametros where Parametro = 'ADMIN_No_PREGUNTAS_SECRETAS'";
$dato1 = mysqli_query ($conn,$consulta1);
$valor= mysqli_fetch_array ($dato1);
$v=$valor[0];

if(empty($_POST)){
  $_SESSION["con"]=1;
}


if(!empty($_POST)){
  $respuestas=$_POST['respuesta'];
  $pregunta=$_POST['pregunta'];
  $_SESSION["pre"] = isset($_SESSION["pre"]) ? $_SESSION["pre"] : 0;
  $_SESSION["con"] = isset($_SESSION["con"]) ? $_SESSION["con"] : 1;

  if(empty($_POST['respuesta']) || empty($_POST['pregunta'])) {

    $alert="<p style='text-align:center; color:white; background-color: red;'>ERR-07 Debe de escoger una pregunta y responderla</p>";
  }else{
    //Obtengo el codigo Usuario
    $consulta="SELECT CodigoUsuario from tbl_usuario where Usuario = '$usuario'";
    $dato = mysqli_query ($conn,$consulta);
    $codigo= mysqli_fetch_array ($dato);
    $c=$codigo[0];
    
    if($_SESSION["pre"]<($v-1)){
      //Insertamos en la preguntaUsuario
      $insert=mysqli_query($conn,"INSERT INTO tbl_preguntausuario (CodigoUsuario, Usuario, Pregunta, Respuesta, Fecha_Creacion) VALUES ('$c','$usuario','$pregunta','$respuestas', now())");
      $_SESSION["pre"]++;
      $_SESSION["con"]++;

    }elseif($_SESSION['pre']=$v){
      //Actualizamos Usuario con las preguntas contestadas
      $insert=mysqli_query($conn,"INSERT INTO tbl_preguntausuario (CodigoUsuario, Usuario, Pregunta, Respuesta, Fecha_Creacion) VALUES ('$c','$usuario','$pregunta','$respuestas', now())");
      $update=mysqli_query($conn,"UPDATE tbl_usuario SET Preguntas_Contestadas = $v, CodigoEstadoUsuario = 2 WHERE Usuario = '$usuario' ");
      $_SESSION['con']=0;
      $_SESSION["pre"]=0;

      if($update){
        switch ($direccion) {
          case 1:
            //Llamada a la funcion bitacora
            $CodObjeto=3;
            $accion='Contestación';
            $descrip='Responde a preguntas secretas';
            bitacora($CodObjeto,$accion,$descrip);
            header("Location:login.php");
            break;
          case 2:
            $CodObjeto=3;
            $accion='Contestación';
            $descrip='Responde a preguntas secretas para poder recuperar contraseña si la olvida';
            bitacora($CodObjeto,$accion,$descrip);
            header("Location:pregunta_cambiarcontrasena.php");
            break;
          default:
            # code...
            break;
        }
      }else{
        $alert="<p style='text-align:center; color:white; background-color: red;'>Error</p>";
    
      }
              
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
</head>

<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo">
  <a href="../../index2.html"><b></a>
</div>
<!-- /.login-logo -->

<div class="card">
<div class="card-header text-center">
   <strong>DEBE REGISTRAR PREGUNTAS SECRETAS | <?php echo $v ?>  </strong>
  </div>
  <div class="card-body login-card-body">
  <p class="login-box-msg">Pregunta No. <?php echo $_SESSION["con"] ?> </p>
    
     
    <form action="" method="post">
    <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 
<!------------------------------------------------------------------AQUI TRAE LAS PREGUNTAS PREDETERMINADAS DE LA BD--------------------------------------------------------------------------- /.login-logo -->

      <div class="input-group mb-3">
      <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user-shield"type="button" ></span>
          </div>
        </div>
        
      
      <select name="pregunta" id="pregunta"  class="custom-select">
      <option selected>Escoge una pregunta...</option>
        <?php
        $consulta="SELECT * FROM  tbl_preguntapredeterminada ";
        $ejecutar=mysqli_query($conn, $consulta) or die (mysqli_error($conn));
        ?>
        <?php foreach ($ejecutar as $opciones ):  ?>
        <option value="<?php echo $opciones['Pregunta'] ?>"> <?php echo $opciones['Pregunta'] ?> </option>
          <?php endforeach ?>
      </select>
  <!-------------------------------------------------------------------------------------------------------------------------------- /.login-logo -->

        
      </div>
      <div class="input-group mb-3">
      <input minlength="4" OnKeyUp="this.value=this.value.toUpperCase();" type="text" class="form-control" placeholder="Respuesta" name="respuesta" id="respuesta" require style="text-transform:uppercase" >
                
        <div class="input-group-append">
          <div class="input-group-text">
          </div>
        </div>
      </div>
      <div>
  
      
     
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block">Siguiente</button>
        </div>
        <!-- /.col -->
      </div>
     
      
    </form>
  
     

    
  </div>
  <!-- /.login-card-body -->
</div>
</div>
