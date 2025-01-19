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
                <li class="dropdown" >
                    <a href="#" id="usuario-icon">
                        <img src="{{ asset('img/usuario.png') }}" alt="Usuario">
                    </a>
                    <div class="dropdown-menu" id="menu-usuario" style="display: none;">
                        <button id="primer_boton_perfil"></button>
                        <button id="segundo_boton_perfil"></button>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>
<!--Para la animación del logo de usuario-->
<script src="{{ asset('js/despliegue-menu.js') }}" defer></script>
<script src="{{ asset('js/icono.js') }}" defer></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
    function getCookieByName(name) {
    const cookieString = document.cookie;
    const cookies = cookieString.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith(name + '=')) {
            return cookie.substring(name.length + 1);
        }
    }
    return null;
    }

    // Referencia a los botones
    const boton1 = document.getElementById('primer_boton_perfil');
    const boton2 = document.getElementById('segundo_boton_perfil');

    let sesion = getCookieByName('session_token');
    if (sesion) {
        // Usuario autenticado: Mostrar "Perfil" y "Cerrar sesión"
        boton1.textContent = 'Perfil';
        boton1.onclick = () => {
            window.location.href = '{{ route("perfil.get") }}';
        };

        boton2.textContent = 'Cerrar sesión';
        boton2.onclick = () => {
            window.location.href = '{{ route("cerrarsesion.get") }}';
        };
    } else {
        // Usuario no autenticado: Mostrar "Iniciar sesión" y "Registrarme"
        boton1.textContent = 'Iniciar sesión';
        boton1.onclick = () => {
            window.location.href = '{{ route("login.get") }}';
        };

        boton2.textContent = 'Registrarme';
        boton2.onclick = () => {
            window.location.href = '{{ route("registrar.get") }}';
        };
    }
});
</script>

</body> 
</html>