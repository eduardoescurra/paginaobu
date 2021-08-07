<?php
function estadoAutenticado():bool{
    session_start();
    $autenticado = $_SESSION['login'];
    if($autenticado){
        return true;
    }
    return false;
}
function esAdmi():bool{
    session_start();
    $autenticado = $_SESSION['login'];
    $esadmi = $_SESSION['admi'];
    if($autenticado && $esadmi){
        return true;
    }
    return false;
}

?>
