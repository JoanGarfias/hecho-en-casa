
<link rel="stylesheet" href="{{ asset('css/calendario.css') }}">
<title>Calendario - Ver fechas</title>
<x-menu />
           

        </head>
            <body>

                <h1> CALENDARIO 2025 </h1>
               
                <div class="container">
                <div class="calendar" id="calendar">

                        <!-- Nombres de los días -->
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
                </div >
                <div class="ambos">
                    <div class="legend">
                        <p><span class="closed"></span> Fechas cerradas</p>
                        <p><span class="current"></span> Fecha actual</p>
                        <p><span class="available"></span> Disponible</p>
                    </div>

                    <div class="arrows">
                        <button id="prev-month" class="arrow">⬅</button>
                        <button id="next-month" class="arrow">➡</button>
                    </div>
                </div>
            </div>           
                
            <br>
            
            </body>
            <x-pie/>
            <script src="{{ asset('js/meses.js') }}"></script>
            <!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>
