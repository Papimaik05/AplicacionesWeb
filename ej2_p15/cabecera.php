<?php
function mostrarSaludo() {
  if (isset($_SESSION["login"])) {
    echo 'Bienvenido ' . $_SESSION['nombre'] . '! ';
    echo '<a href="logout.php">(salir)</a>';
  } else {
    echo 'Usuario desconocido. ';
    echo '<a href="login.php">Login</a>';
  }
}

?>
<header>
	<h1>Mi gran página web</h1>
		<div class="saludo">
		<?php
		mostrarSaludo();
		?>
		</div>
</header>