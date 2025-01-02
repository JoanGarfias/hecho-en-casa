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
            <option value="{{ $categoria->id_cat }}" @if($categoria->id_cat == $categoriaSeleccionada) selected @endif>{{ $categoria->nombre }}</option>
        @endforeach
    </select>

    <!-- Contenedor para mostrar los productos -->
    <div id="productos">

    </div>

    <script>
        function obtenerImagenCompleta(shortLink) {
            // Extraemos el ID del enlace corto
            const imageId = shortLink.split('/').pop(); // Obtiene la última parte del enlace

            // Tu API Key de ImgBB
            const apiKey = '2c79d8a7e650f2eab106cb4cc7a2b0d4';

            // Hacemos una solicitud a la API de ImgBB
            fetch(`https://api.imgbb.com/1/links/${imageId}?key=${apiKey}`)
                .then(response => response.json())
                .then(data => {
                    if (data.data && data.data.url) {
                        console.log('URL Completa de la imagen:', data.data.url);
                        // Aquí puedes hacer lo que necesites con la URL completa
                        // Por ejemplo, asignarla a una imagen en el DOM:
                        const imagenElement = document.querySelector('#imagenProducto');
                        imagenElement.src = data.data.url;
                    } else {
                        console.error('Error al obtener la imagen');
                    }
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                });
        }

        // Llamar a la función con el enlace corto de ImgBB
        const shortLink = 'https://ibb.co/abc123'; // Reemplaza con tu enlace corto
        obtenerImagenCompleta(shortLink);



        // Función para cambiar la URL y recargar la página
        function cambiarCategoria(categoriaId) {
            // Cambiar la URL y recargar la página
            window.location.href = `/fijo/catalogo/${categoriaId}`;
        }

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


    </script>
</body>
</html>
