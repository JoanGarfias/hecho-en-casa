<link rel="stylesheet" href="{{ asset('css/CalEdit.css') }}">
   <title>Calendario - Elegir fechas</title>          
<x-menu />
            <body>

                <h1> CALENDARIO 2025 </h1>

                <div class="container">
                <div class="calendar" id="calendar">

                    <ol class="ol">
                        <li class='nom-dia'>L</li>
                        <li class='nom-dia'>M</li>
                        <li class='nom-dia'>M</li>
                        <li class='nom-dia'>J</li>
                        <li class='nom-dia'>V</li>
                        <li class='nom-dia'>S</li>
                        <li class='nom-dia'>D</li>
                    </ol>
                          
                     <!-- Números de los días -->
                     <ol class="numbers" id="numbers">
                        <!-- Los días se generarán dinámicamente -->
                    </ol>
                    
                </div>
                <div class="cuacro">
                    <div class="legend">
                        <p><span class="closed"></span> Fechas cerradas</p>
                        <p><span class="current"></span> Fecha actual</p>
                        <p><span class="available"></span> Disponible</p>
                    </div>
                   
                    <form action="{{route($metodo)}}" method="POST" id="cambioFecha">
                        <div class="hour">
                            <label for="time" class="seleccionarHora">Seleccionar hora:</label>
                            <div class="hora-selector">
                                <input type="time" id="horaEntrega" name="horaEntrega" min="11:00" max="19:00" required>
                                <div class="boton-wrapper">
                                    <button type="button" id="incrementarHora" class="hora-boton">🔺</button>
                                    <button type="button" id="decrementarHora" class="hora-boton">🔻</button>                                        
                                </div>
                            </div>
                        </div>
                        <div class="botAceptar">
                            <button class="aceptandoFecha">Aceptar fecha y hora</button>
                        </div>
                        @csrf
                        <input type="hidden" name="mes" id="mes" value="">
                        <input type="hidden" name="anio" id="anio" value="">
                        <input type="hidden" name="fechaSeleccionada" id="fechaSeleccionada" value="">
                        <div class="arrows">
                            <button type="submit" id="prev-month" class="arrow">⬅</button>
                            <button type="submit" id="next-month" class="arrow">➡</button>
                        </div>                        
                    </form>
                </div>
                </div>
                <br>
                <script>
                    const calendario = @json($calendarioJson);

                    const months = [
                        { bg: "url('{{ asset('img/enero.png') }}')" },
                        { bg: "url('{{ asset('img/febrero.png') }}')" },
                        { bg: "url('{{ asset('img/marzo.png') }}')" },
                        { bg: "url('{{ asset('img/abril.png') }}')" },
                        { bg: "url('{{ asset('img/mayo.png') }}')" },
                        { bg: "url('{{ asset('img/junio.png') }}')" },
                        { bg: "url('{{ asset('img/julio.png') }}')" },
                        { bg: "url('{{ asset('img/agosto.png') }}')" },
                        { bg: "url('{{ asset('img/septiembre.png') }}')" },
                        { bg: "url('{{ asset('img/octubre.png') }}')" },
                        { bg: "url('{{ asset('img/noviembre.png') }}')" },
                        { bg: "url('{{ asset('img/diciembre.png') }}')" },
                    ];        
                    
                    
                </script>
            </body>
            <x-pie/>
            <script src="{{ asset('js/calEdit.js') }}"></script>
            <script src="{{ asset('js/meses.js') }}"></script>
           
<!--Para la animación del logo de usuario-->

<script src="{{ asset('js/icono.js') }}" defer></script>


