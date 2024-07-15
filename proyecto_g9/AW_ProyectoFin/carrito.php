<?php
require_once __DIR__.'/includes/config.php';

$formLogin = new \es\ucm\fdi\aw\forms\FormularioLogin('/carrito.php');
$formLogin = $formLogin->gestiona();
$mostrarCarrito = new \es\ucm\fdi\aw\mostrar\MostrarCarrito();
$mostrarCarrito = $mostrarCarrito->gestiona();

$css = 'carrito.css';

$tituloPagina = 'Carrito';
$contenidoPrincipal='';

if ($app->tieneRol(es\ucm\fdi\aw\clases\Usuario::USER_ROLE)) {
  $contenidoPrincipal=<<<EOF
    <h1>Bienvenido al carrito</h1>
    $mostrarCarrito
  EOF;
} else {
  $contenidoPrincipal=<<<EOS
  <h1>Inicie sesión para acceder al carrito</h1>
  $formLogin
  EOS;
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);