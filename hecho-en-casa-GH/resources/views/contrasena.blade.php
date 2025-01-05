<link rel="stylesheet" href="{{ asset('css/estilosRegistro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilosContra.css') }}">
    <title>Registro</title>
    <x-menu />

<div class="flexi">
    <div class = "contenedor"><!-- café-->
        <form id="validandoContra" action="{{route('registrar.guardarContrasena')}}" method="POST">
            @csrf
            <h2 class="titule">Regístrate</h2>
            
            <label for="password" id = "campos">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <div class="mensaje">
            <p id="errorPass" class="error"></p>
            <p id="bienPass" class="bien"></p>
            </div>
            <br>

            <label for="confirmacion" id = "campos">Confirmar contraseña:</label>
            <input type="password" id="confirmacion" name="confirmacion" required>
            <div class="mensaje">
            <p id="errorConfirmacion" class="error"></p>
            <p id="bienConfirmacion" class="bien"></p>
            </div>

            <button class="botoncito" type="submit" name="action" value="contrasena">Continuar</button>
        </form>  
    </div>
</div>

<x-pie/>

<script src="{{ asset('js/validarContrasena.js') }}"></script>
<!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>