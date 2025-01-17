
// Función para mostrar u ocultar los campos de dirección
function toggleAddressFields() {
    const addressFields = document.getElementById('address-fields');
    const isOtherChecked = document.getElementById('other').checked;
    
    if (isOtherChecked) {
        addressFields.style.display = 'block';
    } else {
        addressFields.style.display = 'none';
    }
}
 
// Función para habilitar campos después de confirmar el CP
document.getElementById('confirm-cp').addEventListener('click', function () {
    const cpInput = document.getElementById('codigo_postal');
    const calleInput = document.getElementById('calle');
    const estadoInput = document.getElementById('estado');
    const numeroIntInput = document.getElementById('numeroInt'); // Cambiado a numeroInt
    const numeroExtInput = document.getElementById('numeroExt'); // Cambiado a numeroExt
    const ciudadInput = document.getElementById('ciudad');
    const coloniaSelect = document.getElementById('asentamiento');
    const checklistInput = document.querySelector('.checklist input'); // Asegura seleccionar el input del checklist

    if (cpInput.value.trim() !== '') {
        // Habilitar los campos
        calleInput.disabled = false;
        estadoInput.disabled = false;
        numeroIntInput.disabled = false; // Habilitar número interno
        numeroExtInput.disabled = false; // Habilitar número externo
        ciudadInput.disabled = false;
        coloniaSelect.disabled = false;
        checklistInput.disabled = false;
    } else {
        alert('Por favor, ingresa un código postal válido.');
    }
});
