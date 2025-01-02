<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/estilosRegistro.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Atma:wght@300;400;500;600;700&family=Covered+By+Your+Grace&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Red+Hat+Mono:ital,wght@0,300..700;1,300..700&family=Rethink+Sans:ital,wght@0,400..800;1,400..800&family=Share+Tech+Mono&display=swap" rel="stylesheet">

</head>
<body>
    <div class = "contenedor"><!-- café-->
        <form id="formularioRegistro" action="" method="">
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

            <button class="botoncito" type="submit" name="action" value="login">Iniciar sesión</button>
            <button class="botoncito" type="submit" name="action" value="register" onclick="validateForm()">Continuar</button>
            <p></p>
        </form>  
    </div>
   <!-- <div class = "abajo">
            <p></p>
    </div>-->
</body>
    <script src="{{ asset('js/registrando.js') }}"></script>
</html>