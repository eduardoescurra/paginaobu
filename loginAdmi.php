<?php
    require "includes/config/database.php";
    $db = conectarDB();

    //AUTENTICAR EL USUARIO
    $errores = [];
    $usuario = "";
    $password = "";

    //EJECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usuario = mysqli_real_escape_string($db, $_POST['usuario']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$usuario){
            $errores[] = "El usuario es obligatorio";
        }
        if(!$password){
            $errores[] = "La contraseña es obligatoria";
        }

        if(empty($errores)){
            //revisar si el usuario existe
            $query = "SELECT * FROM usuarios where codigo = '${usuario}'";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows){
                //revisar si el password es correcto
                $datos_usuario = mysqli_fetch_assoc($resultado);

                //revisar si el password es correcto
                $autenticado = password_verify($password, $datos_usuario['password']);

                if($datos_usuario['rolId'] == 2){
                    if($autenticado){
                        //el usuario esta autenticado ingresa al sistema
                        session_start();

                        //llenar de datos la sesion
                        $_SESSION['usuario'] = $datos_usuario['codigo'];
                        $_SESSION['login'] = true;
                        $_SESSION['admi'] = true;

                        header('Location: indexAdmi.php');
                    }else{
                        $errores[] = "La contraseña es incorrecta";
                    }
                }else{
                    $errores[] = "No tiene permiso para acceder";
                }
            }else{
                $errores[] = "El usuario No Existe";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginAdmi</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    <main class="flex">
        <form class="formulario" method="POST" action="loginAdmi.php">
            <img class="imagen-obu" src="build/img/logoobu.png" alt="imagen logo obu">
            <p class="usuario">Administrador</p>
            <img class="imagen-login" src="build/img/login.png" alt="imagen login">

            <?php
            foreach($errores as $error){ ?>
                <div class="alerta">
                    <p><?php echo $error ?></p> 
                </div>
                <?php
            }
            ?>
            
            <fieldset>
                
                <!-- <label for="usuario">Usuario</label> -->
                <input type="text" name="usuario" placeholder="usuario" id="usuario">

                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" placeholder="contraseña" id="password">
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class=" boton boton-verde">
        </form> 
              
    </main>
    
</body>
</html>