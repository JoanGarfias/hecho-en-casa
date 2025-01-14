<!-- Archivo HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporada y Pop-Up</title>
    <link rel="stylesheet" href="emerpop.css">
    <link rel="stylesheet" href="{{ asset('css/emerpop.css') }}"> <!-- Ruta absoluta -->
</head>
<body>
    <x-menu />
    <x-banner-registrado/>
    <!-- Menú lateral -->
    <div class="menu-lateral">
        <h3 id="titulo-postres" style="cursor: pointer;">Postres</h3>
        <ul>
        </ul>
        <h3 id="titulo-pasteles" style="cursor: pointer;">Pasteles</h3>
        <h3>Temporada y Pop-up</h3>
        
    </div>
    <script>
        // Seleccionar el encabezado y agregar evento de clic
        document.getElementById('titulo-pasteles').addEventListener('click', function () {
            // Redirige a la ruta /personalizado
            window.location.href = "{{ route('personalizado.catalogo.get') }}";
        });
    </script>


    <script>
        document.getElementById('titulo-postres').addEventListener('click', function () {
            // Redirige a la ruta base del catálogo
            window.location.href = "{{ route('fijo.catalogo.get') }}";
        });
    </script>

    <div class="container">
        <div class="content">
            <div class="section">
                <h2>Temporada</h2>
                <div class="carousel" id="carousel-temporada">
                    <button class="carousel-button left" onclick="moveCarousel('carousel-temporada', -1)">&lt;</button>
                    <div class="carousel-track">
                        <div class="carousel-item"><img src="img/rosca.jpg" alt="Imagen 1"></div>
                        <div class="carousel-item"><img src="img/rosca2.jpg" alt="Imagen 2"></div>
                        <div class="carousel-item"><img src="img/rosca3.jpg" alt="Imagen 3"></div>
                        <div class="carousel-item"><img src="img/amor1.jpg" alt="Imagen 4"></div>
                        <div class="carousel-item"><img src="img/amor2.jpg" alt="Imagen 5"></div>
                        <div class="carousel-item"><img src="img/amor3.jpg" alt="Imagen 6"></div>
                        <div class="carousel-item"><img src="img/madre1.jpg" alt="Imagen 7"></div>
                        <div class="carousel-item"><img src="img/madre2.jpg" alt="Imagen 8"></div>
                        <div class="carousel-item"><img src="img/madre3.jpg" alt="Imagen 9"></div>
                        <div class="carousel-item"><img src="img/muerto1.jpg" alt="Imagen 10"></div>
                        <div class="carousel-item"><img src="img/muerto2.jpg" alt="Imagen 11"></div>
                        <div class="carousel-item"><img src="img/muerto3.jpg" alt="Imagen 12"></div>
                        <div class="carousel-item"><img src="img/navidad1.jpg" alt="Imagen 13"></div>
                        <div class="carousel-item"><img src="img/navidad2.jpg" alt="Imagen 14"></div>
                        <div class="carousel-item"><img src="img/navidad3.jpg" alt="Imagen 15"></div>
                    </div>
                    <button class="carousel-button right" onclick="moveCarousel('carousel-temporada', 1)">&gt;</button>
                </div>
            </div>

            <div class="section">
                <h2>Pop-Up</h2>
                <div class="carousel" id="carousel-popup">
                    <button class="carousel-button left" onclick="moveCarousel('carousel-popup', -1)">&lt;</button>
                    <div class="carousel-track">
                        <div class="carousel-item"><img src="img/emer1.jpg" alt="Imagen 1"></div>
                        <div class="carousel-item"><img src="img/emer2.jpg" alt="Imagen 2"></div>
                        <div class="carousel-item"><img src="img/emer3.jpg" alt="Imagen 3"></div>
                        <div class="carousel-item"><img src="img/emer4.jpg" alt="Imagen 4"></div>
                        <div class="carousel-item"><img src="img/emer5.jpg" alt="Imagen 5"></div>
                        <div class="carousel-item"><img src="img/emer6.jpg" alt="Imagen 6"></div>
                    </div>
                    <button class="carousel-button right" onclick="moveCarousel('carousel-popup', 1)">&gt;</button>
                </div>
            </div>
        </div>
    </div>
    <x-pie/>
    <script src="{{asset ('js/scripte.js')}}"></scri>

    <script src="{{asset ('js/scripte.js')}}"></script>
    <!--Para la animación del logo de usuario-->
<script src="{{asset ('js/despliegue-menu.js')}}" defer> </script>
<script src="{{ asset('js/icono.js') }}" defer></script>
</body>
</html>