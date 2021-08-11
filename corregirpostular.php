    
<?php 
    require "includes/funciones.php";
    $autenticado = estadoAutenticado();

    if(!$autenticado){
        header('Location: login.php');
    }
    //BASE DE DATOS
    require 'includes/config/database.php';
    $db = conectarDB();

    $codigo = $_SESSION['usuario'];
    //DATOS DEL ALUMNO
    $query = "SELECT * FROM alumnos WHERE codigo = '${codigo}'";
    $resultado = mysqli_query($db, $query);
    $datos_alumno = mysqli_fetch_assoc($resultado);

    //DATOS DE DISTRITO Y DIREECION
    $queryDP = "SELECT distritos.id as 'distritoId', provincias.id as 'provinciaId' FROM alumnos
    LEFT JOIN distritos ON distritos.id = alumnos.distritoId
    LEFT JOIN provincias ON provincias.id = distritos.provinciaId
    WHERE alumnos.id = '${datos_alumno['id']}'";
    $resultadoDP = mysqli_query($db, $queryDP);
    $datosDP = mysqli_fetch_assoc($resultadoDP);

    //ID DE LA ENCARGADA
    $id_encargada = "";
    $queryE = "SELECT encargadas.id FROM escuelas
    LEFT JOIN facultades ON facultades.id = escuelas.facultadId
    LEFT JOIN encargadas ON encargadas.id = facultades.encargadaId
    WHERE escuelas.id = '${datos_alumno['escuelaId']}';";

    $resultadoE = mysqli_query($db, $queryE);
    $id_encargada = mysqli_fetch_assoc($resultadoE);

    //CONSULTAR CON LAS PROVINCIAS
    $consulta = "SELECT * FROM provincias";
    $resultadoP = mysqli_query($db, $consulta);


 //ARREGLO CON MENSAJES DE ERRORES
 $errores = [];

 $dni = $datos_alumno['dni'];
 $email = $datos_alumno['email'];
 $celular = $datos_alumno['celular'];
 $direccion = $datos_alumno['direccion'];
 $provincia = $datosDP['provinciaId'];
 $distrito = $datosDP['distritoId'];

 //EJECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //ASIGANR FILES HACIA UNA VARIABLE
    $adni = $_FILES['adni'];
    $luz = $_FILES['luz'];
    $anexo = $_FILES['anexo'];

    $dni = mysqli_real_escape_string($db, $_POST['dni']);
    $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
    $celular = mysqli_real_escape_string($db, $_POST['celular']);
    $direccion = mysqli_real_escape_string($db, $_POST['direccion']);
    $provincia = mysqli_real_escape_string($db, $_POST['provincia']);
    $distrito = mysqli_real_escape_string($db, $_POST['distrito']);
    $fecha = date('Y/m/d');

    if(!$dni){
        $errores[] = "El DNI es obligatorio";
    }
    if(!$email){
        $errores[] = "El email es obligatorio o no es válido";
    }
    if(!$celular){
        $errores[] = "El celular es obligatorio";
    }
    if(!$direccion){
        $errores[] = "La dirección es obligatoria";
    }
    if(!$provincia){
        $errores[] = "La provincia es obligatoria";
    }
    if(!$distrito){
        $errores[] = "El distrito es obligatorio";
    }

    // if(!$adni['name'] || $adni['error']){
    //     $errores[] = "Adjunte el DNI y del apoderado";
    // }
    // if(!$luz['name'] || $luz['error']){
    //     $errores[] = "Adjunte el recibo de Luz";
    // }
    //VALIDAR POR TAMAÑO (1000KB MAXIMO)
    $medida = 1000 * 2000;
    if($adni['size'] > $medida){
        $errores[] = "El pdf DNI es muy pesada, maximo 2MB";
    }
    if($luz['size'] > $medida){
        $errores[] = "El pdf recibo de  Luz es muy pesada, maximo 2MB";
    }
    if($anexo['size'] > $medida){
        $errores[] = "El pdf anexo es muy pesada, maximo 2MB";
    }

    
    //ELIMINAR PDF PREVIO
    $anexoSINO = "No";
    $nombrePdf1 = "";
    $nombrePdf2 = "";
    $nombrePdf3 = "";
    if(empty($errores)){
        //SUBIDA DE ARCHIVOS
        $carpetaPdf = "pdf/";

        if(!is_dir($carpetaPdf)){
            mkdir($carpetaPdf);
        }
        if($adni['name']){
            unlink($carpetaPdf . $datos_alumno['pdfdni']);
            //GENERAR NOMBRE UNICO
            $nombrePdf1 = md5(uniqid(rand(),true)) . ".pdf";
            //SUBIR IMAGEN
            move_uploaded_file($adni['tmp_name'], $carpetaPdf . $nombrePdf1);
        }else{
            $nombrePdf1 = $datos_alumno['pdfdni'];
        }
        if($luz['name']){
            unlink($carpetaPdf . $datos_alumno['pdfluz']);
            //GENERAR NOMBRE UNICO
            $nombrePdf2 = md5(uniqid(rand(),true)) . ".pdf";
            //SUBIR IMAGEN
            move_uploaded_file($luz['tmp_name'], $carpetaPdf . $nombrePdf2);
        }else{
            $nombrePdf2 = $datos_alumno['pdfluz'];
        }        

        if($anexo['size'] > 0){
            if($anexo['name']){
                unlink($carpetaPdf . $datos_alumno['pdfanexos']);
                //GENERAR NOMBRE UNICO
                $nombrePdf3 = md5(uniqid(rand(),true)) . ".pdf";
                //SUBIR IMAGEN
                move_uploaded_file($anexo['tmp_name'], $carpetaPdf . $nombrePdf3);
                //EXISTE ANEXO 
                $anexoSINO = "Si";
            }else{
                $nombrePdf3 = $datos_alumno['pdfanexos'];
            }   
        }

    
        //ACTUALIZAR BASE DE DATOS ALUMNO
        $query = "UPDATE alumnos SET 
        dni = '${dni}', 
        email = '${email}', 
        celular = '${celular}', 
        direccion = '${direccion}',
        pdfdni = '${nombrePdf1}',
        pdfluz = '${nombrePdf2}',
        pdfanexos = '${nombrePdf3}',
        distritoId = '${distrito}'
        WHERE codigo = '${codigo}'";

        //SUBIR A LA BASE DE DATOS DEL ALUMNO
        $resultado = mysqli_query($db, $query);

        if($resultado){
            //CREAR LA BECA
            $query2 = "UPDATE becas SET estadoId = 3 WHERE alumnoId = ${datos_alumno['id']}";
            $resultado2 = mysqli_query($db, $query2);

            if($resultado2){
                //REDIRECIONAR AL USUARIO   
                header('Location: verpostulacion.php?resultado=4');
            }  
        }    
        
    }
 }

