document.addEventListener('DOMContentLoaded', function(){
    calendarioData = JSON.parse(calendario);
    const primerDia = calendarioData.diasDelMes[0].fecha;
    const ultimoDia = calendarioData.diasDelMes[calendarioData.diasDelMes.length - 1].fecha;
    const numeroUltimoDia = parseInt(ultimoDia.split('-')[2], 10);
    const primerDiaNumero = calendarioData.diaSemana; //1 para lunes
    const fecha = new Date(primerDia);
    const mesNumerico = fecha.getUTCMonth() + 1; // 1 para enero
    const inputMes = document.getElementById('mes');
    const formulario = document.getElementById('cambioFecha');
    const inputAnio = document.getElementById('anio');
    const hoy = new Date();
    const hoyanio = hoy.getFullYear(); 
    const hoymes = hoy.getMonth() + 1; 
    const hoydia = hoy.getDate(); 
    const botonPrevio = document.getElementById('prev-month');
    const botonSig = document.getElementById('next-month');


    function renderCalendar() {
        
        const calendar = document.getElementById("calendar");
        const numbers = document.getElementById("numbers");
        // Establecer fondo dinámico
        calendar.style.backgroundImage = `url(${months[mesNumerico-1].bg})`        

        // Limpiar días previos
        numbers.innerHTML = "";

        // Agregar días vacíos al inicio según startDay
        for (let i = 0; i < primerDiaNumero-1; i++) {
            const emptyDay = document.createElement("li");
            emptyDay.classList.add("empty-day"); // Clase para los días vacíos
            numbers.appendChild(emptyDay);
        }

        // Generar días del mes actual
        for (let i = 1; i <= numeroUltimoDia ; i++) {
            const day = document.createElement("li");
            day.textContent = i;

            // Día actual
            const today = new Date();
            if (
                i === today.getDate() &&
                mesNumerico-1 === today.getMonth() &&
                today.getFullYear() === 2025
            ) {
                day.classList.add("current");
            }
            // Días cerrados
            else if (calendarioData.diasDelMes[i-1].porciones>=100) {
                day.classList.add("closed");
            }
            // Días disponibles
            else {
                day.classList.add("available");
            }

            numbers.appendChild(day);
        }
        
        //aqui configuren el css porque no pude quien sabe como funciona esa cosa
        //para que si se esta viendo el mes actual no le deje ir para atras
        if(mesNumerico===hoymes){
            botonPrevio.disabled = true;
        }
    }

    botonPrevio.addEventListener('click', (e) => {
        e.preventDefault();
        mesAux = (mesNumerico - 1) % 12;
        inputMes.value = mesAux;
        inputAnio.value = hoyanio;
        if(mesAux===12) 
            inputAnio.value = hoyanio - 1;
        formulario.submit();
    });

    botonSig.addEventListener('click', (e) => {
        e.preventDefault();
        mesAux = (mesNumerico + 1) % 12;
        inputMes.value = mesAux;
        inputAnio.value = hoyanio;
        if(mesAux===1)
            inputAnio.value = hoyanio + 1;
        
        formulario.submit();
    });

    renderCalendar();
});
