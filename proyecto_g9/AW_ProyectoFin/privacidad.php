<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Aviso de Privacidad de Shopirt';

$contenidoPrincipal=<<<EOS
    <h1>Aviso de Privacidad de Shopirt</h1>
    <p> Última actualización el 31 de agosto de 2020.</p>

    <p>Sabemos lo importante que es para ti el uso que hacemos de tu información personal y el modo en que la compartimos. Apreciamos la confianza que depositas en nosotros para que la tratemos con el debido cuidado y prudencia. Este Aviso de Privacidad describe el modo en que recabamos y tratamos tu información personal en las páginas web, dispositivos, productos, servicios, tiendas online y físicas, y aplicaciones de Shopirt que remitan a este Aviso de Privacidad (en conjunto, los "Servicios de Amazon").</p>
    <ul>
        <li>
            <h2>¿Con qué finalidades trata tu información personal Shopirt?</h2>
                <ul>
                    <li><h3>Compra y entrega de productos y servicios.</h3>
                    <p>Utilizamos tu información personal para aceptar y gestionar pedidos, entregar productos y servicios, procesar pagos y comunicarnos contigo en relación con pedidos, productos, servicios y ofertas promocionales.</p>
                    </li>
                    <li><h3>Prestación, resolución de problemas y mejora de los Servicios de Shopirt.</h3>
                    <p>Utilizamos tu información personal para aportar funcionalidad, analizar el rendimiento, resolver errores y mejorar la usabilidad y efectividad de los Servicios de Shopirt.</p>
                    </li>
                    <li><h3> Recomendaciones y personalización.</h3>
                    <p>Utilizamos tu información personal para recomendar funcionalidades, productos y servicios que puedan interesarte, identificar tus preferencias y personalizar tu experiencia con los Servicios de Shopirt.</p>
                    </li>
                    <li><h3> Comunicarnos contigo.</h3>
                    <p> Utilizamos tu información personal para comunicarnos contigo en relación con los Servicios de Shopirt a través de diferentes canales (por ejemplo, por teléfono, correo electrónico, chat).</p>
                    </li>
                </ul>
        </li>
        <li><h2>Información sobre cookies y otros identificadores</h2>
            <p>Utilizamos cookies y herramientas similares para mejorar tu experiencia de compra, prestar nuestros servicios y entender cómo utilizan los clientes nuestros servicios con el fin de realizar mejoras y mostrar publicidad. Terceras partes aprobadas también utilizan estas herramientas en relación con la publicidad mostrada.</p>
        </li>
        <li><h2>¿Está a salvo mi información personal?</h2>
            <p>Diseñamos nuestros sistemas y dispositivos teniendo en cuenta tu seguridad y privacidad.</p>
            <ul>
                <li>Trabajamos para proteger la seguridad de tu información personal durante la transmisión utilizando software y protocolos de encriptación.</li>
                <li>Al gestionar datos de tarjetas de crédito, cumplimos los Estándares de Seguridad de los Datos de la Industria de las Tarjetas de Pago (PCI DSS).</li>
                <li>Contamos con sistemas de seguridad físicos, electrónicos y procedimentales en relación con la recogida, almacenamiento, y divulgación de información personal del cliente. Nuestros procedimientos de seguridad implican que podemos pedirte que verifiques tu identidad antes de facilitarte información confidencial.</li>
                <li>Nuestros dispositivos ofrecen funcionalidades de seguridad que los protegen frente a accesos no autorizados y pérdidas de datos. Puedes controlar esas funcionalidades y configurarlas en función de tus necesidades.</li>
                <li>Es importante que te protejas contra el acceso no autorizado de terceros a tu contraseña y a tus ordenadores, dispositivos y aplicaciones. Te recomendamos que utilices una contraseña única para tu cuenta de Shopirt que no utilices para otras cuentas online.</li>           
            </ul>
        </li>
    </ul>

  EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => null];
$app->generaVista('/plantillas/plantilla.php', $params);