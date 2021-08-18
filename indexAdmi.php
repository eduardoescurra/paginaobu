    
<?php 
  require "includes/funciones.php";
  $autenticado = esAdmi(); 

  if(!$autenticado){
      header('Location: loginAdmi.php');
  }

    //BASE DE DATOS
    require 'includes/config/database.php';
    $db = conectarDB();

    $codigo = $_SESSION['usuario'];
    $query = "SELECT encargadas.nombre FROM encargadas
                LEFT JOIN usuarios ON usuarios.id = encargadas.usuarioId
                WHERE usuarios.codigo = '${codigo}'";
    $resultado = mysqli_query($db, $query);
    $datos_admi = mysqli_fetch_assoc($resultado);

include "includes/templates/headerAdmi.php"; 
?>
    <main class="contenedor main">
        <div class="principal r-gap">
            <section class="seccion">
                <div class="titulo bg-azul">
                    <h2>Bienvenido</h2>
                </div>
                <div class="info">
                    <h3 class="postulante"> !Hola <?php echo $datos_admi['nombre'] ?>!</h3>
                    <p>Te damos la bienvenida a nuestra página web donde  pondrás gestionar el trámite de la beca de alimentos.</p>
                    <p>En la pestañá Ver Postulaciones, podrás ver una tabla con todas las postulaciones realizadas, en la misma con un botón de Revisar podrá visualizar los documentos subidos como los datos del almuno, también podrá corregirlos emitiendo un mensaje hacia el alumno y si desea una reunión podrá realizarlo con el botón Reunión.</p>
                    <p>En la pestaña Gestión Beca, podrá establecer el Nº de Total de Becas Disponibles en la Universidad, como asi mismo hacerlo por cada Facultad. También, podrá ver el Nº Postulados por facultad. Según el cronograma podrá Finalizar la convocatoria (Proceso de selección de Becas), inmediatamente se mostrarán los resultados de los Postulantes Becados</p>
                    <p>Según el próximo cronograma, podrá Iniciar una convocatoria Nueva, donde se repetirán todos los pasos anteriores</p>
                    <h3>Facultades Encargadas: </h3>
                    <ul>
                        <li>Lic. Emma Solis Espinoza: FCC, FCE, FIPA, FIARN, FCNM- Martes 7 septiembre, 08:00 a 16:00 horas</li>
                        <li>Lic. Veronica Lazaro Lazaro: FIQ, FCA, FIIS, FIEE, FCS - Miercoles 8 septiembre, 08:00 a 16:00 horas</li>
                        <li>Lic. Natividad Cerrón Rengifo: FIME - Jueves 9 septiembre, 08:00 a 16:00 horas</li>
                        <li>Correcion de datos del postulante - Lunes 13 de Septiembre, 08:o0 a 16:00 horas</li>
                        <li>Resultados Finales - Viernes, 17 de Septiembre</li>
                    </ul>
                    <img class="oficina" src="build/img/OBU.webp" alt="imagen de obu">
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
    </main>
<?php include "includes/templates/popupAdmi.php"; ?> 
<?php include "includes/templates/footer.php"; ?> 

