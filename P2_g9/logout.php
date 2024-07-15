<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Portada</title>
</head>
<body>

<?php
	session_start();

	$_SESSION = array();
	session_destroy();
	require("index.php");

?>
</body>
</html>