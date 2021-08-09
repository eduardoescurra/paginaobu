<?php 
    require "includes/funciones.php";
    $autenticado = esAdmi(); 

    if(!$autenticado){
        header('Location: loginAdmi.php');
    }

    //BASE DE DATOS
    require 'includes/config/database.php';
    $db = conectarDB();

    $id_beca = $_GET['id'] ?? null;

    //DATOS DE LA BECA
    $queryBeca = "SELECT becas.id, alumnos.apellido, alumnos.nombre, facultades.nombre as 'facultad', escuelas.nombre as 'escuela', ciclos.nombre as 'ciclo', becas.fecha, becas.anexo, estados.nombre as 'estado', alumnos.id as 'id_alumno' FROM becas
    LEFT JOIN alumnos ON alumnos.id = becas.alumnoId
    LEFT JOIN escuelas ON escuelas.id = alumnos.escuelaId
    LEFT JOIN facultades ON facultades.id = escuelas.facultadId
    LEFT JOIN ciclos ON ciclos.id = becas.cicloId
    LEFT JOIN estados ON estados.id = becas.estadoId
    WHERE becas.id = '${id_beca}'";
    
    $resultadoBeca = mysqli_query($db, $queryBeca);
    $datos_beca = mysqli_fetch_assoc($resultadoBeca);

    $queryPDF = "SELECT pdfdni, pdfluz, pdfanexos FROM alumnos
    WHERE id = '${datos_beca['id_alumno']}'";
    $resultadoPDF = mysqli_query($db, $queryPDF);
    $datosPDF = mysqli_fetch_assoc($resultadoPDF);


include "includes/templates/headerAdmi.php"; 
?>
    <main id="main" class="contenedor-revisar">
        <section class="seccion seccion-revisar">
            <div class="titulo bg-amarillo">
                <h2>Revisión</h2>
            </div>
            <div class="info">
                <div class="datos">
                    <h3 class="titulo">Beca Nº:</h3>
                    <p class="texto"><?php echo $datos_beca['id']; ?></p>
                </div>
                <div class="datos">
                    <h3 class="titulo">Apellidos:</h3>
                    <p class="texto"><?php echo $datos_beca['apellido']; ?></p>
                </div>
                <div class="datos">
                    <h3 class="titulo">Nombres:</h3>
                    <p class="texto"><?php echo $datos_beca['nombre']; ?></p>
                </div>
                <div class="datos">
                    <h3 class="titulo">Facultad:</h3>
                    <p class="texto"><?php echo $datos_beca['facultad']; ?></p>
                </div>
                <div class="datos">
                    <h3 class="titulo">Escuela:</h3>
                    <p class="texto"><?php echo $datos_beca['escuela']; ?></p>
                </div>
                <div class="datos">
                    <h3 class="titulo">Ciclo:</h3>
                    <p class="texto"><?php echo $datos_beca['ciclo']; ?></p>
                </div>
                <div class="datos">
                    <h3 class="titulo">Fecha:</h3>
                    <p class="texto"><?php echo $datos_beca['fecha']; ?></p>
                </div>
                <div class="datos">
                    <h3 class="titulo">Anexos:</h3>
                    <p class="texto"><?php echo $datos_beca['anexo']; ?></p>
                </div>
                <div class="datos">
                    <h3 class="titulo">Estado:</h3>
                    <p class="texto"><?php echo $datos_beca['estado']; ?></p>
                </div>
                <div class="datos">
                    <h3 class="titulo">DNI:</h3>
                    <button id="btn-pdf1" class="visualizar visualizarDNI" >Visualizar</button>
                </div>
                <div class="datos">
                    <h3 class="titulo">Recibo de Luz:</h3>
                    <button id="btn-pdf2" class="visualizar visualizarLuz" >Visualizar</button>
                </div>
                <div class="datos">
                    <h3 class="titulo">Anexos:</h3>
                    <button id="btn-pdf3" class="visualizar visualizarLuz" >Visualizar</button>
                </div>
            </div>
        </section>
    </main>

    <div id="overlay-pdf" class="overlay-pdf">
        <div id="contenedor-pdf" class="contenedor-pdf">
            <button id="btn-cerrar-pdf" class="btn-cerrar-pdf">x</button>
            <object class="view-pdf" data="pdf/<?php echo $datosPDF['pdfdni'] ?>" type="application/pdf">
                    <p>Parece que tu navegador no soporta PDF</p>
                    <a href="pdf/<?php echo $datosPDF['pdfdni'] ?>" download="PDF-DNI.pdf">Descargar PDF</a>
            </object>
        </div>
    </div>
    <div id="overlay-pdf2" class="overlay-pdf">
        <div id="contenedor-pdf2" class="contenedor-pdf">
            <button id="btn-cerrar-pdf2" class="btn-cerrar-pdf">x</button>
            <object class="view-pdf" data="pdf/<?php echo $datosPDF['pdfluz'] ?>" type="application/pdf">
                    <p>Parece que tu navegador no soporta PDF</p>
                    <a href="pdf/<?php echo $datosPDF['pdfluz'] ?>" download="PDF-RECIBO-LUZ.pdf">Descargar PDF</a>
            </object>
        </div>
    </div>

    <?php if($datos_beca['anexo'] == 'Si') : ?>
    <div id="overlay-pdf3" class="overlay-pdf">
        <div id="contenedor-pdf3" class="contenedor-pdf">
            <button id="btn-cerrar-pdf3" class="btn-cerrar-pdf">x</button>
            <object class="view-pdf" data="pdf/<?php echo $datosPDF['pdfanexos'] ?>" type="application/pdf">
                    <p>Parece que tu navegador no soporta PDF</p>
                    <a href="pdf/<?php echo $datosPDF['pdfanexos'] ?>" download="PDF-ANEXOS.pdf">Descargar PDF</a>
            </object>
        </div>
    </div>
    <?php endif; ?>

    
<?php include "includes/templates/popupAdmi.php"; ?>
<?php include "includes/templates/footer.php"; ?> 