let validoEnviar = true

document.addEventListener('DOMContentLoaded', function () {
    const numbers = document.getElementById("numbers");
    validoEnviar = false
    // Delegación de eventos: Detectar clics solo en elementos con la clase "available"
    numbers.addEventListener("click", function (e) {
        const clickedDay = e.target;
        if (clickedDay.classList.contains("available")) {
            // Deseleccionar el día anterior
            const previouslySelected = numbers.querySelector(".selected");
            if (previouslySelected) {
                previouslySelected.classList.remove("selected");
            }
            console.log('adentro')
            console.log(clickedDay)
            // Seleccionar el nuevo día
            clickedDay.classList.add("selected");

            // Obtener la fecha seleccionada
            const diaNumero = clickedDay.textContent;
            const mes = document.getElementById("mes").value || new Date().getMonth() + 1;
            const anio = document.getElementById("anio").value || new Date().getFullYear();
            const fecha = `${anio}-${String(mes).padStart(2, "0")}-${String(diaNumero).padStart(2, "0")}`;
            console.log("Fecha seleccionada:", fecha);

            console.log (fecha)

            // Guardar en el campo oculto
            const inputFecha = document.getElementById("fechaSeleccionada");
            if (inputFecha) {
                inputFecha.value = fecha;
            }

            validoEnviar = true

            console.log('1' + validoEnviar)
        }
    });
});




//Para la hora
document.addEventListener("DOMContentLoaded", () => {
    const horaInput = document.getElementById("horaEntrega");
    const incrementarBtn = document.getElementById("incrementarHora");
    const decrementarBtn = document.getElementById("decrementarHora");

    // Rango permitido
    const horaMinima = { hora: 11, minutos: 0 }; // 11:00 am
    const horaMaxima = { hora: 19, minutos: 0 }; // 19:00 o 7 pm

    // Función para incrementar la hora
    function incrementarHora() {
        let [hora, minutos] = horaInput.value.split(":").map(Number);
        minutos += 5;
        if (minutos >= 60) {
            minutos = 0;
            hora++;
        }
        verificarRangoYActualizar(hora, minutos);
    }

    // Función para decrementar la hora
    function decrementarHora() {
        let [hora, minutos] = horaInput.value.split(":").map(Number);
        minutos -= 5;
        if (minutos < 0) {
            minutos = 5;
            hora--;
        }
        verificarRangoYActualizar(hora, minutos);
    }

    // Verifica si la hora está dentro del rango permitido
    function verificarRangoYActualizar(hora, minutos) {
        const tiempo = { hora, minutos };
        if (esMenorQue(tiempo, horaMinima)) {
            actualizarHora(horaMinima.hora, horaMinima.minutos);
        } else if (esMayorQue(tiempo, horaMaxima)) {
            actualizarHora(horaMaxima.hora, horaMaxima.minutos);
        } else {
            actualizarHora(hora, minutos);
        }
    }

    // Compara si un tiempo es menor que otro
    function esMenorQue(tiempo1, tiempo2) {
        return tiempo1.hora < tiempo2.hora || (tiempo1.hora === tiempo2.hora && tiempo1.minutos < tiempo2.minutos);
    }

    // Compara si un tiempo es mayor que otro
    function esMayorQue(tiempo1, tiempo2) {
        return tiempo1.hora > tiempo2.hora || (tiempo1.hora === tiempo2.hora && tiempo1.minutos > tiempo2.minutos);
    }

    // Actualiza el valor del campo de hora
    function actualizarHora(hora, minutos) {
        horaInput.value = `${hora.toString().padStart(2, "0")}:${minutos.toString().padStart(2, "0")}`;
    }

    // Validar la hora ingresada manualmente
    function validarHoraIngresada() {
        let [hora, minutos] = horaInput.value.split(":").map(Number);
        if (isNaN(hora) || isNaN(minutos)) {
            actualizarHora(horaMinima.hora, horaMinima.minutos);
        } else {
            verificarRangoYActualizar(hora, minutos);
        }
    }

    // Eventos
    incrementarBtn.addEventListener("click", incrementarHora);
    decrementarBtn.addEventListener("click", decrementarHora);
    horaInput.addEventListener("blur", validarHoraIngresada);

    if (horaInput.value.trim() === "") {
        validoEnviar = false
    }  

    console.log('2' + validoEnviar)
});

document.addEventListener("DOMContentLoaded", () => {
    // Seleccionar el formulario y el botón de envío
    const formulario = document.getElementById("cambioFecha");
    const enviarFormulario = document.getElementById("enviarFormulario");

    console.log('3' + validoEnviar)

    if (validoEnviar){
         // Enviar el formulario solo cuando se hace clic en el botón con id 'enviarFormulario'
         enviarFormulario.addEventListener("click", function() {
            formulario.submit(); // Enviar el formulario cuando se hace clic en el botón específico
        });
        console.log('5' + validoEnviar)
    } else {
       // Detener el envío del formulario cuando se presiona cualquier botón
        formulario.addEventListener("submit", function(event) {
            event.preventDefault(); // Detiene el envío del formulario por defecto

            alert('Por favor, seleccione una fecha o una hora')
        });
        console.log('4' + validoEnviar)
    }
});

