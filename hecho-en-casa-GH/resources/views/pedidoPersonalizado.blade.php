<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de tu Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5ebe1;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #d16b23;
        }
        .header p {
            font-size: 1.2em;
        }
        .highlight {
            color: red;
            font-weight: bold;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .grid-item {
            display: flex;
            flex-direction: column;
        }
        .grid-item label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .grid-item input,
        .grid-item textarea {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            font-size: 1em;
        }
        .grid-item textarea {
            resize: none;
        }
        .btn-download {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #d16b23;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .btn-download:hover {
            background-color: #b3551b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>RESUMEN DE TU PEDIDO</h1>
            <p>Pedido con folio: <span class="highlight">{{ $ticket_pedido->id_ped ?? 'N/A' }}</span></p>
        </div>
        <div class="grid">
            <div class="grid-item">
                <label for="tipo_postre">Tipo de postre:</label>
                <input type="text" id="tipo_postre" value="{{ $ticket_pedido->id_tipopostre ?? 'No especificado' }}" readonly>
            </div>
            <div class="grid-item">
                <label for="tematica">Temática:</label>
                <input type="text" id="tematica" value="{{ $ticket_pastel->tipo_evento ?? 'No especificada' }}" readonly>
            </div>
            <div class="grid-item">
                <label for="porciones">Porciones:</label>
                <input type="text" id="porciones" value="{{ $ticket_pedido->porcionespedidas ?? 'No especificado' }}" readonly>
            </div>
            <div class="grid-item">
                <label for="estatus">Estatus:</label>
                <input type="text" id="estatus" value="{{ $ticket_pedido->status ?? 'Sin estatus' }}" readonly>
            </div>
            <div class="grid-item">
                <label for="costo">Costo aprox:</label>
                <input type="text" id="costo" value="{{ $ticket_pedido->precio_final ?? 'No especificado' }}" readonly>
            </div>
            <div class="grid-item">
                <label for="sabor_pan">Sabor de pan:</label>
                <input type="text" id="sabor_pan" value="{{ $ticket_pastel->id_saborpan ?? 'No especificado' }}" readonly>
            </div>
            <div class="grid-item">
                <label for="sabor_relleno">Sabor de relleno:</label>
                <input type="text" id="sabor_relleno" value="{{ $ticket_pastel->id_saborrelleno ?? 'No especificado' }}" readonly>
            </div>
            <div class="grid-item">
                <label for="cobertura">Cobertura:</label>
                <input type="text" id="cobertura" value="{{ $ticket_pastel->id_cobertura ?? 'No especificada' }}" readonly>
            </div>
            <div class="grid-item">
                <label for="imagen">Imagen:</label>
                <input type="text" id="imagen" value="{{ $ticket_pastel->imagendescriptiva ?? 'No especificado' }}" readonly>
            </div>
            <div class="grid-item" style="grid-column: span 2;">
                <label for="descripcion">Descripción detallada:</label>
                <textarea id="descripcion" rows="4" readonly>{{ $ticket_pastel->descripciondetallada ?? 'No especificada' }}</textarea>
            </div>
        </div>

        <script>
            let ticket_pastel = @json($ticket_pastel);
            let ticket_pedido = @json($ticket_pedido);
            let datos = @json($datos);

            console.log("pastel", ticket_pastel);
            console.log("pedido", ticket_pedido);
            console.log("datos", datos);
        </script>

        <a class="btn-download">Descargar resumen</a>
    </div>
</body>

</html>
