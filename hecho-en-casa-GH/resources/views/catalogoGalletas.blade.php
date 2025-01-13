<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menuCatalogoFijo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/galleta.css') }}">
    <title>Catálogo de Galletas</title>
</head>
<body>
    <x-menu />

    <div class="layout">
        <x-menu-catalogo />

        <main class="contenido-principal">
            <div class="title">Galletas</div>

            <div class="grid-container">
                <!-- Producto 1 -->
                <div class="main-container">
                    <h2>S’mores</h2>
                    <img src="{{ asset('img/galletaChoco.png') }}" alt="Galleta Smores">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>12 pza:</span>
                            <span>$360</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Rica galleta crujiente</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="main-container">
                    <h2>Chispas de chocolate</h2>
                    <img src="{{ asset('img/galletaChoco.png') }}" alt="Galleta Chispas de chocolate">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>12 pza:</span>
                            <span>$360</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Rica galleta crujiente</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>

                <!-- Producto 3 -->
                <div class="main-container">
                    <h2>Red Velvet</h2>
                    <img src="{{ asset('img/galletaChoco.png') }}" alt="Galleta Red Velvet">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>12 pza:</span>
                            <span>$360</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Rica galleta crujiente</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>

                <!-- Producto 4 -->
                <div class="main-container">
                    <h2>Glorias</h2>
                    <img src="{{ asset('img/galletaChoco.png') }}" alt="Galleta Glorias">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>12 pza:</span>
                            <span>$360</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Rica galleta crujiente</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>

                <!-- Producto 5 -->
                <div class="main-container">
                    <h2>Birthday</h2>
                    <img src="{{ asset('img/galletaChoco.png') }}" alt="Galleta Birthday">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>12 pza:</span>
                            <span>$360</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Rica galleta crujiente</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>
            </div>
        </main>
    </div>

    <x-pie />
</body>
</html>
