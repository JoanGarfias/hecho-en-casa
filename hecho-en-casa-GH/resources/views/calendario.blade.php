<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Fecha</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <h1>Seleccionar Fecha</h1>

    <!-- Formulario para seleccionar mes y año -->


    <!-- AQUI SE TIENE QUE COLOCAR LA LÓGICA PARA SABER QUE RUTA USAR.-->  <!--Si gustan pobrar personalizados ya agarra-->
    <form id="calendario-form" method="POST" action="{{ route('fijo.calendario.post') }}">
        <label for="mes">Mes: </label>
        <input type="number" id="mes" name="mes" min="1" max="12" required>
        <label for="anio">Año: </label>
        <input type="number" id="anio" name="anio" min="1" required>
        @csrf <!-- Token CSRF obligatorio -->
        <button type="submit">Cargar Calendario</button>
    </form>

    <p class="error"></p>>

    <div id="calendario"></div>

    <hr>

    <!-- Formulario para seleccionar fecha
    <h2>Seleccionar Fecha para Pedido</h2>
    <form id="seleccionar-fecha-form">
        <label for="fecha">Fecha: </label>
        <input type="date" id="fecha" name="fecha" required>
        <label for="hora">Hora de entrega: </label>
        <input type="time" id="hora" name="hora" required>
        <label for="id_postre">ID Postre: </label>
        <input type="number" id="id_postre" name="id_postre" required>
        <button type="submit">Seleccionar Fecha</button>
    </form>-->

    <script>
        const calendario = @json($calendarioJson);
        const error = @json($error);
        console.log(calendario);
        console.log(error);


        if(error !== null){
            document.querySelector('.error').textContent = error;
        }
    </script>
</body>
</html>
