<?php   
    require "includes/funciones.php";
    $autenticado = esAdmi(); 

    if(!$autenticado){
        header('Location: loginAdmi.php');
    }

    //MUESTRA MENSAJE CONDICIONAL
    $resultadoP = $_GET['resultado'] ?? null;

    include "includes/config/database.php";
    $db = conectarDB();

    $query = "SELECT * FROM facultades";
    $resultado = mysqli_query($db, $query);

    $query2 = "SELECT * FROM ciclos WHERE id = 1";
    $resultado2 = mysqli_query($db, $query2);
    $datosCiclo = mysqli_fetch_assoc($resultado2);

    $cantidadTotal = $datosCiclo['totalbeca'];

    $errores = [];
    $sumatotal = 0;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        for($x = 1; $x<12;$x++){
            $sumatotal += $_POST[$x];
        }
        if($sumatotal>$_POST['totalbeca']){
            $errores[] = "Sobre pasa la cantidad de Becas Disponibles";
        }
        if(empty($errores)){
            if(isset($_POST['guardar'])){
                $cantidadTotal = mysqli_real_escape_string($db, $_POST['totalbeca']);
                $queryTotal = "UPDATE ciclos SET totalbeca = '${cantidadTotal}' WHERE id = 1";
                $resultadoTotal = mysqli_query($db, $queryTotal);
                if($resultadoTotal){
                    $i=1;
                    while($row = mysqli_fetch_assoc($resultado)){
                        
                        $queryfacu = "UPDATE facultades SET cantidadbeca = ${_POST[$i]}  WHERE id = $i";
                        $i++;
                        $resultadofacu = mysqli_query($db, $queryfacu);
                        if($resultadofacu){
                            header('Location: gestionbeca.php?resultado=1');
                        }
                    }
                }
            }
            if(isset($_POST['finalizar'])){
                //FINALIZAR LA CONVOCATORIA
                // echo "<pre>";
                // var_dump($_POST);
                // echo "</pre>";
                for($i=1;$i<=11;$i++){
                    if($_POST[$i] != 0){
                        $query = "SELECT becas.id as 'id', alumnos.nombre FROM becas
                        LEFT JOIN alumnos ON alumnos.id = becas.alumnoId
                        LEFT JOIN escuelas ON escuelas.id = alumnos.escuelaId
                        LEFT JOIN facultades ON facultades.id = escuelas.facultadId
                        WHERE facultades.id = ${i}
                        ORDER BY puntaje DESC LIMIT ${_POST[$i]}";
                        // echo "<pre>";
                        // var_dump($query);
                        // echo "</pre>";
                        $resultadoBecas = mysqli_query($db, $query);
                        while($becados = mysqli_fetch_assoc($resultadoBecas)){
                            // echo "<pre>";
                            // var_dump($becados['id'] . " " . $becados['nombre'] );
                            // echo "</pre>";
                            $queryEstado = "UPDATE becas
                            SET estadoId = 6
                            WHERE id = ${becados['id']}";
                            // echo "<pre>";
                            // var_dump($queryEstado);
                            // echo "</pre>";
                            $resultadoEstado = mysqli_query($db, $queryEstado);
                            if(!$resultadoEstado){
                                echo "No se pudo actualizar el estado";
                            }
                        }
                    }
                }
                //CERRAR CONVOCATORIA
                $queryCerrar = "UPDATE ciclos SET convocatoria = 'no' WHERE id = 1";
                $resultadoCerrar = mysqli_query($db, $queryCerrar);
                if($resultadoCerrar){
                    header('Location: versolicitudes.php?resultado=3');
                }
            }
            if(isset($_POST['iniciar'])){
                //INICIAR CONVOCATORIA
                $queryIniciar = "UPDATE ciclos SET convocatoria = 'si' WHERE id = 1";
                $resultadoIniciar = mysqli_query($db, $queryIniciar);
                if($resultadoIniciar){
                    //HACER CAMBIOS
                    $queryNueva = "UPDATE alumnos SET puntajeAnexo = 0, postulado = 'no'";
                    $resultadoNueva = mysqli_query($db, $queryNueva);
                    if($resultadoNueva){
                        $queryDelete = "DELETE FROM becas";
                        $resultadoDelete = mysqli_query($db, $queryDelete);
                        if($resultadoDelete){
                            header('Location: gestionbeca.php?resultado=2');
                        }
                    }
                }
            }
        }
    }
    


