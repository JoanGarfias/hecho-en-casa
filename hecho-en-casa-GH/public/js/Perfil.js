// Obtener referencias a los elementos del DOM
const saveButton = document.querySelector('.save-button');
const editarTelButton = document.querySelector('.editarTel');
const editarPasButton = document.querySelector('.editarPas');
const editarDirButton = document.querySelector('.editarDir');

const telefonoInput = document.getElementById('telefono');
const passwordInput = document.getElementById('contrasena');
const cpInput = document.getElementById('codigopostal');
const estadoInput = document.getElementById('estado');
const ciudadInput = document.getElementById('ciudad');
const calleInput = document.getElementById('calle');
const numeroIntInput = document.getElementById('numero-int');
const numeroExtInput = document.getElementById('numero-ext');
const coloniaSelect = document.getElementById('colonia');
const referenciaInput = document.getElementById('referencia');
const cambiarContrasena = document.getElementById('hiddenAction1');
const cambiarDomicilio = document.getElementById('hiddenAction2');
const cambiarTelefono = document.getElementById('hiddenAction3');

// Función para habilitar edición de uno o más campos
function habilitarEdicion(button, inputs) {
    inputs.forEach(input => {
        if (input.tagName === 'SELECT') {
            input.removeAttribute('disabled');
        } else {
            input.removeAttribute('readonly');
            input.focus();
        }
        input.classList.add('editing');
    });

    saveButton.disabled = false;
    button.disabled = true; // Desactiva el botón de edición
}

// Habilitar edición del teléfono
editarTelButton.addEventListener('click', () => {
    habilitarEdicion(editarTelButton, [telefonoInput]);
});

// Habilitar edición de la contraseña
editarPasButton.addEventListener('click', () => {
    habilitarEdicion(editarPasButton, [passwordInput]);
});

// Habilitar edición de la dirección
editarDirButton.addEventListener('click', () => {
    habilitarEdicion(editarDirButton, [
        cpInput,
        estadoInput,
        ciudadInput,
        calleInput,
        numeroIntInput,
        numeroExtInput,
        coloniaSelect,
        referenciaInput
    ]);
});

// Guardar los cambios
saveButton.addEventListener('click', () => {
    //console.log("abc")
    const form = document.getElementById('Form');
    if(editarTelButton.disabled == true){
        const telefonoReg = /^\d{2,3}[-.\s]?\d{2,3}[-.\s]?\d{4}$/
        if(telefonoReg.test(telefonoInput.value.trim())){
            cambiarTelefono.value = true;
        }
    }

    if(editarPasButton.disabled == true){
        if (/[A-Z]/.test(passwordInput.value) && /[a-z]/.test(passwordInput.value) && /\d/.test(passwordInput.value)) {
        cambiarContrasena.value = true;
        }
    }

    if(editarDirButton.disabled == true){
        if(!/[\<\>]/.test(referenciaInput.value)){
            cambiarDomicilio.value = true;
        }
    }

    if(cambiarTelefono.value || cambiarContrasena.value || cambiarDomicilio.value){
        form.submit();
    }else{
        const editingFields = document.querySelectorAll('.editing');
        editingFields.forEach(field => {
        if (field.tagName === 'SELECT') {
            field.setAttribute('disabled', true);
        } else {
            field.setAttribute('readonly', true);
        }
        field.classList.remove('editing');
    });

    saveButton.disabled = true;

    // Reactivar botones de edición
    editarTelButton.disabled = false;
    editarPasButton.disabled = false;
    editarDirButton.disabled = false;
    }
});
