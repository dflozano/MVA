
<?php
include 'conexión.php';
include 'funcionBitacora.php';
session_start();

/*BITACORA*/
$consulta="SELECT CodigoObjeto from tbl_objetos where Objeto = 'eventos_recibo1.php'";
$consulta1 = mysqli_query($conn,$consulta);
$valor= mysqli_fetch_array($consulta1);
$numero=$valor[0];
//Llamada a la funcion bitacora
$CodObjeto=$numero;
$accion='Impresión';
$descrip='Impreme el recibo de un pedido';
bitacora($CodObjeto,$accion,$descrip);

$cod=$_GET['NumeroEvento'];
    //VALORES
    $consulta="SELECT * from tbl_eventos where NumeroEvento = '$cod'";
    $consulta1 = mysqli_query($conn,$consulta);
    $valores= mysqli_fetch_array($consulta1);
    $estado1 = $valores['CodigoEstadoEvento'];

    $parametro1="SELECT Valor from tbl_parametros where Parametro = 'ADMIN_NOMBRE_REPORTE'";
$datos1 = mysqli_query ($conn,$parametro1);
$fila1= mysqli_fetch_array ($datos1);
$codigo_nombre_empresa=$fila1['Valor'];

$parametro2="SELECT Valor from tbl_parametros where Parametro = 'ADMIN_NUMTELEFONO_REPORTE'";
$datos2 = mysqli_query ($conn,$parametro2);
$fila2= mysqli_fetch_array ($datos2);
$codigo_telefono_empresa=$fila2['Valor'];


$parametro="SELECT e.NumeroEvento, e.FechaEvento, e.SubTotal, e.ISV, e.PrecioTotal, e.Transporte, p.NombreCompleto, u.NombreUsuario, es.Estado   from tbl_eventos as e 
inner join tbl_detalleevento as d on d.NumeroEvento = e.NumeroEvento
inner join tbl_personas as p ON p.CodigoPersona = e.CodigoPersona 
inner join tbl_usuario as u ON u.CodigoUsuario = e.CodigoUsuario
inner join tbl_estadoevento as es ON es.CodigoEstadoEvento = e.CodigoEstadoEvento
WHERE e.NumeroEvento = '$cod' ";
$datos = mysqli_query ($conn,$parametro);
$valores= mysqli_fetch_array ($datos);
$numero=$valores['NumeroEvento'];
$cliente=$valores['NombreCompleto'];
$usuario=$valores['NombreUsuario'];
$estado=$valores['Estado'];
$isv=$valores['ISV'];
$precioTotal=$valores['PrecioTotal'];
$fecha=$valores['FechaEvento'];
$transporte=$valores['Transporte'];
$sub=$valores['SubTotal'];



$NumOfDecimals=2;
$decimalIndicator='.';
$thousandSeparator=',';
$subTotal= number_format($sub, $NumOfDecimals, $decimalIndicator, $thousandSeparator);

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../vistas/style.css">    <!----------------- diseno css"> --------------------------->
        <script src="script.js"> </script>
       <script src="plugins/jquery/jquery.min.js"></script>
    </head>
    <body>
        <div class="ticket">
        <!--    <img src="../dist/img/minuta.png" alt="Logotipo"> -->
            <p class="centrado"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $codigo_nombre_empresa; ?>  
                <br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Teléfono <?php echo $codigo_telefono_empresa; ?>
                <br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Cotización
                <br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp _____________________________
                <small></small>
                <br></p>
                 <small >Numero de pedido:</small> &nbsp; <small><?php echo $numero?></small>
                 <br>
                <small >Cliente:</small> &nbsp; <small> <?php echo $cliente?></small>
                <br>
                <small >Estado:</small> &nbsp; <small> <?php echo $estado?></small>
                <br>
                <small >Vendedor:</small> &nbsp; <small> <?php echo $usuario?></small>
                <br/>
                <small >Fecha del Evento:</small> &nbsp; <small><?php echo $fecha ?> </small>
                <pre></pre>
                
            <table>
                <thead>
                   <small>---------------------------------------------------------------------------------------------</small>
   
    <div class="row">
    <div class="col-xs-12">
        <table class="table table-condensed table-bordered table-striped">
            <thead>
            <tr>
     
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Precio Total</th>
             
            </tr>
            </thead>
            <tbody>
    
            
            <?php 
                  $consulta_tabla="SELECT CantidadPersonas, Descripcion, Precio, PrecioTotal FROM tbl_detalleevento WHERE NumeroEvento = '$cod'" ;                            
                  $resultado_tablas=mysqli_query($conn,$consulta_tabla);
                  while($row=mysqli_fetch_array($resultado_tablas)){ 
                  ?>
                  <tr>
                    <td><?php echo $row['CantidadPersonas'] ?></td>
                    <td><center><?php echo $row['Descripcion'] ?></center></td>
                    <td><center><?php echo $row['Precio'] ?></center></td>
                    <td><center><?php echo $row['PrecioTotal'] ?></center></td>
                    </tr>
                    <?php } ?>
           
            </tbody>           
            <tfoot>
            <tr>
                
            <th>
           </th>
           <td>
           </td>
           </tr>
           <tr>
                <th colspan="3" class="text-center" class="text-letf">TOTAL DEL PAQUETE</th>
                <?php 
                  $consulta_tabla1="SELECT sum(preciototal) as PrecioTotal FROM tbl_detalleevento WHERE NumeroEvento = '$cod'" ;                            
                  $resultado_tablas1=mysqli_query($conn,$consulta_tabla1);
                  while($row1=mysqli_fetch_array($resultado_tablas1)){ 
                  ?>
                <td colspan="4"><center><?php echo $row1['PrecioTotal'] ?></center></td>
                <?php } ?>

            </tr>
            <tr>
                <th colspan="3" class="text-center" class="text-letf">TRANSPORTE</th>
                <td colspan="4"><center><?php echo $transporte?></center></td>
            </tr>
            <tr>
                <th colspan="3" class="text-center" class="text-letf">SUB TOTAL</th>
                <td colspan="4" ><center><?php echo $subTotal?></center></td>
            </tr>
            <tr>
                <th colspan="3" class="text-center" class="text-letf">IVS</th>
                <td colspan="4"><center><?php echo $isv?></center></td>
            </tr>
            <tr>
                <th colspan="3" class="text-center" class="text-right"><h4>TOTAL</h4></th>
                <td colspan="4"><h4><center> <?php echo $precioTotal?></center></h4></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
    
</html>

<script>

window.print();

</script>

    