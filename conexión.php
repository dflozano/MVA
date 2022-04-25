<?php 

$server="localhost";
$user="root";
$pass="";
$database="prueba";

$conn = mysqli_connect($server,$user,$pass,$database);

if(!$conn){
    die("ERR-001 Conexión fallida");
}

?>