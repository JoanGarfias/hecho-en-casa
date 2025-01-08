let formulario = document.querySelector('#validandoContra');

formulario.addEventListener("submit", (e) => {
    e.preventDefault(); // Detenemos el envío del formulario
    validateContra(); // Llamamos a la función de validación
});
 HEAD
 HEAD

 origin/Backend-main

function validateContra() {
    const password = document.getElementById("password").value.trim();
    const confirmacion = document.getElementById("confirmacion").value.trim();

 HEAD
    let validarPass = document.getElementById("mensajePass")
    let confirmar = document.getElementById("mensajeConfirmacion")

    let isValid = true;
    let confirmando = true

    // Validar que la contraseña tenga al menos 8 caracteres
    if (password.length < 8) {
        validarPass.textContent = "La contraseña debe tener al menos 8 caracteres.";
        validarPass.className = "error";
        isValid = false;
    } 

    // Validar que la contraseña contenga al menos una letra mayúscula
    if (!/[A-Z]/.test(password)) {
        validarPass.textContent = "La contraseña debe contener al menos una letra mayúscula.";
        validarPass.className = "error";

    // Limpiar mensajes de error
    document.getElementById("errorPass").textContent = "";
    document.getElementById("errorConfirmacion").textContent = "";
    document.getElementById("bienPass").textContent = "";
    document.getElementById("bienConfirmacion").textContent = "";
    document.getElementById("asegurarConfirmacion").textContent=""

    let isValid = true;

    // Validar que la contraseña tenga al menos 8 caracteres
    if (password.length < 8) {
        document.getElementById("errorPass").textContent = "La contraseña debe tener al menos 8 caracteres.";
        isValid = false;
    }

    // Validar que la contraseña contenga al menos una letra mayúscula
    if (!/[A-Z]/.test(password)) {
        document.getElementById("errorPass").textContent = "La contraseña debe contener al menos una letra mayúscula.";
 origin/Backend-main
        isValid = false;
    }

    // Validar que la contraseña contenga al menos una letra minúscula
    if (!/[a-z]/.test(password)) {
 HEAD
        validarPass.textContent = "La contraseña debe contener al menos una letra minúscula.";
        validarPass.className = "error";

        document.getElementById("errorPass").textContent = "La contraseña debe contener al menos una letra minúscula.";
 origin/Backend-main
        isValid = false;
    }

    // Validar que la contraseña contenga al menos un número
    if (!/\d/.test(password)) {
 HEAD
        validarPass.textContent = "La contraseña debe contener al menos un número.";
        validarPass.className = "error";

        document.getElementById("errorPass").textContent = "La contraseña debe contener al menos un número.";
 origin/Backend-main
        isValid = false;
    }

    if (isValid){
 HEAD
        validarPass.textContent = "Contraseña válida.";
        validarPass.className = "bien";
    }

    confirmando = isValid

    // Validar que las contraseñas coincidan
    if (!confirmando){ 
        confirmar.textContent = "La contraseña debe ser válida.";
        confirmar.className = "error";
        confirmando = false;
    } else if (password !== confirmacion) {
        confirmar.textContent = "Las contraseñas no coinciden.";
        confirmar.className = "error";
        confirmando = false;
    } else {  
        confirmar.textContent = "Las contraseñas coinciden.";
        confirmar.className = "bien";
    }

    // Si todo es válido, enviar el formulario
    if (confirmando) {

        document.getElementById("bienPass").textContent = "Contraseña válida.";
    }

    // Validar que las contraseñas coincidan

    if (password !== confirmacion) {
        document.getElementById("errorConfirmacion").textContent = "Las contraseñas no coinciden.";
        isValid = false;
    } else if (!isValid){ 
        document.getElementById("asegurarConfirmacion").textContent = "La contraseña debe ser válida.";
        isValid = false;
    } else {  
        document.getElementById("bienConfirmacion").textContent = "Las contraseñas coinciden.";
    }

    // Si todo es válido, enviar el formulario
    if (isValid) {
 origin/Backend-main
        formulario.submit(); // Enviar el formulario si todas las validaciones son correctas
    }
}

/*Mostrar la contraseña */
function visibility(id, icon) {
    const input = document.getElementById(id);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fi-rs-crossed-eye"); // Elimina el ícono de ojo cerrado
        icon.classList.add("fi-rs-eye");           // Agrega el ícono de ojo abierto
    } else {
        input.type = "password";
        icon.classList.remove("fi-rs-eye");        // Elimina el ícono de ojo abierto
        icon.classList.add("fi-rs-crossed-eye");   // Agrega el ícono de ojo cerrado
    }
 HEAD
}

 main

}
 origin/Backend-main
