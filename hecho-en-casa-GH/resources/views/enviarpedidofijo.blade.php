<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón Enviar</title>
</head>
<body>
    <form action="fijo/detalles-entrega" method="POST">
        <label for="id_ped">id_ped:</label>
        <input type="text" id="id_ped" name="id_ped" required>
        <hr>

        <label for="id_usuario">id_usuario:</label>
        <input type="text" id="id_usuario" name="id_usuario" required>
        <hr>

        <label for="id_tipopostre">id_tipopostre:</label>
        <input type="text" id="id_tipopostre" name="id_tipopostre" required>
        <hr>

        <label for="id_categoria_postre">id_categoria_postre:</label>
        <input type="text" id="id_categoria_postre" name="id_categoria_postre" required>
        <hr>

        <label for="estado_e">estado_e:</label>
        <input type="text" id="estado_e" name="estado_e" required>
        <hr>

        <label for="Codigo_postal_e">Codigo_postal_e:</label>
        <input type="text" id="Codigo_postal_e" name="Codigo_postal_e" required>
        <hr>

        <label for="ciudad_e:">ciudad_e:</label>
        <input type="text" id="ciudad_e:" name="ciudad_e:" required>
        <hr>

        <label for="colonia_e">colonia_e:</label>
        <input type="text" id="colonia_e" name="colonia_e" required>
        <hr>

        <label for="calle_e">calle_e:</label>
        <input type="text" id="calle_e" name="calle_e" required>
        <hr>

        <label for="num_exterior_e">num_exterior_e:</label>
        <input type="text" id="num_exterior_e" name="num_exterior_e" required>
        <hr>

        <label for="num_interior_e">num_interior_e:</label>
        <input type="text" id="num_interior_e" name="num_interior_e" required>
        <hr>

        <label for="referencia_e">referencia_e:</label>
        <input type="text" id="referencia_e" name="referencia_e" required>
        <hr>

        <label for="porcionespedidas">porcionespedidas:</label>
        <input type="text" id="porcionespedidas" name="porcionespedidas" required>
        <hr>

        <label for="fecha_hora_registro">fecha_hora_registro:</label>
        <input type="text" id="fecha_hora_registro" name="fecha_hora_registro" required>
        <hr>

        <label for="fecha_hora_entrega">fecha_hora_entrega:</label>
        <input type="text" id="fecha_hora_entrega" name="fecha_hora_entrega" required>
        <hr>

        <label for="status">status:</label>
        <input type="text" id="status" name="status" required>
        <hr>

        <label for="precio_final">precio_final:</label>
        <input type="text" id="precio_final" name="precio_final" required>
        <hr>

        <button type="submit">Reaizar pedido</button>
    </form>
</body>
</html>
