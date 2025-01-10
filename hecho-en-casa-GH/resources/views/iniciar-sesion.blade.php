<link rel="stylesheet" href="{{ asset('css/iniciando.css') }}">
<title>Iniciar sesión</title>
<x-menu />    

<div class = "contenedor">   
    
    <form action="{{route('login.post')}}" method="POST" id="inicioSesion">
        @csrf
        <h2>Iniciar sesión</h2>
        <label for="email">Correo: </label>
        <input type="email" id = "email" name = "correo_electronico" required> 
        <div class="mensaje">
        <p id="errorEmail" class="error"></p>
        <p id="bienEmail" class="bien"></p>
        </div>

        <br>
        <label for="password">Contraseña: </label>
        <input type="password" id = "pass" name ="contraseña"> 
        <div class="mensaje">
        <p id="errorPass" class="error"></p>
        <p id="bienPass" class="bien"></p>
        </div>
        <div>
            <button class="botoncito" type="submit" name="action" value="recuperar" id="olvidadizo">Olvide mi contraseña</button>
            <button class="botoncito" type="submit" name="action" value="register">Registrarme</button>
            <button class="botoncito" type="submit" name="action" value="login" onclick="validateForm()">Continuar</button>
        </div>
    </form>
</div>
</div>
<x-pie/>

<script src="{{ asset('js/iniciando.js') }}"></script>
<!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>