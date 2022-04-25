<?php
   include 'conexion.php';
   include 'funcionBitacora.php';

   $persona=mysqli_query($conexion,"SELECT TipoPersona FROM tbl_tipopersona");
  
   session_start();
   //Llamada a la funcion bitacora
   $CodObjeto=39;
   $accion='Ingreso';
   $descrip='Ingreso en la pantalla para agregar una nueva persona';
   bitacora($CodObjeto,$accion,$descrip);
  
  if(!empty($_POST)){
      $nombre=$_POST['nombre'];
      $numero=$_POST['numero'];
      $tel=$_POST['tel'];
      $correo=$_POST['correo'];
      $direccion=$_POST['direccion'];
      $tipo=$_POST['persona'];

    $alert='';
    if(empty($_POST['nombre']) || empty($_POST['numero']) || empty($_POST['tel']) || empty($_POST['correo']) || empty($_POST['direccion']) || $tipo=="Persona"){
        $alert="<p style='text-align:center; color:white; background-color: red;'>Llene todos los campos</p>";
    }else{      

      $consulta_numero=mysqli_query($conexion,"SELECT * FROM tbl_personas WHERE NumeroIdentidad ='$numero' ");
      $resultado_numero=mysqli_fetch_array($consulta_numero);
      $id='0000000000000';

      if($numero==$id){
        $alert="<p style='text-align:center; color:white; background-color: red;'>Ingrese un número de identidad correcto</p>";
      }else{
        if($resultado_numero>0){
          $alert="<p style='text-align:center; color:white; background-color: red;'>El número de Identidad ya existe</p>";
        }else{

           /*Obtengo el parametro*/
           $consult_persona="SELECT CodigoTipoPersona from tbl_tipopersona where TipoPersona = '$tipo'";
           $cod_persona = mysqli_query ($conexion,$consult_persona);
           $cod_tipo= mysqli_fetch_array ($cod_persona);
           $cod=$cod_tipo[0];

           //Ingresar en personas
           $a="INSERT INTO tbl_personas (CodigoTipoPersona, NombreCompleto, NumeroIdentidad) VALUES ('$cod','$nombre','$numero')";
           $InsPersona=mysqli_query($conexion,$a);

           /*Obtener el ultimo codigoPersona*/
           $ultimo_codigo=mysqli_insert_id($conexion);  

           //Ingresar en tabla contacto
           $telefono="INSERT INTO tbl_contacto (CodigoPersona, Telefono, Direccion, Correo) VALUES ('$ultimo_codigo','$tel','$direccion','$correo')";
           $InsTelefono=mysqli_query($conexion,$telefono);


          if($InsPersona AND $InsTelefono){
            //Llamada a la funcion bitacora
            $CodObjeto=38;
            $accion='Agregar';
            $descrip='Se agrego una nueva persona';
            bitacora($CodObjeto,$accion,$descrip);

            echo '<script>
            alert("Agregado exitosamente");
            window.location="tablapersonas.php";
            </script>';
          }else{
            $alert="<p style='text-align:center; color:white; background-color: red;'>Error al Ingresar persona</p>";
          }    

              
                }
            }
  
            
            //// 
          }
        }
 ///codigo que asocia el rol del usuario y asiga el permiso
 $usuariorol= $_SESSION['usuario'];//traer nombre del usuario que tiene la seccio
 $sql_consulta="SELECT CodigoRol, Usuario FROM tbl_usuario where  Usuario='$usuariorol'";
 $resultado_consulta=$conexion->query($sql_consulta);//guarda la consulta
 $row1=$resultado_consulta->fetch_assoc();//arreglo asociativo
 $rol=($row1['CodigoRol']);  

 //--------------------------------------------------PERMISO
 $permiso="SELECT CodigoPermiso, CodigoObjeto, CodigoRol, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion,Permiso_Consultar FROM tbl_permisos where CodigoObjeto ='$CodObjeto' AND CodigoRol=' $rol' ";
 $datos56 = mysqli_query ($conexion,$permiso);
 $fila56= mysqli_fetch_array ($datos56);
 error_reporting(0);//oculta el error cuando no se ha otrogado el permiso
 $codigopermiso=$fila56[0];
 $permiso_insertar=$fila56[3];
 $permiso_eliminar=$fila56[4];
 $permiso_actualizar=$fila56[5];
 $permiso_consultar=$fila56[6];
  //--------------------------------------------------PERMISO
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MVA | Software</title>
  <link rel="icon" type="image/png" href="dist/img/minuta.png">

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
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
    
</head>
<body class="hold-transition register-page">
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake"  src="dist/img/minuta.png" alt="AdminLTELogo" height="150" width="150">
  </div>
