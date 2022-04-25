<?php

    error_reporting(0);

	include 'backup_function.php';

	if(isset($_POST['backupnow'])){
		
		$server = $_POST['server'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$dbname = $_POST['dbname'];
        $NombreRespaldo= $_POST['dbnombre'];
		
		backDb($server, $username, $password, $dbname, $NombreRespaldo );

		exit();
		
	}
	else{
		echo 'Agregar todos los campos obligatorios';
	}

?>