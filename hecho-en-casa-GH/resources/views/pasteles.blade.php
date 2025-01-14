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
    <div>  
    <!-- Menú lateral -->
    <div class="menu-lateral">
        <h3>Postres</h3>
        <ul>
        </ul>
        <h3>Pasteles</h3>
        <h3>Temporada y Pop-Up</h3>
    </div>
<div class="container">
    <h1>PASTELES</h1>
    <div class="image-gallery">
        <div class="image-card">
            <img src="img/pastel1.jpg" alt="Pastel 1">
        </div>
        <div class="image-card">
            <img src="img/pastel2.jpg" alt="Pastel 2">
        </div>
        <div class="image-card">
            <img src="img/pastel3.jpg" alt="Pastel 3">
        </div>
        <div class="image-card">
            <img src="img/pastel2.jpg" alt="Pastel 4">
        </div>
    </div>
    <div class="description-section">
        <div class="description">
            <p>Contamos con variedad de pasteles personalizados para diferentes eventos: bodas, XV años, cumpleaños y más.</p>
        </div>
        <form action="{{route('personalizado.catalogo.post')}}" method="POST">
            @csrf
            <div class="customize">
                <button type="submit" class="personaliza">
                    <img src="{{ asset('img/varita.png') }}" alt="Personaliza tu pastel">
                    <span>Personaliza tu pastel</span>
                </button>
            </div>
        </form>
    </div>
</div>
<x-pie/>
</div>
</body>
</html>


