    
<?php 
    require "includes/funciones.php";
    $autenticado = esAdmi(); 

    if(!$autenticado){
        header('Location: loginAdmi.php');
    }

    include "includes/config/database.php";
    $db = conectarDB();

    $query = "SELECT becas.id, alumnos.apellido, alumnos.nombre, facultades.nombre as 'facultad', escuelas.nombre as 'escuela', ciclos.nombre as 'ciclo', becas.fecha, becas.anexo, estados.nombre as 'estado' FROM becas
    LEFT JOIN alumnos ON alumnos.id = becas.alumnoId
    LEFT JOIN escuelas ON escuelas.id = alumnos.escuelaId
    LEFT JOIN facultades ON facultades.id = escuelas.facultadId
    LEFT JOIN ciclos ON ciclos.id = becas.cicloId
    LEFT JOIN estados ON estados.id = becas.estadoId";

    $resultadoConsulta = mysqli_query($db, $query);

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
    <main class="contenedor">
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
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
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
                        <td><p class="estado <?php 
                        if($beca['estado']=="CORRECCION"){
                            echo "rojo";
                        }elseif($beca['estado']=="REVISADO"){
                            echo "verde";
                        }elseif($beca['estado']=="REUNION"){
                            echo "azul";
                        }
                        ?>"><?php echo $beca['estado']; ?></p> </td>
                        <td>
                            <form  method="POST" class="w-100">
                                <input type="hidden" value="<?php echo $beca['id'];?>" name="id">
                                <input type="submit" value="Revisar" class="btn btn-revisar">
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
<?php include "includes/templates/popupAdmi.php"; ?>
<?php include "includes/templates/footer.php"; ?> 

