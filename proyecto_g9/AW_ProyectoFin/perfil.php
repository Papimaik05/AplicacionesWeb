<?php

use es\ucm\fdi\aw\Aplicacion;
require_once __DIR__.'/includes/config.php';
$formLogin = new \es\ucm\fdi\aw\forms\FormularioLogin('/perfil.php');
$formLogin = $formLogin->gestiona();
$formPerfil = new \es\ucm\fdi\aw\forms\FormularioPerfil();
$formPerfil = $formPerfil->gestiona();
$formContraseña = new \es\ucm\fdi\aw\forms\FormularioPassword();
$formContraseña = $formContraseña->gestiona();
$formUsuario = new \es\ucm\fdi\aw\forms\FormularioEliminarUsuario();
$formUsuario = $formUsuario->gestiona();

$css = 'perfil.css';

$tituloPagina = 'Perfil';
$contenidoPrincipal='';

if ($app->tieneRol(es\ucm\fdi\aw\clases\Usuario::USER_ROLE)) {
  $contenidoPrincipal=<<<EOF
  <h1>Mi perfil</h1>
  <div class="perfil">
  <div id="modificar">$formPerfil</div>
  <br>
  <div id="cambiarContra">$formContraseña</div>
  </div>
  <br>
  <div id="eliminarUsuario">$formUsuario</div>
  EOF;
  
} else {
  $contenidoPrincipal=<<<EOF
  <h1>Inicie sesión para acceder a su perfil.</h1>
  $formLogin

  EOF;
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);