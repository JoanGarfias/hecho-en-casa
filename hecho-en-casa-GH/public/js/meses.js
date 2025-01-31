let variableMes
let fechando = ''

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
            botonPrevio.classList.add('desabilitado')
        } 

        
    }

    function calcularBloqueo(diafuturo, diapresente){
        switch(diafuturo){
            case "Saturday":
                return diapresente + 6;
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
    variableMes = mesNumerico
});

//Para seleccionar la fecha

document.addEventListener('DOMContentLoaded', function () {
    const numbers = document.getElementById("numbers");
    // Delegación de eventos: Detectar clics solo en elementos con la clase "available"
    numbers.addEventListener("click", function (e) {
        const clickedDay = e.target;
        if (clickedDay.classList.contains("available")) {
            // Deseleccionar el día anterior
            const previouslySelected = numbers.querySelector(".selected");
            if (previouslySelected) {
                previouslySelected.classList.remove("selected");
            }
            // Seleccionar el nuevo día
            clickedDay.classList.add("selected");

            // Obtener la fecha seleccionada
            const diaNumero = clickedDay.textContent;
            const mes = variableMes;
            const anio = document.getElementById("anio").value || new Date().getFullYear();
            const fecha = `${anio}-${String(mes).padStart(2, "0")}-${String(diaNumero).padStart(2, "0")}`;

            // Guardar en el campo oculto
            const inputFecha = document.getElementById("fechaSeleccionada");
            if (inputFecha) {
                inputFecha.value = fecha;
            }
            
            fechando = fecha

           
        }
    });
    fechando =''
    
});

//Para la hora
document.addEventListener("DOMContentLoaded", () => {
    const horaInput = document.getElementById("horaEntrega");
    const incrementarBtn = document.getElementById("incrementarHora");
    const decrementarBtn = document.getElementById("decrementarHora");

    if ((horaInput != null) && (incrementarBtn != null) && (decrementarBtn != null)){
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

    }    
});

document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.getElementById('cambioFecha');
    const hiddenAction = document.getElementById('botonPress');
    const enviar = document.querySelector('.aceptandoFecha')

    const botones = document.querySelectorAll('.botonPr');
    let action = null; 

    botones.forEach(boton => {
        boton.addEventListener('click', event => {
            event.preventDefault(); 
            action = boton.value; 

            hiddenAction.value = action;

            if (enviar != null){
                if ((action === 'Enviar') && (fechando.trim() === '')){
                    mostrarMensaje('Tienes que seleccionar una fecha')                          
                } else {   
                    formulario.submit();        
                }
            }      
        });
    });
});
