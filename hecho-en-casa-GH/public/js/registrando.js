// Capturar el formulario
let formulario = document.querySelector('#formularioRegistro');
const botones = document.querySelectorAll('button[type="submit"]');

let valorBoton = ""; // Variable para almacenar el valor del botón presionado

// Captura el botón presionado
botones.forEach((boton) => {
    boton.addEventListener("click", () => {
        valorBoton = boton.value; // Gua rda el valor del botón presionado
    });
});

formulario.addEventListener("submit", (e) => {
    
    e.preventDefault(); // Detenemos el envío del formulario
    const inputOculto = document.createElement("input");
    inputOculto.type = "hidden";
    inputOculto.name = "action";
    inputOculto.value = valorBoton;
    formulario.appendChild(inputOculto);
    validateForm(); // Llamamos a la función de validación
});

function validateForm() {
    // Obtener valores de los campos
    let seleccion = false;

    const nombre = document.getElementById("name").value.trim();
    const apellidoP = document.getElementById("apellidoP").value.trim();
    const apellidoM = document.getElementById("apellidoM").value.trim();
    const email = document.getElementById("email").value.trim();
    const telefono = document.getElementById("phone").value.trim();
   
    // Expresiones regulares para validaciones
    const nombreReg = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ'-\s]{2,}$/; 
    const apellidoPReg =  /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ'-]{2,}$/;
    const apellidoMReg =  /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ'-]{2,}$/;
    const emailReg = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z]{2,}$/;
    const telefonoReg = /^\d{2,3}[-.\s]?\d{2,3}[-.\s]?\d{4}$/

    // Limpiar mensajes de error
    document.getElementById("errorName").textContent = "";
    document.getElementById("errorApellidoPaterno").textContent = "";
    document.getElementById("errorApellidoMaterno").textContent = "";
    document.getElementById("errorEmail").textContent = "";
    document.getElementById("errorPhone").textContent = "";
    document.getElementById("bienName").textContent = "";
    document.getElementById("bienApellidoPaterno").textContent = "";
    document.getElementById("bienApellidoMaterno").textContent = "";
    document.getElementById("bienEmail").textContent = "";
    document.getElementById("bienPhone").textContent = "";
    

    let isValid = true;

    // Validar nombre
    if (nombreReg.test(nombre)) {
        document.getElementById("bienName").textContent = "Nombre válido.";
        
    } else {
        document.getElementById("errorName").textContent = "El nombre debe contener solo letras y espacios.";
        isValid = false
    }

    if (apellidoPReg.test(apellidoP)) {
        document.getElementById("bienApellidoPaterno").textContent = "Apellido válido.";
        
    } else {
        document.getElementById("errorApellidoPaterno").textContent = "El apellido debe contener solo letras.";
        isValid = false
    }

    if (apellidoMReg.test(apellidoM)) {
        document.getElementById("bienApellidoMaterno").textContent = "Apellido válido.";
        
    } else {
        document.getElementById("errorApellidoMaterno").textContent = "El apellido debe contener solo letras";
        isValid = false
    }


    // Validar correo electrónico
    if (emailReg.test(email)) {
        document.getElementById("bienEmail").textContent = "Correo válido.";
      
    } else {
        document.getElementById("errorEmail").textContent = "Introduce un correo electrónico válido.";
        isValid = false
    }

    // Validar número de teléfono
    if (telefonoReg.test(telefono)) {
        document.getElementById("bienPhone").textContent = "Número de teléfono válido.";
    } else {
        document.getElementById("errorPhone").textContent = "Introduce un número de teléfono válido (10 dígitos).";
        isValid = false
    }

    // Si todo es válido, mostrar un mensaje
    if (isValid) {
//        alert("Formulario enviado exitosamente. ¡Gracias!");
        formulario.submit(); // Enviamos el formulario si todo es correcto
    }
}