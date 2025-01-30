//Para los botones de sabores

let seleccionadoR
let panValue = null
let coberturaValue = null
let rellenoValue = null
let valorValue = ''
let enviarImg = false
let enviarDescrip = false
let enviarOtros = false
let otrosSeleccionado = false
let enviarFormulario = true
let validarFormulario = true; // Se valida por defecto

document.addEventListener("DOMContentLoaded", () => {
    const toggleSelectPan = document.getElementById("seleccionarPan");
    const toggleSelectRelleno = document.getElementById("seleccionarRelleno");
    const toggleSelectCobertura = document.getElementById("seleccionarCobertura");
    const selectOptionsPan = document.getElementById("seleccionadoOpcionPan");
    const selectOptionsRelleno = document.getElementById("seleccionadoOpcionRelleno");
    const selectOptionsCobertura = document.getElementById("seleccionadoOpcionCobertura");
    const selectedValuePan = document.getElementById("agarrarValorPan");
    const selectedValueRelleno = document.getElementById("agarrarValorRelleno");
    const selectedValueCobertura = document.getElementById("agarrarValorCobertura");
    const pan = document.getElementById('panElegido');
    const relleno = document.getElementById('rellenoElegido');
    const cobertura = document.getElementById('coberturaElegido');
    
    // Mostrar/Ocultar el menú desplegable
    toggleSelectPan.addEventListener("click", () => {
        selectOptionsPan.style.display = selectOptionsPan.style.display === "none" ? "block" : "none";
    });

    toggleSelectRelleno.addEventListener("click", () => {
        selectOptionsRelleno.style.display = selectOptionsRelleno.style.display === "none" ? "block" : "none";
    });

    toggleSelectCobertura.addEventListener("click", () => {
        selectOptionsCobertura.style.display = selectOptionsCobertura.style.display === "none" ? "block" : "none";
    });

    // Actualizar el valor seleccionado
    const updateSelectedValue = (event, label, menu, oculto) => {
        const target = event.target;
        if (target.classList.contains("darOpciones")) {
            const value = target.getAttribute("data-value");
            const text = target.textContent;
            label.textContent = text; // Muestra el texto en el label
            oculto.value = value;
            menu.style.display = "none"; // Oculta el menú desplegable
        }
    };

    selectOptionsPan.addEventListener("click", (event) => {
        updateSelectedValue(event, selectedValuePan, selectOptionsPan, pan);
        panValue = pan.value
    });

    selectOptionsRelleno.addEventListener("click", (event) => {
        updateSelectedValue(event, selectedValueRelleno, selectOptionsRelleno, relleno);
        rellenoValue = relleno.value
    });

    selectOptionsCobertura.addEventListener("click", (event) => {
        updateSelectedValue(event, selectedValueCobertura, selectOptionsCobertura, cobertura);
        coberturaValue = cobertura.value
    });

    // Cerrar el menú si se hace clic fuera
    document.addEventListener("click", (event) => {
        if (!selectOptionsPan.contains(event.target) && event.target !== toggleSelectPan) {
            selectOptionsPan.style.display = "none";
        }
        if (!selectOptionsRelleno.contains(event.target) && event.target !== toggleSelectRelleno) {
            selectOptionsRelleno.style.display = "none";
        }
        if (!selectOptionsCobertura.contains(event.target) && event.target !== toggleSelectCobertura) {
            selectOptionsCobertura.style.display = "none";
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const otrosRadio = document.getElementById("otrosRadio");
    const campoOtros = document.getElementById("campoOtros");
    const radios = document.querySelectorAll('input[name="tematica"]'); // Todos los radio buttons

    // Verificar si hay un radio button seleccionado
    function verificarSeleccion() {
        const seleccionado = Array.from(radios).some(radio => radio.checked); // Verifica si alguno está seleccionado
        if (!seleccionado) {
            seleccionadoR = false
        } else {
            seleccionadoR = true
        }
    }

    // Escuchar el evento de cambio en los radio buttons
    radios.forEach(radio => {
        radio.addEventListener("change", () => {
            verificarSeleccion(); // Verifica la selección en tiempo real
           enviarOtros = false
            if (otrosRadio.checked) {

                campoOtros.style.display = "block"; // Mostrar el campo "Otros"
                const textOtros = document.getElementById('otrosTexto')
                otrosSeleccionado = true
                textOtros.addEventListener('input', () => {
                    
                    let valorTexto= textOtros.value.trim()
                    if (textOtros.value.trim() == '' ||(valorTexto.length < 3 || valorTexto.length > 100)){
                        enviarOtros = false
                    } else {
                        enviarOtros = true
                    }
                });
            } else {
                campoOtros.style.display = "none"; // Ocultar el campo "Otros"
                enviarOtros = true
                document.getElementById("otrosTexto").value = ""; // Limpia el campo "Otros" al ocultarlo
            }
        });
    });
});

//Para el boton de tipo entrega
document.getElementById('toggleSelect').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el botón envíe el formulario o recargue la página.
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

const textImg = document.getElementById('imagen')

textImg.addEventListener('input', () => {
    let valorEnlace = textImg.value.trim()
    if (valorEnlace.length < 5 || valorEnlace.length > 255){
        enviarImg = false
    } else {
        enviarImg = true
    }
});

const textDescrip = document.getElementById('descripcion')

textDescrip.addEventListener('input', () => {
    let valorDescrip = textDescrip.value.trim()
    if (valorDescrip.length < 5 || valorDescrip.length > 255){
        enviarDescrip = false
    } else {
        enviarDescrip = true
    }
});

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


const formulario = document.getElementById('formularioPedidos')

formulario.addEventListener("submit", (e) => {
    if (!validarFormulario) {
        console.log("Enviando formulario sin validaciones...");
        return; // Se permite el envío sin validaciones
    }
    
    const fondoEmergente = document.getElementById('fondoEmergente');
    const flechaNext = document.getElementById('next')
    const editar = document.getElementById('editar')
    const continuar = document.getElementById('continuar')

    e.preventDefault(); // Detenemos el envío del formulario
    if ((valorValue == '')|| (!enviarImg) || (!enviarDescrip) || (!seleccionadoR) || (panValue === null) || (coberturaValue === null || !enviarOtros) 
        || (rellenoValue === null)){
            if (!enviarImg){
                mostrarMensaje('Hay un problema con el enlace (muy corto o muy extenso)')
            } else if(!enviarDescrip) {
                mostrarMensaje('Hay un problema con la descripción (muy corta o muy extensa)')
            } else if (otrosSeleccionado && !enviarOtros){
                mostrarMensaje('Hay un problema con la temática (muy corta o muy extensa)')            
            }
            else {
                mostrarMensaje('Tienes que rellenar todos los campos')
            } 
        fondoEmergente.style.display = 'none'
    } else{
        flechaNext.addEventListener('click', function(event) {
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