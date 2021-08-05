<?php
    //MUESTRA MENSAJE CONDICIONAL
    $resultado = $_GET['resultado'] ?? null;

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
                $usuario = mysqli_fetch_assoc($resultado);

                //revisar si el password es correcto
                $autenticado = password_verify($password, $usuario['password']);

                if($autenticado){
                    //el usuario esta autenticado ingresa al sistema
                    session_start();

                    //llenar de datos la sesion
                    $_SESSION['usuario'] = $usuario['codigo'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');
                }else{
                    $errores[] = "La contraseña es incorrecta";
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
    <title>Login</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    <main class="flex">
        <?php if($resultado == 1):?>
            <div class="mensaje exito">
                <p>Cuenta Creada Correctamente</p> 
            </div>
        <?php endif;?>
        <form class="formulario" method="POST" action="login.php">
            <img class="imagen-obu" src="build/img/logoobu.png" alt="imagen logo obu">
            <p class="usuario">Estudiante</p>
            <img class="imagen-login" src="build/img/login.png" alt="imagen login">
            
            <fieldset>
                
                <!-- <label for="usuario">Usuario</label> -->
                <input type="text" name="usuario" placeholder="usuario" id="usuario" value="<?php echo $usuario ?>">

                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" placeholder="contraseña" id="password">
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class=" boton boton-verde">
            <p>¿No estás registrado? <a href="signup.php">Crea una cuenta</a></p>
        </form> 
              
    </main>
    
</body>
</html>