<?php

namespace es\ucm\fdi\aw;

require_once __DIR__.'/includes/config.php';

$id = $_GET['id'];
$mostrarProducto = new \es\ucm\fdi\aw\mostrar\MostrarProducto();
$mostrarProducto = $mostrarProducto->gestiona($id);

$css = 'producto.css';

$tituloPagina = 'Producto';

$contenidoPrincipal=<<<EOF
  	<h1>Producto seleccionado</h1>
    <div class="mostrarProd">
    $mostrarProducto
    </div>
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);