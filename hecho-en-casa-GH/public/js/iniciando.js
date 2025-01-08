const enlaceOlvidado = document.getElementById('olvidadizo');
//////////////////
const botones = document.querySelectorAll('button[type="submit"]');
let formulario = document.querySelector('#inicioSesion');
let valorBoton = "";

botones.forEach((boton) => {
    boton.addEventListener("click", () => {
        valorBoton = boton.value; // Gua rda el valor del botón presionado
    });
});

formulario.addEventListener("submit", (e) => {
    
    e.preventDefault(); // Detenemos el envío del formulario
    const inputOculto = document.createElement("input");
    inputOculto.type = "hidden";
    inputOculto.name = "solicitud";
    inputOculto.value = valorBoton;
    formulario.appendChild(inputOculto);
    validateForm(); // Llamamos a la función de validación
});
/////////////////
function validateForm() {
    // Agregar un  evento de clic al enlace
    enlaceOlvidado.addEventListener('click', function(event) {
        let valido = false;
        event.preventDefault(); // Evita que el enlace navegue
    
        // Si quieres hacer una validación antes de mostrar algo, puedes agregar lógica aquí
        const emailInput = document.getElementById('email');
        //Hacer la validación del correo desde la BD para ver si existe

        let validarEmail = document.getElementById("mensajeEmail")
        validarEmail.textContent = ""
        // Verificar si el campo de email tiene valor
        if (emailInput.value.trim() === "") {
            validarEmail.textContent = 'Ingresa tu correo electrónico para continuar.';
            validarEmail.className = "error";
        } else {
            validarEmail.textContent = 'Correo válido.';
            validarEmail.className = "bien"; 
            /*Para el blur*/
            // Obtener referencias a los elementos
            const fondoEmergente = document.getElementById('fondoEmergente');
           // const cerrarPopup = document.getElementById('cerrarEmergente');

            // Mostrar la ventana emergente
            fondoEmergente.style.display = 'flex';
          

            // Aquí se oculta, pero, podrías hacer otra cosa
            cerrarPopup.addEventListener('click', () => {
                fondoEmergente.style.display = 'none';
            });
        }

    });

} //Se agregó una llave faltante en la línea 60


/*Mostrar la contraseña */
function visibility(id, icon) {

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
