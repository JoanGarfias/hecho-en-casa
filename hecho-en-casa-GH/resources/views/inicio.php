
<?php require('./plantillas/menu.php'); ?>
<?php require('./plantillas/banner.php'); ?>


<link rel="stylesheet" href="/ProyectoINGS/Pagina/css/cuerpo.css"> <!-- Ruta absoluta -->

    <main>
        <h2>DESCUBRE</h2>
        <div class="contenedor">
            <div class="seccion temporada">
                <h3>TEMPORADA</h3>
                <img src="./img/temporada.png" alt="Pasteles de temporada">
            </div>
            <div class="seccion pasteles">
                <h3>PASTELES</h3>
                <div class="contenedor-flex">
                    <img src="./img/pasteles.png" alt="Pasteles personalizados">
                    <button class="personaliza">
                        <img src="./img/varita.png" alt="Personaliza tu pastel">
                        Personaliza tu pastel
                    </button>
                </div>
            </div>    
        </div>
    </main>
    
    <?php require('./plantillas/piePg.php'); ?>
