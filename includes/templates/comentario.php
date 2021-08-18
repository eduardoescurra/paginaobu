<?php 
    $codigo = $_SESSION['usuario'];
    $queryComentarios = "SELECT comentarios.mensaje, comentarios.link, estados.id FROM alumnos 
    LEFT JOIN becas ON becas.alumnoId = alumnos.id
    LEFT JOIN estados ON estados.id = becas.estadoId
    LEFT JOIN comentarios ON comentarios.id = becas.comentarioId
    WHERE alumnos.codigo = '${codigo}'";
    $resultadoComentarios = mysqli_query($db, $queryComentarios);
    $datosComentarios = mysqli_fetch_assoc($resultadoComentarios);

    if($datosComentarios['id']==2 || $datosComentarios['id']==4) : ?>
        <section class="seccion ">
            <div class="titulo bg-azul">
                <h2>Comentario de la Asistenta</h2>
            </div>
            <div class="comentario">
                <div class="col-1">
                    <h3>Comentario</h3>
                    <p><?php echo $datosComentarios['mensaje']; ?></p>
                </div>
                <?php if($datosComentarios['link']) :?>
                    <div class="col-1">
                        <h3>Link para la Reunión</h3>
                        <p><a target="_blank" href="<?php echo $datosComentarios['link']; ?>"><?php echo $datosComentarios['link']; ?></a></p>
                    </div>
                <?php endif; ?>
                <?php if($datosComentarios['id'] == 2) :?>
                    <div class="col-1">
                        <h3>Acción</h3>
                        <a class="btn-corregir bg-rojo" href="corregirpostular.php">Corregir Datos Aquí</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif;?>
