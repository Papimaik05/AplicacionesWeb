<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Aviso de Cookies';

$contenidoPrincipal=<<<EOS
    <h1>Aviso de Cookies</h1>
    <p> Utilizamos cookies y herramientas similares (conjuntamente, “cookies”) para los fines descritos a continuación.</p>

    <p>Sabemos lo importante que es para ti el uso que hacemos de tu información personal y el modo en que la compartimos. Apreciamos la confianza que depositas en nosotros para que la tratemos con el debido cuidado y prudencia. Este Aviso de Privacidad describe el modo en que recabamos y tratamos tu información personal en las páginas web, dispositivos, productos, servicios, tiendas online y físicas, y aplicaciones de Shopirt que remitan a este Aviso de Privacidad (en conjunto, los "Servicios de Shopirt").</p>
    <ul>
        <li>
            <h2>Cookies operativas:</h2>
                <ul>
                    <li>
                        <p>Reconocer cuándo te registras para usar nuestros servicios.</p>
                    </li>
                    <li>
                        <p>Reconocerte como miembro de Shopirt y ofrecerte otras funcionalidades y servicios personalizados.</p>
                    </li>
                    <li>
                        <p>Mostrar funcionalidades, productos y servicios que podrían ser de tu interés, incluidos los anuncios en nuestros servicios si son de productos y servicios disponibles en Shopirt.</p>
                    </li>
                    <li>
                        <p> Mantener un registro de los productos guardados en tu cesta.</p>
                    </li>
                    <li>
                        <p> Prevenir actividades fraudulentas.</p>
                    </li>
                    <li>
                        <p> Mejorar la seguridad.</p>
                    </li>
                    <li>
                        <p> Mantener un registro de tus preferencias, como la divisa y el idioma.</p>
                    </li>
                    <li>
                    <p>También utilizamos cookies para entender cómo usan los clientes nuestros servicios y así poder mejorarlos. Por ejemplo, usamos cookies para llevar a cabo investigaciones y análisis para mejorar el contenido, los productos y los servicios de Shopirt, y para medir y entender el funcionamiento de nuestros servicios</p>
                    </li>
                </ul>
        </li>
        <li>
            <h2>Cookies publicitarias:</h2>
            <p>También usamos cookies para ofrecer ciertos tipos de anuncios, incluidos los de aquellos productos y servicios que no están disponibles en Shopirt, y otros anuncios relevantes para tus intereses.</p>

            <p>Terceros autorizados también pueden utilizar cookies cuando interactúas con los servicios de Shopirt. Estos terceros incluyen motores de búsqueda, proveedores de servicios de medición y analíticos, redes sociales y compañías de publicidad. Los terceros utilizan cookies cuando proporcionan contenidos publicitarios, incluidos anuncios relevantes para tus intereses, para medir la efectividad de sus anuncios y para prestar servicios por cuenta de Shopirt.</p>
        </li>
    </ul>

  EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => null];
$app->generaVista('/plantillas/plantilla.php', $params);