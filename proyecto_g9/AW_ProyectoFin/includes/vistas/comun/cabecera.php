<?php

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\forms\FormularioLogout;

function mostrarSaludo()
{
    $html = '';
    $app = Aplicacion::getInstance();
    if ($app->usuarioLogueado()) {
        $nombre = $app->nombre();

        $formLogout = new FormularioLogout();
        $htmlLogout = $formLogout->gestiona();
        $html = "Bienvenido, ${nombre}. $htmlLogout";
    } else {
        $loginUrl = $app->resuelve('/login.php');
        $registroUrl = $app->resuelve('/registro.php');
        $html = <<<EOS
        <a href="{$loginUrl}">Iniciar sesión</a> <a href="{$registroUrl}">Registrarse</a>
      EOS;
    }

    return $html;
}


?>

<header>
    <div id="logo">
    <img id="imglogo" src="img/logo.png">
    </div>
    <div class="saludo">
		<?= mostrarSaludo(); ?>
    </div>
</header>