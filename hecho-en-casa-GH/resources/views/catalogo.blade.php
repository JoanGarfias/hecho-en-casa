<html>
    <head>
        <script>
            // Aquí pasamos los datos desde PHP a JavaScript
            var categorias = @json($categorias);

            // Usar los datos dentro de JavaScript
            console.log(categorias); // Solo para verificar

            // Aquí puedes usar los datos en el frontend, por ejemplo, para llenar un dropdown
            window.onload = function() {
                var select = document.getElementById('categoriaSelect');
                categorias.forEach(function(categoria) {
                    var option = document.createElement('option');
                    option.value = categoria.id_cat;
                    option.text = categoria.nombre;
                    select.appendChild(option);
                });
            };
        </script>
    </head>
    <body>
        <h3>Selecciona tu categoría</h3>

        <select id="categoriaSelect">
            <option value="">--Selecciona una categoría--</option>
        </select>

        <!-- Aquí puedes usar AJAX para obtener los datos del catálogo según la categoría seleccionada -->
    </body>
</html>
