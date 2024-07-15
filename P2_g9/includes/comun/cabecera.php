<header>

<?php
session_start();
$cabecera =<<< HTML

	<h1>
        <a href="index.php"><img src="img/Shopirt.png"
        width="30"
        height="30"></a>
        SHOPIRT 
	</h1> 

	<a href="ventas.php"><h2>Catalogo</h2></a> <a href="paginaCarr.php"><h2>Carrito</h2></a>

HTML;
echo $cabecera;

	if(isset($_SESSION["login"]) && $_SESSION["login"] === true)
	{
		echo 'Hola ' . $_SESSION['nombre'] . ' <a href="logout.php">Salir</a>';
	}
	else
	{
		echo ' <a href="login.php">Iniciar sesión</a>';
	}	
?>

</header>