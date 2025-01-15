const selencionMenu = document.getElementById("usuario-icon");
const seleccionadoDelMenu = document.getElementById("menu-usuario");
// Mostrar/Ocultar el menú desplegable
selencionMenu.addEventListener("click", (event) => {
    //event.preventDefault();
    seleccionadoDelMenu.style.display =
    seleccionadoDelMenu.style.display === "none" ? "block" : "none";
});

z