<?php
$html = '';
require 'includes/config/database.php';
$db = conectarDB();
 
$id_provincia = $_POST['id_provincia'];

$consulta = "SELECT * FROM distritos WHERE provinciaId = ".$id_provincia."";

$resultado = mysqli_query($db, $consulta);
$html = '<option value="">-- Seleccione --</option>';

if($resultado->num_rows > 0){
    while ($distrito = mysqli_fetch_assoc($resultado)) {                
        $html .= '<option value="'.$distrito['id'].'">'.$distrito['nombre'].'</option>';
    }
}


echo $html;
?>