include "includes/templates/header.php"; ?>
    <main class="main-postular contenedor-mensaje">
    <?php @include "includes/templates/mensaje.php" ?>
        <section class="seccionP">
            <div class="titulo bg-amarillo">
                <h2>Corregir Datos</h2>
            </div>
            <?php
            foreach($errores as $error){ ?>
                <div class="alerta">
                    <p><?php echo $error ?></p> 
                </div>
                <?php
            }
            ?>
            <form class="formularioP" method="POST" action="corregirpostular.php" enctype="multipart/form-data">                       
                    <fieldset>
                        <legend>Datos Personales</legend>

                        <label for="dni">DNI <span>*</span></label>
                        <input class="input" type="number" name="dni" placeholder="ingrese su dni" id="dni"  value="<?php echo $dni; ?>">

                        <label for="email">Email <span>*</span></label>
                        <input class="input" type="email" name="email" placeholder="su Email" id="email" value="<?php echo $email; ?>">

                        <label for="celular">Celular <span>*</span></label>
                        <input class="input" type="number" name="celular" placeholder="ingrese su celular" id="celular" value="<?php echo $celular; ?>">

                        <label for="direccion">Dirección Actual <span>*</span></label>
                        <input class="input" type="text" id="direccion" name="direccion"  placeholder="su dirección actual" value="<?php echo $direccion; ?>">

                        <label for="">Provincia <span>*</span></label>
                        <select id="provincia" name="provincia">
                            <option value="">-- Seleccione --</option>
                            <?php while($row = mysqli_fetch_assoc($resultadoP)) : ?>
                                <option <?php echo $provincia == $row['id'] ? 'selected' : ''; ?> value=" <?php echo $row['id'] ?>"><?php echo $row['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>

                        
                        
                        
                        <label for="">Distrito <span>*</span></label>
                        <select id="distrito" name="distrito">
                            <option value="">-- Seleccione --</option>
                            <?php if($provincia) : ?>
                                <?php 
                                $consulta2 = "SELECT * FROM distritos WHERE provinciaId = ".$provincia."";
                                $resultadoD = mysqli_query($db, $consulta2);
                                while ($row2 = mysqli_fetch_assoc($resultadoD)) : ?>                
                                    <option <?php echo $distrito == $row2['id'] ? 'selected' : ''; ?> value="<?php echo $row2['id'] ?>"> <?php echo $row2['nombre']; ?></option>
                                <?php endwhile?>
                            <?php endif; ?>
                        </select>
                    </fieldset>

                    <fieldset>
                        <legend>Documentos Adjuntos <span>(Re-subir SOLO los documentos a corregir en formato PDF, máximo 2MB c/u)</span></legend>

                        <label for="adni">Adjunte su DNI y del Apoderado en 1 pdf <span>*</span></label>
                        <input class="subirfile" type="file" id="adni" accept="application/pdf" name="adni">
                        <!-- <div class="verpdf"><p>Ver pdf</p></div> -->

                        <label for="luz">Adjunte Recibo de Luz en pdf <span>*</span></label>
                        <input class="subirfile" type="file" id="luz" accept="application/pdf" name="luz">

                        <label for="anexo">Adjunte Anexos en 1 solo archivo </label>
                        <input class="subirfile" type="file" id="anexo" accept="application/pdf" name="anexo">
                    </fieldset>

                    <p><span>*</span> Campos obligatorios</p>

                    <input type="submit" value="Enviar Corrección" class="botonE bg-verde">

                </form>
        </section>
    </main>
    <!-- <div class="contenedor-pdf">
        <h2>Visualizador PDF</h2>
        <object class="pdf" data="pdf/ejemplo.pdf" type="application/pdf"></object>
    </div> -->
<?php include "includes/templates/popup.php"; ?>     
<?php include "includes/templates/footer.php"; ?> 

