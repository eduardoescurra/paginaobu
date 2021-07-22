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
        <form class="formulario" method="POST" action="loginAdmi.php">
            <img class="imagen-obu" src="build/img/logoobu.png" alt="imagen logo obu">
            <p class="usuario">Administrador</p>
            <img class="imagen-login" src="build/img/login.png" alt="imagen login">
            
            <fieldset>
                
                <!-- <label for="usuario">Usuario</label> -->
                <input type="number" name="usuario" placeholder="usuario" id="usuario">

                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" placeholder="contraseña" id="password">
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class=" boton boton-verde">
        </form> 
              
    </main>
    
</body>
</html>