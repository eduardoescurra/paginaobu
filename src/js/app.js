
document.addEventListener("DOMContentLoaded", function(){
    evenListeners();
    // const pdf = document.querySelector(".verpdf");
    // pdf.onclick = verPdf;
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