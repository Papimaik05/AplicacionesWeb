<?php
require_once __DIR__.'/includes/config.php';

$formLogin = new \es\ucm\fdi\aw\forms\FormularioLogin('/pedidos.php');
$formLogin = $formLogin->gestiona();
$mostrarPedido = new \es\ucm\fdi\aw\mostrar\MostrarPedido();
$mostrarPedido= $mostrarPedido->gestiona();

$css = "pedidos.css";
$tituloPagina = 'Pedido';
$contenidoPrincipal='';

if ($app->tieneRol(es\ucm\fdi\aw\clases\Usuario::USER_ROLE)) {
  $contenidoPrincipal=<<<EOF
    <h1>Bienvenido a Pedidos</h1>
    $mostrarPedido
    
  EOF;
} else {
  $contenidoPrincipal=<<<EOS
  <h1>Inicie sesión para acceder a Pedidos</h1>
  $formLogin
  EOS;
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);