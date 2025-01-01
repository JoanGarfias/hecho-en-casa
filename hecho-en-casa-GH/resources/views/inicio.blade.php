

<link rel="stylesheet" href="{{ asset('css/cuerpo.css') }}"> <!-- Ruta absoluta -->
<title>Inicio</title>
<x-menu />

<x-banner />

<main>
    <h2>DESCUBRE</h2>
    <div class="contenedor">
        <div class="seccion temporada">
            <h3>TEMPORADA</h3>
            <img src="{{ asset('img/temporada.png') }}" alt="Pasteles de temporada">
        </div>
        <div class="seccion pasteles">
            <h3>PASTELES</h3>
            <div class="contenedor-flex">
                <img src="{{ asset('img/pasteles.png') }}" alt="Pasteles personalizados">
                <button class="personaliza">
                    <img src="{{ asset('img/varita.png') }}" alt="Personaliza tu pastel">
                    Personaliza tu pastel
                </button>
            </div>
        </div>    
    </div>
</main>
<script src="{{ asset('js/icono.js') }}" defer></script>