<?php
    require "includes/config/database.php";
    $db = conectarDB();

    //CREAR UN EMAIL Y PASSWORD
    $codigo = "123456789";
    $password = "1234";

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //var_dump($passwordHash);

    //QUERY PARA CREAR AL USUARIO
    $query = "INSERT INTO usuarios (codigo, password) VALUES ('${codigo}','${passwordHash}')";

    //AGREGAR A LA BASE DE DATOS
    mysqli_query($db, $query);