<link rel="stylesheet" href="{{ asset('css/estilosRegistro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilosContra.css') }}">
    <title>Registro</title>
    <x-menu />

<div class="flexi">
    <div class = "contenedor"><!-- café-->
        <form id="validandoContra" action="" method="">
            <h2 class="titule">Regístrate</h2>
            <br>
            <label for="password" class = "campos">Contraseña:</label>
            <div class="campo-contrasena">
                <input type="password" id="password" name="password" required>
                <i class="fi fi-rs-crossed-eye visibility" onclick="visibility('password', this)"></i>
            </div>
            <div class="mensaje">
                <p id="errorPass" class="error"></p>
                <p id="bienPass" class="bien"></p>
            </div>
            <br>

            <label for="confirmacion" class = "campos">Confirmar contraseña:</label>
            <div class="campo-contrasena">
                <input type="password" id="confirmacion" name="confirmacion" required>
                <i class="fi fi-rs-crossed-eye visibility" onclick="visibility('confirmacion', this)"></i>
            </div>
            <div class="mensaje">
                <p id="errorConfirmacion" class="error"></p>
                <p id="asegurarConfirmacion" class="error"></p>
                <p id="bienConfirmacion" class="bien"></p>
            </div>
            <br>
            <button class="botoncito" type="submit" name="action" value="contrasena" onclick="validateContra()">Continuar</button>
        </form>  
    </div>
</div>

<x-pie/>

<script src="{{ asset('js/validarContrasena.js') }}"></script>
<!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>