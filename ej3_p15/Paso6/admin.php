<?php
//Inicio del procesamiento
require_once './includes/config.php';

 $tituloPagina = 'Admin';

 $contenidoPrincipal = '';

if (! isset($_SESSION['esAdmin']) || !$_SESSION['esAdmin']) {
	$contenidoPrincipal .= <<<EOS
	<h1>Acceso denegado!</h1>
	<p>No tienes permisos suficientes para administrar la web.</p>
	EOS;
} else {
	$contenidoPrincipal .= <<<EOS
	<h1>Consola de administración</h1>
	<p>Aquí estarían todos los controles de administración</p>
	EOS;
}
include './includes/vistas/plantillas/plantilla.php';
?>


