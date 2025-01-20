document.addEventListener("DOMContentLoaded", () => {
    let formulario = document.querySelector('#formularioRegistro');
    const botones = document.querySelectorAll('button[type="submit"]');

    let valorBoton = ""; // Variable para almacenar el valor del botón presionado

    // Captura el botón presionado
    botones.forEach((boton) => {
        boton.addEventListener("click", event => {
            event.preventDefault();
            valorBoton = boton.value; 
            hiddenAction.value = valorBoton;
            switch (valorBoton) {
                case 'login':
                    formulario.submit();
                    break;
                case 'register':
                    if(validateForm())
                        formulario.submit();
                    break;
            }
        });
    });
});

function validateForm() {
    // Obtener valores de los campos
    let seleccion = false;

    const nombre = document.getElementById("name").value;
    const apellidoP = document.getElementById("apellidoP").value.trim();
    const apellidoM = document.getElementById("apellidoM").value.trim();
    const email = document.getElementById("email").value.trim();
    const telefono = document.getElementById("phone").value.trim();
    
   
    // Expresiones regulares para validaciones
    const nombreReg = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ'-]+( [a-zA-ZáéíóúÁÉÍÓÚñÑüÜ'-]+)?$/
    const apellidoPReg =  /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ'-]{2,100}$/;
    const apellidoMReg =  /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ'-]{2,100}$/;
    const emailReg = /^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z]{2,100}$/
    const telefonoReg = /^\d{2,3}[-.\s]?\d{2,3}[-.\s]?\d{4}$/

    // Limpiar mensajes de error
    document.getElementById("mensajeName").textContent = ""
    document.getElementById("mensajeApellidoP").textContent = ""
    document.getElementById("mensajeApellidoM").textContent = ""
    document.getElementById("mensajeEmail").textContent = ""
    document.getElementById("mensajePhone").textContent = ""

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
    } else if (nombre.length < 2 || nombre.length > 100){
        validarName.textContent = "Error en el nombre (es muy corto o muy extenso).";
        validarName.className = "error"; 
        isValid = false
    } else {
        validarName.textContent = "El nombre debe contener solo letras y un único espacio.";
        validarName.className = "error"; 
        isValid = false
    }

    if (apellidoPReg.test(apellidoP)) {
        validarApellidoP.textContent = "Apellido válido."; 
        validarApellidoP.className = "bien";      
    } else if (apellidoP.length < 2 || apellidoP.length > 100){
        validarApellidoP.textContent = "Error en el apellido (es muy corto  o muy extenso).";
        validarApellidoP.className = "error"; 
        isValid = false
    } else {
        validarApellidoP.textContent = "El apellido no debe contener espacios y debe tener únicamente letras.";
        validarApellidoP.className = "error"; 
        isValid = false
    }

    if (apellidoMReg.test(apellidoM)) {
        validarApellidoM.textContent = "Apellido válido.";
        validarApellidoM.className = "bien"; 
        
    } else if (apellidoM.length < 2 || apellidoM.length > 100){
        validarApellidoM.textContent = "Error en el apellido (es muy corto o muy extenso).";
        validarApellidoM.className = "error"; 
        isValid = false
    } else {
        validarApellidoM.textContent = "El apellido no debe contener espacios y debe tener únicamente letras.";
        validarApellidoM.className = "error"; 
        isValid = false
    }

    // Validar correo electrónico
    if (emailReg.test(email)) {
        validarEmail.textContent = "Correo válido.";
        validarEmail.className = "bien";     
    }  else if (email.length < 5 || email.length > 100){
        validarEmail.textContent = "Error en el correo electrónico (es muy corto o muy extenso).";
        validarEmail.className = "error"; 
        isValid = false
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

    return isValid;
}

