<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/estilo.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Admin</title>
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
                    if (!isset($_SESSION["esAdmin"])) { //Admin incorrecto
                        echo '<h1>ERROR</h1>';
                        echo '<p>El usuario tiene el acceso denegado al control,debido a que no es administrador</p>';
                    }
                    else { //Admin registrado
                        echo '<h1>Consola de administración</h1>';
		                echo '<p>Aquí estarían los controles para la administración de la web</p>';
                        echo '<img src="admin.jpg" width ="440"  height ="280" alt="Imagen">';
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
