//para el movimiento de los botones de incremento y decremento de porciones
document.querySelector('.incrementar').addEventListener('click', function() {
    var cantidadInput = document.getElementById('porciones');
    cantidadInput.value = parseInt(cantidadInput.value) + 1;
});

document.querySelector('.decrementar').addEventListener('click', function() {
    var cantidadInput = document.getElementById('porciones');
    if (parseInt(cantidadInput.value) > 1) { // No permitir que sea menor que 1
        cantidadInput.value = parseInt(cantidadInput.value) - 1;
    }
});