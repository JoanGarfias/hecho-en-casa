document.addEventListener('DOMContentLoaded', function(){
    calendarioData = JSON.parse(calendario);
    console.log(calendarioData);
    const primerDia = calendarioData.diasDelMes[0].fecha;
    const ultimoDia = calendarioData.diasDelMes[calendarioData.diasDelMes.length - 1].fecha;
    const numeroUltimoDia = parseInt(ultimoDia.split('-')[2], 10);
    const primerDiaNumero = calendarioData.diaSemana; //1 para lunes
    const fecha = new Date(primerDia);
    const mesNumerico = fecha.getUTCMonth() + 1; // 1 para enero
    const anioNumerico = fecha.getUTCFullYear();
    const inputMes = document.getElementById('mes');
    const formulario = document.getElementById('cambioFecha');
    const inputAnio = document.getElementById('anio');
    const hoy = new Date();
    const diaEnLetra = hoy.toLocaleDateString('es-ES', { weekday: 'long' });
    const hoyanio = hoy.getFullYear(); 
    const hoymes = hoy.getMonth() + 1; 
    const botonPrevio = document.getElementById('prev-month');
    const botonSig = document.getElementById('next-month');


    function renderCalendar() {

        const calendar = document.getElementById("calendar");
        const numbers = document.getElementById("numbers");
        // Establecer fondo dinámico
        calendar.style.backgroundImage = months[mesNumerico - 1].bg;

        // Limpiar días previos
        numbers.innerHTML = "";

        
        // Agregar días vacíos al inicio según el primer dia
        for (let i = 0; i < primerDiaNumero-1; i++) {
            const emptyDay = document.createElement("li");
            emptyDay.classList.add("empty-day"); // Clase para los días vacíos
            numbers.appendChild(emptyDay);
        }

        const today = new Date();
        const futureDate = new Date(today);
        futureDate.setDate(today.getDate() + 4); 
        const dayName = futureDate.toLocaleDateString('en-US', { weekday: 'long' });
        const dosmeses = new Date(today); 
        dosmeses.setDate(today.getDate() + 70);
        // Generar días del mes actual
        for (let i = 1; i <= numeroUltimoDia ; i++) {
            const day = document.createElement("li");
            day.textContent = i;
            if (
                i === today.getDate() &&
                mesNumerico-1 === today.getMonth() &&
                anioNumerico === hoyanio
            ) {
                day.classList.add("current");
            }
            // Días cerrados
            else if (calendarioData.diasDelMes[i-1].porciones>=100 //CERRAR DIAS POR PORCIONES
                || (i<today.getDate() &&
                mesNumerico-1 === today.getMonth() &&
                today.getFullYear() === anioNumerico)) //CERRAR DIAS ANTERIORES A LA FECHA ACTUAL
            {
                day.classList.add("closed");
            }
            else if(mesNumerico-1===today.getMonth()
                 && (i>today.getDate() && i<=calcularBloqueo(dayName, today.getDate())))//CERRAR DIAS DESPUES SEGUN REGLA DE NEGOCIO
            {
                day.classList.add("closed");
            }
            // Días disponibles
            else {
                const diaFecha = new Date(anioNumerico, mesNumerico-1, i);
                if(diaFecha>dosmeses){
                    day.classList.add("closed");
                }
                else day.classList.add("available");
            }
            numbers.appendChild(day);
        }
        
        //aqui configuren el css porque no pude quien sabe como funciona esa cosa
        //para que si se esta viendo el mes actual no le deje ir para atras
        if(mesNumerico===hoymes && anioNumerico === hoyanio){
            botonPrevio.disabled = true;
        }
    }

    function calcularBloqueo(diafuturo, diapresente){
        switch(diafuturo){
            case "Saturday":
                return diapresente + 6;
            case "Sunday":
                return diapresente + 5;
            default:
                return diapresente + 4;
        }
    }

    botonPrevio.addEventListener('click', (e) => {
        e.preventDefault();
        mesAux = mesNumerico === 1 ? 12 : (mesNumerico-1);
        inputMes.value = mesAux;
        inputAnio.value = anioNumerico;
        if(mesAux===12) 
            inputAnio.value = anioNumerico - 1;
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
