
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

//Para los botones de sabores

document.addEventListener("DOMContentLoaded", () => {
    const toggleSelect = document.getElementById("seleccionar");
    const selectOptions = document.getElementById("seleccionadoOpcion");
    const selectedValue = document.getElementById("agarrarValor");
    const hiddenInput = document.getElementById("tipoEntrega");

    // Mostrar/Ocultar el menú desplegable
    toggleSelect.addEventListener("click", (event) => {
        event.preventDefault();
        selectOptions.style.display =
            selectOptions.style.display === "none" ? "block" : "none";
    });

    // Actualizar el valor seleccionado
    selectOptions.addEventListener("click", (event) => {
        const target = event.target;
        if (target.classList.contains("darOpciones")) {
            const value = target.getAttribute("data-value");
            const text = target.textContent;
            selectedValue.value = text; // Muestra el texto en el input
            hiddenInput.value = value; // Almacena el valor en el input oculto
            selectOptions.style.display = "none"; // Oculta el menú desplegable
        }
    });

    // Cerrar el menú si se hace clic fuera
    document.addEventListener("click", (event) => {
        if (!selectOptions.contains(event.target) && event.target !== toggleSelect) {
            selectOptions.style.display = "none";
        }
    });
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
