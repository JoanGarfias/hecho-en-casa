<link rel="stylesheet" href="{{ asset('css/iniciando.css') }}">
<title>Iniciar sesión</title>
<x-menu />    

<div class="flexi">
<div class = "contenedor">         
    <form action="procesar.php" method="POST" id = "inicioSesion">
        <h2>Iniciar sesión</h2>
        <label for="email">Correo: </label>
        <input type="email" id = "email" name = "email" required> 
        <div class="mensaje">
        <p id="errorEmail" class="error"></p>
        <p id="bienEmail" class="bien"></p>
        </div>

        <br>
        <div class="alineando">
            <label for="password">Contraseña: </label>
            <div class="campo-contrasena">
                <input type="password" id="password" name="password" required>
                <i class="fi fi-rs-crossed-eye visibility" onclick="visibility('password', this)"></i>
            </div>
        </div>
        <div class="mensaje">
        <p id="errorPass" class="error"></p>
        <p id="bienPass" class="bien"></p>
        </div>

        <button id="olvidadizo" type="submit" name="action" value="register">Olvidé mi contraseña</button>
        <br><br>

    <div>
        <button class="botoncito" type="submit" name="action" value="register">Registrarme</button>
        <button class="botoncito" type="submit" name="action" value="login" onclick="validateForm()">Continuar</button>
    </div>
</form>
</div>

<div class="fondo-emergente" id="fondoEmergente">
    <div class="emergente">    
        <p class="mensajeEmergente">Se ha enviado un código de seguridad a tu correo.</p>
        <p class="mensajeEmergente"></p>
        <button id="aceptar" class="aceptando">✔</button>
    </div>
</div>

</div>


<x-pie/>

<script src="{{ asset('js/iniciando.js') }}"></script>
<!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>