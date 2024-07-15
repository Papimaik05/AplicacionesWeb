<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Login</title>
</head>

<body>

	<?php require("includes/comun/cabecera.php"); ?>


		<h1>Login</h1>

		<form action="procesarLogin.php" method="post">
        <fieldset>
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



</body>
</html>