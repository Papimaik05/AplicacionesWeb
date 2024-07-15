<?php

	function comprobar(){
		if(isset($_SESSION["carrito"])){
			echo "enabled";
		}
		else{
			echo "disabled";
		}
	}

	function volcarCarrito($i){
		foreach($_SESSION["carrito"] as $indice => $value){
			$_SESSION["pedido"][$i][$indice]["producto"] =  $_SESSION["carrito"][$indice]["nombre"];
			$_SESSION["pedido"][$i][$indice]["cant"] =  $_SESSION["carrito"][$indice]["cant"];
			$_SESSION["pedido"][$i][$indice]["imagen"] =  $_SESSION["carrito"][$indice]["imagen"];
			}
			$_SESSION["pedido"][$i]["precio"] = $total;
	}

	function realizarCompra(){
		if(isset($_SESSION["carrito"])){
				if(!isset($_SESSION["pedido"])){
					volcarCarrito(0);
					$j = 1;
				}
				else{
					volcarCarrito($j);
					$j++;
				}		
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Carrito</title>
</head>

<body>

	<?php  require("includes/comun/cabecera.php");?>

	<h1>Carrito</h1>

	<?php 
		
		foreach($_SESSION["carrito"] as $indice => $value){
				echo '<img src="' . $_SESSION["carrito"][$indice]["imagen"] . 
				  '" width="100" height="100"> <h2>'. $_SESSION["carrito"][$indice]["nombre"] . 
				  "</h2> <h4> Unidades: ". $_SESSION["carrito"][$indice]["cant"] ."</h4>
				  <h3>Precio/ud : " . $_SESSION["carrito"][$indice]["precio"] . " €</h3>";
				$total += $_SESSION["carrito"][$indice]["precio"] * $_SESSION["carrito"][$indice]["cant"];
		}
		
		if(isset($_SESSION["carrito"])){
				echo "<h2>Precio total:" . $total .  " €</h2>";
		}
	?>

		<form method="POST">
		<input type="submit" value="Comprar" name="botonComprar" <?= comprobar() ?>>
		</form>
		<br>
		<form method="POST">
		<input type="submit" value="Vaciar Carrito" name="botonVaciar" <?= comprobar() ?>>
		</form>
	
	<?php
	if(isset($_REQUEST["botonComprar"])){
		realizarCompra();
		unset($_SESSION["carrito"]);
		header("Location: pedidos.php");
	}
	if(isset($_REQUEST["botonVaciar"])){
		unset($_SESSION["carrito"]);
		header("Location: ventas.php");
	}
	
	?>

</body>
</html>