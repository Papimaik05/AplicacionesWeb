<?php
//Inicio del procesamiento
require_once './includes/config.php';

 $tituloPagina = 'Portada';
 $contenidoPrincipal = <<<EOS
 <h1>Página principal</h1>
<p> Aquí está el contenido público, visible para todos los usuarios. </p>
EOS;
include './includes/vistas/plantillas/plantilla.php';
?>