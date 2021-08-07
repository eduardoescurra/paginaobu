<?php
    require "includes/config/database.php";
    $db = conectarDB();

    //CREAR UN EMAIL Y PASSWORD
    $codigo = "123456";
    $password = "123456";

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //var_dump($passwordHash);

    //QUERY PARA CREAR AL USUARIO
    //$query = "INSERT INTO usuarios (codigo, password) VALUES ('${codigo}','${passwordHash}')";
    $query = "UPDATE usuarios
    SET codigo = '${codigo}', password = '${passwordHash}'
    WHERE id = 10";

    //AGREGAR A LA BASE DE DATOS
    mysqli_query($db, $query);