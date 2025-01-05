const enlaceOlvidado = document.getElementById('olvidadizo');

    // Agregar un evento de clic al enlace
    enlaceOlvidado.addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el enlace navegue
        
        // Si quieres hacer una validación antes de mostrar algo, puedes agregar lógica aquí
        const emailInput = document.getElementById('email');
        const href = enlaceOlvidado.getAttribute('href');
        //Hacer la validación del correo desde la BD para ver si existe

        // Verificar si el campo de email tiene valor
        if (emailInput.value.trim() === "") {
            document.getElementById('errorEmail').textContent = 'Ingresa tu correo electrónico para continuar.';
        } else {
            document.getElementById('errorEmail').textContent = '';
            document.getElementById('bienEmail').textContent = 'Correo válido.';
            window.location.href = href;
        }
    });