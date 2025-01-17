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

    console.log(horaInput.value);
    
});


