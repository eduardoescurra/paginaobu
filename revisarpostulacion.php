<?php 
    require "includes/funciones.php";
    $autenticado = esAdmi(); 

    if(!$autenticado){
        header('Location: loginAdmi.php');
    }

include "includes/templates/headerAdmi.php"; 
?>
<main class="contenedor">
    <section class="seccion seccion-revisar">
        <div class="titulo bg-amarillo">
            <h2>Revisión</h2>
        </div>
        <div class="info">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
            <h3>Facultades Encargadas: </h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
        </div>
    </section>
</main>
<?php include "includes/templates/popupAdmi.php"; ?>
<?php include "includes/templates/footer.php"; ?> 