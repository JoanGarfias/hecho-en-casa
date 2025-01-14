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
        <x-banner-registrado/>
    <!-- Menú lateral -->
    <div class="menu-lateral">
        <h3 id="titulo-postres" style="cursor: pointer;">Postres</h3>

        <ul>
        </ul>
        <h3>Pasteles</h3>
        <h3 id="titulo-emergentes" style="cursor: pointer;">Temporada y Pop-up</h3>
        <ul></ul>
    </div>

    <script>
        document.getElementById('titulo-emergentes').addEventListener('click', function () {
            // Redirige a la ruta /emergentes
            window.location.href = "{{ route('emergente.catalogo.get') }}";
        });
    </script>

    <script>
        document.getElementById('titulo-postres').addEventListener('click', function () {
            // Redirige a la ruta base del catálogo
            window.location.href = "{{ route('fijo.catalogo.get') }}";
        });
    </script>

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
<!--Para la animación del logo de usuario-->
<script src="{{asset ('js/despliegue-menu.js')}}" defer> </script>
<script src="{{ asset('js/icono.js') }}" defer></script>
</html>


