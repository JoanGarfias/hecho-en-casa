<link rel="stylesheet" href="{{ asset('css/cuerpo.css') }}"> <!-- Ruta absoluta -->
<link rel="stylesheet" href="{{ asset('css/mensajeErrorE.css') }}">
<script src="{{ asset('js/MensajeError.js') }}"></script>   
<title>Inicio</title>
<x-menu />

<x-banner />

<main>
    <h2>DESCUBRE</h2>
    <div class="contenedor">
        <div class="seccion temporada">
            <h3>TEMPORADA</h3>
            <img src="{{ asset('img/temporada.png') }}" alt="Pasteles de temporada">
            <button class="personaliza" onclick="window.location.href='{{ route('emergente.catalogo.get') }}'">
                <img src="{{ asset('img/varita.png') }}" alt="Personaliza tu pastel">
                Aprovecha que se acaban
            </button>
        </div>
        <div class="seccion pasteles">
            <h3>PASTELES</h3>
            <div class="contenedor-flex">
                <img src="{{ asset('img/pasteles.png') }}" alt="Pasteles personalizados">
                <button class="personaliza" onclick="window.location.href='{{ route('personalizado.catalogo.get') }}'">
                    <img src="{{ asset('img/varita.png') }}" alt="Personaliza tu pastel">
                    Personaliza tu pastel
                </button>
            </div>
        </div>    
    </div>
</main>

    @if (isset($error))
    <!-- Mensaje de error si el pedido no existe -->
        <div id="mensajeEmergente"></div>
        <script>
            mostrarMensaje('{{$error}}');
        </script>
    @endif
<x-pie/>





