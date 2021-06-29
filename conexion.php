<?php

  
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'almacenkeka';
        
    $link = mysqli_connect($server,$user,$pass,$database);
        if(!$link){
            echo "Error en la conexion a la base de datos";
        }
    

?>
