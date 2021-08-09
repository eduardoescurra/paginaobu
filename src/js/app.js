
document.addEventListener("DOMContentLoaded", function(){
    evenListeners();
    abrirPopup();
    abrirPDF();
    abrirPDF2();
    abrirPDF3();
});

function evenListeners(){
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsive);
}

function navegacionResponsive(){
    const navegacion = document.querySelector(".navegacion");
    if(navegacion.classList.contains("mostrar")){
        navegacion.classList.remove("mostrar");
    }else{
        navegacion.classList.add("mostrar");
    }
}

function mostrarAlerta(titulo, descripcion,tipoAlerta){
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}

function abrirPopup(){
    const btnAbriPopup = document.getElementById('btn-abrir-popup');
    const overlay = document.getElementById('overlay');
    const popup = document.getElementById('popup');
    const btnCerrarPopup = document.getElementById('btn-cerrar-popup');
    const btnCerrar = document.querySelector('.btn-cancelar');

    btnAbriPopup.addEventListener('click', function(){
        overlay.classList.add("active");
        popup.classList.add("active");
    });
    btnCerrarPopup.addEventListener('click', function(){
        overlay.classList.remove("active");
        popup.classList.remove("active");
    });
    btnCerrar.addEventListener('click', function(){
        overlay.classList.remove("active");
        popup.classList.remove("active");
    });
    // overlay.addEventListener('click',function(){
    //     overlay.classList.remove("active");
    //     popup.classList.remove("active");
    // })
}
function abrirPDF(){
    const btnAbrirPdf = document.getElementById("btn-pdf1");
    const overlayPdf = document.getElementById("overlay-pdf");
    const contenedorPdf = document.getElementById("contenedor-pdf");
    const btnCerrarPdf = document.getElementById("btn-cerrar-pdf");

    btnAbrirPdf.addEventListener('click', function(){
        overlayPdf.classList.add("active");
        contenedorPdf.classList.add("active");
    });
    btnCerrarPdf.addEventListener('click', function(){
        overlayPdf.classList.remove("active");
        contenedorPdf.classList.remove("active");
    });
}
function abrirPDF2(){
    const btnAbrirPdf2 = document.getElementById("btn-pdf2");
    const overlayPdf2 = document.getElementById("overlay-pdf2");
    const contenedorPdf2 = document.getElementById("contenedor-pdf2");
    const btnCerrarPdf2 = document.getElementById("btn-cerrar-pdf2");

    btnAbrirPdf2.addEventListener('click', function(){
        overlayPdf2.classList.add("active");
        contenedorPdf2.classList.add("active");
    });
    btnCerrarPdf2.addEventListener('click', function(){
        overlayPdf2.classList.remove("active");
        contenedorPdf2.classList.remove("active");
    });
}
function abrirPDF3(){
    const btnAbrirPdf3 = document.getElementById("btn-pdf3");
    const overlayPdf3 = document.getElementById("overlay-pdf3");
    const contenedorPdf3 = document.getElementById("contenedor-pdf3");
    const btnCerrarPdf3 = document.getElementById("btn-cerrar-pdf3");

    btnAbrirPdf3.addEventListener('click', function(){
        overlayPdf3.classList.add("active");
        contenedorPdf3.classList.add("active");
    });
    btnCerrarPdf3.addEventListener('click', function(){
        overlayPdf3.classList.remove("active");
        contenedorPdf3.classList.remove("active");
    });
}