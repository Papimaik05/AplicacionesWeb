<?php
//Inicio del procesamiento
require_once './includes/config.php';
require_once './includes/FormularioRegistro.php';

$form = new FormularioRegistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';

$contenidoPrincipal = <<<EOS
<h1>Registro de usuario</h1>
$htmlFormRegistro
EOS;

include './includes/vistas/plantillas/plantilla.php';
?>
