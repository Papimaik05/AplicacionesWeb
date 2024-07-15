<?php

require_once __DIR__.'/includes/config.php';

$formLogin = new \es\ucm\fdi\aw\forms\FormularioLogin('/favoritos.php');
$formLogin = $formLogin->gestiona();

$css= "favoritos.css";

$tituloPagina = 'Favorito';
$contenidoPrincipal='';

if ($app->tieneRol(es\ucm\fdi\aw\clases\Usuario::USER_ROLE)) {
  $mostrarFavoritos = new \es\ucm\fdi\aw\mostrar\MostrarFavorito();
  $mostrarFavoritos = $mostrarFavoritos->gestiona();
  $contenidoPrincipal=<<<EOF
    <h1>Productos en favoritos</h1>
    $mostrarFavoritos
    
  EOF;
} else {
  $contenidoPrincipal=<<<EOS
  <h1>Inicie sesión para acceder a Favoritos</h1>
  $formLogin
  EOS;
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);