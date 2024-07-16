<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
	    <title>Login</title>
        <link rel="stylesheet" type="text/css" href="./css/estilo.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div id="contenedor">
            <?php
            require ('cabecera.php');
            require ('sidebarIzq.php');
            ?>
	    <main id="contenido">
            <br>
            <form action="procesarLogin.php" method="post">
                <fieldset >
                    <legend>Datos de inicio de sesión</legend>
                        Nombre:
                        <br> 
                        <input type="text" name="username" required>
                        <br>
                        Contraseña: 
                        <br> 
                        <input type="password" name="password" required>
                        <br><br>
				        <input type="submit">
                </fieldset>
            </form>
	    </main>
            <?php
            require ('sidebarDer.php');
            require ('pie.php');
            ?>
        </div> <!-- Fin del contenedor -->	
    </body>
</html>