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

//para el movimiento de los botones de incremento y decremento de porciones
/*document.querySelector('.incrementar').addEventListener('click', function() {
    var cantidadInput = document.getElementById('cantidad');
    cantidadInput.value = parseInt(cantidadInput.value) + 1;
});

document.querySelector('.decrementar').addEventListener('click', function() {
    var cantidadInput = document.getElementById('cantidad');
    if (parseInt(cantidadInput.value) > 1) { // No permitir que sea menor que 1
        cantidadInput.value = parseInt(cantidadInput.value) - 1;
    }
});*/

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

