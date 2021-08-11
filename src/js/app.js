
document.addEventListener("DOMContentLoaded", function(){
    evenListeners();
    abrirPopup();
    abrirPDF();
    abrirPDF2();
    abrirPDF3();
    abrirCorregir();
    abrirMensaje();
    abrirReunión();
});
function abrirReunión(){
    const btnAbriReunion = document.getElementById('btn-abrir-reunion');
    const overlayReunion = document.getElementById('overlay-reunion');
    const popupReunion = document.getElementById('popup-reunion');
    const btnCancelarReunion = document.getElementById('btn-cancelar-reunion');
    const btnCerrarReunion = document.getElementById('btn-cerrar-reunion');
    if(btnAbriReunion === null || overlayReunion === null || popupReunion === null || btnCancelarReunion === null || btnCerrarReunion === null){
        //console.log("Faltan elementos");
    }else{
        btnAbriReunion.addEventListener('click', function(){
            overlayReunion.classList.add("active");
            popupReunion.classList.add("active");
        });
        btnCancelarReunion.addEventListener('click', function(){
            overlayReunion.classList.remove("active");
            popupReunion.classList.remove("active");
        });
        btnCerrarReunion.addEventListener('click', function(){
            overlayReunion.classList.remove("active");
            popupReunion.classList.remove("active");
        });
    } 
}
function abrirMensaje(){
    const btnVerMensaje = document.getElementById('ver-mensaje');
    const overlayPopup = document.getElementById('popup-mensaje');
    const btnCerrarMensaje = document.getElementById('btn-cerrar-mensaje');
    const btnCerrarMobile = document.getElementById('mobile-menu');

    if(btnVerMensaje === null || overlayPopup === null || btnCerrarMensaje === null || btnCerrarMobile === null){
        
    }else{
        btnVerMensaje.addEventListener('click', function(){
            overlayPopup.classList.add("active");
        });
        btnCerrarMensaje.addEventListener('click', function(){
            overlayPopup.classList.remove("active");
        });
        btnCerrarMobile.addEventListener('click', function(){
            overlayPopup.classList.remove("active");
        });
    }
}

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
function abrirCorregir(){
    const btnAbriCorregir = document.getElementById('btn-abrir-corregir');
    const overlayCorregir = document.getElementById('overlay-corregir');
    const popupCorregir = document.getElementById('popup-corregir');
    const btnCancelarCorregir = document.getElementById('btn-cancelar-corregir');
    const btnCerrarCorregir = document.getElementById('btn-cerrar-corregir');
    if(btnAbriCorregir === null || overlayCorregir === null || popupCorregir === null || btnCancelarCorregir === null || btnCerrarCorregir === null){
        //console.log("Faltan elementos");
    }else{
        btnAbriCorregir.addEventListener('click', function(){
            overlayCorregir.classList.add("active");
            popupCorregir.classList.add("active");
        });
        btnCancelarCorregir.addEventListener('click', function(){
            overlayCorregir.classList.remove("active");
            popupCorregir.classList.remove("active");
        });
        btnCerrarCorregir.addEventListener('click', function(){
            overlayCorregir.classList.remove("active");
            popupCorregir.classList.remove("active");
        });
    } 

}
function abrirPopup(){
    const btnAbriPopup = document.getElementById('btn-abrir-popup');
    const overlay = document.getElementById('overlay');
    const popup = document.getElementById('popup');
    const btnCerrarPopup = document.getElementById('btn-cerrar-popup');
    const btnCerrar = document.querySelector('.btn-cancelar');

    if(btnAbriPopup === null || overlay === null || popup === null || btnCerrarPopup === null || btnCerrar === null){
        //console.log("Faltan elementos");
    }else{
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
    }

}
function verificarElementos(btnAbrirPdf, overlayPdf, contenedorPdf, btnCerrarPdf){
    if(btnAbrirPdf === null || overlayPdf === null || contenedorPdf === null || btnCerrarPdf === null){
        //console.log("Faltan elementos");
    }else{
        return true;
    }
}
function abrirPDF(){
    const btnAbrirPdf = document.getElementById("btn-pdf1");
    const overlayPdf = document.getElementById("overlay-pdf");
    const contenedorPdf = document.getElementById("contenedor-pdf");
    const btnCerrarPdf = document.getElementById("btn-cerrar-pdf");
    if(verificarElementos(btnAbrirPdf, overlayPdf, contenedorPdf, btnCerrarPdf)){
        btnAbrirPdf.addEventListener('click', function(){
            overlayPdf.classList.add("active");
            contenedorPdf.classList.add("active");
        });
        btnCerrarPdf.addEventListener('click', function(){
            overlayPdf.classList.remove("active");
            contenedorPdf.classList.remove("active");
        });
    }
}
function abrirPDF2(){
    const btnAbrirPdf2 = document.getElementById("btn-pdf2");
    const overlayPdf2 = document.getElementById("overlay-pdf2");
    const contenedorPdf2 = document.getElementById("contenedor-pdf2");
    const btnCerrarPdf2 = document.getElementById("btn-cerrar-pdf2");
    if(verificarElementos(btnAbrirPdf2, overlayPdf2, contenedorPdf2, btnCerrarPdf2)){
        btnAbrirPdf2.addEventListener('click', function(){
            overlayPdf2.classList.add("active");
            contenedorPdf2.classList.add("active");
        });
        btnCerrarPdf2.addEventListener('click', function(){
            overlayPdf2.classList.remove("active");
            contenedorPdf2.classList.remove("active");
        });
    }
}
function abrirPDF3(){
    const btnAbrirPdf3 = document.getElementById("btn-pdf3");
    const overlayPdf3 = document.getElementById("overlay-pdf3");
    const contenedorPdf3 = document.getElementById("contenedor-pdf3");
    const btnCerrarPdf3 = document.getElementById("btn-cerrar-pdf3");
    if(verificarElementos(btnAbrirPdf3, overlayPdf3, contenedorPdf3, btnCerrarPdf3)){
        btnAbrirPdf3.addEventListener('click', function(){
            overlayPdf3.classList.add("active");
            contenedorPdf3.classList.add("active");
        });
        btnCerrarPdf3.addEventListener('click', function(){
            overlayPdf3.classList.remove("active");
            contenedorPdf3.classList.remove("active");
        });
    }
}