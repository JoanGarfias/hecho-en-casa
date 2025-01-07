<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pedido</title>
</head>
<body>
    <form action="{{ route('emergente.detallesPedido.post') }}" method="POST">
        @csrf

        <label for="fecha-entrega">Fecha de entrega:</label>
        <input type="date" id="fecha-entrega" name="fecha_entrega" value="{{ session('fecha') }}">
        @error('fecha_entrega')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="tipo-postre">Tipo de postre:</label>
        <input type="text" id="tipo_postre" name="tipo_postre" value="{{ session('nombre_postre') }}">
        @error('tipo_postre')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" min="{{session('cantidad_minima')}}" value="{{session('cantidad_minima')}}">
        {{-- <p>Quedan XX porciones disponibles.</p> --}}
        @error('cantidad')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label>Tipo de entrega:</label>
        <div>
            <label><input type="radio" name="tipo_entrega" value="Sucursal" {{ old('tipo_entrega') == 'sucursal' ? 'checked' : '' }}> Recoger en sucursal</label>
            <label><input type="radio" name="tipo_entrega" value="Domicilio" {{ old('tipo_entrega') == 'domicilio' ? 'checked' : '' }}> Envío a domicilio</label>
        </div>
        @error('tipo_entrega')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <p class="costo">Costo: $700.00</p>
        <p class="nota">NOTA: El costo es aproximado, el precio final puede variar según su ubicación.</p>

        <button type="submit">Continuar</button>
    </form>
</body>
</html>
