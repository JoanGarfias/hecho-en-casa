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
    <form id="calendario-form">
        <label for="mes">Mes: </label>
        <input type="number" id="mes" name="mes" min="1" max="12" required>
        <label for="anio">Año: </label>
        <input type="number" id="anio" name="anio" required>
        <button type="submit">Cargar Calendario</button>
    </form>

    <div id="calendario"></div>

    <hr>

    <!-- Formulario para seleccionar fecha -->
    <h2>Seleccionar Fecha para Pedido</h2>
    <form id="seleccionar-fecha-form">
        <label for="fecha">Fecha: </label>
        <input type="date" id="fecha" name="fecha" required>
        <label for="id_postre">ID Postre: </label>
        <input type="number" id="id_postre" name="id_postre" required>
        <button type="submit">Seleccionar Fecha</button>
    </form>

    <script>
        // Función para cargar el calendario de acuerdo a mes y año
        document.getElementById('calendario-form').addEventListener('submit', function(event) {
            event.preventDefault();
            let mes = document.getElementById('mes').value;
            let anio = document.getElementById('anio').value;

            axios.get(`/fijo/seleccionar-fecha?mes=${mes}&anio=${anio}`)
                .then(function(response) {
                    const diasDelMes = response.data;
                    let calendarioHTML = '<table border="1"><tr><th>Fecha</th><th>Porciones</th></tr>';
                    diasDelMes.forEach(function(dia) {
                        calendarioHTML += `<tr><td>${dia.fecha}</td><td>${dia.porciones}</td></tr>`;
                    });
                    calendarioHTML += '</table>';
                    document.getElementById('calendario').innerHTML = calendarioHTML;
                })
                .catch(function(error) {
                    console.error(error);
                });
        });

        // Función para seleccionar la fecha y hacer validaciones
        document.getElementById('seleccionar-fecha-form').addEventListener('submit', function(event) {
            event.preventDefault();
            let fecha = document.getElementById('fecha').value;
            let idPostre = document.getElementById('id_postre').value;

            axios.post('/fijo/seleccionar-fecha', {
                fecha: fecha,
                id_postre: idPostre
            })
            .then(function(response) {
                alert('Fecha seleccionada correctamente.');
            })
            .catch(function(error) {
                if (error.response && error.response.data) {
                    alert(error.response.data);
                } else {
                    alert('Error al seleccionar la fecha.');
                }
            });
        });
    </script>
</body>
</html>