include "includes/templates/headerAdmi.php"; 
?>
    <main class="contenedor contenedor-gestion">
        <div class="principal">
            <section class="seccion">
                <div class="titulo bg-rojo">
                    <h2>Gestión de Becas</h2>
                </div>
                <div class="info">
                    <?php
                    foreach($errores as $error){ ?>
                        <div class="alerta">
                            <p><?php echo $error ?></p> 
                        </div>
                        <?php
                    }
                    ?>
                    <form class="form-gestionbeca" action="gestionbeca.php" method="POST">
                        <fieldset>
                            <div class="cantidad-total">
                                <label for="cantidadtotal">Cantidad Total de Becas Disponibles: </label>
                                <input id="cantidadtotal" type="number" placeholder="cantidad total de becas" name="totalbeca" value="<?php echo $cantidadTotal ?>">
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Cantidad de Becas por Facultad</legend>
                            <div class="cantidad-facultades">
                                <?php 
                                $query = "SELECT * FROM facultades";
                                $resultado = mysqli_query($db, $query);
                                while($datosResultado = mysqli_fetch_assoc($resultado)) : ?>
                                <?php 
                                $queryPostulantes = "SELECT COUNT(*) as 'cantidad' FROM becas
                                LEFT JOIN alumnos ON alumnos.id = becas.alumnoId
                                LEFT JOIN escuelas ON escuelas.id = alumnos.escuelaId
                                LEFT JOIN facultades ON facultades.id = escuelas.facultadId
                                WHERE facultades.id = ${datosResultado['id']}";
                                $resultadoPostulantes = mysqli_query($db, $queryPostulantes);
                                $datosPostulante = mysqli_fetch_assoc($resultadoPostulantes);
                                ?>
                                    <div class="facultad">
                                        <label class="label" for="<?php echo $datosResultado['id'] ?>"><?php echo $datosResultado['nombre'] ?></label>
                                        <input class="input" id="<?php echo $datosResultado['id'] ?>" name="<?php echo $datosResultado['id'] ?>" type="number" placeholder="cantidad de becas en <?php echo $datosResultado['nombre']?> " value="<?php echo $datosResultado['cantidadbeca'] ?>">
                                        <label class="label">Nº Postulados</label>
                                        <input class="input" type="number" value="<?php echo $datosPostulante['cantidad'] ?>" disabled>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </fieldset>
                        <div class="submits <?php if($datosCiclo['convocatoria'] == 'no'){ echo "iniciar" ;} ?>">
                            <?php if($datosCiclo['convocatoria'] == 'si') : ?>
                                <input class="btn-becas bg-verde" type="submit" value="Guardar Datos" name="guardar">
                                <input class="btn-becas bg-rojo" type="submit" value="Finalizar Convocatoria" name="finalizar">
                            <?php else : ?>
                                <input class="btn-becas bg-amarillo" type="submit" value="Iniciar Convocatoria" name="iniciar">
                            <?php endif; ?>
                        </div>
                    </form>

                </div>
            </section>
        </div>
    </main>
    <?php if($resultadoP == 1) : ?>
        <script type="text/javascript">
        Swal.fire(
        "!Éxito!",
        "Datos Guardados",
        "success"
        );</script>
    <?php endif; ?>    
    <?php if($resultadoP == 2) : ?>
        <script type="text/javascript">
        Swal.fire(
        "!Éxito!",
        "Convocatoria Iniciada",
        "success"
        );</script>
    <?php endif; ?> 
<?php include "includes/templates/popupAdmi.php"; ?>
<?php include "includes/templates/footer.php"; ?> 

