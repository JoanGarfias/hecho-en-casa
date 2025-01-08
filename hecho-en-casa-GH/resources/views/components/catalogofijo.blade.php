<?php
    $con = mysqli_connect("autorack.proxy.rlwy.net", 'root', 'CtMoIMkVciKXNsNSWxTqEFMseaLXKLUG', 'Hecho_en_casa', 28232);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>
<html>
    <head>
    </head>
    <body>
        
        <div id="divEncuesta">
            <h3>Prueba</h3>

            <form method="POST" id="formulario" action='votar.php'>
                <?php
                    $sql = "SELECT e.nombre FROM categoria e";
                    $rs = mysqli_query($con, $sql);
                    while($fila = mysqli_fetch_assoc($rs)){
                        echo "
                                <div>
                                <label><input type='radio' value='{$fila['nombre']}' name='rdVoto'/>{$fila['nombre']} </label>
                                </div>
                        ";
                    }
                ?>
                </form>
            </div>
        </body>
</html>