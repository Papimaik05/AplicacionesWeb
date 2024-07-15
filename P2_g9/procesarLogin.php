<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Login</title>
</head>
<body>
<?php
require("includes/comun/cabecera.php");
$username = htmlspecialchars(trim(strip_tags($_REQUEST["username"])));
$password = htmlspecialchars(trim(strip_tags($_REQUEST["password"])));
if ($username == "usuario1" && $password == "pass") {
$_SESSION["login"] = true;
$_SESSION["nombre"] = "Usuario";
$_SESSION["esAdmin"] = false;
}else if ($username == "admin" && $password == "adminpass") {
$_SESSION["login"] = true;
$_SESSION["nombre"] = "Administrador";
$_SESSION["esAdmin"] = true;
}


?>

<?php
if (!isset($_SESSION["login"])) { //Usuario incorrecto
$cont =<<< HTML

			<h1>ERROR</h1>
			<p>El usuario o contraseña no son válidos.</p>

	HTML;
	echo $cont;
require("includes/comun/pie.php");

}
else { 
	header('Location: ventas.php');
}
?>

</body></html>
