<form method="POST" action="{{ route('pedido.guardarDireccion') }}">
    @csrf

    <!-- Campo de Teléfono -->
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" value="{{$usuario->telefono}}" placeholder="000 0000 000">

    <!-- Ubicación del pedido -->
    <p>Ubicación del pedido:</p>
    <div>
        <input type="radio" id="direccion_predefinida" name="ubicacion" value="predefinida" checked>
        <label for="direccion_predefinida">
            {{$usuario->calle_u." ".$usuario->num_exterior_u." ".$usuario->colonia_u." ".$usuario->ciudad_u." ".$usuario->estado_u}}
        </label>
    </div>

    <div>
        <input type="radio" id="direccion_otro" name="ubicacion" value="otra">
        <label for="direccion_otro">Otra...</label>
    </div>

    <!-- Campos para nueva dirección -->
    <div>
        <label for="codigo_postal">Código postal:</label>
        <input type="text" id="codigo_postal" name="codigo_postal">

        <label for="calle">Calle:</label>
        <input type="text" id="calle" name="calle">

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" >

        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero" >

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" >

        <label for="colonia">Colonia:</label>
        <input type="text" id="colonia" name="colonia" v>
    </div>

    <!-- Checkbox para establecer como predeterminado -->
    <div>
        <input type="checkbox" id="predeterminado" name="predeterminado" value="1">
        <label for="predeterminado">Establecer como predeterminado</label>
    </div>
    
    <input type="hidden" name="id_usuario" value="{{ $usuario->id_u }}">
    <!-- Botón de Confirmar -->
    <button type="submit">Confirmar</button>
</form>
