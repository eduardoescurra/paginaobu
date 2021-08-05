    
<?php 
    require "includes/funciones.php";
    $autenticado = estadoAutenticado();

    //BASE DE DATOS
    require 'includes/config/database.php';
    $db = conectarDB();

    if(!$autenticado){
        header('Location: login.php');
    }

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
    <main class="contenedor baseP">
        <div class="principal r-gap">
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
                <section class="seccion scroll">
                    <div class="titulo bg-azul">
                        <h2>Ver postulacion</h2>
                    </div>
                    <div class="info tabla">
                        <div class="columna">
                            <h3>Id</h3>
                            <p><?php echo $datos_beca['id'] ?></p>
                        </div>
                        <div class="columna">
                            <h3>Apellidos</h3>
                            <p><?php echo $datos_alumno['apellido'] ?></p>
                        </div>
                        <div class="columna">
                            <h3>Nombres</h3>
                            <p><?php echo $datos_alumno['nombre'] ?></p>
                        </div>        
                        <div class="columna">
                            <h3>Facultad</h3>
                            <p><?php echo $datos_Facu['facultad'] ?></p> 
                        </div>
                        <div class="columna">
                            <h3>Escuela</h3>
                            <p><?php echo $datos_Facu['escuela'] ?></p>
                        </div>
                        <div class="columna">
                            <h3>Calendario</h3>
                            <p><?php echo $datos_beca['ciclo'] ?></p>
                        </div>
                        <div class="columna">
                            <h3>Fecha</h3>
                            <p><?php echo $datos_beca['fecha'] ?></p>
                        </div>
                        <div class="columna">
                            <h3>Anexos</h3>
                            <p><?php echo $datos_beca['anexo'] ?></p>
                        </div>
                        <div class="columna">
                            <h3>Estado</h3>
                            <p><?php echo $datos_beca['estado'] ?></p>
                        </div>
                    </div>
                </section>
            <?php endif;?>
            <section class="seccion">
                <div class="titulo bg-azul">
                    <h2>Comentario de la Asistenta</h2>
                </div>
                <div class="info">
                    <h3>Comentario</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
                    <h3>Datos para la entrevista</h3>
                </div>
                
                <div class="info comentario">
                    <div class="columna">
                        <h3>Día</h3>
                        <p>05/08/2021</p>
                    </div>
                    <div class="columna">
                        <h3>Hora</h3>
                        <p>10:00 am</p>
                    </div>
                    <div class="columna">
                        <h3>Enlace</h3>
                        <p><a href="#">https://meet.google.com/wtb-fjus-vgt</a></p>
                    </div>
                </div>
            </section>
        </div>
    </main>
<?php include "includes/templates/footer.php"; ?> 

