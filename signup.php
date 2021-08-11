<?php
    require "includes/config/database.php";
    $db = conectarDB();

    //ARREGLO CON MENSAJES DE ERRORES
    $errores = [];

    $codigo = "";
    $password = "";
    $cpassword = "";

    //EJECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $codigo = mysqli_real_escape_string($db, $_POST['codigo']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $cpassword = mysqli_real_escape_string($db, $_POST['cpassword']);

        if(!$codigo){
            $errores[] = "El código es obligatorio";
        }
        if(!$password){
            $errores[] = "La contraseña es obligatoria";
        }
        if(strlen($password)>20){
            $errores[] = "La contraseña es demasiada larga, máximo 20 caracteres";
        }
        if($password){
            if(!$cpassword){
                $errores[] = "Confirme la contraseña";
            }
        }
        
        if($password && $cpassword){
            if($password != $cpassword){
                $errores[] = "Las contraseñas no coinciden";
            }
        }

        if(empty($errores)){
            //REVISA SI PERTENECE A LA INSTITUCION
            $query = "SELECT * FROM alumnos WHERE codigo = '${codigo}'";
            $resultado = mysqli_query($db, $query);

            //REVISA SI YA EXISTE EL USUARIO
            $query2 = "SELECT * FROM usuarios where codigo = '${codigo}'";
            $resultado2 = mysqli_query($db, $query2);

            if($resultado2->num_rows){
                $errores[] = "El usuario ya está registrado";
            }else{
                if($resultado->num_rows){
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    //QUERY PARA CREAR AL USUARIO
                    $query = "INSERT INTO usuarios (codigo, password,rolId) VALUES ('${codigo}','${passwordHash}',1)";
                    //AGREGAR A LA BASE DE DATOS
                    mysqli_query($db, $query);

                    //ASIGNAR USUARIO
                    $query2 = "SELECT id FROM usuarios WHERE codigo = '${codigo}'";
                    $resultado = mysqli_query($db, $query2);

                    $id_usuario = mysqli_fetch_assoc($resultado);

                    // echo "<pre>";
                    // var_dump($id_usuario);
                    // echo "</pre>";

                    //QUERY PARA AGREGAR USUARIO AL ALUMNO
                    $query3 = "UPDATE alumnos SET usuarioId = '${id_usuario['id']}' WHERE codigo = '${codigo}'";

                    //AGREGAR A LA BASE DE DATOS
                    mysqli_query($db, $query3);
    
                    header('Location: login.php?resultado=1');
                }else{
                    $errores[] = "No pertenece a la institución";
                }
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
        <form class="formulario" method="POST" action="signup.php">
            <img class="imagen-obu" src="build/img/logoobu.png" alt="imagen logo obu">
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
                <input type="number" name="codigo" placeholder="codigo de estudiante" id="codigo" value="<?php echo $codigo ?>">

                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" placeholder="nueva contraseña" id="password" value="<?php echo $password ?>">
                <input type="password" name="cpassword" placeholder="confirmar contraseña" id="cpassword">
            </fieldset>
            <input type="submit" value="Crear Cuenta" class=" boton boton-verde">
        </form> 
              
    </main>
    
</body>
</html>