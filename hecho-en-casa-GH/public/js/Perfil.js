// Obtener referencias a los elementos del DOM
const saveButton = document.querySelector('.save-button');
const editarTelButton = document.querySelector('.editarTel');
const editarPasButton = document.querySelector('.editarPas');
const editarDirButton = document.querySelector('.editarDir');

const telefonoInput = document.querySelector('input[type="text"][value="000 000 0000"]');
const passwordInput = document.querySelector('input[type="password"]');
const cpInput = document.querySelector('input[type="text"][value="70610"]');
const estadoInput = document.querySelector('input[type="text"][value="Oaxaca"]');
const ciudadInput = document.querySelector('input[type="text"][value="Salina Cruz"]');
const calleInput = document.getElementById('calle');
const numeroIntInput = document.getElementById('numero-int');
const numeroExtInput = document.getElementById('numero-ext');
const coloniaSelect = document.getElementById('colonia');

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
        coloniaSelect
    ]);
});

// Guardar los cambios
saveButton.addEventListener('click', () => {
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

    console.log('Cambios guardados');
});
