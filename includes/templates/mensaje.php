<?php

    $codigo = $_SESSION['usuario'];
    $queryComentarios = "SELECT comentarios.mensaje, comentarios.link, estados.id FROM alumnos 
    LEFT JOIN becas ON becas.alumnoId = alumnos.id
    LEFT JOIN estados ON estados.id = becas.estadoId
    LEFT JOIN comentarios ON comentarios.id = becas.comentarioId
    WHERE alumnos.codigo = '${codigo}'";
    $resultadoComentarios = mysqli_query($db, $queryComentarios);
    $datosComentarios = mysqli_fetch_assoc($resultadoComentarios);

?>

<!-- ELIMINAR REDUDANCIA DE MENSAJES MAS ADELANTE -->
<div id="popup-mensaje" class="popup-mensaje">
    <p id="btn-cerrar-mensaje" class="btn-cerrar-mensaje">x</p>
    <h3>Mensaje</h3>
    <?php if($datosComentarios['id']==2 ||$datosComentarios['id']==4) :?>
        <p class="texto"><?php echo $datosComentarios['mensaje']?></p>
    <?php else :?>
        <p class="texto">No tienes mensajes</p>
    <?php endif;?>
    <?php if($datosComentarios['id']==4) :?>
        <h3>Link</h3>
        <a href="<?php echo $datosComentarios['link']?>" target="_blank"><?php echo $datosComentarios['link']?></a>
    <?php endif;?>
    
</div>