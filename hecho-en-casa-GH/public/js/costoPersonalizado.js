
document.addEventListener('DOMContentLoaded', () => {
    const costoInput = document.getElementById('costo');
    let totalCosto = 0;

    // Actualiza el costo en el input
    function actualizarCosto() {
        costoInput.value = `${totalCosto.toFixed(2)} MXN`;
    }

    // Costo de la selección de sabor de pan
    const saborPanOpciones = document.querySelectorAll('#seleccionadoOpcionPan .darOpciones');
    saborPanOpciones.forEach(opcion => {
        opcion.addEventListener('click', () => {
            const precioPan = parseFloat(opcion.textContent.match(/\d+(\.\d+)?/)[0]);
            totalCosto += precioPan;
            actualizarCosto();
        });
    });

    // Costo de la selección de sabor de relleno
    const saborRellenoOpciones = document.querySelectorAll('#seleccionadoOpcionRelleno .darOpciones');
    saborRellenoOpciones.forEach(opcion => {
        opcion.addEventListener('click', () => {
            const precioRelleno = parseFloat(opcion.textContent.match(/\d+(\.\d+)?/)[0]);
            totalCosto += precioRelleno;
            actualizarCosto();
        });
    });

    // Costo de la selección de cobertura
    const coberturaOpciones = document.querySelectorAll('#seleccionadoOpcionCobertura .darOpciones');
    coberturaOpciones.forEach(opcion => {
        opcion.addEventListener('click', () => {
            const precioCobertura = parseFloat(opcion.textContent.match(/\d+(\.\d+)?/)[0]);
            totalCosto += precioCobertura;
            actualizarCosto();
        });
    });

    // Costo de la selección de elementos adicionales
    const elementosCheckboxes = document.querySelectorAll('input[name="elementos[]"]');
    elementosCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const precioElemento = parseFloat(checkbox.nextElementSibling.textContent.match(/\d+(\.\d+)?/)[0]);
            if (checkbox.checked) {
                totalCosto += precioElemento;
            } else {
                totalCosto -= precioElemento;
            }
            actualizarCosto();
        });
    });

    // Depende del precio de cada porcion
    const porcionesInput = document.getElementById('porciones');
    const incrementarBtn = document.querySelector('.incrementar');
    const decrementarBtn = document.querySelector('.decrementar');
    let precioPorPorcion = 100; // por pones algo 100 pesos cada porcion jaja

    incrementarBtn.addEventListener('click', () => {
        porcionesInput.value = parseInt(porcionesInput.value) + 1;
        totalCosto += precioPorPorcion;
        actualizarCosto();
    });

   /* decrementarBtn.addEventListener('click', () => {
        if (parseInt(porcionesInput.value) > 8) { // Minimo 8 o algo asi recuerdo
            porcionesInput.value = parseInt(porcionesInput.value) - 1;
            totalCosto -= precioPorPorcion;
            actualizarCosto();
        }
    });*/
    

    // actualizar el costo
    actualizarCosto();
});

