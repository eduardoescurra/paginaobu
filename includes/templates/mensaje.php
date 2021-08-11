<?php

    $codigo = $_SESSION['usuario'];
    $queryComentarios = "SELECT comentarios.mensaje, comentarios.link FROM alumnos 
    LEFT JOIN becas ON becas.alumnoId = alumnos.id
    LEFT JOIN comentarios ON comentarios.id = becas.comentarioId
    WHERE alumnos.codigo = '${codigo}'";
    $resultadoComentarios = mysqli_query($db, $queryComentarios);
    $datosComentarios = mysqli_fetch_assoc($resultadoComentarios);

?>


<div id="popup-mensaje" class="popup-mensaje">
    <p id="btn-cerrar-mensaje" class="btn-cerrar-mensaje">x</p>
    <h3>Mensaje</h3>
    <p class="texto"><?php echo $datosComentarios['mensaje']?></p>
    <h3>Link</h3>
    <a href="<?php echo $datosComentarios['link']?>" target="_blank"><?php echo $datosComentarios['link']?></a>
</div>