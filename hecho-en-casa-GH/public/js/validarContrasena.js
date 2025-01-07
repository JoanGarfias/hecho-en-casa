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
