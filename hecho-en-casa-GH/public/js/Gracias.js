// Selección de elementos
const fondoEmergente = document.getElementById('fondoEmergente'); // Fondo del emergente
const botonMostrar = document.getElementById('next'); // Botón para mostrar el emergente
const botonCerrar = document.getElementById('continuar'); // Botón "volver al inicio"

// Mostrar el emergente al hacer clic en "next"
botonMostrar.addEventListener('click', () => {
    fondoEmergente.style.display = 'flex'; // Mostrar el emergente
});

// Cerrar el emergente al hacer clic en "Continuar"
botonCerrar.addEventListener('click', () => {
    fondoEmergente.style.display = 'none'; // Ocultar el emergente
});
