// Capturar el formulario
document.addEventListener("DOMContentLoaded", () => {
    let formulario = document.getElementById('validandoContra');
    
    formulario.addEventListener("submit", (e) => {
        e.preventDefault(); // Detenemos el envío del formulario
        validateContra(); // Llamamos a la función de validación
    });   
});

function validateContra() {
    const password = document.getElementById("password").value.trim();
    const confirmacion = document.getElementById("confirmacion").value.trim();

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
        isValid = false;
    }

    // Validar que la contraseña contenga al menos una letra minúscula
    if (!/[a-z]/.test(password)) {
        validarPass.textContent = "La contraseña debe contener al menos una letra minúscula.";
        validarPass.className = "error";
        isValid = false;
    }

    // Validar que la contraseña contenga al menos un número
    if (!/\d/.test(password)) {
        validarPass.textContent = "La contraseña debe contener al menos un número.";
        validarPass.className = "error";
        isValid = false;
    }

    if (isValid){
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
        let formulario = document.getElementById('validandoContra');
        formulario.submit(); // Enviar el formulario si todas las validaciones son correctas
    }
}

