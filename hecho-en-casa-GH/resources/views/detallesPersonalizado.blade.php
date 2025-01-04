<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pastel Personalizado</title>
</head>
<body>
    <h1>Detalles del Pastel Personalizado</h1>
    
    <script>
        let pan = @json($sabores);
        let relleno = @json($rellenos);
        let elementos = @json($elementos);
        let cobertura = @json($coberturas);

        console.log("Panes: ", pan);
        console.log("Rellenos: ", relleno);
        console.log("Elementos: ", elementos);
        console.log("Coberturas: ", cobertura);
    </script>

    <!-- Formulario para enviar los datos -->
    <form method="POST" action="{{ route('personalizado.detallesPedido.post') }}">
        @csrf <!-- Token de seguridad para formularios en Laravel -->

        <!-- Sabores -->
        <label for="sabor">Selecciona el sabor del pan:</label>
        <select name="sabor_pan" id="sabor">
            @foreach($sabores as $sabor)
                <option value="{{ $sabor->id_sp }}">
                    {{ $sabor->nom_pan }} ({{ $sabor->precio_p }} MXN)
                </option>
            @endforeach
        </select>
        <br><br>

        <!-- Rellenos -->
        <label for="relleno">Selecciona el relleno:</label>
        <select name="sabor_relleno" id="relleno">
            @foreach($rellenos as $relleno)
                <option value="{{ $relleno->id_sr }}">
                    {{ $relleno->nom_relleno }} ({{ $relleno->precio_sr }} MXN)
                </option>
            @endforeach
        </select>
        <br><br>

        <!-- Coberturas -->
        <label for="cobertura">Selecciona la cobertura:</label>
        <select name="cobertura" id="cobertura">
            @foreach($coberturas as $cobertura)
                <option value="{{ $cobertura->id_c }}">
                    {{ $cobertura->nom_cobertura }} ({{ $cobertura->precio_c }} MXN)
                </option>
            @endforeach
        </select>
        <br><br>

        <!-- Elementos -->
        <label for="elementos">Selecciona elementos adicionales:</label>
        <select name="elementos[]" id="elementos" multiple size="5">
            @foreach($elementos as $elemento)
                <option value="{{ $elemento->id_e }}">
                    {{ $elemento->nom_elemento }} ({{ $elemento->precio_e }} MXN)
                </option>
            @endforeach
        </select>
        

        <br><br>
        <label>Tipo de entrega:</label>
        <select name="tipo_entrega" id="entrega">
            <option value="Domicilio">Envío a domiclio</option>
            <option value="Sucursal">Recoge en sucursal</option>
        </select>

        <br><br>

        <label>Tematica:</label>
        <select name="tematica" id="tematica">
            <option>XV Años</option>
            <option>Cumpleaños</option>
            <option>Boda</option>
            <option>Bautizo</option>
        </select>
        
        <br><br>
        <label>Imagen:</label><br>
        <textarea name="imagen" id="imagen" rows="4" cols="50"></textarea>

        <br><br>
        <label>Descripción:</label><br>
        <textarea name="descripcion" id="descripcion" rows="4" cols="50"></textarea>

        <br>
        <label>Costo:</label><br>
        <input type="number" name="costo" value="800" min="100" max="800"></input>
        <br>
        <label>Porciones:</label><br>
        <input type="number" name="porciones"></input>

        <br><br>
        <!-- Botón de envío -->
        <button type="submit">Guardar selección</button>
    </form>
</body>
</html>
