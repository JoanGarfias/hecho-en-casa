const enlaceOlvidado = document.getElementById('olvidadizo');

    // Agregar un evento de clic al enlace
    enlaceOlvidado.addEventListener('click', function(event) {
        let valido = false;
        event.preventDefault(); // Evita que el enlace navegue
    
        // Si quieres hacer una validación antes de mostrar algo, puedes agregar lógica aquí
        const emailInput = document.getElementById('email');
        
        //Hacer la validación del correo desde la BD para ver si existe

        // Verificar si el campo de email tiene valor
        if (emailInput.value.trim() === "") {
            document.getElementById('bienEmail').textContent = '';
            document.getElementById('errorEmail').textContent = 'Ingresa tu correo electrónico para continuar.';
        } else {
            document.getElementById('errorEmail').textContent = '';
            document.getElementById('bienEmail').textContent = 'Correo válido.';
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
