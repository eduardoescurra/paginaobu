<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBU</title>
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="assets/plugins/SweetAlert/dist/sweetalert2.min.css">
    <script src="build/js/jquery-3.6.0.min.js"></script>
    <script language="javascript">
    $(document).ready(function(){
        $("#provincia").on('change', function () {
            $("#provincia option:selected").each(function () {
                var id_provincia = $(this).val();
                $.post("distritos.php", { id_provincia: id_provincia }, function(data) {
                    $("#distrito").html(data);
                });			
            });
        });
    });
    </script>
    <script src="build/js/bundle.min.js"></script>
    <script src="assets/plugins/SweetAlert/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="contenido-logo">
                <a href="../../index.php" ><img class="logo" src="build/img/logoobu.png" alt="logo de OBU"></a>
                <div class="separa"></div>
                <h2>Estudiante</h2>
            </div>

            <div class="mobile-menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="28" height="28" viewBox="0 0 24 24" stroke-width="3" stroke="#828282" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="4" y1="6" x2="20" y2="6" />
                <line x1="4" y1="12" x2="20" y2="12" />
                <line x1="4" y1="18" x2="20" y2="18" />
                </svg>
            </div>

            <nav class="navegacion">

                <a href="../../index.php" class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="#828282" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                    <p class="texto">Inicio</p>
                </a>    

                <a href="../../postular.php" class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="#828282" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                    <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                    </svg>
                    <p class="texto">Postular</p>
                </a>    

                <a href="verpostulacion.php" class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="#828282" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="12" r="2" />
                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                    </svg>
                    <p class="texto">Ver Postulación</p>
                </a>

                <a href="#" class="icono icono-mensaje">
                    <div class="icono-mensaje">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="#828282" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        <p class="mensaje">0</p>
                    </div>    
                    <p class="texto">Mensajes</p>
                </a>

                <a href="cerrar-sesion.php" class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="28" height="28" viewBox="0 0 24 24" stroke-width="2.5" stroke="#fd0061" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                    <path d="M7 12h14l-3 -3m0 6l3 -3" />
                    </svg>
                </a>

            </nav>
        </div>
    </header>