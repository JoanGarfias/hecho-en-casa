<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/buscarPedido.css') }}">
    <title>Buscador de Pedidos</title>
</head>
<body>
    <center>
        <div class="header">
            <h1 class="titulo">Buscador de Pedidos</h1>
            <form method="POST" action="{{ route('buscarpedido.post') }}" class="search-container">
                @csrf
                <input type="number" name="folio" id="folio" placeholder="Buscar pedido" required>
                <button type="submit">
                    <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="Buscar">
                </button>
            </form>
        </div>

        <div class="container">
            <div class="folio">
                Pedido con folio: <span class="folio-number">{{ isset($pedido) ? $pedido->id_ped : '00000' }}</span>
            </div>
            <div class="form-columns">
                <div class="form-column">
                    <div class="form-group">
                        <label for="tipo-postre">Tipo de postre:</label>
                        <input type="text" id="tipo-postre" value="{{ isset($tipopostre) ? $tipopostre : 'Selección' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="porciones">Porciones:</label>
                        <input type="text" id="porciones" value="{{ isset($pedido) ? (int)$pedido->porcionespedidas : 'XX' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="estatus">Estatus:</label>
                        <div class="estatus-options">
                            <?php if (!isset($pedido)): ?>
                                <!-- Mostrar ambas opciones al inicio -->
                                <button class="pending">Pendiente</button>
                                <span>ó</span>
                                <button class="accepted">Aceptada</button>
                            <?php else: ?>
                                <!-- Mostrar solo la opción correspondiente tras la búsqueda -->
                                <?php if ($pedido->status == 'pendiente'): ?>
                                    <button class="pending">Pendiente</button>
                                <?php else: ?>
                                    <button class="accepted">Aceptada</button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                                       
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" value="{{ isset($nombre_completo) ? $nombre_completo : 'XXXXX' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" value="{{ isset($telefono) ? $telefono : 'XXXXX' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fecha-entrega">Fecha de entrega:</label>
                        <input type="text" id="fecha-entrega" value="{{ isset($fecha_entrega) ? $fecha_entrega : 'XX/XX/XXXX' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="hora-entrega">Hora de entrega:</label>
                        <input type="text" id="hora-entrega" value="{{ isset($hora_entrega) ? $hora_entrega : '00:00' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tipo-entrega">Tipo de entrega:</label>
                        <input type="text" id="tipo-entrega" value="{{ isset($tipo_entrega) ? $tipo_entrega : 'Selección' }}" readonly>
                    </div>
                    <div class="form-group cost">
                        <label>Costo aprox:</label>
                        <span class="costo-aprox">{{ isset($precio_final) ? $precio_final : '$0.00' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </center>
</body>
</html>
