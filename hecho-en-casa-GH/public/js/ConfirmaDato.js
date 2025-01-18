
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
 
