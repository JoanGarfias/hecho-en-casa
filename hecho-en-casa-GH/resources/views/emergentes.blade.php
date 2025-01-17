<!-- Archivo HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporada y Pop-Up</title>
    <link rel="stylesheet" href="emerpop.css">
    <link rel="stylesheet" href="{{ asset('css/emerpop.css') }}"> <!-- Ruta absoluta -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Redirección para "Pasteles"
            document.getElementById('titulo-pasteles').addEventListener('click', function () {
                window.location.href = "{{ route('personalizado.catalogo.get') }}";
            });
    
            // Redirección para "Postres"
            document.getElementById('titulo-postres').addEventListener('click', function () {
                window.location.href = "{{ route('fijo.catalogo.get') }}";
            });
    
            // Configurar botones del carrusel
            document.querySelectorAll('.carousel-button').forEach(button => {
                button.addEventListener('click', function () {
                    const direction = this.classList.contains('right') ? 1 : -1;
                    const carouselId = this.closest('.carousel').id;
                    moveCarousel(carouselId, direction);
                });
            });
        });
    </script>
    
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
    

    <div class="container">
        <div class="content">
            <!-- Sección de Temporada -->
            <div class="section">
                <h2>Temporada</h2>
                <div class="carousel" id="carousel-temporada">
                    <button class="carousel-button left" onclick="moveCarousel('carousel-temporada', -1)">&lt;</button>
                    <div class="carousel-track">
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/rosca.jpg" alt="Imagen 1">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/rosca2.jpg" alt="Imagen 2">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/rosca3.jpg" alt="Imagen 3">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/amor1.jpg" alt="Imagen 4">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/amor2.jpg" alt="Imagen 5">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/amor3.jpg" alt="Imagen 6">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/madre1.jpg" alt="Imagen 7">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/madre2.jpg" alt="Imagen 8">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/madre3.jpg" alt="Imagen 9">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/muerto1.jpg" alt="Imagen 10">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/muerto2.jpg" alt="Imagen 11">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/muerto3.jpg" alt="Imagen 12">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/navidad1.jpg" alt="Imagen 13">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/navidad2.jpg" alt="Imagen 14">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/navidad3.jpg" alt="Imagen 15">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <!-- Agregar más imágenes de Temporada según sea necesario -->
                    </div>
                    <button class="carousel-button right" onclick="moveCarousel('carousel-temporada', 1)">&gt;</button>
                </div>
            </div>

            <!-- Sección de Pop-Up -->
            <div class="section">
                <h2>Pop-Up</h2>
                <div class="carousel" id="carousel-popup">
                    <button class="carousel-button left" onclick="moveCarousel('carousel-popup', -1)">&lt;</button>
                    <div class="carousel-track">
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/emer1.jpg" alt="Imagen 16">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/emer2.jpg" alt="Imagen 17">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/emer3.jpg" alt="Imagen 18">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/emer4.jpg" alt="Imagen 18">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/emer5.jpg" alt="Imagen 19">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="image-container">
                                <img src="img/emer6.jpg" alt="Imagen 20">
                                <img class="shopping-bag" src="{{ asset('img/bolsa3.png') }}" alt="Bolsa de compras">
                            </div>
                        </div>
                        <!-- Agregar más imágenes de Pop-Up según sea necesario -->
                    </div>
                    <button class="carousel-button right" onclick="moveCarousel('carousel-popup', 1)">&gt;</button>
                </div>
            </div>
        </div>
    </div>
    
    <x-pie/>
    <script src="{{ asset('js/scripte.js') }}"></script>
</body>
</html>
