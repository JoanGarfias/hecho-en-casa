function mostrarMensaje(texto) {
    const mensaje = document.getElementById('mensajeEmergente');
    mensaje.textContent = texto; // Agregar texto al mensaje
    mensaje.style.opacity = '1'; // Mostrar el mensaje
    mensaje.style.visibility = 'visible'; // Asegurarse de que sea visible

    // Ocultar el mensaje después de 3 segundos
    setTimeout(() => {
        mensaje.style.opacity = '0'; // Inicia la transición para ocultar
        setTimeout(() => {
            mensaje.style.visibility = 'hidden'; // Ocultar completamente
        }, 500); // Coincidir con el tiempo de transición de opacity
    }, 3000);
}
