<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menuCatalogoFijo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/galleta.css') }}">
    <title>Catálogo</title>
</head>
<x-menu/>
<body>
    <!-- Menú lateral -->
    <aside class="menu-lateral">
        <h3>Postres</h3>
        <ul>
            @foreach($categorias as $categoria)
                <li>
                    <a href="#" data-id="{{ $categoria->id_cat }}" onclick="cambiarCategoria(event, this)">
                        {{ $categoria->nombre }}
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>

    <!-- Contenedor de productos -->
    <div class="contenido-principal">
        <h1 class="title">Catálogo de Postres</h1>
        <div id="productos">
            @foreach($catalogo as $producto)
            <div class="main-container">
                <h2>{{ $producto->nombre }}</h2>
                <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                <div class="description-container">
                    <span>{{ $producto->descripcion }}</span>
                    <img class="shopping-bag" src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                </div>
            </div>
            @endforeach
        </div>
    </div>
    

    <script>
        // Función para cambiar la categoría al hacer clic en un enlace del menú lateral
        function cambiarCategoria(event, element) {
            event.preventDefault(); // Evita el comportamiento predeterminado del enlace
            const categoriaId = element.getAttribute("data-id");

            if (categoriaId) {
                // Redirige a la URL con la categoría seleccionada
                window.location.href = `/fijo/catalogo/${categoriaId}`;
            }
        }
    </script>

</body>
</html>
