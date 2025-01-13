<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menuCatalogoFijo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/catalogoFijo.css') }}">
    <title>Flanes</title>
</head>
<body>
    <x-menu />
    
    <div class="layout">
        <!-- Incluir el menú -->
        <x-menu-catalogo />

        <!-- Contenido principal -->
        <main class="contenido-principal">
            <div class="title">FLANES</div>

            <div class="main-container">
                <h2>NAPOLITANO</h2>
                <img src="{{ asset('img/flan.png') }}" alt="Pay de plátano">
                <div class="outer-circle">
                    <div class="price-circle">
                        <span>10 px:</span>
                        <span>$360</span>
                    </div>
                </div>
            </div>

            <div class="description-container">
                <span>Rico flan napolitano con azucar caramelizada</span>
                <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
            </div>
        </main>
    </div>
</body>
<x-pie />


</html>