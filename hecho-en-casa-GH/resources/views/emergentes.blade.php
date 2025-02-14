<!-- Archivo HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Temporada y Pop-Up</title>
    <link rel="stylesheet" href="{{ asset('css/emerpop.css') }}"> <!-- Ruta absoluta -->
</head>
<body>
    <x-menu />
    <x-banner-registrado/>
    <div class="contenedor_principal">
    <!-- Menú lateral -->
    <div class="menu-lateral">
        <h3 id="titulo-postres" style="cursor: pointer;">Postres</h3>
        <ul>
        </ul>
        <h3 id="titulo-pasteles" style="cursor: pointer;">Pasteles</h3>
        <h3>Temporada y Pop-up</h3>
    </div>
    </div>

    
    <script>
        // Redirección para "Pasteles"
        document.getElementById('titulo-pasteles').addEventListener('click', function () {
            window.location.href = "{{ route('personalizado.catalogo.get') }}";
        });

        // Redirección para "Postres"
        document.getElementById('titulo-postres').addEventListener('click', function () {
            window.location.href = "{{ route('fijo.catalogo.get') }}";
        });
    </script>

<div class="container">
    <div class="content">
        <!-- Sección de Temporada -->
        <div class="section temporada">
            <h2>TEMPORADA</h2>
            <div class="carousel" data-carousel="temporada">
                <button class="carousel-button left">&lt;</button>
                <div class="love-day-text">
                    <span>Día del Amor</span><br><span> y la Amistad</span>
                </div>
                <div class="carousel-track">
                    @foreach ($emergentes as $categoria => $items)
                        @if ($categoria == "temporada")
                            <form action="{{route('emergente.catalogo.post')}}" method="POST" id="formularioTemp">
                                @csrf                  
                                <input id="seleccionTemporada" type="hidden" name="id_postre" value="">  
                                @foreach ($items as $item)
                                    <div class="carousel-item">
                                        <div class="image-container">
                                            <img src="{{$item->imagen}}" alt="{{$item->nombre}}" class="imagen_postre">
                                            <img id="{{$item->id_postre}}-temporada" class="shopping-bag" src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                                        </div>
                                    </div>
                                @endforeach     
                            </form>
                        @endif
                    @endforeach
                </div>
                <button class="carousel-button right">&gt;</button>
            </div>
        </div>

        <!-- Sección de Pop-Up -->
        <div class="section popup">
            <h2>POP-UP</h2>
            <div class="carousel" data-carousel="popup">
                <button class="carousel-button left">&lt;</button>
                <div class="love-day-text">
                    <span>Roles</span><br><span>de canela</span>
                </div>
                <div class="carousel-track">
                    @foreach ($emergentes as $categoria => $items)
                        @if ($categoria == "pop-up")
                            <form action="{{route('emergente.catalogo.post')}}" method="POST" id="formularioPopUp">
                                @csrf
                                <input id="seleccionPopup" type="hidden" name="id_postre" value="">                     
                                @foreach ($items as $item)
                                    <div class="carousel-item">
                                        <div class="image-container">
                                            <img src="{{$item->imagen}}" alt="{{$item->nombre}}" class="imagen_postre">
                                            <img id="{{$item->id_postre}}-popup" class="shopping-bag" src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                                        </div>
                                    </div>
                                @endforeach     
                            </form>
                        @endif
                    @endforeach
                </div>
                <button class="carousel-button right">&gt;</button>
            </div>
        </div>
    </div>
</div>
    <div id="mensajeEmergente"></div>
    @if ($errors->has('errorStock'))
        <script>
            mostrarMensaje('{{$errors->first('errorStock')}}');
        </script>
    @endif
    <script>
    
        document.addEventListener("DOMContentLoaded", (event) => {
            let botones = document.querySelectorAll(".shopping-bag");
            botones.forEach(boton =>{
                let id = boton.id;
                let [numero, categoria] = id.split('-');
                
                if(categoria == 'temporada'){
                    boton.addEventListener('click', function(){
                        document.getElementById('seleccionTemporada').value = numero;
                        document.getElementById('formularioTemp').submit();            
                    });
                }else if(categoria == 'popup'){
                    boton.addEventListener('click', function(){
                        document.getElementById('seleccionPopup').value = numero;
                        document.getElementById('formularioPopUp').submit();            
                    });
                }
            });
        });
        
    </script>
       <x-pie/>
    <script src="{{ asset('js/scripte.js') }}"></script>
</body>
</html>
