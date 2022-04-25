<?php 

$server="localhost";
$user="root";
$pass="";
$database="minutasv";

$conexion = mysqli_connect($server,$user,$pass,$database);

if(!$conexion){
    die("ERR-001 Conexión fallida");
}

?>