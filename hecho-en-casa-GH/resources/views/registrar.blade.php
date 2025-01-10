
<link rel="stylesheet" href="{{ asset('css/estilosRegistro.css') }}">
<title>Registro</title>  
<x-menu />

<div class="flexi">
    <div class = "contenedor"><!-- café-->
        <form id="formularioRegistro" action="{{route('registrar.post')}}" method="POST">
            @csrf
            <h2 class="titule">Regístrate</h2>
            
            <label for="name" id = "campos">Nombre:</label>
            <input type="text" id="name" name="name" required>
            <div class="mensaje">
            <p id="errorName" class="error"></p>
            <p id="bienName" class="bien"></p><br>
            </div>

            <label for="apellidoP" id = "campos">Apellido paterno:</label>
            <input type="text" id="apellidoP" name="apellidoP" required>
            <div class="mensaje">
            <p id="errorApellidoPaterno" class="error"></p>
            <p id="bienApellidoPaterno" class="bien"></p><br>
            </div>

            <label for="apellidoM" id = "campos">Apellido materno:</label>
            <input type="text" id="apellidoM" name="apellidoM" required>
            <div class="mensaje">
            <p id="errorApellidoMaterno" class="error"></p>
            <p id="bienApellidoMaterno" class="bien"></p><br>
            </div>

            <label for="phone" id = "campos">Número de teléfono:</label>
            <input type="tel" id="phone" name="phone" required>
            <div class="mensaje">
            <p id="errorPhone" class="error"></p>
            <p id="bienPhone" class="bien"></p><br>
            </div>

            <label for="email" id = "campos">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
            <div class="mensaje">
            <p id="errorEmail" class="error"></p>
            <p id="bienEmail" class="bien"></p><br>
            </div>

            <button class="botoncito" type="submit" name="botones" value="login">Iniciar sesión</button>
            <button class="botoncito" type="submit" name="botones" value="register">Continuar</button>
            <p></p>
        </form>  
    </div>
</div>


    <script src="{{ asset('js/registrando.js') }}"></script>
    <!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>