<?php  if($permiso_consultar==1){?> <!--ocultat permiso de ocultar ------------------------------------------------------------->

<div class="register-box">



           <?php  if($permiso_actualizar==1){?><!--ejemplo de quitar el permiso de actualizar ------------------------------------------------------------->
            
             <?php } ?>


             <?php  if($permiso_eliminar==1){?><!-- ejemplo quitar permiso de eliminar------------------------------------------------------------->
             
             <?php } ?>
             </div>
            </form>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
    <p style="text-align:center; font-size:18px; font-style:cursives;" >Registra una persona</p>
    </div>
   
          
    <div class="card-body">
      
      <form  action="" method="post">
      <div class="mb-0" class="alert"><?php echo isset($alert) ? $alert : ''; ?> </div> 
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input onkeypress="comprobarEspacios(); return sololetras(event);" OnKeyUp="this.value=this.value.toUpperCase();" maxlength="50" minlength="10"  value="<?php if(isset($nombre)) echo $nombre  ?>" type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre completo" >
          
        </div>
      

        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input onkeypress="return solonumeros(event);" pattern=".{13,13}" maxlength="13" value="<?php if(isset($numero)) echo $numero ?>" type="text" name="numero" class="form-control" placeholder="Numero Identidad" pattern="[0-9]+">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user" ></span>
            </div>
          </div>
          <input onkeypress="return solonumeros(event);" pattern=".{8,8}" maxlength="8" value="<?php if(isset($tel)) echo $tel ?>" type="text" name="tel" class="form-control" placeholder="Numero de Telefono/Celular" pattern="[0-9]+">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input maxlength="35" value="<?php if(isset($correo)) echo $correo ?>" type="email" name="correo" class="form-control" placeholder="Correo electronico">
        </div>

        

        <div>
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-map-marker"></span>
            </div>
          </div>
          <textarea onkeypress="comprobarEspacios();" OnKeyUp="this.value=this.value.toUpperCase();" class="form-control" id="direc" name="direccion" rows="1" placeholder="Direccion" <?php if(isset($direccion)) echo $direccion?> ></textarea>

        </div>
        </div>

        <div>
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <select id="persona" name="persona" class="form-control" autofocus>
                        <option selected>Persona</option>
                        <?php
                            while($tipo_persona=mysqli_fetch_array($persona))
                            {
                          ?>    
                        <option> <?php echo $tipo_persona['TipoPersona']?> </option>     
                          <?php 
                            }         
                          ?>   
                      </select>
        </div>
        </div>
        
        
       
          
          <!-- /.col -->
          <div class="form-group">
                    <div class="row">
                      <div class="col-md-8"> <?php  if($permiso_insertar==1){?><!-- Generar insetar------------------------------------------------------------->
                                     <button type="" id='btn_agregar' name='btn_agregar' type="" class="btn btn-primary btn-block md-3">Agregar</button>

             <?php } ?>
                      </div>
                      <div class="col-md-1">
                      </div>
                      <div class="col-md-2">
                        <a href="tablapersonas.php" class="btn btn-danger " role="button" aria-pressed="true">Salir</a>
                      </div>
                    </div>
                  </div> 
                  </div> 
          <!-- /.col -->
        </div>
        <?php } ?> <!--  finn ocultat permiso de ocultar ------------------------------------------------------------->
    <!-- /.content -->
    <?php  if($permiso_consultar==0){?> <!--si lo hay permiso de consultar  ------------------------------------------------------------->
     
      <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>¡Error!</strong> <strong>005</strong> Contacta con el administrador.
</div>

      <?php } ?> <!---------------------------  fin mensaje de oculto----------------------------------->
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
<script>
  /*Solo letras Nombre Completo*/
  
    function sololetras(e){
      
       key = e.KeyCode || e.which;
       tecla = String.fromCharCode(key).toString();
       letras = 'ABCDEFGHIJCLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú';

       especiales = [8,32];
       tecla_especial = false
       for(var i in especiales){
         if (key==especiales[i]){
           tecla_especial = true;
           break;
         } 
       }
       
       if (letras.indexOf(tecla) == -1 && !tecla_especial){ 
         return false;
       }
       
    }

    

    /*Solo letras Usuario*/
    function sololetrasUsuario(e){
      

       key = e.KeyCode || e.which;
       tecla = String.fromCharCode(key).toString();
       letras = "ABCDEFGHIJCLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";

       especiales = [8];
       tecla_especial = false
       for(var i in especiales){
         if (key==especiales[i]){
           tecla_especial = true;
           break;
         }
       }
       
       if (letras.indexOf(tecla) == -1 && !tecla_especial){
         return false;
       }

       
    }

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




    function comprobarEspacios() {
			
			let input = document.getElementById('nombre');

			let remplazar = input.value.replace(/(\s{1,})/g, ' ');

			input.value = remplazar;
		}
  
      function comprobarEspacios() {
			
			let input = document.getElementById('direc');

			let remplazar = input.value.replace(/(\s{1,})/g, ' ');

			input.value = remplazar;
		}
</script>
</body>
</html>




