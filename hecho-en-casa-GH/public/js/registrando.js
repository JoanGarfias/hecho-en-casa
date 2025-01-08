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
    document.getElementById("mensajeName").textContent = ""
    document.getElementById("mensajeApellidoP").textContent = ""
    document.getElementById("mensajeApellidoM").textContent = ""
    document.getElementById("mensajeEmail").textContent = ""
    document.getElementById("mensajePhone").textContent = ""

    //document.getElementById("errorName").textContent = "";
    //document.getElementById("errorApellidoPaterno").textContent = "";
    //document.getElementById("errorApellidoMaterno").textContent = "";
   // document.getElementById("errorEmail").textContent = "";
    //document.getElementById("errorPhone").textContent = "";
    //document.getElementById("bienName").textContent = "";
    //document.getElementById("bienApellidoPaterno").textContent = "";
    //document.getElementById("bienApellidoMaterno").textContent = "";
    //document.getElementById("bienEmail").textContent = "";
    //document.getElementById("bienPhone").textContent = "";
    

    let isValid = true;
    let validarName = document.getElementById("mensajeName")
    let validarApellidoP = document.getElementById("mensajeApellidoP")
    let validarApellidoM = document.getElementById("mensajeApellidoM")
    let validarEmail = document.getElementById("mensajeEmail")
    let validarPhone = document.getElementById("mensajePhone")

    // Validar nombre
    if (nombreReg.test(nombre)) {
        validarName.textContent = "Nombre válido.";
        validarName.className = "bien"; 
        
    } else {
        validarName.textContent = "El nombre debe contener solo letras y espacios.";
        validarName.className = "error"; 
        isValid = false
    }

    if (apellidoPReg.test(apellidoP)) {
        validarApellidoP.textContent = "Apellido válido."; 
        validarApellidoP.className = "bien";      
    } else {
        validarApellidoP.textContent = "El apellido debe contener solo letras.";
        validarApellidoP.className = "error"; 
        isValid = false
    }

    if (apellidoMReg.test(apellidoM)) {
        validarApellidoM.textContent = "Apellido válido.";
        validarApellidoM.className = "bien"; 
        
    } else {
        validarApellidoM.textContent = "El apellido debe contener solo letras";
        validarApellidoM.className = "error"; 
        isValid = false
    }

    // Validar correo electrónico
    if (emailReg.test(email)) {
        validarEmail.textContent = "Correo válido.";
        validarEmail.className = "bien";     
    } else {
        validarEmail.textContent = "Introduce un correo electrónico válido.";
        validarEmail.className = "error";   
        isValid = false
    }

    // Validar número de teléfono
    if (telefonoReg.test(telefono)) {
        validarPhone.textContent = "Número de teléfono válido.";
        validarPhone.className = "bien";   
    } else {
        validarPhone.textContent = "Introduce un número de teléfono válido (10 dígitos).";
        validarPhone.className = "error"; 
        isValid = false
    }

    // Si todo es válido, mostrar un mensaje
<<<<<<< HEAD
    if (isValid) {  
=======
    if (isValid) {
//        alert("Formulario enviado exitosamente. ¡Gracias!");
>>>>>>> main
        formulario.submit(); // Enviamos el formulario si todo es correcto
    }
}

