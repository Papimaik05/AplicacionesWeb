<?php
//Inicio del procesamiento
require_once './includes/config.php';
require_once './includes/FormularioLogin.php';

$form = new FormularioLogin();//haces un formulario
$htmlFormLogin = $form->gestiona();//llamas al gestiona más adelante

$tituloPagina = 'Login';

$contenidoPrincipal = <<<EOS
<h1>Acceso al sistema</h1>
$htmlFormLogin 
EOS;
include './includes/vistas/plantillas/plantilla.php';
?>