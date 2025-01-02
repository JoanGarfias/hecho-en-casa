<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
</head>
<body>
    <h1>Catálogo de Postres</h1>

    <!-- Dropdown para seleccionar categoría -->
    <select id="categorias" onchange="cambiarCategoria(this.value)">
        <option value="">Selecciona una categoría</option> 
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id_cat }}" 
                @if($categoria->id_cat == $categoriaSeleccionada) selected @endif>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
    <button class="buscarProducto">Escojer</button>

    <!-- Contenedor para mostrar los productos -->
    <div id="productos"></div>

    <script>
        // Función para cambiar la URL
        function cambiarCategoria(categoriaId) {
            // Cambiar la URL sin recargar la página
            window.history.pushState({categoriaId: categoriaId}, "", `/fijo/catalogo/${categoriaId}`);
            
            // Mostrar los productos de la categoría seleccionada
            mostrarProductos(categoriaId);
        }

        // Función para manejar la carga de productos de la categoría seleccionada desde la URL
        function cargarProductosDesdeURL() {
            // Obtener la categoría desde la URL
            const urlParts = window.location.pathname.split('/');
            const categoriaId = urlParts[urlParts.length - 1];
            
            // Mostrar los productos de la categoría seleccionada
            mostrarProductos(categoriaId);
        }

        // Llamar a cargarProductosDesdeURL cuando la página se carga
        document.addEventListener('DOMContentLoaded', function() {
            cargarProductosDesdeURL();
        });

        // Llamar a cargarProductosDesdeURL cuando el usuario navega por el historial
        window.onpopstate = function(event) {
            if (event.state && event.state.categoriaId) {
                mostrarProductos(event.state.categoriaId);
            }
        };

        // Función para mostrar los productos en el contenedor
        function mostrarProductos(categoriaId) {
            // Realizar la solicitud AJAX a tu backend para obtener los productos de la categoría seleccionada
            fetch(`/fijo/catalogo/${categoriaId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                // Actualizar los productos y las categorías
                let productosContainer = document.getElementById("productos");
                productosContainer.innerHTML = ""; // Limpiar productos actuales

                // Mostrar los productos filtrados
                data.catalogo.forEach(producto => {
                    let productoElement = document.createElement("div");
                    productoElement.classList.add("producto");
                    productoElement.innerHTML = `
                        <h3>${producto.nombre}</h3>
                        <img src="${producto.imagen}" alt="${producto.nombre}">
                        <p>${producto.descripcion}</p>
                    `;
                    productosContainer.appendChild(productoElement);
                });
            })
            .catch(error => console.error('Error:', error));
        }

    </script>
    
</body>
</html>
