<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo Emergentes</title>
</head>
<body>
    <h2>Temporada</h2>
    <div>
        <form action="{{route('emergente.catalogo.post')}}" method="POST">
            @csrf
            @foreach ($emergentes['temporada'] as $item)
                <div>
                    <img src="{{ $item->imagen }}" alt="Postre Temporada">            
                    <p>Nombre: {{$item->nombre}}</p>
                    <p>Precio: {{$item->precio_emergentes}}</p>
                    <button type="submit" name="comprar" value="{{$item->id_postre}}">Comprar</button>
                </div>    
            @endforeach
        </form>
    </div>

    <h2>Pop-Up</h2>
    <div>
        <form action="{{route('emergente.catalogo.post')}}" method="POST">
            @csrf
            @foreach ($emergentes['pop-up'] as $item)
                <div>
                    <img src="{{ $item->imagen }}" alt="{{ $item->nombre }}">
                    <p>Nombre: {{ $item->nombre }}</p>
                    <p>Descripción: {{ $item->descripcion }}</p>
                    <p>Stock: {{ $item->stock }}</p>
                    <p>Precio: {{$item->precio_emergentes}}</p>
                    <button type="submit" name="comprar" value="{{$item->id_postre}}">Comprar</button>
                </div>
            @endforeach
        </form>
    </div>
</body>
</html>
