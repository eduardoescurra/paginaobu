<?php
    //MUESTRA MENSAJE CONDICIONAL
    $resultadoC = $_GET['resultado'] ?? null;

    require "includes/config/database.php";
    $db = conectarDB();

    //HAY CONVOCATORIA?
    $query2 = "SELECT * FROM ciclos WHERE id = 1";
    $resultado2 = mysqli_query($db, $query2);
    $datosCiclo = mysqli_fetch_assoc($resultado2);

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
                //VERIFICA LOS PERMISOS
                if($datos_usuario['rolId'] == 1){
                    if($autenticado){
                        //el usuario esta autenticado ingresa al sistema
                        session_start();

                        //llenar de datos la sesion
                        $_SESSION['usuario'] = $datos_usuario['codigo'];
                        $_SESSION['login'] = true;
                        $_SESSION['alumno'] = true;

                        if($datosCiclo['convocatoria'] == 'si'){
                            header('Location: index.php');
                        }
                        else{
                            $errores[] = "Por el momento no hay convocatoria";
                        }
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
    <title>Login</title>
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="assets/plugins/SweetAlert/dist/sweetalert2.min.css">
    <script src="assets/plugins/SweetAlert/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <main class="flex">
        <form class="formulario" method="POST" action="login.php">
            <img class="imagen-obu" src="build/img/logoobu.png" alt="imagen logo obu">
            <p class="usuario">Estudiante</p>
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
                <input type="text" name="usuario" placeholder="usuario" id="usuario" value="<?php echo $usuario ?>">

                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" placeholder="contraseña" id="password">
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class=" boton boton-verde">
            <p>¿No estás registrado? <a href="signup.php">Crea una cuenta</a></p>
        </form> 
              
    </main>
    <?php if($resultadoC == 1){
        ?>
        <script type="text/javascript">
        Swal.fire(
        "!Éxito!",
        "Cuenta Creada",
        "success"
        );</script>
        <?php
    } ?>
</body>
</html>