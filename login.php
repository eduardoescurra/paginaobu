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
        <form class="formulario" method="POST" action="login.php">
            <fieldset>
                <img class="imagen-login" src="build/img/login.png" alt="imagen login">
                <!-- <label for="usuario">Usuario</label> -->
                <input type="text" name="usuario" placeholder="usuario" id="usuario">

                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" placeholder="contraseña" id="password">
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class=" boton boton-verde">
            <p>¿No estás registrado? <a href="">Crea una cuenta</a></p>
        </form> 
              
    </main>
    
</body>
</html>