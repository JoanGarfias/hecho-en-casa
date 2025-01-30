//Para el boton de tipo entrega

document.addEventListener("DOMContentLoaded", function () {
    let validarFormulario = true; // Se valida por defecto

    // Botón para omitir validaciones
    document.getElementById('prev').addEventListener('click', function () {
        validarFormulario = false;
        console.log('Sin validaciones');
    });

    // Botón para validar
    document.getElementById('next').addEventListener('click', function () {
        validarFormulario = true;
        console.log('Con validaciones');
    });

    let valorValue = ''

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
    document.getElementById('toggleSelect').addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el botón envíe el formulario o recargue la página.
        const options = document.getElementById('selectOptions');
        options.style.display = (options.style.display === 'none' || options.style.display === '') ? 'block' : 'none';
    });

    document.querySelectorAll('.custom-select-options .option').forEach(option => {
        option.addEventListener('click', function() {
            const value = this.getAttribute('value');
            document.getElementById('tipoEntrega').value = value;
            valorValue = value
            document.getElementById('toggleSelect').textContent = this.textContent;
            document.getElementById('selectOptions').style.display = 'none';
        });
    });

    const formulario = document.getElementById('formularioPedidos')

    formulario.addEventListener("submit", (e) => { 
        if (!validarFormulario) {
            // Si "prev" fue presionado, enviamos sin validar
            console.log("Enviando formulario sin validaciones...");
            return; // Se envía sin restricciones
        }
    // console.log("en el listener");
        const fondoEmergente = document.getElementById('fondoEmergente');
        const flechaNext = document.getElementById('next')
        const editar = document.getElementById('editar')
        const continuar = document.getElementById('continuar')
    
        e.preventDefault(); // Detenemos el envío del formulario
        if (valorValue == ''){
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

});
