const formulario = document.getElementById('cambioFecha');
const hiddenAction = document.getElementById('botonPress');
const botones = document.querySelectorAll('.botonPr');
let action = null; 
botones.forEach(boton => {
    boton.addEventListener('click', event => {
        event.preventDefault(); 
        action = boton.value; 
        hiddenAction.value = action;
        formulario.submit();
    });
});