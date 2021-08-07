    
<?php 
  require "includes/funciones.php";
  $autenticado = esAdmi(); 

  if(!$autenticado){
      header('Location: loginAdmi.php');
  }

    //BASE DE DATOS
    require 'includes/config/database.php';
    $db = conectarDB();

    $codigo = $_SESSION['usuario'];
    $query = "SELECT encargadas.nombre FROM encargadas
                LEFT JOIN usuarios ON usuarios.id = encargadas.usuarioId
                WHERE usuarios.codigo = '${codigo}'";
    $resultado = mysqli_query($db, $query);
    $datos_admi = mysqli_fetch_assoc($resultado);

include "includes/templates/headerAdmi.php"; 
?>
    <main class="contenedor main">
        <div class="principal r-gap">
            <section class="seccion">
                <div class="titulo bg-azul">
                    <h2>Bienvenido</h2>
                </div>
                <div class="info">
                    <h3 class="postulante"> !Hola <?php echo $datos_admi['nombre'] ?>!</h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                    <h3>Facultades Encargadas: </h3>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                </div>
            </section>
        </div>
        <div class="aside r-gap">
            <section class="seccion">
                <div class="titulo bg-rojo">
                    <h2>Cronograma</h2>
                </div>
                <div class="info">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                </div>
            </section>
            <section class="seccion">
                <div class="titulo bg-rojo">
                    <h2>Parámetros</h2>
                </div>
                <div class="info">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae officia quae doloremque, sapiente ab ipsam suscipit excepturi id porro quas facilis iusto in, dicta perspiciatis doloribus pariatur inventore illum est.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur molestias quasi optio! Consequuntur expedita saepe libero accusantium non animi molestiae laborum dolore molestias hic ullam iste, sed consequatur maxime fuga.</p>
                </div>
            </section>
        </div>
    </main>
<?php include "includes/templates/popupAdmi.php"; ?> 
<?php include "includes/templates/footer.php"; ?> 

