<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menuCatalogoFijo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/galleta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mensajeErrorE.css') }}">
    <script src="{{ asset('js/MensajeError.js') }}"></script>   
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
                <form id="formulario" method="POST" action="{{route("fijo.catalogo.post")}}">
                    @csrf
                    <input type="hidden" name="id_postre" value="{{ $producto->id_postre }}">
                    <input type="hidden" name="nombre_postre" value="{{ $producto->nombre }}">
                    <h2>{{ $producto->nombre }}</h2>
                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
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

        /*Datos de prueba
        let datos = @json($catalogo);
        console.log(datos);
        */

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

    @if ($errors->has('errorPostre'))
        <script>
            mostrarMensaje('{{$errors->first('errorPostre')}}');
        </script>
    @endif

<x-pie/>

</body>
</html>
