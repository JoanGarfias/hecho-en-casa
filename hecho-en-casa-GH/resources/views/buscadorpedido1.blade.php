<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/buscarPedido.css') }}">
    <title>Buscador de Pedidos</title>
</head>
<body>
<x-menu />
    <!-- Encabezado con título y buscador --> 
     <div class="header"> 
        <div class="header">
            <h1 class="titulo">BUSCADOR DE PEDIDOS</h1>
            <div class="search-container">
                <input type="text" placeholder="Buscar pedido">
                <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="Buscar">
            </div>
        </div>

    <div class="container">
        <div class="folio">
            Pedido con folio: <span class="folio-number">00025</span>
        </div>

        <div class="form-columns">
            <!-- Columna izquierda -->
            <div class="form-column">
                <div class="form-group">
                    <label for="tipo-postre">Tipo de postre:</label>
                    <select id="tipo-postre">
                        <option value="">Selección</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="porciones">Porciones:</label>
                    <input type="text" id="porciones" placeholder="XX">
                </div>
                <div class="form-group">
                    <label for="estatus">Estatus:</label>
                    <div class="estatus-options">
                        <button class="pending">Pendiente</button>
                        <span>ó</span>
                        <button class="accepted">Aceptada</button>
                    </div>
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="form-column">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" placeholder="xxxxx">
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" placeholder="xxxxx">
                </div>
                <div class="form-group">
                    <label for="fecha-entrega">Fecha de entrega:</label>
                    <input type="text" id="fecha-entrega" placeholder="xx/xx/xxxx">
                </div>
                <div class="form-group">
                    <label for="hora-entrega">Hora de entrega:</label>
                    <input type="time" id="hora-entrega" value="00:00">
                </div>
                <div class="form-group">
                    <label for="tipo-entrega">Tipo de entrega:</label>
                    <select id="tipo-entrega">
                        <option value="">Selección</option>
                    </select>
                </div>

                <div class="form-group cost">
                    <label>Costo aprox:</label>
                    <span class="costo-aprox">$550.00</span>
                </div>
            </div>
        </div>
    </div>
    <x-pie/>
    
</body>
</html>