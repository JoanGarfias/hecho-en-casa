const enlaceOlvidado = document.getElementById('olvidadizo');

    // Agregar un evento de clic al enlace
    enlaceOlvidado.addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el enlace navegue

        // Aquí puedes hacer lo que desees, como mostrar un mensaje o abrir una ventana emergente
        alert('Has hecho clic en "Olvidé mi contraseña"');
        
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