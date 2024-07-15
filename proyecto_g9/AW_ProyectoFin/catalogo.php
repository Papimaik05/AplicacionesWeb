<?php

namespace es\ucm\fdi\aw;

require_once __DIR__.'/includes/config.php';

if(!isset($_GET['idCat'])){
  $idCat = 0;
}
else{
  $idCat = $_GET['idCat'];
}

$mostrarTienda = new \es\ucm\fdi\aw\mostrar\MostrarTienda();
$mostrarTienda = $mostrarTienda->gestiona($idCat);
$mostrarCat = new \es\ucm\fdi\aw\mostrar\MostrarCategorias();
$mostrarCat = $mostrarCat->gestiona();

$css = "catalogo.css";

$tituloPagina = 'Catalogo';
$contenidoPrincipal=<<<EOF
    <div class="todoCat">
    $mostrarCat
    $mostrarTienda
    </div>

EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);