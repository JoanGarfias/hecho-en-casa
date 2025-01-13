<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menuCatalogoFijo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/galleta.css') }}">
    <title>Cokie Cake</title>
</head>
<body>
    <x-menu />

    <div class="layout">
        <x-menu-catalogo />

        <main class="contenido-principal">
            <div class="title">Cokie Cake</div>

            <div class="grid-container">
                <!-- Producto 1 -->
                <div class="main-container">
                    <h2>Chispas de chocolate</h2>
                    <img src="{{ asset('img/CookieCake.png') }}" alt="Chispas">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>6px:</span>
                            <span>$360</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Chispas de chocolate
                        circular o corazón</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="main-container">
                    <h2>Red velvet</h2>
                    <img src="{{ asset('img/CookieCake.png') }}" alt="Chispas de chocolate">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>6 px:</span>
                            <span>$300</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Red velvet
                        circular o corazón</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>
            </div>
        </main>
    </div>

    <x-pie />
</body>
</html>
