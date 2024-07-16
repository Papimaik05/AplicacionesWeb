<?php
//Inicio del procesamiento
require_once './includes/config.php';

$form = new es\ucm\fdi\aw\FormularioLogin();
$htmlFormLogin = $form->gestiona();//llamas al gestiona más adelante

$tituloPagina = 'Login';

$contenidoPrincipal = <<<EOS
<h1>Acceso al sistema</h1>
$htmlFormLogin 
EOS;
include './includes/vistas/plantillas/plantilla.php';
?>