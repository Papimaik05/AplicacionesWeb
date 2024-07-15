<?php
	function producto(){
	$producto = htmlspecialchars(trim(strip_tags($_REQUEST["nombreProd"])));
	$precio = htmlspecialchars(trim(strip_tags($_REQUEST["precio"])));
	$imagen = htmlspecialchars(trim(strip_tags($_REQUEST["imagen"])));
	$_SESSION["producto"] = $producto;
	$_SESSION["precio"] = $precio;
	$_SESSION["imagen"] = $imagen;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Catalogo</title>
</head>

<body>
	<?php   require("includes/comun/cabecera.php"); ?>
	<h1>Productos</h1>

	<form action="ventas.php" method="POST">
	<input type="hidden" name="nombreProd" value="Camiseta Betis">
	<input type="hidden" name="precio" value="13">
	<input type="hidden" value="img/CBetis.jpg" name="imagen">
	<img src="img/CBetis.jpg" width="200" height="200" >
	<h2>
        Camiseta Betis 13€
	</h2>
	<input type="submit" value="Ir a producto" name="botonComprar">
	
	</form>

	<br>
	
    <form action="ventas.php" method="POST">
	<input type="hidden" name="nombreProd" value="Camiseta azul">
	<input type="hidden" name="precio" value="10.99">
	<input type="hidden" value="img/azul.jpg" name="imagen">
	<img src="img/azul.jpg" width="200" height="200">
	<h2>
        Camiseta Azul 10.99€
	</h2>
	<input type="submit" value="Ir a producto" name="botonComprar">
	</form>


	<br>
	
    <form action="ventas.php" method="POST">
	<input type="hidden" name="nombreProd" value="Camiseta Roja">
	<input type="hidden" name="precio" value="10.99">
	<input type="hidden" name="imagen" value="img/roja.jpg">
	<img  src="img/roja.jpg" width="200" height="200" >
	<h2>
        Camiseta Roja 10.99€
	</h2>
	<input type="submit" value="Ir a producto" name="botonComprar">
	</form>

	<br>

	<?php 
	if(isset($_REQUEST["botonComprar"])){
		producto();
		header("Location: paginaProd.php ");
	}
	require("includes/comun/pie.php"); ?>

</body>
</html>