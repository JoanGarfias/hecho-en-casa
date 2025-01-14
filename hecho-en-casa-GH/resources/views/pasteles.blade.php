<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pastel.css') }}"> <!-- Ruta absoluta -->
    <title>Pasteles</title>
</head>
<body>
    <x-menu />
<div class="container">
    <x-menu-catalogo/>
    <h1>PASTELES</h1>
    <div class="image-gallery">
        <div class="image-card">
            <img src="{{ asset('img/pastel1.jpg') }}" alt="Pastel 1">
        </div>
        <div class="image-card">
            <img src="{{ asset('img/pastel2.jpg') }}" alt="Pastel 2">
        </div>
        <div class="image-card">
            <img src="{{ asset('img/pastel3.jpg') }}" alt="Pastel 3">
        </div>
        <div class="image-card">
            <img src="{{ asset('img/pastel2.jpg') }}" alt="Pastel 4">
        </div>
    </div>
    <div class="description-section">
        <div class="description">
            <p>Contamos con variedad de pasteles personalizados para diferentes eventos: bodas, XV años, cumpleaños y más.</p>
        </div>
        <div class="customize">
            <button class="personaliza">
                <img src="{{ asset('img/varita.png') }}" alt="Personaliza tu pastel">
                <span>Personaliza tu pastel</span>
            </button>
        </div>
    </div>
    <div>
        <footer class="piePa">
            <img src="{{ asset('img/piePag.png') }}" alt="Pie de página informativo">
        </footer>
    </div>
</div>
</body>
</html>


