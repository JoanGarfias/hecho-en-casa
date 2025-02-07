
// Función para mostrar u ocultar los campos de dirección
function toggleAddressFields() {
    const addressFields = document.getElementById('address-fields');
    const isOtherChecked = document.getElementById('other').checked;
    
    if (isOtherChecked) {
        addressFields.style.display = 'flex';
    } else {
        addressFields.style.display = 'none';
    }
}

// Aplicamos las validaciones en tiempo real
function limpiarEntradaNumerica(id) {
    document.getElementById(id).addEventListener("input", function() {
        this.value = this.value.replace(/\D/g, ""); // Solo permite números
        this.value = this.value.replace(/\s+/g, ""); // Elimina espacios
    });
}

function limpiarEntradaTexto(id) {
    document.getElementById(id).addEventListener("input", function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, ""); // Solo letras y espacios
        this.value = this.value.replace(/^\s+/, ""); // Evita espacios al inicio
        this.value = this.value.replace(/\s{2,}/g, " "); // Evita espacios dobles
    });
}

function limpiarCalle (id){
    document.getElementById(id).addEventListener("input", function() {
        this.value = this.value.replace(/\s{2,}/g, " "); // Evita espacios dobles
    });
}

// Aplicar validaciones a los inputs numéricos
limpiarEntradaNumerica("codigo_postal");
limpiarEntradaNumerica("numeroInt");
limpiarEntradaNumerica("numeroExt");

// Aplicar validaciones a los inputs de texto
limpiarEntradaTexto("estado");
limpiarEntradaTexto("ciudad");
limpiarCalle("calle");

document.addEventListener("DOMContentLoaded", () => {
    let seleccionado = document.querySelector('input[name="ubicacion"]:checked')?.value || 'predeterminada';

    document.querySelectorAll('input[name="ubicacion"]').forEach(radio => {
        radio.addEventListener('change', () => {
            seleccionado = document.querySelector('input[name="ubicacion"]:checked')?.value;
            console.log("Seleccionaste: " + (seleccionado || "Ninguno"));
            toggleAddressFields();
        });
    });

    document.getElementById('direccion').addEventListener("submit", (event) => {
        if (seleccionado === 'otra') {
            event.preventDefault();
            if (!validateDatos()) {
                mostrarMensaje('Debe rellenar los campos requeridos correctamente.');
            } else {
                event.target.submit();
            }
        }
    });
});

function validateDatos() {
    let enviarFormulario = true;
    let campos = {
        codigoPostal: document.getElementById("codigo_postal"),
        estado: document.getElementById("estado"),
        municipio: document.getElementById("ciudad"),
        calle: document.getElementById("calle"),
        numInt: document.getElementById("numeroInt"),
        numExt: document.getElementById("numeroExt"),
        referencias: document.getElementById("referencias"),
        asentamiento: document.getElementById("asentamiento")
    };

    let mensajes = {
        codigoPostal: document.getElementById("mensajeCodigo"),
        estado: document.getElementById("mensajeEstado"),
        municipio: document.getElementById("mensajeMuni"),
        calle: document.getElementById("mensajeCalle"),
        numInt: document.getElementById("mensajeInt"),
        numExt: document.getElementById("mensajeExt"),
        referencias: document.getElementById("mensajeRef"),
        asentamiento: document.getElementById("mensajeAsent")
    };

    let validaciones = {
        codigoPostal: validarLongitud(campos.codigoPostal, mensajes.codigoPostal, 5, 100),
        estado: validarLongitud(campos.estado, mensajes.estado, 3, 100),
        municipio: validarLongitud(campos.municipio, mensajes.municipio, 5, 100),
        calle: validarLongitud(campos.calle, mensajes.calle, 3, 100),
        numInt: validarLongitud(campos.numInt, mensajes.numInt, 0, 45),
        numExt: validarLongitud(campos.numExt, mensajes.numExt, 1, 45),
        referencias: validarLongitud(campos.referencias, mensajes.referencias, 5, 300),
        asentamiento: campos.asentamiento.value.trim().length > 0
    };

    if (!validaciones.asentamiento) {
        mensajes.asentamiento.textContent = "Seleccione una colonia";
        mensajes.asentamiento.className = "error";
    } else {
        mensajes.asentamiento.textContent = "";
    }

    enviarFormulario = Object.values(validaciones).every(val => val === true);
    return enviarFormulario;
}

function validarLongitud(input, mensajeElemento, min, max) {
    let valor = input.value.trim();
    if (valor.length < min || valor.length > max) {
        mensajeElemento.textContent = "Muy corto o muy extenso.";
        mensajeElemento.className = "error";
        return false;
    } else {
        mensajeElemento.textContent = "";
        return true;
    }
}
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
