<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/estilo.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Portada</title>
    </head>

    <body>

        <div id="contenedor">
            <?php
            require ('cabecera.php');
            require ('sidebarIzq.php');
            ?>
	    <main>
	        <article>
		        <h1>Página Principal</h1>
		        <p>Aquí está el contenido público,visible para todos los usuarios.
                <br>
                <p>Esto es una imagen visible para todos</p>
                <img src="buspublico.jpg" width ="440"  height ="280" alt="Imagen">
	        </article>
	    </main>

            <?php
            require ('sidebarDer.php');
            require ('pie.php');
            ?>
            
        </div> <!--Fin del contenedor -->

    </body>
</html>