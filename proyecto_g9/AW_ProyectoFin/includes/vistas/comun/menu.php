<?php

use es\ucm\fdi\aw\Aplicacion;

$mostrarCat = new \es\ucm\fdi\aw\mostrar\MostrarCategorias();
$mostrarCat = $mostrarCat->gestiona();

$app = Aplicacion::getInstance();

?>
<nav id="menu">
	<ul id = "op">
		<div class="dropdown">
			<button class="dropbtn"><a href="<?= $app->resuelve('/index.php')?>">Inicio</a></button>
		</div>
		<div class="dropdown">
			<button class="dropbtn"><a href="<?= $app->resuelve('/catalogo.php')?>">Catálogo</a></button>
			<!-- <div class="dropdown-content">
				 <?php echo $mostrarCat; ?> 
			</div> -->
		</div>
		<div class="dropdown">
			<button class="dropbtn"><a href="<?= $app->resuelve('/favoritos.php')?>">Favoritos</a></button>
		</div>
		<div class="dropdown">
			<button class="dropbtn"><a href="<?= $app->resuelve('/pedidos.php')?>">Pedidos</a></button>
		</div>
		<div class="dropdown">
			<button class="dropbtn"><a href="<?= $app->resuelve('/carrito.php')?>"><img id = 'carrito' src="img/carrito.png" style=width:30px alt="img2"></a></button>
		</div>
		<?php if ($app->tieneRol(es\ucm\fdi\aw\clases\Usuario::ADMIN_ROLE) || 
		$app->tieneRol(es\ucm\fdi\aw\clases\Usuario::USER_ROLE)){ ?>
		<div class="dropdown">
			<button class="dropbtn"><a href="<?= $app->resuelve('/perfil.php')?>">Perfil</a></button>
			<div class="dropdown-content">
				<a href="<?= $app->resuelve('/perfil.php#modificar')?>">Modificar perfil</a>
				<a href="<?= $app->resuelve('/perfil.php#cambiarContra')?>">Cambiar contraseña</a>
				<a href="<?= $app->resuelve('/perfil.php#eliminarUsuario')?>">Borrar usuario</a>
			</div>
		</div>
		<?php } ?>
		<?php if ($app->tieneRol(es\ucm\fdi\aw\clases\Usuario::ADMIN_ROLE)){ ?>
		<div class="dropdown">
			<button class="dropbtn"><a href="<?= $app->resuelve('/admin.php')?>">Administrar</a></button>
			<div class="dropdown-content">
				<a href="<?= $app->resuelve('/admin.php#agregarProd')?>">Añadir producto</a>
				<a href="<?= $app->resuelve('/catalogo.php')?>">Eliminar productos</a>
				<a href="<?= $app->resuelve('/catalogo.php')?>">Gestionar ofertas</a>
				<a href="<?= $app->resuelve('/admin.php#hacerOferta')?>">Agregar categorias</a>
			</div>
		</div>
		<?php } ?>
	</ul>
</nav>

