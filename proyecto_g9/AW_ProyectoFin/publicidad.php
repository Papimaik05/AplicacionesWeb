<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Aviso sobre publicidad basada en los intereses del usuario';

$contenidoPrincipal=<<<EOS
    <h1>Aviso sobre publicidad basada en los intereses del usuario</h1>
    <p>Los anuncios basados en los intereses del usuario suelen hacer referencia a anuncios personalizados o específicos. Mostramos anuncios basados en los intereses para mostrar funcionalidades, productos y servicios que podrían ser de tu interés.</p>

    <h3>¿Qué tipo de información utilizamos para mostrarte anuncios basados en los intereses?</h3>
        <p>Para mostrarte anuncios basados en tus intereses utilizamos información como tus interacciones con las webs, contenidos o servicios de Shopirt. No utilizamos información que permita identificar a individuos directamente, como el nombre o el correo electrónico, para mostrar anuncios basados en tus intereses. Para ello, solo guardamos información durante el tiempo necesario para proporcionarte nuestros servicios de publicidad de acuerdo con nuestro Aviso de Privacidad y las leyes aplicables.</p>

        <p>Como es habitual en el sector de la publicidad, utilizamos cookies, píxels y otras tecnologías (conjuntamente, "cookies") que nos permiten conocer la efectividad de los anuncios basados en los intereses que te mostramos, midiendo los anuncios en los que has hecho clic o que has visto, para ofrecerte anuncios más útiles y adecuados. Por ejemplo, si sabemos qué anuncios se muestran en tu navegador podemos tener cuidado de no mostrar los mismos anuncios una y otra vez</p>
    <h3>Preferencias de publicidad</h3>
        <p>Amazon te ofrece distintas opciones para recibir publicidad basada en intereses. Puedes optar por no recibir este tipo de publicidad de Shopirt. En tal caso, seguirás viendo anuncios, pero estos no estarán basados en tus intereses</p>
  EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => null];
$app->generaVista('/plantillas/plantilla.php', $params);