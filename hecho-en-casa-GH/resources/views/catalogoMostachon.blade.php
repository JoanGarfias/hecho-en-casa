<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menuCatalogoFijo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/catalogoFijo.css') }}">
    <title>Mostachon</title>
</head>
<body>
    <x-menu />
    
    <div class="layout">
        <!-- Incluir el menú -->
        <x-menu-catalogo />

        <!-- Contenido principal -->
        <main class="contenido-principal">
            <div class="title">MOSTACHÓN</div>

            <div class="main-container">
                <h2>NUEZ</h2>
                <img src="{{ asset('img/mostachon.png') }}" alt="Pay de plátano">
                <div class="outer-circle">
                    <div class="price-circle">
                        <span>6px: $380</span>
                        <span>12px: $360</span>
                    </div>
                </div>
            </div>

            <div class="description-container">
                <span>Merengue y nueces con capa de queso crema y frutas</span>
                <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
            </div>
        </main>
    </div>
</body>
<x-pie />


</html>