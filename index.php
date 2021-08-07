    
<?php

    require "includes/funciones.php";
    $autenticado = estadoAutenticado(); 

    if(!$autenticado){
        header('Location: login.php');
    }

    //MUESTRA MENSAJE CONDICIONAL
    $resultadoP = $_GET['resultado'] ?? null;
    //BASE DE DATOS
    require 'includes/config/database.php';
    $db = conectarDB();

    $codigo = $_SESSION['usuario'];

    $query = "SELECT * FROM alumnos WHERE codigo = '${codigo}'";
    $resultado = mysqli_query($db, $query);
    $datos_alumno = mysqli_fetch_assoc($resultado);
    

include "includes/templates/header.php"; 
?>

    <main class="contenedor main">
        <div class="principal r-gap">
            <section class="seccion">
                <div class="titulo bg-azul">
                    <h2>Bienvenido</h2>
                </div>
                <div class="info">
                    <h3 class="postulante">!Hola <?php echo $datos_alumno['nombre'] ?>!</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                    <img class="oficina" src="build/img/OBU.webp" alt="imagen de obu">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                </div>
            </section>
            <section class="seccion">
                <div class="info postular">
                    <p>Si aún no realizas tu Postulación, haz click en: </p>
                    <a href="postular.php">Postular</a>
                </div>
            </section>
        </div>
        <div class="aside r-gap">
            <section class="seccion">
                <div class="titulo bg-rojo">
                    <h2>Cronograma</h2>
                </div>
                <div class="info">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                </div>
            </section>
            <section class="seccion">
                <div class="titulo bg-rojo">
                    <h2>Parámetros</h2>
                </div>
                <div class="info">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                </div>
            </section>
        </div>
    </main>
    <?php if($resultadoP == 1) : ?>
        <script type="text/javascript">
        Swal.fire(
        "!Éxito!",
        "Postulación Enviada",
        "success"
        );</script>
    <?php elseif($resultadoP == 2) : ?>
        <script type="text/javascript">
        Swal.fire(
        "!Oops!",
        "Parece que ya te postulaste",
        "error"
        );</script>
    <?php endif; ?>
<?php include "includes/templates/popup.php"; ?> 
<?php include "includes/templates/footer.php"; ?> 

