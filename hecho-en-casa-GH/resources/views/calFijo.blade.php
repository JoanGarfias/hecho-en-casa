<title>Calendario - Ver fechas</title>

           
           <link rel="stylesheet" href="{{ asset('css/calendario.css') }}">

            <?php require('./Plantillas/menu.php'); ?>

        </head>
            <body>

                <h1> CALENDARIO 2025 </h1>
               
                <div class="container">
                <div class="calendar" id="calendar">

                        <!-- Nombres de los días -->
                        <ol class="ol">
                            <li class='nom-dia'>Lun</li>
                            <li class='nom-dia'>Mar</li>
                            <li class='nom-dia'>Mie</li>
                            <li class='nom-dia'>Jue</li>
                            <li class='nom-dia'>Vie</li>
                            <li class='nom-dia'>Sab</li>
                            <li class='nom-dia'>Dom</li>
                        </ol>

                        <!-- Números de los días -->
                        <ol class="numbers" id="numbers">
                            <!-- Los días se generarán dinámicamente -->
                        </ol>
                </div>

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

                <script src="Cjs/meses.js"></script>

            </body>