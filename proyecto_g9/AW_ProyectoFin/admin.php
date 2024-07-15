<?php
require_once __DIR__.'/includes/config.php';

$formProducto = new \es\ucm\fdi\aw\forms\FormularioProducto();
$formProducto = $formProducto->gestiona();
$formCategoria = new \es\ucm\fdi\aw\forms\FormularioCategoria();
$formCategoria = $formCategoria->gestiona();

$css = 'admin.css';

$tituloPagina = 'Admin';
$contenidoPrincipal='';

if ($app->tieneRol(es\ucm\fdi\aw\clases\Usuario::ADMIN_ROLE)) {
  $contenidoPrincipal=<<<EOF
    <h1>Bienvenido a la consola de administración</h1>
    <div class="admin">
    <div id="agregarProd">$formProducto</div>
    <div id="agregarCat">$formCategoria</div>
    </div>
  EOF;
} else {
  $contenidoPrincipal=<<<EOS
  <h1>¡Acceso Denegado!</h1>
  <p>No tienes permisos suficientes para administrar la web.</p>
  EOS;
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);