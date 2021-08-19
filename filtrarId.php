<?php
    if(isset($_POST['id_beca'])){
        $html = '';
        require 'includes/config/database.php';
        $db = conectarDB();
         
        $id_beca = $_POST['id_beca'];
    
        $query = "SELECT becas.id, becas.puntaje, alumnos.apellido, alumnos.nombre, facultades.nombre as 'facultad', escuelas.nombre as 'escuela', ciclos.nombre as 'ciclo', becas.fecha, becas.anexo, estados.nombre as 'estado' FROM becas
        LEFT JOIN alumnos ON alumnos.id = becas.alumnoId
        LEFT JOIN escuelas ON escuelas.id = alumnos.escuelaId
        LEFT JOIN facultades ON facultades.id = escuelas.facultadId
        LEFT JOIN ciclos ON ciclos.id = becas.cicloId
        LEFT JOIN estados ON estados.id = becas.estadoId
        WHERE (becas.id LIKE '%$id_beca%')";
    
        $resultadoConsulta = mysqli_query($db, $query);
    
        $queryCiclo = "SELECT * FROM ciclos WHERE id = 1";
        $resultadoCiclo = mysqli_query($db, $queryCiclo);
        $datosCiclo = mysqli_fetch_assoc($resultadoCiclo);
    
        if($resultadoConsulta){
            while($beca = mysqli_fetch_assoc($resultadoConsulta)){
                $color = "";
                if($beca['estado']=="EN CORRECCION"){
                    $color = "rojo";
                }elseif($beca['estado']=="REVISADO"){
                    $color = "verde";
                }elseif($beca['estado']=="REUNION"){
                    $color = "azul";
                }elseif($beca['estado']=="CORREGIDO"){
                    $color = "naranja";
                }elseif($beca['estado']=="BECADO"){
                    $color = "becado";
                }
                $html .= '<tr>';
                $html .= '<td>'.$beca['id'].'</td>';
                $html .= '<td>'.$beca['apellido'].'</td>';
                $html .= '<td>'.$beca['nombre'].'</td>';
                $html .= '<td>'.$beca['facultad'].'</td>';
                $html .= '<td>'.$beca['escuela'].'</td>';
                $html .= '<td>'.$beca['ciclo'].'</td>';
                $html .= '<td>'.$beca['fecha'].'</td>';
                $html .= '<td>'.$beca['anexo'].'</td>';
                $html .= '<td>'.$beca['puntaje'].'</td>';
                $html .= '<td><p class= "estado '. $color .'">'. $beca['estado'] .'</p></td>';
                if($datosCiclo['convocatoria'] == 'si'){
                    $html .= '<td>
                                <form  method="POST" class="w-100">
                                    <input type="hidden" value="'. $beca['id'] .'" name="id">
                                    <input type="submit" value="Revisar" class="btn btn-revisar">
                                </form>
                            </td>';
                }
                $html .= '</tr>';
            }
        }
        echo $html;
    }
    if(isset($_POST['apellido_beca'])){
        $html = '';
        require 'includes/config/database.php';
        $db = conectarDB();
         
        $apellido_beca = $_POST['apellido_beca'];
    
        $query = "SELECT becas.id, becas.puntaje, alumnos.apellido, alumnos.nombre, facultades.nombre as 'facultad', escuelas.nombre as 'escuela', ciclos.nombre as 'ciclo', becas.fecha, becas.anexo, estados.nombre as 'estado' FROM becas
        LEFT JOIN alumnos ON alumnos.id = becas.alumnoId
        LEFT JOIN escuelas ON escuelas.id = alumnos.escuelaId
        LEFT JOIN facultades ON facultades.id = escuelas.facultadId
        LEFT JOIN ciclos ON ciclos.id = becas.cicloId
        LEFT JOIN estados ON estados.id = becas.estadoId
        WHERE (alumnos.apellido LIKE '%$apellido_beca%')";
    
        $resultadoConsulta = mysqli_query($db, $query);
    
        $queryCiclo = "SELECT * FROM ciclos WHERE id = 1";
        $resultadoCiclo = mysqli_query($db, $queryCiclo);
        $datosCiclo = mysqli_fetch_assoc($resultadoCiclo);
    
        if($resultadoConsulta){
            while($beca = mysqli_fetch_assoc($resultadoConsulta)){
                $color = "";
                if($beca['estado']=="EN CORRECCION"){
                    $color = "rojo";
                }elseif($beca['estado']=="REVISADO"){
                    $color = "verde";
                }elseif($beca['estado']=="REUNION"){
                    $color = "azul";
                }elseif($beca['estado']=="CORREGIDO"){
                    $color = "naranja";
                }elseif($beca['estado']=="BECADO"){
                    $color = "becado";
                }
                $html .= '<tr>';
                $html .= '<td>'.$beca['id'].'</td>';
                $html .= '<td>'.$beca['apellido'].'</td>';
                $html .= '<td>'.$beca['nombre'].'</td>';
                $html .= '<td>'.$beca['facultad'].'</td>';
                $html .= '<td>'.$beca['escuela'].'</td>';
                $html .= '<td>'.$beca['ciclo'].'</td>';
                $html .= '<td>'.$beca['fecha'].'</td>';
                $html .= '<td>'.$beca['anexo'].'</td>';
                $html .= '<td>'.$beca['puntaje'].'</td>';
                $html .= '<td><p class= "estado '. $color .'">'. $beca['estado'] .'</p></td>';
                if($datosCiclo['convocatoria'] == 'si'){
                    $html .= '<td>
                                <form  method="POST" class="w-100">
                                    <input type="hidden" value="'. $beca['id'] .'" name="id">
                                    <input type="submit" value="Revisar" class="btn btn-revisar">
                                </form>
                            </td>';
                }
                $html .= '</tr>';
            }
        }
        echo $html;
    }
    if(isset($_POST['facultad_beca'])){
        $html = '';
        require 'includes/config/database.php';
        $db = conectarDB();
         
        $facultad_beca = $_POST['facultad_beca'];
    
        $query = "SELECT becas.id, becas.puntaje, alumnos.apellido, alumnos.nombre, facultades.nombre as 'facultad', escuelas.nombre as 'escuela', ciclos.nombre as 'ciclo', becas.fecha, becas.anexo, estados.nombre as 'estado' FROM becas
        LEFT JOIN alumnos ON alumnos.id = becas.alumnoId
        LEFT JOIN escuelas ON escuelas.id = alumnos.escuelaId
        LEFT JOIN facultades ON facultades.id = escuelas.facultadId
        LEFT JOIN ciclos ON ciclos.id = becas.cicloId
        LEFT JOIN estados ON estados.id = becas.estadoId
        WHERE (facultades.id LIKE '%$facultad_beca%')";
    
        $resultadoConsulta = mysqli_query($db, $query);
    
        $queryCiclo = "SELECT * FROM ciclos WHERE id = 1";
        $resultadoCiclo = mysqli_query($db, $queryCiclo);
        $datosCiclo = mysqli_fetch_assoc($resultadoCiclo);
    
        if($resultadoConsulta){
            while($beca = mysqli_fetch_assoc($resultadoConsulta)){
                $color = "";
                if($beca['estado']=="EN CORRECCION"){
                    $color = "rojo";
                }elseif($beca['estado']=="REVISADO"){
                    $color = "verde";
                }elseif($beca['estado']=="REUNION"){
                    $color = "azul";
                }elseif($beca['estado']=="CORREGIDO"){
                    $color = "naranja";
                }elseif($beca['estado']=="BECADO"){
                    $color = "becado";
                }
                $html .= '<tr>';
                $html .= '<td>'.$beca['id'].'</td>';
                $html .= '<td>'.$beca['apellido'].'</td>';
                $html .= '<td>'.$beca['nombre'].'</td>';
                $html .= '<td>'.$beca['facultad'].'</td>';
                $html .= '<td>'.$beca['escuela'].'</td>';
                $html .= '<td>'.$beca['ciclo'].'</td>';
                $html .= '<td>'.$beca['fecha'].'</td>';
                $html .= '<td>'.$beca['anexo'].'</td>';
                $html .= '<td>'.$beca['puntaje'].'</td>';
                $html .= '<td><p class= "estado '. $color .'">'. $beca['estado'] .'</p></td>';
                if($datosCiclo['convocatoria'] == 'si'){
                    $html .= '<td>
                                <form  method="POST" class="w-100">
                                    <input type="hidden" value="'. $beca['id'] .'" name="id">
                                    <input type="submit" value="Revisar" class="btn btn-revisar">
                                </form>
                            </td>';
                }
                $html .= '</tr>';
            }
        }
        echo $html;
    }
    if(isset($_POST['estado_beca'])){
        $html = '';
        require 'includes/config/database.php';
        $db = conectarDB();
         
        $estado_beca = $_POST['estado_beca'];
    
        $query = "SELECT becas.id, becas.puntaje, alumnos.apellido, alumnos.nombre, facultades.nombre as 'facultad', escuelas.nombre as 'escuela', ciclos.nombre as 'ciclo', becas.fecha, becas.anexo, estados.nombre as 'estado' FROM becas
        LEFT JOIN alumnos ON alumnos.id = becas.alumnoId
        LEFT JOIN escuelas ON escuelas.id = alumnos.escuelaId
        LEFT JOIN facultades ON facultades.id = escuelas.facultadId
        LEFT JOIN ciclos ON ciclos.id = becas.cicloId
        LEFT JOIN estados ON estados.id = becas.estadoId
        WHERE (estados.nombre LIKE '%$estado_beca%')";
    
        $resultadoConsulta = mysqli_query($db, $query);
    
        $queryCiclo = "SELECT * FROM ciclos WHERE id = 1";
        $resultadoCiclo = mysqli_query($db, $queryCiclo);
        $datosCiclo = mysqli_fetch_assoc($resultadoCiclo);
    
        if($resultadoConsulta){
            while($beca = mysqli_fetch_assoc($resultadoConsulta)){
                $color = "";
                if($beca['estado']=="EN CORRECCION"){
                    $color = "rojo";
                }elseif($beca['estado']=="REVISADO"){
                    $color = "verde";
                }elseif($beca['estado']=="REUNION"){
                    $color = "azul";
                }elseif($beca['estado']=="CORREGIDO"){
                    $color = "naranja";
                }elseif($beca['estado']=="BECADO"){
                    $color = "becado";
                }
                $html .= '<tr>';
                $html .= '<td>'.$beca['id'].'</td>';
                $html .= '<td>'.$beca['apellido'].'</td>';
                $html .= '<td>'.$beca['nombre'].'</td>';
                $html .= '<td>'.$beca['facultad'].'</td>';
                $html .= '<td>'.$beca['escuela'].'</td>';
                $html .= '<td>'.$beca['ciclo'].'</td>';
                $html .= '<td>'.$beca['fecha'].'</td>';
                $html .= '<td>'.$beca['anexo'].'</td>';
                $html .= '<td>'.$beca['puntaje'].'</td>';
                $html .= '<td><p class= "estado '. $color .'">'. $beca['estado'] .'</p></td>';
                if($datosCiclo['convocatoria'] == 'si'){
                    $html .= '<td>
                                <form  method="POST" class="w-100">
                                    <input type="hidden" value="'. $beca['id'] .'" name="id">
                                    <input type="submit" value="Revisar" class="btn btn-revisar">
                                </form>
                            </td>';
                }
                $html .= '</tr>';
            }
        }
        echo $html;
    }
?>