const formulario = document.getElementById('inicioSesion');
const hiddenAction = document.getElementById('hiddenAction');

const botones = document.querySelectorAll('.botoncito');
let action = null; 

botones.forEach(boton => {
    boton.addEventListener('click', event => {
        event.preventDefault(); 
        action = boton.value; 
        hiddenAction.value = action;
        switch (action) {
            case 'recuperar':
                if(validarEmail()){
                    activarBlur();
                    formulario.submit();
                };
                break;        
            case 'login':
                if(validarEmail()&&validarContraseña())
                    formulario.submit();
                break;
            case 'register':
                formulario.submit();
                break;
        }
    });
});

function validarEmail() {
    const emailInput = document.getElementById('email');
    const validarEmail = document.getElementById('mensajeEmail');
    if (emailInput.value.trim() === "") {
        validarEmail.textContent = 'Ingresa tu correo electrónico para continuar.';
        validarEmail.className = "error";   
        return false;
    }
    return true;
}   

function validarContraseña(){
    const claveInput = document.getElementById('password');
    const validarClave = document.getElementById('mensajePass');
    if (claveInput.value.trim() === "") {
        validarClave.textContent = 'Ingresa tu contraseña para continuar.';
        validarClave.className = "error";   
        return false;
    }
    return true;
}

function activarBlur(){
    const fondoEmergente = document.getElementById('fondoEmergente');
    fondoEmergente.style.display = 'flex';
    const cerrarPopup = document.getElementById('aceptar')
    cerrarPopup.addEventListener('click', () => {
        fondoEmergente.style.display = 'none';
    });
}