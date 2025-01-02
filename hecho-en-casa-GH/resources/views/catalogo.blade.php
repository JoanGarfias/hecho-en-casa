<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Postres</title>
</head>
<body>
    <h1>Catálogo de Postres</h1>

    <!-- Dropdown para seleccionar categoría -->
    <select id="categorias" onchange="cambiarCategoria(this.value)">
        <option value="">Selecciona una categoría</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id_cat }}">{{ $categoria->nombre }}</option>
        @endforeach
    </select>
    <button class="buscarProducto">Escojer</button>

    <!-- Contenedor para mostrar los productos -->
    <div id="productos"></div>

    <script>
        // Pasar los productos y categorías a JavaScript
        let catalogo = @json($catalogo);
        let categorias = @json($categorias);
        let buscarProductoBtn = document.querySelector(".buscarProducto");
        
        console.log("Catalogo", catalogo);
        console.log("Categorias", categorias);

        // Función para mostrar los productos en el contenedor
        function mostrarProductos(categoriaId) {
            // Filtramos los productos según la categoría seleccionada
            let productosFiltrados = catalogo.filter(producto => producto.id_categoria == categoriaId);
            
            let productosContainer = document.getElementById("productos");
            productosContainer.innerHTML = ""; // Limpiar productos actuales
    
            // Mostrar los productos filtrados
            productosFiltrados.forEach(producto => {
                let productoElement = document.createElement("div");
                productoElement.classList.add("producto");

                // Crear el elemento de imagen
                let imagenElement = document.createElement("img");
                imagenElement.src = ""; // Inicialmente vacío
                
                // Obtener la URL completa de la imagen usando la función de ImgBB
                obtenerImagenCompleta(producto.imagen, imagenElement);

                productoElement.innerHTML = `
                    <h3>${producto.nombre}</h3>
                    <p>${producto.descripcion}</p>
                `;
                productoElement.appendChild(imagenElement);

                productosContainer.appendChild(productoElement);
            });
        }
    
        // Función para cambiar la URL
        function cambiarCategoria(categoriaId) {
            // Cambiar la URL sin recargar la página
            window.history.pushState({}, "", `/fijo/catalogo/${categoriaId}`);
            // Mostrar los productos de la categoría seleccionada
            mostrarProductos(categoriaId);
        }

        // Función para obtener la URL completa de la imagen desde ImgBB
        function obtenerImagenCompleta(shortLink, imagenElement) {
            // Extraemos el ID del enlace corto
            const imageId = shortLink.split('/').pop(); // Obtiene la última parte del enlace

            // Tu API Key de ImgBB
            const apiKey = 'YOUR_IMGBB_API_KEY'; // Sustituye con tu clave API

            // Hacemos una solicitud a la API de ImgBB
            fetch(`https://api.imgbb.com/1/links/${imageId}?key=${apiKey}`)
                .then(response => response.json())
                .then(data => {
                    if (data.data && data.data.url) {
                        console.log('URL Completa de la imagen:', data.data.url);
                        // Asignamos la URL completa de la imagen al elemento img
                        imagenElement.src = data.data.url;
                    } else {
                        console.error('Error al obtener la imagen');
                    }
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                });
        }

    </script>
    
</body>
</html>
