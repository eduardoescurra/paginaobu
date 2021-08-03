    
<?php 
    //BASE DE DATOS
    require 'includes/config/database.php';
    $db = conectarDB();

    //CONSULTAR CON LAS PROVINCIAS
    $consulta = "SELECT * FROM provincias";
    $consulta2 = "SELECT * FROM distritos";
    $resultadoP = mysqli_query($db, $consulta);
    $resultadoD = mysqli_query($db, $consulta2);

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

 //ARREGLO CON MENSAJES DE ERRORES
 $errores = [];

 $dni = "";
 $email = "";
 $celular = "";
 $direccion = "";
 $provincia = "";
 $distrito = "";

 //EJECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //ASIGANR FILES HACIA UNA VARIABLE
    $adni = $_FILES['adni'];
    $luz = $_FILES['luz'];
    $anexo = $_FILES['anexo'];

    $dni = mysqli_real_escape_string($db, $_POST['dni']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $celular = mysqli_real_escape_string($db, $_POST['celular']);
    $direccion = mysqli_real_escape_string($db, $_POST['direccion']);
    $provincia = mysqli_real_escape_string($db, $_POST['provincia']);
    $distrito = mysqli_real_escape_string($db, $_POST['distrito']);

    if(!$dni){
        $errores[] = "El DNI el obligatorio";
    }
    if(!$email){
        $errores[] = "El email el obligatorio";
    }
    if(!$celular){
        $errores[] = "El celular el obligatorio";
    }
    if(!$direccion){
        $errores[] = "La dirección el obligatoria";
    }
    if(!$provincia){
        $errores[] = "La provincia el obligatoria";
    }
    if(!$distrito){
        $errores[] = "El distrito el obligatorio";
    }
 }

include "includes/templates/header.php"; ?>
    <main class="main-postular">
        <section class="seccionP">
            <div class="titulo bg-rojo">
                <h2>Postular</h2>
            </div>
            <?php
            foreach($errores as $error){ ?>
                <div class="alerta">
                    <p><?php echo $error ?></p> 
                </div>
                <?php
            }
             ?>
            <form class="formularioP" method="POST" action="postular.php" enctype="multipart/form-data">                       
                    <fieldset>
                        <legend>Datos Personales</legend>

                        <label for="dni">DNI</label>
                        <input class="input" type="number" name="dni" placeholder="ingrese su dni" id="dni"  value="<?php echo $dni; ?>">

                        <label for="email">Email</label>
                        <input class="input" type="email" name="email" placeholder="su Email" id="email" value="<?php echo $email; ?>">

                        <label for="celular">Celular</label>
                        <input class="input" type="number" name="celular" placeholder="ingrese su celular" id="celular" value="<?php echo $celular; ?>">

                        <label for="direccion">Dirección Actual</label>
                        <input class="input" type="text" id="direccion" name="direccion"  placeholder="su dirección actual" value="<?php echo $direccion; ?>">

                        <label for="">Provincia</label>
                        <select id="provincia" name="provincia">
                            <option value="">-- Seleccione --</option>
                            <?php while($row = mysqli_fetch_assoc($resultadoP)) : ?>
                                <option <?php echo $provincia == $row['id'] ? 'selected' : ''; ?> value=" <?php echo $row['id'] ?>"><?php echo $row['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>

                        
                        
                        
                        <label for="">Distrito</label>
                        <select id="distrito" name="distrito">
                            <option value="">-- Seleccione --</option>
                            <?php if($provincia) : ?>
                                <option value="">holaaa</option>
    
                                <!-- // while ($distrito = mysqli_fetch_assoc($resultado)) {                
                                //     $html .= '<option value="'.$distrito['id'].'">'.$distrito['nombre'].'</option>';
                                // }    -->
                            <?php endif; ?>
                        </select>
                    </fieldset>

                    <fieldset>
                        <legend>Documentos Adjuntos</legend>

                        <label for="adni">Adjunte DNI y del Apoderado </label>
                        <input class="subirfile" type="file" id="adni" accept="application/pdf" name="adni">
                        <!-- <div class="verpdf"><p>Ver pdf</p></div> -->

                        <label for="luz">Adjunte Recibo de Luz </label>
                        <input class="subirfile" type="file" id="luz" accept="application/pdf" name="luz">

                        <label for="anexo">Adjunte Anexos en 1 solo archivo </label>
                        <input class="subirfile" type="file" id="anexo" accept="application/pdf" name="anexo">
                    </fieldset>

                    <input type="submit" value="Enviar Postulación" class="botonE bg-verde">
                </form>
        </section>
    </main>
    <!-- <div class="contenedor-pdf">
        <h2>Visualizador PDF</h2>
        <object class="pdf" data="pdf/ejemplo.pdf" type="application/pdf"></object>
    </div> -->
<?php include "includes/templates/footer.php"; ?> 

