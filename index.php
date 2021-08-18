    
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

    <main class="contenedor main contenedor-mensaje">

        <?php @include "includes/templates/mensaje.php" ?>

        <div class="principal r-gap">
            <section class="seccion">
                <div class="titulo bg-azul">
                    <h2>Bienvenido</h2>
                </div>
                <div class="info">
                    <h3 class="postulante">!Hola <?php echo $datos_alumno['nombre'] ?>!</h3>
                    <p>Te damos la bienvenida a nuestra página web donde  pondrás realizar el trámite de solicitud de beca de alimentos de manera remota.</p>
                    <p>A continuación podrás encontrar el Cronograma y los Criterios de Evaluación (Parámetros) y realizar el correcto proceso de postulación dirigida hacia una beca de alimentos. </p>
                    <p>En la pestaña Postular, podrás subir tu datos personales y documentos necesarios para participar en el concurso.</p>
                    <p>En la pestaña Ver postulación podrás ver el estado de tu postulación (No revisado, En corrección, Corregido, Reunión, Revisado y Becado).</p>
                    <p>Y en la opción Mensajes, recibirás una notificación directa de la encargada de tu facultad.</p>
                    <img class="oficina" src="build/img/OBU.webp" alt="imagen de obu">
                    <p></p>
                    <h3>Funciones</h3>
                    <ol>
                        <li>Dirigir la ejecución de programas de alimentación y de la vivienda universitaria.</li>
                        <li>Evaluar las actividades propias de la Unidad y determina las medidas correctivas para el buen funcionamiento del mismo.</li>
                        <li>Supervisar y controlar la admisión y estadía de los estudiantes residentes y que estos cumplan con el Reglamento de la Residencia Universitaria.</li>
                        <li>Dirigir y coordinar la formulación de documentos técnicos normativos para la correcta aplicación del sistema.</li>
                    </ol>
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
                    <p>El proceso de postulacion de Becas de Alimentos lo realizará el estudiante
                    con sus datos personales y se hará de acuerdo a las fechas asignadas a continuacion:</p>
                    <ul>
                        <li>Creacion de cuenta personal para cada postulante -  Lunes 6 de Septiembre, 08:o0 a 16:00 horas</li>
                    </ul>
                    <p>Ingreso de los datos del postulante:</p>
                    <ul>
                        <li>Lic. Emma Solis Espinoza: FCC, FCE, FIPA, FIARN, FCNM- Martes 7 septiembre, 08:00 a 16:00 horas</li>
                        <li>Lic. Veronica Lazaro Lazaro: FIQ, FCA, FIIS, FIEE, FCS - Miercoles 8 septiembre, 08:00 a 16:00 horas</li>
                        <li>Lic. Natividad Cerrón Rengifo: FIME - Jueves 9 septiembre, 08:00 a 16:00 horas</li>
                        <li>Correcion de datos del postulante - Lunes 13 de Septiembre, 08:o0 a 16:00 horas</li>
                        <li>Resultados Finales - Viernes, 17 de Septiembre</li>
                    </ul>
                </div>
            </section>
            <section class="seccion">
                <div class="titulo bg-rojo">
                    <h2>Parámetros</h2>
                </div>
                <div class="info">
                    <p>La Oficina de Bienestar Universitario tomará estos siguientes parametros:</p>
                    <ul>
                        <li>Promedio ponderado por ciclo</li>
                        <li>Residencia actual</li>
                        <li>Situacion economica</li>
                        <li>Promedio Ponderado: 20 puntos</li>
                        <li>Distancia de Residencia: 30 puntos</li>
                        <li>Anexos: 50 puntos</li>
                        <li>Promedio Ponderado: 20 puntos</li>
                        <li>Socieconomico, Acta de defuncion familiar por Covid, Discapacidad, Salud</li>
                    </ul>
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

