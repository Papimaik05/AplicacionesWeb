<?php
session_start();
unset($_SESSION["login"]);
unset($_SESSION["nombre"]);
if (isset($_SESSION["admin"])) { //Usuario incorrecto
    unset($_SESSION["admin"]);
}
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/estilo.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Logout</title>
    </head>

    <body>

        <div id="contenedor">
            <?php
            require ('cabecera.php');
            require ('sidebarIzq.php');
            ?>
	    <main id="contenido">
        <article>
            <h1>Gracias por usar nuestra Web.</h1>
            <h1>Esperamos verte pronto!!</h1>
        </article>    

	    </main>

            <?php
            require ('sidebarDer.php');
            require ('pie.php');
            ?>
        </div> <!-- Fin del contenedor -->

    </body>
</html>
