//Para el boton de tipo entrega

let valorValue = ''
let seleccionado = false;

document.getElementById('toggleSelect').addEventListener('click', function() {
    event.preventDefault();
    const options = document.getElementById('selectOptions');
    options.style.display = (options.style.display === 'none' || options.style.display === '') ? 'block' : 'none';
});

document.querySelectorAll('.custom-select-options .option').forEach(option => {
    option.addEventListener('click', function() {
        const value = this.getAttribute('data-value');
        document.getElementById('tipoEntrega').value = value;
        valorValue = value
        document.getElementById('toggleSelect').textContent = this.textContent;
        document.getElementById('selectOptions').style.display = 'none';
    });
});

//para el movimiento de los botones de incremento y decremento de porciones
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

// Restringir entrada manual a números
document.getElementById('cantidad').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, ''); // Remueve caracteres no numéricos
});

//Para reestablecer la cantidad si el input está vacío
document.getElementById('cantidad').addEventListener('blur', function() {
    const min = parseInt(this.getAttribute('min'), 10) || 1; // Valor mínimo permitido (por defecto 1)
    const valorActual = parseInt(this.value, 10);

    // Si el valor está vacío, es menor al mínimo o no es un número válido, restablece al mínimo
    if (!valorActual || valorActual < min || isNaN(valorActual)) {
        this.value = min;
    }
});

document.getElementById('next').addEventListener('click', function() {
    // Seleccionar todos los radio buttons con el mismo "name"
    const radios = document.getElementsByName('porciones');
    seleccionado = false
    // Verificar si alguno está seleccionado
    radios.forEach(radio => {
        if (radio.checked) {
            seleccionado = true;
        }
    });
});



const formulario = document.getElementById('formularioPedidos')

formulario.addEventListener("submit", (e) => { 
   // console.log("en el listener");
    const fondoEmergente = document.getElementById('fondoEmergente');
    const flechaNext = document.getElementById('next')
    const editar = document.getElementById('editar')
    const continuar = document.getElementById('continuar')
   
    e.preventDefault(); // Detenemos el envío del formulario
    if ((valorValue == '') || (!seleccionado)){
        mostrarMensaje('Tienes que seleccionar todos los campos')
    } else{
        console.log('Abrir emergente')
        flechaNext.addEventListener('click', function(event) {
            console.log('next')
            fondoEmergente.style.display = 'flex';
        });

        editar.addEventListener('click', function() {   
            fondoEmergente.style.display = 'none';
        });

        continuar.addEventListener('click', function() {
            document.getElementById('formularioPedidos').submit();
        });
    }  
});

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