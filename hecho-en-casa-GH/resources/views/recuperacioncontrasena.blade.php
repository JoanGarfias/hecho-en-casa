<link rel="stylesheet" href="{{ asset('css/estilosRegistro.css') }}">
<link rel="stylesheet" href="{{ asset('css/estilosContra.css') }}">
<title>Registro</title>
<x-menu />

<div class="flexi">
    <div class = "contenedor"><!-- café-->
        <form id="validandoContra" action="{{route('cambiar-clave.post')}}" method="POST">
            @csrf
            <h2 class="titule">Restablecer contraseña</h2>
            <br>
            <label for="password" class = "campos">Crea una nueva contraseña:</label>
            <div class="campo-contrasena">
                <input type="password" id="password" name="password" onfocus="borrarParrafo('mensajePass')"  required>
                <i class="fi fi-rs-crossed-eye visibility" onclick="visibility('password', this)"></i>
            </div>
            <div class="mensajito">
                <p id="mensajePass" class="bien"></p>
            </div>
            <br>

            <label for="confirmacion" class = "campos">Confirma tu nueva contraseña:</label>
            <div class="campo-contrasena">
                <input type="password" id="confirmacion" name="confirmacion" onfocus="borrarParrafo('mensajeConfirmacion')" required>
                <i class="fi fi-rs-crossed-eye visibility" onclick="visibility('confirmacion', this)"></i>
            </div>

            <div class="mensajito">
                <p id="mensajeConfirmacion" class="bien"></p>
            </div>
            <br>
            <button class="botoncito" type="submit" name="action" value="contrasena" onclick="validateContra()">Continuar</button>

            <!--button class="botoncito" type="submit" name="action" value="contrasena">Continuar</button-->

        </form>  
    </div>
</div>

<x-pie/>

<script src="{{ asset('js/validarContrasena.js') }}"></script>

<!--Para mostrar la contraseña-->
<script src="{{ asset('js/mostrarContra.js') }}" defer></script>
<!--Para borrar el parrafo al hacer click al input-->
<script src="{{ asset('js/borrandoParrafo.js') }}" defer></script>
