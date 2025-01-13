<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menuCatalogoFijo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/catalogoFijo.css') }}">
    <title>Brownies</title>
</head>
<body>
    <x-menu />
    
    <div class="layout">
        <!-- Incluir el menú -->
        <x-menu-catalogo />

        <!-- Contenido principal -->
        <main class="contenido-principal">
            <div class="title">BROWNIES</div>

            <div class="main-container">
                <h2>Chocolate</h2>
                <img src="{{ asset('img/brownies.png') }}" alt="Pay de plátano">
                <div class="outer-circle">
                    <div class="price-circle">
                        <span>8pz: $320</span>
                        <span>16minis: $360</span>
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