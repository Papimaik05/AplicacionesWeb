<?php

require_once __DIR__.'/includes/config.php';

$formRegistro = new \es\ucm\fdi\aw\forms\FormularioRegistro();
$formRegistro = $formRegistro->gestiona();

$css = 'registro.css';
$tituloPagina = 'Registro';
$contenidoPrincipal=<<<EOF
  	<h1>Registro de usuario</h1>
    $formRegistro
EOF;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);