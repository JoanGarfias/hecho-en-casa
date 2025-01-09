// Capturar el formulario
document.addEventListener("DOMContentLoaded", () => {
    let formulario = document.getElementById('validandoContra');
    
    formulario.addEventListener("submit", (e) => {
        e.preventDefault(); // Detenemos el envío del formulario
        validateContra(); // Llamamos a la función de validación
    });

    function validateContra() {
        // Obtener valores de los campos
        const password = document.getElementById("password").value.trim();
        
        const confirmacion = document.getElementById("confirmacion").value.trim();

        // Expresiones regulares para validaciones
        const passwordReg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Limpiar mensajes de error

        document.getElementById("errorPass").textContent = "";
        document.getElementById("errorConfirmacion").textContent = "";
        document.getElementById("bienPass").textContent = "";
        document.getElementById("bienConfirmacion").textContent = "";

        let isValid = true;
        
        // Validar contraseña
        if (passwordReg.test(password)) {
            document.getElementById("bienPass").textContent = "Contraseña válida.";
        } else {
            document.getElementById("errorPass").textContent =
                "La contraseña debe tener al menos 8 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial.";

            isValid = false;
        }

        if (password === confirmacion) {
            document.getElementById("bienConfirmacion").textContent = "Las contraseñas coinciden.";
        } else {
            document.getElementById("errorConfirmacion").textContent = "Las contraseñas no coinciden.";
            isValid = false;
        }

        // Si todo es válido, mostrar un mensaje
        if (isValid) {
            //alert("Formulario enviado exitosamente. ¡Gracias!");
            formulario.submit(); // Enviamos el formulario si todo es correcto
        }
    }
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
}
