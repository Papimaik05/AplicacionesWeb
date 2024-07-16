<?php
//Inicio del procesamiento
require_once './includes/config.php';


$form = new es\ucm\fdi\aw\FormularioRegistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';

$contenidoPrincipal = <<<EOS
<h1>Registro de usuario</h1>
$htmlFormRegistro
EOS;

include './includes/vistas/plantillas/plantilla.php';
?>
