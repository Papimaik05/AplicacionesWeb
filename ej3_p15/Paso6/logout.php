<?php

require_once './includes/config.php';

unset($_SESSION['login']);
unset($_SESSION['esAdmin']);
unset($_SESSION['nombre']);


session_destroy();

$tituloPagina = 'Logout';

$contenidoPrincipal = <<<EOS
<h1>Hasta pronto!</h1>
EOS;

include './includes/vistas/plantillas/plantilla.php';
?>
