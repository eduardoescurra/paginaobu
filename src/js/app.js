console.log("Hola mundo");

document.addEventListener("DOMContentLoaded", function(){
    const pdf = document.querySelector(".verpdf");
    pdf.onclick = verPdf;
});

function verPdf(){
    const dni = document.getElementById("adni");
    //nombre del pdf seleccionado
    if(dni.files[0] != null){
        console.log(dni.files[0].name);
    }else{
        console.log("Ningun archivo seleccionado");
    }
    
}