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
<x-banner-registrado/>

<body>
    <!-- Menú lateral -->
    <aside class="menu-lateral">
        <h3>Postres:</h3>
        <ul>
            @foreach($categorias as $categoria)
                <li>
                    <a href="#" data-id="{{ $categoria->id_cat }}" onclick="cambiarCategoria(event, this)">
                        {{ $categoria->nombre }}
                    </a>
                </li>
            @endforeach
            <h3 id="titulo-pasteles" style="cursor: pointer;">Pasteles</h3>
            <h3 id="titulo-emergentes" style="cursor: pointer;">Temporada y Pop-up</h3>

        </ul>
    </aside>
    
    <script>
        document.getElementById('titulo-emergentes').addEventListener('click', function () {
            // Redirige a la ruta /emergentes
            window.location.href = "{{ route('emergente.catalogo.get') }}";
        });
    </script>

    <script>
        // Seleccionar el encabezado y agregar evento de clic
        document.getElementById('titulo-pasteles').addEventListener('click', function () {
            // Redirige a la ruta /personalizado
            window.location.href = "{{ route('personalizado.catalogo.get') }}";
        });
    </script>

    <!-- Contenedor de productos -->
    <main class="contenido-principal">
        <h1 class="title">
            {{ $categorias->where('id_cat', $categoriaSeleccionada)->first()->nombre ?? 'Catálogo de Postres' }}
        </h1>
        
        <div id="productos">
            @foreach($catalogo as $producto)
            <div class="main-container">
                <form id="formulario" method="POST" action="{{ route('fijo.catalogo.post') }}">
                    @csrf
                    <input type="hidden" name="id_postre" value="{{ $producto->id_postre }}">
                    <input type="hidden" name="nombre_postre" value="{{ $producto->nombre }}">
                    <h2>{{ $producto->nombre }}</h2>
                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                    <div class="outer-circles-container">
                        @if(isset($producto->Presentaciones) && $producto->Presentaciones->isNotEmpty())
                            @foreach($producto->Presentaciones as $presentacion)
                            <div class="outer-circle">
                                <div class="price-circle">
                                    <span>{{ $presentacion->cantidad }} {{ $presentacion->nombre_unidad }}:</span>
                                    <span>${{ number_format($presentacion->precio_um, 2) }}</span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="outer-circle">
                                <div class="price-circle">
                                    <span>No disponible:</span>
                                    <span>$0.00</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="description-container">
                        <span>{{ $producto->descripcion }}</span>
                        <img class="shopping-bag" src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </main>
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const products = document.querySelectorAll(".main-container"); // Todos los productos
            
            products.forEach(product => {
                const presentations = product.querySelectorAll(".outer-circle"); // Todas las presentaciones de un producto
                
                // Si hay más de una presentación
                if (presentations.length > 1) {
                    presentations.forEach((circle, index) => {
                        if (index === 0) {
                            // Primer círculo: a la izquierda
                            circle.style.left = "10px"; 
                            circle.style.transform = "translateX(-50%)";
                        } else if (index === 1) {
                            // Segundo círculo: a la derecha
                            circle.style.right = "10px"; 
                            circle.style.transform = "translateX(50%)";
                        }
                        circle.style.position = "absolute";
                        circle.style.top = "-70px"; 
                    });
                } 
                // Si hay solo una presentación
                else if (presentations.length === 1) {
                    const circle = presentations[0];
                    circle.style.position = "absolute";
                    circle.style.right = "-15px"; // Alinearlo al borde derecho
                    circle.style.left = "auto"; // Asegurarse de que no quede centrado como los múltiples círculos
                    circle.style.top = "-70px"; // Mantenerlo en la misma línea
                    circle.style.transform = "translateX(0)"; // No aplicar desplazamiento horizontal
                }
            });
        });
    </script>
    
        
    

    <script>
        // Función para cambiar la categoría al hacer clic en un enlace del menú lateral
        function cambiarCategoria(event, element) {
            event.preventDefault(); // Evita el comportamiento predeterminado del enlace
            const categoriaId = element.getAttribute("data-id");
            
            if (categoriaId) {
                // Redirige a la URL con la categoría seleccionada
                let url = "{{ route('fijo.catalogo.get', ':categoria') }}".replace(':categoria', categoriaId);
                window.location.href = url;
            }
        }

        document.addEventListener("DOMContentLoaded", (event) => {
            let botones = document.querySelectorAll(".shopping-bag");
            botones.forEach(boton => {
                boton.addEventListener('click', function(){
                    document.getElementById('formulario').submit();
                });
            });
        });

    </script>

<x-pie/>

</body>
</html>
