const months = [
    { name: "Enero", days: 31,startDay: 2, bg: "url('img/enero.png')" },
    { name: "Febrero", days: 28, startDay: 5, bg: "url('img/febrero.png')" },
    { name: "Marzo", days: 31, startDay: 5, bg: "url('img/marzo.png')" },
    { name: "Abril", days: 30, startDay: 1, bg: "url('img/abril.png')" },
    { name: "Mayo", days: 31, startDay: 3, bg: "url('img/mayo.png')" },
    { name: "Junio", days: 30, startDay: 6, bg: "url('img/junio.png')" },
    { name: "Julio", days: 31, startDay: 1, bg: "url('img/julio.png')" },
    { name: "Agosto", days: 31, startDay: 4, bg: "url('img/agosto.png')" },
    { name: "Septiembre", days: 30, startDay: 0, bg: "url('img/septiembre.png')" },
    { name: "Octubre", days: 31, startDay: 2, bg: "url('img/octubre.png')" },
    { name: "Noviembre", days: 30, startDay: 5, bg: "url('img/noviembre.png')" },
    { name: "Diciembre", days: 31, startDay: 0, bg: "url('img/diciembre.png')" },
];

// Días cerrados para cada mes
const closedDays = {
    0: [5, 10, 15], // Enero
    1: [7, 14],     // Febrero
    2: [3, 17],     // Marzo
    // Agrega más meses si es necesario
};

let currentMonth = 0;

function renderCalendar() {
    const calendar = document.getElementById("calendar");
    const numbers = document.getElementById("numbers");

    // Establecer fondo dinámico
    calendar.style.backgroundImage = months[currentMonth].bg;

    // Limpiar días previos
    numbers.innerHTML = "";

    // Agregar días vacíos al inicio según startDay
    for (let i = 0; i < months[currentMonth].startDay; i++) {
        const emptyDay = document.createElement("li");
        emptyDay.classList.add("empty-day"); // Clase para los días vacíos
        numbers.appendChild(emptyDay);
    }

    // Generar días del mes actual
    for (let i = 1; i <= months[currentMonth].days; i++) {
        const day = document.createElement("li");
        day.textContent = i;

        // Día actual
        const today = new Date();
        if (
            i === today.getDate() &&
            currentMonth === today.getMonth() &&
            today.getFullYear() === 2025
        ) {
            day.classList.add("current");
        }
        // Días cerrados
        else if (closedDays[currentMonth]?.includes(i)) {
            day.classList.add("closed");
        }
        // Días disponibles
        else {
            day.classList.add("available");
        }

        numbers.appendChild(day);
    }
}

document.getElementById("prev-month").addEventListener("click", () => {
    currentMonth = (currentMonth - 1 + months.length) % months.length;
    renderCalendar();
});

document.getElementById("next-month").addEventListener("click", () => {
    currentMonth = (currentMonth + 1) % months.length;
    renderCalendar();
});

// Inicializar calendario
renderCalendar();


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
            alert("La hora ingresada no es válida.");
            actualizarHora(horaMinima.hora, horaMinima.minutos);
        } else {
            verificarRangoYActualizar(hora, minutos);
        }
    }

    // Eventos
    incrementarBtn.addEventListener("click", incrementarHora);
    decrementarBtn.addEventListener("click", decrementarHora);
    horaInput.addEventListener("blur", validarHoraIngresada);
});


