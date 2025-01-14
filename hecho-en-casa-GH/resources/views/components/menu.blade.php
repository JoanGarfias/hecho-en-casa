<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>Document</title>
</head>
<body>
<header>
    <div class="menu">
        <nav>
            <div class="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="menu-izquierdo">
                <li><a href="{{route('inicio.get')}}">Inicio</a></li>
                <li><a href="{{route('calendario.get') }}">Calendario</a></li>
                <li><a href="{{route('fijo.catalogo.get')}}">Catálogo</a></li>
            </ul>
            <img class="logo" src="{{ asset('img/logoO.png') }}" alt="Logo">
            <ul class="menu-derecho">
                <li><a href="{{route('conocenos.get')}}">Conócenos</a></li>
                <li><a href="{{route('buscarpedido.get')}}">Buscar pedido</a></li>
                <li class="dropdown">
                    <a href="#" id="usuario-icon">
                        <img src="{{ asset('img/usuario.png') }}" alt="Usuario">
                    </a>
                    <div class="dropdown-menu" id="menu-usuario">
                        <button onclick="window.location.href='{{route('login.get')}}'">Iniciar sesión</button>
                        <button onclick="window.location.href='{{route('registrar.get')}}'">Registrarme</button>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>
</body>
<script src="{{ asset ('js/despliegue-menu.js') }}" defer> </script>
</html>