
//para el movimiento de los botones de incremento y decremento de cantidad
document.querySelector('.incrementar').addEventListener('click', function() {
    var cantidadInput = document.getElementById('cantidad');
    cantidadInput.value = parseInt(cantidadInput.value) + 1;
});

document.querySelector('.decrementar').addEventListener('click', function() {
    var cantidadInput = document.getElementById('cantidad');
    if (parseInt(cantidadInput.value) > 1) { // No permitir que sea menor que 1
        cantidadInput.value = parseInt(cantidadInput.value) - 1;
    }
});

//Para el boton de tipo entrega

document.getElementById('toggleSelect').addEventListener('click', function() {
    const options = document.getElementById('selectOptions');
    options.style.display = (options.style.display === 'none' || options.style.display === '') ? 'block' : 'none';
});

document.querySelectorAll('.custom-select-options .option').forEach(option => {
    option.addEventListener('click', function() {
        const value = this.getAttribute('data-value');
        document.getElementById('tipoEntrega').value = value;
        document.getElementById('toggleSelect').textContent = this.textContent;
        document.getElementById('selectOptions').style.display = 'none';
    });
});
