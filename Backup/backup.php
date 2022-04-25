<?php

//Servidor y base de datos MySQL
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'minutasv';
$tables = '*';

//Llamar a la función principal
backup_tables($dbhost, $dbuser, $dbpass, $dbname, $tables);

//Función básica
function backup_tables($Host, $user, $pass, $dbname, $tables = '*') {
    $link = mysqli_connect($Host,$user,$pass, $dbname);

    // Verifica la conexión
    if (mysqli_connect_errno())
    {
        echo "No se pudo conectar a MySQL: " . mysqli_connect_error();
        exit;
    }

    mysqli_query($link, "SET NAMES 'utf8'");

    //traer todas las tablas
    if($tables == '*')
    {
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        while($row = mysqli_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return = '';
    //correr
    foreach($tables as $table)
    {
        $result = mysqli_query($link, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);

        $return.= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        $counter = 1;

        //Over tables
        for ($i = 0; $i < $num_fields; $i++) 
        {   //Over rows
            while($row = mysqli_fetch_row($result))
            {   
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                } else{
                    $return.= '(';
                }

                //Over fields
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }

                if($num_rows == $counter){
                    $return.= ");\n";
                } else{
                    $return.= "),\n";
                }
                ++$counter;
            }
        }
        $return.="\n\n\n";
    }

    //guardar el archivo
    $fileName = $dbname.'_'.date("Ymd_Hms").'_'.'.sql';
    $handle = fopen($fileName,'w+');
    fwrite($handle,$return);
    if(fclose($handle)){
        echo "<script> alert('Respaldo Guardado Exitosamente su nombre es $fileName ');
               Windows:location ='../vistas/administracion.php'
              </script> ";
        exit; 
    }
}

?>
