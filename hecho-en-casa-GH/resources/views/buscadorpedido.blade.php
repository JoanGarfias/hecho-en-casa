<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/buscarPedido.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mensajeErrorE.css') }}">
    <title>Buscador de Pedidos</title>
    <script src="{{ asset('js/MensajeError.js') }}"></script>   
</head>
<body>
    <x-menu />

    <div class="header">
        <h1 class="titulo">BUSCADOR DE PEDIDOS</h1>
        <div class="search-container">
            <form method="POST" action="{{ route('buscarpedido.post') }}">
                @csrf
                <div class="search-input-container">
                    <input type="text" name="folio" id="folio" placeholder="Ingrese su folio" required>
                    <button type="submit" class="search-button">
                        <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="Buscar">
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    
    
    
    

    @if (isset($pedido))
    <div class="container"> <!-- Contenido principal -->
        <!-- Muestra el folio ingresado -->
        <div class="folio">
            Pedido con folio: <span class="folio-number">{{ $pedido->id_ped }}</span>
        </div>

        <div class="form-columns">
            <!-- Columna izquierda -->
            <div class="form-column">
                <div class="form-group">
                    <label for="tipo-postre">Tipo de postre:</label>
                    <input type="text" id="tipo-postre" value="{{ $tipopostre }}" readonly>
                </div>
                <div class="form-group">
                    <label for="porciones">Porciones:</label>
                    <input type="text" id="porciones" value="{{ (int)$pedido->porcionespedidas }}" readonly>
                </div>
                <div class="form-group">
                    <label for="estatus">Estatus:</label>
                    <button style="background-color: #F8CFA0; font-weight: bold; color: #F3770A; border: none; padding: 10px 20px; border-radius: 5px;">
                        {{ $pedido->status }}
                    </button>
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="form-column">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" value="{{ $nombre_completo }}" readonly>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" value="{{ $telefono }}" readonly>
                </div>
                <div class="form-group">
                    <label for="fecha-entrega">Fecha de entrega:</label>
                    <input type="text" id="fecha-entrega" value="{{ $fecha_entrega }}" readonly>
                </div>
                <div class="form-group">
                    <label for="hora-entrega">Hora de entrega:</label>
                    <input type="time" id="hora-entrega" value="{{ $hora_entrega }}" readonly>
                </div>
                <div class="form-group">
                    <label for="tipo-entrega">Tipo de entrega:</label>
                    <input type="text" id="tipo-entrega" value="{{ $tipo_entrega }}" readonly>
                </div>

                <div class="form-group cost">
                    <label>Costo aprox:</label>
                    <span class="costo-aprox">${{ $precio_final }}</span>
                </div>
            </div>
        </div>
    </div>
    
    @elseif (isset($error))
    <!-- Mensaje de error si el pedido no existe -->
        <div id="mensajeEmergente"></div>
        <script>
            mostrarMensaje('{{$error}}');
        </script>
    @endif

</body>

<script src="{{ asset('js/buscaValida.js') }}"></script>
</html>

<!-- PRUEBA -->