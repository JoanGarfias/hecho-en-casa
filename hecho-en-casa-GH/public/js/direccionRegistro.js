 let enviarFormulario = true

 // Función para validar si un campo de solo números es válido
 function esNumeroValido(valor) {
    return /^[0-9]+$/.test(valor); // Solo números, al menos 1 dígito
}

// Función para validar si un campo de solo letras es válido
function esTextoValido(valor) {
    return /^[a-zA-Z\s]+$/.test(valor.trim()); // Solo letras y espacios, sin espacios al inicio o fin
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
limpiarEntradaNumerica("numInt");
limpiarEntradaNumerica("numExt");

// Aplicar validaciones a los inputs de texto
limpiarEntradaTexto("estado");
limpiarEntradaTexto("municipio");
limpiarCalle("calle");

document.addEventListener("DOMContentLoaded", () => {
    let formulario = document.getElementById('formularioRegistro');
    
    formulario.addEventListener("submit", (e) => {
        e.preventDefault(); // Detenemos el envío del formulario
        validateDatos(); // Llamamos a la función de validación
    });   
});

function validateDatos(){
    
    let codigoPostalV = true
    let estadoV = true
    let municipioV = true
    let calleV = true
    let numIntV = true
    let numExtV = true
    let referenciasV = true
    let asentamientoV = true

    let codigoPostal = document.getElementById("codigo_postal")
    let estado = document.getElementById("estado")
    let municipio = document.getElementById("municipio")
    let calle = document.getElementById("calle")
    let numInt = document.getElementById("numInt")
    let numExt = document.getElementById("numExt")
    let referencias = document.getElementById("referencias")
    let asentamiento = document.getElementById("asentamiento")

    let mensajeCodigo = document.getElementById("mensajeCodigo");
    let mensajeEstado = document.getElementById("mensajeEstado");
    let mensajeMunicipio = document.getElementById("mensajeMuni");
    let mensajeCalle= document.getElementById("mensajeCalle");
    let mensajeInt = document.getElementById("mensajeInt");
    let mensajeExt = document.getElementById("mensajeExt");
    let mensajeReferencias = document.getElementById("mensajeRef");
    let mensajeAsentamiento = document.getElementById("mensajeAsent");

    codigoPostalV = validarLongitud(codigoPostal, mensajeCodigo, 5, 100);
    estadoV = validarLongitud(estado, mensajeEstado, 3, 100);
    municipioV = validarLongitud(municipio, mensajeMunicipio, 5, 100);
    calleV = validarLongitud(calle, mensajeCalle, 3, 100);
    numIntV = validarLongitud(numInt, mensajeInt, 0, 45);
    numExtV = validarLongitud(numExt, mensajeExt, 1, 45);
    referenciasV = validarLongitud(referencias, mensajeReferencias, 5, 300);

    if (asentamiento.value.trim() < 1){
        mensajeAsentamiento.textContent = "Seleccione una colonia"
        mensajeAsentamiento.className = "error";
        asentamientoV = false
    } else{
        asentamientoV = true
    }


    if (codigoPostalV && estadoV && municipioV && calleV && numInt && numExtV && referenciasV && asentamientoV){
        enviarFormulario = true
    } else{
        enviarFormulario = false
    }


    if (enviarFormulario) {
        let formulario = document.getElementById('formularioRegistro');
        formulario.submit(); // Enviar el formulario si todas las validaciones son correctas
    }
}

function validarLongitud(input, mensajeElemento, min, max) {
    let valor = input.value.trim();
    if (valor.length < min || valor.length > max) {
        mensajeElemento.textContent = "Muy corto o muy extenso.";
        mensajeElemento.className = "error";
        return false; // Indica que la validación falló
    } else {
        mensajeElemento.textContent = ""; // Limpia el mensaje de error
        return true; // Indica que la validación fue exitosa
    }
}
