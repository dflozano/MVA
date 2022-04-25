<?php 
$destinatario = $Correo; 
$asunto = "Recuperación de contraseña "; 
$Codigo= rand(10000000,99999999);
$cuerpo = ' 
<html> 
<head> 
   <title>Nueva  contraseña </title> 
</head> 
<body> 
<h3>Nueva contraseña </h3>
<div style="text-align:center; background-color:#ccc"> 
<p> 
<b>'.$Codigo.'
</p> 
<p><a href="http://localhost/minutas_valle/public/bower_components/admin-lte/pages/examples/nueva_contrasena.php?Correo='.$Correo.'&Token='.$Token.'">
Para restablcer da click aqui  </a></P>
</div>
</body> 
</html> 
'; 


//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Minutas valle de ángeles <minutas@desarrolloweb.com>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
//$headers .= "Reply-To: mariano@desarrolloweb.com\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 

//direcciones que recibián copia 
//$headers .= "Cc: maria@desarrolloweb.com\r\n"; 

//direcciones que recibirán copia oculta 
//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 
$enviado=false;
if (mail($destinatario,$asunto,$cuerpo,$headers)){
    $enviado=true;
}

?>
