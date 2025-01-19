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
    const pan = document.getElementById('panElegido');
    const relleno = document.getElementById('rellenoElegido');
    const cobertura = document.getElementById('coberturaElegido');
    
    // Mostrar/Ocultar el menú desplegable
    toggleSelectPan.addEventListener("click", () => {
        selectOptionsPan.style.display = selectOptionsPan.style.display === "none" ? "block" : "none";
    });

    toggleSelectRelleno.addEventListener("click", () => {
        selectOptionsRelleno.style.display = selectOptionsRelleno.style.display === "none" ? "block" : "none";
    });

    toggleSelectCobertura.addEventListener("click", () => {
        selectOptionsCobertura.style.display = selectOptionsCobertura.style.display === "none" ? "block" : "none";
    });

    // Actualizar el valor seleccionado
    const updateSelectedValue = (event, input, menu, oculto) => {
        const target = event.target;
        if (target.classList.contains("darOpciones")) {
            const value = target.getAttribute("data-value");
            const text = target.textContent;
            input.value = text; // Muestra el texto en el input
            oculto.value = value;
            menu.style.display = "none"; // Oculta el menú desplegable
        }
    };

    selectOptionsPan.addEventListener("click", (event) => {
        updateSelectedValue(event, selectedValuePan, selectOptionsPan, pan);
    });

    selectOptionsRelleno.addEventListener("click", (event) => {
        updateSelectedValue(event, selectedValueRelleno, selectOptionsRelleno, relleno);
    });

    selectOptionsCobertura.addEventListener("click", (event) => {
        updateSelectedValue(event, selectedValueCobertura, selectOptionsCobertura, cobertura);
    });

    // Cerrar el menú si se hace clic fuera
    document.addEventListener("click", (event) => {
        if (!selectOptionsPan.contains(event.target) && event.target !== toggleSelectPan) {
            selectOptionsPan.style.display = "none";
        }
        if (!selectOptionsRelleno.contains(event.target) && event.target !== toggleSelectRelleno) {
            selectOptionsRelleno.style.display = "none";
        }
        if (!selectOptionsCobertura.contains(event.target) && event.target !== toggleSelectCobertura) {
            selectOptionsCobertura.style.display = "none";
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
    if (parseInt(cantidadInput.value) > 7) { // No permitir que sea menor que 1
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