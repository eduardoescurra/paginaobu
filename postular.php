    
<?php include "includes/templates/header.php"; ?>
    <main class="main-postular">
        <section class="seccionP">
            <div class="titulo bg-rojo">
                <h2>Postular</h2>
            </div>
            <form class="formularioP" method="POST" action="postular.php">                       
                    <fieldset>
                        <legend>Datos Personales</legend>

                        <label for="dni">DNI</label>
                        <input class="input" type="number" name="dni" placeholder="ingrese su dni" id="dni">

                        <label for="email">Email</label>
                        <input class="input" type="email" name="email" placeholder="su Email" id="email">

                        <label for="celular">Celular</label>
                        <input class="input" type="number" name="celular" placeholder="ingrese su celular" id="celular">

                        <label for="direccion">Dirección Actual</label>
                        <input class="input" type="text" id="direccion" name="direccion"  placeholder="su dirección actual"">

                        <label for="">Provincia</label>
                        <select name="provincia">
                            <option value="">-- Seleccione --</option>
                            <option value="">Lima</option>
                            <option value="">Callao</option>
                        </select>

                        <label for="">Distrito</label>
                        <select name="distrito">
                            <option value="">-- Seleccione --</option>
                            <option value="">Carabayllo</option>
                            <option value="">Villa el Salvador</option>
                        </select>
                </select>
                    </fieldset>

                    <fieldset>
                        <legend>Documentos Adjuntos</legend>

                        <label for="adni">Adjunte DNI y del Apoderado </label>
                        <input class="subirfile" type="file" id="adni" accept="application/pdf" name="adni">
                        <div class="verpdf"><p>Ver pdf</p></div>

                        <label for="luz">Adjunte Recibo de Luz </label>
                        <input class="subirfile" type="file" id="luz" accept="application/pdf" name="luz">

                        <label for="anexo">Adjunte Anexos en 1 solo archivo </label>
                        <input class="subirfile" type="file" id="anexo" accept="application/pdf" name="anexo">
                    </fieldset>

                    <input type="submit" value="Enviar Postulación" class="botonE bg-verde">
                </form>
        </section>
    </main>
    <div class="contenedor-pdf">
        <h2>Visualizador PDF</h2>
        <object class="pdf" data="pdf/ejemplo.pdf" type="application/pdf"></object>
    </div>
<?php include "includes/templates/footer.php"; ?> 

