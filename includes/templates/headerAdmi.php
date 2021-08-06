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
    <script src="build/js/bundle.min.js"></script>
    <script src="assets/plugins/SweetAlert/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="contenido-logo">
                <a href="../../index.php" ><img class="logo" src="build/img/logoobu.png" alt="logo de OBU"></a>
                <div class="separa"></div>
                <h2>Administrador</h2>
            </div>

            <div class="mobile-menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="28" height="28" viewBox="0 0 24 24" stroke-width="3" stroke="#828282" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="4" y1="6" x2="20" y2="6" />
                <line x1="4" y1="12" x2="20" y2="12" />
                <line x1="4" y1="18" x2="20" y2="18" />
                </svg>
            </div>

            <nav class="navegacion nav-admi">

                <a href="../../index.php" class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="#828282" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                    <p class="texto">Inicio</p>
                </a>    

                <a href="#" class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="#828282" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="12" r="2" />
                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                    </svg>
                    <p class="texto">Ver Postulaciónes</p>
                </a>

                <a href="#" class="icono">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="28" height="28" viewBox="0 0 24 24" stroke-width="2.5" stroke="#fd0061" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                    <path d="M7 12h14l-3 -3m0 6l3 -3" />
                    </svg>
                </a>

            </nav>
        </div>
    </header>