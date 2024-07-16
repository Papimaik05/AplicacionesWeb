<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/estilo.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Contenido</title>
    </head>

    <body>

        <div id="contenedor">
            <?php
            require ('cabecera.php');
            require ('sidebarIzq.php');
            ?>
	    <main id="contenido">
            <article>
            <?php
            if (!isset($_SESSION["login"])) { //Usuario incorrecto
                echo '<h1>ERROR</h1>';
                echo '<p>El usuario no está registrado,para ver los contenidos debe iniciar sesión.</p>';
            }
            else { //Usuario registrado
                echo '<h1>Automóviles olvidados</h1>';
		        echo '<p>El Citroën SM fue un coche adelantado a su época, en los años 70. Fue presentado en 1970, fruto del acuerdo entre Citroën y Maserati. Este automóvil incorporaba suspensión hidroneumática automática, faros direccionables, dirección asistida variable en función de la velocidad, caja de cambios de 5 velocidades, elevalunas eléctricos y frenos de disco en las cuatro ruedas.</p>';

		        echo'<p>El Citroën SM era capaz de alcanzar 220Km/h y montaba un motor Masetati 2.7 V6 de 172 CV. Este motor fue diseñado a partir de un V8 </p>';

                echo '<p>El Citroën SM se dejó de fabricar en 1975 debido a la falta de recursos</p>';
                echo '<img src="citroensm.jpg" width ="440"  height ="280" alt="Imagen">';
            }
            ?>
            </article>

	    </main>

            <?php
            require ('sidebarDer.php');
            require ('pie.php');
            ?>
        </div> <!-- Fin del contenedor -->

    </body>
</html>
