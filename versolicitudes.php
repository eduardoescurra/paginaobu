    
<?php include "includes/templates/headerAdmi.php"; ?>
    <main class="contenedor base">
        <div class="principal r-gap">
            <section class="desplegable">
                <div class="codigo">
                    <label for="codigo">Código</label>
                    <input class="input" type="number" name="codigo" placeholder="Inserte código">
                </div>
                <div class="facultad">
                    <label>Facultad</label>
                    <select name="facultad">
                        <option value="">--Seleccione--</option>
                        <option value="">FIIS</option>
                    </select>
                </div>
                <div class="escuela">
                    <label>Escuela</label>
                    <select name="facultad">
                        <option value="">--Seleccione--</option>
                        <option value="">EPIS</option>
                        <option value="">EPII</option>
                    </select>
                </div>
                <div class="estado">
                <label>Estado</label>
                    <select name="facultad">
                        <option value="">--Seleccione--</option>
                        <option value="">En proceso</option>
                        <option value="">Recibido</option>
                        <option value="">Denegado</option>
                        <option value="">Aceptado</option>
                    </select>
                </div>

                <div class="paginas">
                    <label>Paginas</label>
                        <ul class="items">
                            <li class="item previo"><a href="#"><</a></li>
                            <li class="item actual"><a href="#">1</a></li>
                            <li class="item"><a href="#">2</a></li>
                            <li class="item"><a href="#">3</a></li>
                            <li class="item"><a href="#">4</a></li>
                            <li class="item next"><a href="#">></a></li>
                        </ul>
                </div>
            </section>

            <section class="seccion">
                <div class="titulo bg-verde">
                    <h2>Solicitudes disponibles</h2>
                </div>
                <div class="info tabla">
                    <div class="columna">
                        <h3>Id</h3>
                        <p>P01</p>
                    </div>
                    <div class="columna">
                        <h3>Facultad</h3>
                        <p>FIIS</p>
                    </div>
                    <div class="columna">
                        <h3>Escuela</h3>
                        <p>EPIS</p>
                    </div>
                    <div class="columna">
                        <h3>Calendario</h3>
                        <p>2021A</p>
                    </div>
                    <div class="columna">
                        <h3>Apellidos</h3>
                        <p>Lopez Gamarra</p>
                    </div>
                    <div class="columna">
                        <h3>Nombres</h3>
                        <p>David Adrian</p>
                    </div>
                    <div class="columna">
                        <h3>Fecha</h3>
                        <p>21/07/21</p>
                    </div>
                    <div class="columna">
                        <h3>Estado</h3>
                        <p>Recibido</p>
                    </div>
                    <div class="columna">
                        <h3>Anexos</h3>
                        <p>No</p>
                    </div>
            </section>
        </div>
    </main>
<?php include "includes/templates/footer.php"; ?> 

