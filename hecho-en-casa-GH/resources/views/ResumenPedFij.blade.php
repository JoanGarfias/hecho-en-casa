<title>RESUMEN FIJO</title>
<link rel="stylesheet" href="{{ asset('css/ResumenPedFij.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

  <x-menu /> 

</head>
<body>

<!-- Título de la página -->
<h1>RESUMEN DE PEDIDO</h1>

   <div class="main-container">
       <!-- Tarjeta de perfil -->
       <!-- <div class="resumen-card"> --> 
       <div class="resumen-card"> 

           <div class="FOLIO-info"> <!--user-info -->
               <h2 class="Folio-name">Pedido con folio:</h2>
               <input type="text" id="folio" name="folio" value="{{session('folio')}}" readonly>
             
           </div>

           <div class="details">

               <div class="left-column">
                   <label for="tipo_postre">Tipo de postre:</label>
                   <input type="text" id="tipo_postre" value="{{session('nombre_categoria')}}" readonly>

                   
                    @if ($tipo_postre == "fijo")
                        <label for="sabor">Sabor:</label>
                        <input type="text" id="sabor" value="{{session('sabor_postre')}}" readonly>
                        <label for="porciones">Porciones:</label>     
                        <input type="text" id="porciones" value="{{session('porcionestotal')}}" readonly>
                    @elseif ($tipo_postre == "temporada" || $tipo_postre == "pop-up")
                        <label for="sabor">Nombre:</label>
                        <input type="text" id="sabor" value="{{session('sabor_postre')}}" readonly>
                        <label for="cantidad">Cantidad:</label>     
                        <input type="text" id="cantidad" value="{{session('cantidad_pedida')}}" readonly>
                    @endif

               </div>

               <div class="right-column">

                    <label for="nombre">Nombre:</label>
                   <input type="text" id="nombre" value="{{$nombre}}" readonly>
                   
                   <label for="telefono">Teléfono:</label>
                   <input type="text" id="telefono" value="{{$telefono}}" readonly>

                   <label for="fecha_entrega">Fecha de entrega:</label>
                   <input type="text" id="fecha_entrega" value="{{$fecha}}" readonly>

                   <label for="hora_entrega">Hora de entrega:</label>
                   <input type="text" id="hora_entrega" value="{{$hora}}" readonly>

                   <label for="tipo_entrega">Tipo de entrega:</label>
                   <input type="text" id="tipo_entrega" value="{{$tipo_entrega}}" readonly>

                   <label for="costo_aproximado">Costo Apróximado:</label>
                   <input type="text" id="costo_aproximado" value="${{$costo}}" readonly>
               </div>
           </div>
           <button class="descargarPDF-button"> 
                <img id="logo-hidden" src="{{ asset('img/logo.png') }}" alt="Logo" style="display: none;">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c
                    6QAAAclJREFUaEPtmuFNxDAMhX2bwCTAJjAJMAlsAkwCm0Cf1EpVLmnsBrdO+yLdj7smrZ8/23UCFznZuJxMr1Dw0YmTM
                    AkfzAMM6YMBvZJDws6EX0TkOXnG6/Adv28ytiZMwSJCwp6xzZD29O5YnFi0WKUdw4w57Ohc3JrvYb6HnUOMOezsYOYwc9
                    g5xJjDo4NzG3LtJv1RRG4KoO5E5D659ikiX4X5P8O93pXQVTaXCP9mHqKNBoj9VhpZm/YwOAgO0QyVzR6CYRwov2msXJh
                    jEYvb7Cq41EZqfQCqEGwZuwtGaINymrM1EWvEhiAMIyD6Y6GIpeJRpG5rHilc353wZJeliFnzdq49jGBtEWsRGyak5wRy
                    ffR0fW3ehiU85XOuiP2H2JCEc0WspUiltStUDs+Nmxex1rwNHdJz49CJga62bdS8qcIS1hi/Zg4FD4cLV3sFr83DGkKta
                    0iYhHMeGOMKG/jSqUVr6G25Xp3D2OFYt3VbCtE8C0dDT+nEUtGCWIjueWSbmqVzqqVmP7ojQDZ7+Fc7mEMe4y/2IB49p9
                    G54YN/kil2cDXB0Uma7aNgs8s6W0DCnQEzm0vCZpd1toCEOwNmNvd0hP8ASzRtPa2Gq1AAAAAASUVORK5CYII=" 
                    alt="Guardar"> Descargar resumen
                </button>

                <button id="next" class="arrow">➡</button>

                        <!------------Mensaje emergente------------>
                        <div class="fondo-emergente" id="fondoEmergente">
                        <div class="emergente">    
                            <p class="mensajeEmergente">¡¡Gracias por confiar en nosotros!!</p>
                            <br>

                            <div class="FOLIO-info"> <!--user-info -->
                                <h2 class="Folio-name">Pedido con folio:</h2>
                                <input type="text" id="folio" name="folio" value="{{session('folio')}}" readonly>
                            </div>       

                            <div class="details">

                                <div class="left-column">
                                    <label>Notas:</label>
                                    <p>En breve se pondrán en contacto con usted.</p> <br><br>
                                    <p>Dispone del buscador de folios para cualquier consulta de su pedido.</p>
                                </div>

                                <div class="right-column">
                                    <label>Indicaciones</label>
                                    <p>Guarde su folio para cualquier aclaración.</p> <br><br>
                                </div>
                            </div>

                            <form action="{{route('inicio.get')}}" method="GET">
                                @csrf
                                <button id="continuar" class="arrow" type="submit">Volver al inicio</button>
                            </form>
                        
                            </div>
                        </div>
                        <!------------------------------------------>
      <!--  </div>-->
            </div>
   </div>

   <script src="{{ asset('js/ResumenPedFij.js') }}"></script>
   <script src="{{ asset('js/Gracias.js') }}"></script>

</body>