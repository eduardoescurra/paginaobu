    
<?php 
    require "includes/funciones.php";
    $autenticado = estadoAutenticado();

    

    if(!$autenticado){
        header('Location: login.php');
    }
    //MENSAJE CONDICIONAL
    $resultadoCorreccion = $_GET['resultado'] ?? null;

    //BASE DE DATOS
    require 'includes/config/database.php';
    $db = conectarDB();

    $codigo = $_SESSION['usuario'];

    //DATOS DEL ALUMNO
    $query = "SELECT * FROM alumnos WHERE codigo = '${codigo}'";
    $resultado = mysqli_query($db, $query);
    $datos_alumno = mysqli_fetch_assoc($resultado);

    //DATOS DE LA BECA
    $queryBeca = "SELECT becas.id, becas.fecha, becas.anexo, ciclos.nombre as 'ciclo', estados.nombre as 'estado' FROM ciclos
    LEFT JOIN becas ON becas.cicloId = ciclos.id
    LEFT JOIN estados ON becas.estadoId = estados.id
    WHERE alumnoId = '${datos_alumno['id']}'";
    $resultadoBeca = mysqli_query($db, $queryBeca);
    $datos_beca = mysqli_fetch_assoc($resultadoBeca);

    //DATOS DE  LA FACULTAD
    $queryFacu = "SELECT facultades.nombre as 'facultad', escuelas.nombre as 'escuela' FROM facultades
    LEFT JOIN escuelas ON escuelas.facultadId = facultades.id
    WHERE escuelas.id = '${datos_alumno['escuelaId']}'";
    $resultadoFacu = mysqli_query($db, $queryFacu);
    $datos_Facu = mysqli_fetch_assoc($resultadoFacu);


    // echo "<pre>";
    // var_dump($datos_Facu);
    // echo "</pre>";


include "includes/templates/header.php"; 
?>
    <main class="contenedor baseP contenedor-mensaje">
        <?php @include "includes/templates/mensaje.php" ?>
        <div class="principal r-ver">
            <?php if(!$datos_beca) : ?>
                <section class="seccion">
                    <div class="titulo bg-rojo">
                        <h2>Sin Postulación</h2>
                    </div>
                    <div class="info postular">
                        <p>Parece que aún no realizas tu Postulación, haz click en: </p>
                        <a href="postular.php">Postular</a>
                    </div>
                </section>
            <?php else : ?>

                <div class="contenedor-tabla">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Apellidos</th>
                                <th>Nombres</th>
                                <th>Facultad</th>
                                <th>Escuela</th>
                                <th>Calendario</th>
                                <th>Fecha</th>
                                <th>Anexos</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $datos_beca['id'] ?></td>
                                <td><?php echo $datos_alumno['apellido'] ?></td>
                                <td><?php echo $datos_alumno['nombre'] ?></td>
                                <td><?php echo $datos_Facu['facultad'] ?></td>
                                <td><?php echo $datos_Facu['escuela'] ?></td>
                                <td><?php echo $datos_beca['ciclo'] ?></td>
                                <td><?php echo $datos_beca['fecha'] ?></td>
                                <td><?php echo $datos_beca['anexo'] ?></td>
                                <td><p class="estado <?php
                                if($datos_beca['estado']=="EN CORRECCION"){
                                    echo "rojo";
                                }elseif($datos_beca['estado']=="REVISADO"){
                                    echo "verde";
                                }elseif($datos_beca['estado']=="REUNION"){
                                    echo "azul";
                                }elseif($datos_beca['estado']=="CORREGIDO"){
                                    echo "naranja";
                                }elseif($datos_beca['estado']=="BECADO"){
                                    echo "becado";
                                }
                                ?>"><?php echo $datos_beca['estado'] ?></p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            <?php endif;?>
        <?php @include "includes/templates/comentario.php" ?>    
        </div>
    </main>
    <?php if($resultadoCorreccion == 4) : ?>
        <script type="text/javascript">
        Swal.fire(
        "!Éxito!",
        "Postulación Corregida",
        "success"
        );</script>
    <?php endif; ?>

<?php include "includes/templates/popup.php"; ?>     
<?php include "includes/templates/footer.php"; ?> 

