<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pedidos fijos</title>
</head>
<body>
    <form action="{{ route('fijo.detallesPedido.get') }}" method="POST">
        @csrf

        <label for="fecha-entrega">Fecha de entrega:</label>
        <input type="date" id="fecha-entrega" name="fecha_entrega" value="{{ session('fecha') }}">
        @error('fecha_entrega')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="hora_entrega">Hora de entrega:</label>
        <input type="time" id="hora_entrega" name="hora_entrega" value="{{ session('hora_entrega') }}">
        @error('hora_entrega')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="nombre_categoria">Tipo de postre:</label>
        <input type="text" id="nombre_categoria" name="nombre_categoria" value="{{ session('nombre_categoria') }}">
        @error('nombre_categoria')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="sabor_postre">sabor:</label>
        <input type="text" id="sabor_postre" name="sabor_postre" value="{{ session('sabor_postre') }}">
        @error('sabor_postre')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="unidad_m"> 
            {{ session('lista_unidad')[0]['nombreunidad'] == 'Porciones' ? 'porciones:' : 
               (session('lista_unidad')[0]['nombreunidad'] == 'Piezas' ? 'piezas:' : 
               (session('lista_unidad')[0]['nombreunidad'] == 'Piezas Mini' ? 'piezas mini:' : 'Cantidad:')) }}
        </label>        
        <!--Ahi va la variable nombre_unidad-->
        <select id="unidadm" name="unidadm">
            @if (session('lista_unidad') && count(session('lista_unidad')) > 0)
                @foreach (session('lista_unidad') as $unidad)
                    <option value="{{ $unidad['cantidadporciones'] }}">{{ $unidad['cantidadporciones'] }} {{ $unidad['nombreunidad'] }}</option>
                @endforeach
            @else
                <option>No hay opciones disponibles</option>
            @endif
        </select>
        
        @error('unidadm')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror
        

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" min="{{session('cantidad_minima')}}" value="{{session('cantidad_minima')}}">
        {{-- <p>Quedan XX porciones disponibles.</p> --}}
        @error('cantidad')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <br>
        <br>
        <label>Tipo de entrega:</label>
        <br>
        <br>
        <div>
            <label><input type="radio" name="tipo_entrega" value="sucursal" {{ old('tipo_entrega') == 'sucursal' ? 'checked' : '' }}> Recoger en sucursal</label>
            <label><input type="radio" name="tipo_entrega" value="domicilio" {{ old('tipo_entrega') == 'domicilio' ? 'checked' : '' }}> Envío a domicilio</label>
        </div>
        @error('tipo_entrega')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <p class="costo">Costo: $200</p>
        <p class="nota">NOTA: El costo es aproximado.</p>

        <button type="submit">Continuar</button>
    </form>
</body>
</html>
