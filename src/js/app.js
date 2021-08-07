
document.addEventListener("DOMContentLoaded", function(){
    evenListeners();
    abrirPopup();
    // const pdf = document.querySelector(".verpdf");
    // pdf.onclick = verPdf;
    //mostrarAlerta("!Éxito!","Cuenta Creada", "success");
});

// function verPdf(){
//     const dni = document.getElementById("adni");
//     //nombre del pdf seleccionado
//     if(dni.files[0] != null){
//         console.log(dni.files[0].name);
//     }else{
//         console.log("Ningun archivo seleccionado");
//     }
    
// }

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

    btnAbriPopup.addEventListener('click', function(){
        overlay.classList.add("active");
        popup.classList.add("active");
    });
    btnCerrarPopup.addEventListener('click', function(){
        overlay.classList.remove("active");
        popup.classList.remove("active");
    });
}