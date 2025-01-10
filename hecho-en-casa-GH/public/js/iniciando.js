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
        /* event.preventDefault(); */ // Evita que el enlace navegue
        /////////////////////


        // Si quieres hacer una validación antes de mostrar algo, puedes agregar lógica aquí
        const emailInput = document.getElementById('email');
        //Hacer la validación del correo desde la BD para ver si existe

        // Verificar si el campo de email tiene valor
        if (emailInput.value.trim() === "") {
            document.getElementById('errorEmail').textContent = 'Ingresa tu correo electrónico para continuar.';
        } else {
            document.getElementById('errorEmail').textContent = '';
            document.getElementById('bienEmail').textContent = 'Correo válido.';
        }
    });

    formulario.submit(); // Enviamos el formulario
}