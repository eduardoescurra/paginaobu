<?php 
    $codigo = $_SESSION['usuario'];
    $queryComentarios = "SELECT comentarios.mensaje, comentarios.link FROM alumnos 
    LEFT JOIN becas ON becas.alumnoId = alumnos.id
    LEFT JOIN comentarios ON comentarios.id = becas.comentarioId
    WHERE alumnos.codigo = '${codigo}'";
    $resultadoComentarios = mysqli_query($db, $queryComentarios);
    $datosComentarios = mysqli_fetch_assoc($resultadoComentarios);

    if($datosComentarios['mensaje']) : ?>
        <section class="seccion">
            <div class="titulo bg-azul">
                <h2>Comentario de la Asistenta</h2>
            </div>
            <div class="info">
                <h3>Comentario</h3>
                <p><?php echo $datosComentarios['mensaje']; ?></p>
            </div>
            
            <div class="comentario">
                <h3>Link para la Reunión</h3>
                <p><a href="<?php echo $datosComentarios['link']; ?>"><?php echo $datosComentarios['link']; ?></a></p>

            </div>
        </section>
    <?php endif;?>
