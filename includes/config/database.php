<?php
 
function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'root', 'root', 'obu');
    $db -> set_charset("utf8");
    if(!$db){
        echo "Error no se pudo Conectar";
        exit;
    }

    return $db;
}