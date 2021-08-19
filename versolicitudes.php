    
<?php 
    require "includes/funciones.php";
    $autenticado = esAdmi(); 

    if(!$autenticado){
        header('Location: loginAdmi.php');
    }
    //MUESTRA MENSAJE CONDICIONAL
    $resultadoGestion = $_GET['resultado'] ?? null;

    include "includes/config/database.php";
    $db = conectarDB();

    $query = "SELECT becas.id, becas.puntaje, alumnos.apellido, alumnos.nombre, facultades.nombre as 'facultad', escuelas.nombre as 'escuela', ciclos.nombre as 'ciclo', becas.fecha, becas.anexo, estados.nombre as 'estado' FROM becas
    LEFT JOIN alumnos ON alumnos.id = becas.alumnoId
    LEFT JOIN escuelas ON escuelas.id = alumnos.escuelaId
    LEFT JOIN facultades ON facultades.id = escuelas.facultadId
    LEFT JOIN ciclos ON ciclos.id = becas.cicloId
    LEFT JOIN estados ON estados.id = becas.estadoId";

    $resultadoConsulta = mysqli_query($db, $query);

    $queryCiclo = "SELECT * FROM ciclos WHERE id = 1";
    $resultadoCiclo = mysqli_query($db, $queryCiclo);
    $datosCiclo = mysqli_fetch_assoc($resultadoCiclo);

    //FACULTADES
    $queryFacu = "SELECT * FROM facultades";
    $resultadoFacu = mysqli_query($db, $queryFacu);

     //REVISAR EL POST
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if($id){
            header('Location: revisarpostulacion.php?id='.$id);
        }
    }

include "includes/templates/headerAdmi.php"; 
?>
    <main class="contenedor-gap">
        <div class="buscador">
            <div class="bus1">
                <p>Buscar por Id:</p>
                <input class="input-id" id="input-id" type="number">
            </div>
            <div class="bus1">
                <p>Buscar por Apellido:</p>
                <input class="input-id" id="input-apellido" type="text">
            </div>
            <div class="bus1">
                <p>Buscar por Facultad:</p>
                <select id="input-facultad" name="input-facultad" class="input-facultad">
                <option value="">-- Seleccione --</option>
                <?php while($rowFacu = mysqli_fetch_assoc($resultadoFacu)) : ?>
                    <option value="<?php echo $rowFacu['id'] ?>"><?php echo $rowFacu['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="bus1">
                <p>Buscar por Estado:</p>
                <input class="input-id" id="input-estado" type="text">
            </div>
            </div>
        <div class="contenedor-tabla">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Facultad</th>
                        <th>Escuela</th>
                        <th>Ciclo</th>
                        <th>Fecha</th>
                        <th>Anexos</th>
                        <th>Puntaje</th>
                        <th>Estado</th>
                        <?php if($datosCiclo['convocatoria'] == 'si') :?>
                            <th>Acción</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="contenido-tabla">
                    <?php while( $beca = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                    <tr> <!--//MOSTRAR LOS RESULTADOS-->
                        <td><?php echo $beca['id']; ?></td>
                        <td><?php echo $beca['apellido']; ?></td>
                        <td><?php echo $beca['nombre']; ?></td>
                        <td><?php echo $beca['facultad']; ?></td>
                        <td><?php echo $beca['escuela']; ?></td>
                        <td><?php echo $beca['ciclo']; ?></td>
                        <td><?php echo $beca['fecha']; ?></td>
                        <td><?php echo $beca['anexo']; ?></td>
                        <td><?php echo $beca['puntaje']; ?></td>
                        <td><p class="estado <?php 
                        if($beca['estado']=="EN CORRECCION"){
                            echo "rojo";
                        }elseif($beca['estado']=="REVISADO"){
                            echo "verde";
                        }elseif($beca['estado']=="REUNION"){
                            echo "azul";
                        }elseif($beca['estado']=="CORREGIDO"){
                            echo "naranja";
                        }elseif($beca['estado']=="BECADO"){
                            echo "becado";
                        }
                        ?>"><?php echo $beca['estado']; ?></p> </td>
                        <?php if($datosCiclo['convocatoria'] == 'si') :?>
                            <td>
                                <form  method="POST" class="w-100">
                                    <input type="hidden" value="<?php echo $beca['id'];?>" name="id">
                                    <input type="submit" value="Revisar" class="btn btn-revisar">
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php if($resultadoGestion == 3) : ?>
        <script type="text/javascript">
        Swal.fire(
        "!Éxito!",
        "Convocatoria Finalizada",
        "success"
        );</script>
    <?php endif; ?> 
<?php include "includes/templates/popupAdmi.php"; ?>
<?php include "includes/templates/footer.php"; ?> 

