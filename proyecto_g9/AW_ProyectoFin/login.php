<?php

require_once __DIR__.'/includes/config.php';

$formLogin = new \es\ucm\fdi\aw\forms\FormularioLogin('/perfil.php');
$formLogin = $formLogin->gestiona();

$tituloPagina = 'Login';
$contenidoPrincipal=<<<EOF
  	<h1>Acceso al sistema</h1>
    $formLogin
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => null];
$app->generaVista('/plantillas/plantilla.php', $params);