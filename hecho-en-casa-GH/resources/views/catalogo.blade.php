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
            <div class="title">CUPCAKES</div>

            <div class="grid-container">
                <!-- Producto 1 -->
                <div class="main-container">
                    <h2>VAINILLA</h2>
                    <img src="{{ asset('img/cupcakes.png') }}" alt="Vainilla">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>12 pza:</span>
                            <span>$180</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Con frost de mantequilla o queso crema</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="main-container">
                    <h2>CHOCOLATE</h2>
                    <img src="{{ asset('img/cupcakes.png') }}" alt="Cupcake de zanahoria">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>12 pza:</span>
                            <span>$180</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Con frost de mantequilla o queso crema</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>
                

                <!-- Producto 3 -->
                <div class="main-container">
                    <h2>ZANAHORIA</h2>
                    <img src="{{ asset('img/cupcakes.png') }}" alt="Galleta Red Velvet">
                    <div class="outer-circle">
                        <div class="price-circle">
                            <span>12 pza:</span>
                            <span>$180</span>
                        </div>
                    </div>
                    <div class="description-container">
                        <span>Con frost de mantequilla o queso crema</span>
                        <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                    </div>
                </div>
            </div>
        </main>
    </div>

    <x-pie />
    <script src="{{asset ('js/despliegue-menu.js')}}" defer> </script>
    <script src="{{ asset('js/icono.js') }}" defer></script>
</body>

</html>
