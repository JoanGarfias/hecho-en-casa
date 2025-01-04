const months = [
    
    { name: "Enero", days: 31,startDay: 2, bg: "url('img/enero.png')" },
    { name: "Febrero", days: 28, startDay: 5, bg: "url('img/febrero.png')" },
    { name: "Marzo", days: 31, startDay: 5, bg: "url('img/marzo.png')" },
    { name: "Abril", days: 30, startDay: 1, bg: "url('img/abril.png')" },
    { name: "Mayo", days: 31, startDay: 3, bg: "url('img/mayo.png')" },
    { name: "Junio", days: 30, startDay: 0, bg: "url('img/junio.png')" },
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
