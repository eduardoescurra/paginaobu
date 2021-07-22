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
            
            <fieldset>
                
                <!-- <label for="usuario">Usuario</label> -->
                <input type="number" name="codigo" placeholder="codigo de estudiante" id="codigo">

                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" placeholder="nueva contraseña" id="password">
                <input type="password" name="cpassword" placeholder="confirmar contraseña" id="cpassword">
            </fieldset>
            <input type="submit" value="Crear Cuenta" class=" boton boton-verde">
        </form> 
              
    </main>
    
</body>
</html>