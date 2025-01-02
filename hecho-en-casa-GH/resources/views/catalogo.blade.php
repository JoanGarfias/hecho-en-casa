<html>
    <head>
        <script>
            function obtenerCatalogo(categoria) {
                // Realizar una petición GET para obtener los postres de la categoría seleccionada
                fetch(`/catalogo/${categoria}`)
                    .then(response => response.json())
                    .then(data => {
                        // Si se obtienen los datos correctamente, mostrar los postres
                        let catalogoDiv = document.getElementById('catalogo');
                        catalogoDiv.innerHTML = ''; // Limpiar contenido previo

                        // Agregar los postres al catálogo
                        data.forEach(postre => {
                            let postreDiv = document.createElement('div');
                            postreDiv.innerHTML = `
                                <h4>${postre.nombre}</h4>
                                <img src="${postre.imagen}" alt="${postre.nombre}" />
                                <p>${postre.descripcion}</p>
                            `;
                            catalogoDiv.appendChild(postreDiv);
                        });
                    })
                    .catch(error => {
                        console.error('Error al obtener el catálogo:', error);
                    });
            }

            function redirigir() {
                let categoria = document.querySelector('input[name="postre"]:checked');
                
                if (categoria) {
                    // Llamar a la función que obtiene el catálogo de la categoría seleccionada
                    obtenerCatalogo(categoria.value);
                } else {
                    alert("Por favor, selecciona una opción");
                }
            }
        </script>
    </head>
    <body>
        <div id="divEncuesta">
            <h3>Selecciona tu postre</h3>

            <form method="POST" id="formulario">
                <label><input type="radio" value="fijo" name="postre"/>Postre fijo</label>
                <label><input type="radio" value="emergente" name="postre"/>Postre emergente</label>
                <label><input type="radio" value="personalizado" name="postre"/>Postre personalizado</label>
            </form>

            <button type="button" onclick="redirigir()">Elegir</button>
        </div>

        <!-- Aquí se mostrará el catálogo dinámico -->
        <div id="catalogo"></div>
    </body>
</html>
