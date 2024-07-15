<?php 
	function anadirCarrito(){
		$producto = $_SESSION["producto"];
		if(!isset($_SESSION["carrito"][$producto])){
		$_SESSION["carrito"][$producto]["imagen"] = $_SESSION["imagen"];
		$_SESSION["carrito"][$producto]["nombre"] = $_SESSION["producto"];
		$_SESSION["carrito"][$producto]["precio"] = $_SESSION["precio"];
		$_SESSION["carrito"][$producto]["cant"] = $_REQUEST["Unidades"];
		}
		else{
			$_SESSION["carrito"][$producto]["cant"] += $_REQUEST["Unidades"];
		}
	}

	function valorar(){
		$producto = $_SESSION["producto"];
		if(!isset($_SESSION[$producto]["Val"])){
			$_SESSION[$producto]["Val"] = $_REQUEST["Valoracion"];
		}
		else{
			$valoracion = $_SESSION[$producto]["Val"] + $_REQUEST["Valoracion"];
			$_SESSION[$producto]["Val"] = ($valoracion/2);
		}	
	}

	function compSesion(){
		if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
			echo "enabled";
		}
		else{
			echo "disabled";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Producto</title>
</head>

<body>
	<?php  
	require("includes/comun/cabecera.php"); 
	echo  "<h1>" . $_SESSION["producto"] . "</h1>";

	echo '<img src="' . $_SESSION["imagen"] . '" width="400" height="400">';

	echo  "<h2>" . $_SESSION["precio"] . " € </h2>"; 
	
	if(isset($_SESSION[$_SESSION["producto"]]["Val"])){
		echo "<h3> Valoración: " . $_SESSION[$_SESSION["producto"]]["Val"] . "/10</h3>"; 
	}
	else{
		echo "<h3> Valoración: No hay valoraciones. Inicia sesion y valora este producto! </h3>";
	}
	
	?>

	<form action="paginaProd.php" method="POST">
	<p>Ud: <input type="number" value="1" name="Unidades" width="10" min="1"></p> 
  	<input type="submit" value="Añadir al carrito" name="botonCarrito" <?= compSesion() ?>>
	</form>
	<br>

	<form action="paginaProd.php" method="POST">
	<p>Valoración: <input type="number" value="1" name="Valoracion" width="10" min="1" max="10"></p>
  	<input type="submit" value="Valorar" name="botonValorar"<?= compSesion() ?>>
	</form>
	<br>

	<?php 
	if(isset($_REQUEST["botonCarrito"]) && isset($_SESSION["login"]) && $_SESSION["login"] === true){
		anadirCarrito();
		header("Location: paginaCarr.php");
	}
	if(isset($_REQUEST["botonValorar"]) && isset($_SESSION["login"]) && $_SESSION["login"] === true){
		valorar();
		header("Location: paginaProd.php");
	}
	require("includes/comun/pie.php");
	?>

</body>
</html>