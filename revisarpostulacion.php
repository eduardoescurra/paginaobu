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

    //DATOS DE LOS PUNTAJES
    $querypuntaje = "SELECT promedios.promedio, distritos.puntaje, alumnos.puntajeAnexo FROM alumnos
    LEFT JOIN promedios ON promedios.alumnoId = alumnos.id
    LEFT JOIN distritos ON distritos.id = alumnos.distritoId
    LEFT JOIN becas ON becas.alumnoId = alumnos.id
    WHERE becas.id = $id_beca";
    $resultadopuntaje = mysqli_query($db, $querypuntaje);
    $datosPuntaje = mysqli_fetch_assoc($resultadopuntaje);
    // echo "<pre>";
    // var_dump($datosPuntaje);
    // echo "</pre>";
    
    $resultadoBeca = mysqli_query($db, $queryBeca);
    $datos_beca = mysqli_fetch_assoc($resultadoBeca);
    if(!$datos_beca['id_alumno']){
        header('Location: versolicitudes.php');
    }
    
    $queryPDF = "SELECT pdfdni, pdfluz, pdfanexos FROM alumnos
    WHERE id = '${datos_beca['id_alumno']}'";
    $resultadoPDF = mysqli_query($db, $queryPDF);
    $datosPDF = mysqli_fetch_assoc($resultadoPDF);

    $errores = [];
    $sumatotal = 0;
     //EJECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        if(isset($_POST['aprobar'])){
            if($_POST['puntajeanexo']>50 || $_POST['puntajeanexo']<0){
                $errores[] = "El puntaje del anexo es incorrecto";
            }else{
                $queryAnexo = "UPDATE alumnos SET puntajeAnexo = ${_POST['puntajeanexo']} WHERE id = ${datos_beca['id_alumno']}";
                $resultadoAnexo = mysqli_query($db, $queryAnexo);

                $sumatotal = floatval($datosPuntaje['promedio']) + floatval($datosPuntaje['puntaje']) + floatval($_POST['puntajeanexo']);
                //CAMBIAR ESTADO DE LA BECA A REVISADO
                $queryActualizar = "UPDATE becas SET estadoId = 5, puntaje = $sumatotal WHERE id = '${datos_beca['id']}'";
                $resultadoActualizar = mysqli_query($db, $queryActualizar);
                if($resultadoActualizar){
                    header('Location: versolicitudes.php?resultado=1');
                }
            }
        }
        if(isset($_POST['corregir'])){
            $mensaje = mysqli_real_escape_string($db, $_POST['mensajecorregir']); 

            if(!$mensaje){
                $errores[] = "Debe escribir un mensaje antes de enviar la corrección";
            }

            if(empty($errores)){
                $queryCorregir = "INSERT INTO comentarios (mensaje) VALUES ('${mensaje}')";
                $resultadoCorregir = mysqli_query($db, $queryCorregir);
    
                $queryId = "SELECT MAX(id) AS id FROM comentarios";
                $row = mysqli_query($db, $queryId);
                $resultadoId = mysqli_fetch_assoc($row);
                if($resultadoId){
                    $id_comentario = $resultadoId['id'];
                    if($resultadoCorregir){
                        $queryActualizar = "UPDATE becas SET estadoId = 2, comentarioId = '${id_comentario}' WHERE id = '${datos_beca['id']}'";
                        $resultadoActualizar = mysqli_query($db, $queryActualizar);
                        if($resultadoActualizar){
                            header('Location: versolicitudes.php?resultado=2');
                        }
                        
                    }
                }
            }   
        }
        if(isset($_POST['reunion'])){
            $mensaje = mysqli_real_escape_string($db, $_POST['mensajereunion']); 
            $link = mysqli_real_escape_string($db, $_POST['linkopcional']);

            if(!$mensaje){
                $errores[] = "Debe escribir un mensaje antes de enviar la corrección";
            }
            if(!$link){
                $errores[] = "Debe copiar el link de la reunión";
            }

            if(empty($errores)){
                $queryCorregir = "INSERT INTO comentarios (mensaje, link) VALUES ('${mensaje}','${link}')";
                $resultadoCorregir = mysqli_query($db, $queryCorregir);
    
                $queryId = "SELECT MAX(id) AS id FROM comentarios";
                $row = mysqli_query($db, $queryId);
                $resultadoId = mysqli_fetch_assoc($row);
                if($resultadoId){
                    $id_comentario = $resultadoId['id'];
                    if($resultadoCorregir){
                        $queryActualizar = "UPDATE becas SET estadoId = 4, comentarioId = '${id_comentario}' WHERE id = '${datos_beca['id']}'";
                        $resultadoActualizar = mysqli_query($db, $queryActualizar);
                        if($resultadoActualizar){
                            header('Location: versolicitudes.php?resultado=3');
                        }
                        
                    }
                }
            }   
        }
    }

