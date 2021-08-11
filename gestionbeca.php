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
                                while($row = mysqli_fetch_assoc($resultado)) : ?>
                                    <div class="facultad">
                                        <label class="label" for="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></label>
                                        <input class="input" id="<?php echo $row['id'] ?>" name="<?php echo $row['id'] ?>" type="number" placeholder="cantidad de becas en <?php echo $row['nombre']?> " value="<?php echo $row['cantidadbeca'] ?>">
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </fieldset>
                        <div class="submits">
                            <input class="btn-becas bg-verde" type="submit" value="Guardar Datos" name="guardar">
                            <input class="btn-becas bg-naranja" type="submit" value="Finalizar Convocatoria" name="finalizar">
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
<?php include "includes/templates/popupAdmi.php"; ?>
<?php include "includes/templates/footer.php"; ?> 

