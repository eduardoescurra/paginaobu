<?php
function estadoAutenticado():bool{
    session_start();
    $autenticado = $_SESSION['login'];
    if($autenticado){
        return true;
    }
    return false;
}