include "includes/templates/headerAdmi.php"; 
?>
    <main id="main" class="contenedor-revisar">
        <section class="seccion seccion-revisar">
            <div class="titulo bg-rojo">
                <h2>Revisión</h2>
            </div>
            <a class="btn-regresar-revisar" href="versolicitudes.php">Regresar</a>
            <div class="info">
                <?php
                foreach($errores as $error){ ?>
                    <div class="alerta">
                        <p><?php echo $error ?></p> 
                    </div>
                    <?php
                }
                ?>
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
                <?php if($datos_beca['anexo'] == 'Si') : ?>
                    <div class="datos">
                        <h3 class="titulo">Anexos:</h3>
                        <button id="btn-pdf3" class="visualizar visualizarLuz" >Visualizar</button>
                    </div>
                <?php endif; ?>

                <!-- FORMULARIO CORRECCION -->
                <form class="revision-datos"  method="POST">
                    <?php if($datos_beca['anexo'] == 'Si') : ?>
                    <div class="puntaje">
                        <label for="puntajeanexo">Puntaje del Anexo:</label>
                        <input id="puntajeanexo" type="number" name="puntajeanexo" placeholder="0" value="<?php echo $datosPuntaje['puntajeAnexo'] ?>">
                    </div>
                    <?php endif; ?>
                    <div id="overlay-corregir" class="overlay-corregir">
                        <div id="popup-corregir" class="popup-corregir">
                            <p id="btn-cerrar-corregir" class="btn-cerrar-corregir">x</p>
                            <label class="mensajecorregir" for="mensajecorregir">Detalle los datos a corregir<span>*</span> </label>
                            <textarea id="text-corregir" class="text-corregir" name="mensajecorregir" id="mensajecorregir"></textarea>
                            <div class="botones-corregir">
                                <a id="btn-cancelar-corregir" class="btn-correccion bg-morado">Cancelar</a>
                                <input type="submit" class="btn-correccion bg-verde" value="Enviar Corrección" name="corregir">
                            </div>
                        </div>
                    </div>
                    <div id="overlay-reunion" class="overlay-corregir">
                        <div id="popup-reunion" class="popup-corregir">
                            <p id="btn-cerrar-reunion" class="btn-cerrar-corregir">x</p>
                            <label class="mensajecorregir" for="mensajereunion">Detalle los datos para la reunión<span>*</span> </label>
                            <textarea class="text-corregir" name="mensajereunion" id="mensajereunion"></textarea>
                            <label class="linkopcional" for="linkopcional">Link de reunión <span>Meet</span> (opcional)</label>
                            <input class="boton-opcional" type="text" name="linkopcional" id="linkopcional" placeholder="www.meet.google.com">
                            <div class="botones-corregir">
                                <a id="btn-cancelar-reunion" class="btn-correccion bg-morado">Cancelar</a>
                                <input type="submit" class="btn-correccion bg-verde" value="Enviar Reunión" name="reunion">
                            </div>
                        </div>
                    </div>

                    <div class="botones-revisar">
                        <input type="submit" class="btn-revisar-datos bg-verde" value="Aprobar" name="aprobar">
                        <a id="btn-abrir-corregir" class="btn-revisar-datos bg-amarillo btn-corregir">Corregir</a>
                        <a id="btn-abrir-reunion" class="btn-revisar-datos btn-reunion">Reunión</a>
                        <!-- <a id="btn-abrir-reunion" class="btn-revisar-datos bg-morado btn-reunion">Reunión</a> -->
                    </div>
                    

                </form>
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