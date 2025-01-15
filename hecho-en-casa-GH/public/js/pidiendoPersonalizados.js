//Para los botones de sabores

document.addEventListener("DOMContentLoaded", () => {
    const toggleSelectPan = document.getElementById("seleccionarPan");
    const toggleSelectRelleno = document.getElementById("seleccionarRelleno");
    const toggleSelectCobertura = document.getElementById("seleccionarCobertura");
    const selectOptionsPan = document.getElementById("seleccionadoOpcionPan");
    const selectOptionsRelleno = document.getElementById("seleccionadoOpcionRelleno");
    const selectOptionsCobertura = document.getElementById("seleccionadoOpcionCobertura");
    const selectedValuePan = document.getElementById("agarrarValorPan");
    const selectedValueRelleno = document.getElementById("agarrarValorRelleno");
    const selectedValueCobertura = document.getElementById("agarrarValorCobertura");
    const hiddenInput = document.getElementById("tipoEntrega");

    // Mostrar/Ocultar el menú desplegable
    toggleSelectPan.addEventListener("click", (event) => {
        //event.preventDefault();
        selectOptionsPan.style.display =
            selectOptionsPan.style.display === "none" ? "block" : "none";
    });

    toggleSelectRelleno.addEventListener("click", (event) => {
        //event.preventDefault();
        selectOptionsRelleno.style.display =
            selectOptionsRelleno.style.display === "none" ? "block" : "none";
    });

    toggleSelectCobertura.addEventListener("click", (event) => {
        //event.preventDefault();
        selectOptionsCobertura.style.display =
            selectOptionsCobertura.style.display === "none" ? "block" : "none";
    });

    // Actualizar el valor seleccionado
    selectOptionsPan.addEventListener("click", (event) => {
        const target = event.target;
        if (target.classList.contains("darOpciones")) {
            const value = target.getAttribute("data-value");
            const text = target.textContent;
            selectedValuePan.value = text; // Muestra el texto en el input
            hiddenInput.value = value; // Almacena el valor en el input oculto
            selectOptionsPan.style.display = "none"; // Oculta el menú desplegable
        }
    });

    selectOptionsRelleno.addEventListener("click", (event) => {
        const target = event.target;
        if (target.classList.contains("darOpciones")) {
            const value = target.getAttribute("data-value");
            const text = target.textContent;
            selectedValueRelleno.value = text; // Muestra el texto en el input
            hiddenInput.value = value; // Almacena el valor en el input oculto
            selectOptionsRelleno.style.display = "none"; // Oculta el menú desplegable
        }
    });

    selectOptionsCobertura.addEventListener("click", (event) => {
        const target = event.target;
        if (target.classList.contains("darOpciones")) {
            const value = target.getAttribute("data-value");
            const text = target.textContent;
            selectedValueCobertura.value = text; // Muestra el texto en el input
            hiddenInput.value = value; // Almacena el valor en el input oculto
            selectOptionsCobertura.style.display = "none"; // Oculta el menú desplegable
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
document.getElementById('toggleSelect').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el botón envíe el formulario o recargue la página.
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

const formulario = document.getElementById('formularioPedidos')

formulario.addEventListener("submit", (e) => {
   // console.log("en el listener");
    e.preventDefault(); // Detenemos el envío del formulario
    enviandoForm(); // Llamamos a la función de validación
});


function enviandoForm () {
    //Para enviar el formulario

    const fondoEmergente = document.getElementById('fondoEmergente');
    document.getElementById('next').addEventListener('click', function(event) {
        fondoEmergente.style.display = 'flex';
       // console.log(fondoEmergente)
    });

    document.getElementById('editar').addEventListener('click', function() {   
        fondoEmergente.style.display = 'none';
        //console.log(fondoEmergente)
    });

    document.getElementById('continuar').addEventListener('click', function() {
        document.getElementById('formularioPedidos').submit();
       // console.log('enviando')
    });
}

