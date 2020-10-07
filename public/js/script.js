function saludoArchivo(){
    alert("Saludo desde arvhivo js");  
}

function parametros(nombre, asunto){
    alert("Nombre: " + nombre + " Asunto: " + asunto);
}

function leerValores(){
    var nombre=document.getElementById('nombre');
    nombre.value="otra cosa";
    alert(nombre.value);
    
}
