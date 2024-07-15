<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Condiciones de Uso y Venta';

$contenidoPrincipal=<<<EOS
    <h1>Condiciones de Uso y Venta</h1>
    <p> Te rogamos que leas detenidamente las presentes condiciones antes de utilizar los Servicios de Shopirt. Al utilizar los Servicios de Shopirt, aceptas quedar vinculado por las presentes condiciones.</p>
    <ol>
        <li><h3>Comunicaciones electrónicas</h3>
            <p>Cada vez que utilices un Servicio de Shopirt o nos envíes un correo electrónico, un mensaje de texto (SMS) o cualquier otra comunicación desde tu ordenador o dispositivo móvil, estarás comunicándote electrónicamente con nosotros.</p>
        </li>
        <li><h3>Recomendaciones y personalizacion</h3>
            <p>Como parte del Servicio de Shopirt, te recomendaremos funcionalidades, productos y servicios, incluyendo anuncios de terceros, que podrían ser de tu interés, identificar tus preferencias y personalizar tu experiencia.</p>
        </li>
        <li><h3>Derechos de autor, derechos de propiedad intelectual y derechos sobre bases de datos</h3>
            <p>No está permitida la extracción sistemática ni la reutilización de parte alguna del contenido de ninguno de los Servicios de Shopirt sin nuestro expreso consentimiento por escrito. En particular, no se permite el uso de herramientas o robots de búsqueda y extracción de datos para la extracción (ya sea en una o varias ocasiones) de partes sustanciales de los Servicios de Shopirt para su reutilización sin nuestro expreso consentimiento por escrito. Tampoco le está permitido al usuario crear ni publicar sus propias bases de datos cuando éstas contengan partes sustanciales de cualquiera de los Servicios de Amazon (por ejemplo, nuestras listas de productos y listas de precios) sin nuestro expreso consentimiento por escrito.</p>
        </li>
        <li><h3>Marcas registradas</h3>
            <p>De forma adicional, los gráficos, logotipos, encabezados de página, iconos de botón, scripts y nombres de servicio que aparecen incluidos o están disponibles a través de los Servicios de Shopirt son marcas registradas o representan la imagen comercial de Shopirt.</p>
        </li>
        <li><h3>Licencia y acceso</h3>
        <p>Sujeto a tu cumplimiento de estas Condiciones de Uso y las Condiciones Generales de los Servicios aplicables, así como al pago del precio aplicable, en su caso, Shopirt o sus proveedores de contenidos te conceden una licencia limitada no exclusiva, no transferible y no sublicenciable, de acceso y utilización, a los Servicios de Shopirt para fines personales no comerciales. Dicha licencia no incluye derecho alguno de reventa ni de uso comercial de los Servicios de Shopirt ni de sus contenidos, ni derecho alguno a compilar ni utilizar lista alguna de productos, descripciones o precios. Tampoco incluye el derecho a realizar ningún uso derivado de los Servicios de Shopirt ni de sus contenidos, ni a descargar o copiar información de cuenta alguna para el beneficio de otra empresa, ni el uso de herramientas o robots de búsqueda y extracción de datos o similar.</p>
        </li>
        <li><h3>Tu Cuenta</h3>
        <p>No podrás utilizar ningún Servicio de Shopirt: (i) en forma alguna que cause, o pueda causar, daño o perjuicio alguno a cualquiera de los Servicios de Shopirt o la interrupción del acceso a los mismos; o (ii) para cualquier fin fraudulento, ni a efectos de la comisión de delito alguno u otra actividad ilícita de ningún otro tipo; o (iii) para generar cualquier tipo de molestia, inconveniente o ansiedad en un tercero.</p>
        </li>
        <li><h3>Ley Aplicable</h3>
        <p>Las presentes condiciones se regirán e interpretarán de conformidad con las leyes del Gran Ducado de Luxemburgo (a excepción de sus disposiciones sobre conflicto de leyes), excluyéndose expresamente la aplicación de la Convención de las Naciones Unidas sobre los Contratos de Compraventa Internacional de Mercaderías. Si eres un consumidor y tienes tu residencia habitual en la Unión Europea, también contarás con la protección que pueda ofrecerte cualquier disposición imperativa de la legislación de tu país de residencia. Ambas partes acordamos someternos a la jurisdicción no exclusiva de los tribunales de distrito de la ciudad de Luxemburgo, lo que significa que podrás reclamar tus derechos como consumidor en relación con las presentes Condiciones de Uso tanto en Luxemburgo como en tu Estado Miembro de residencia en la Unión Europea.
        </p>
        <p>
        La Comisión Europea ofrece una plataforma para la resolución alternativa de conflictos, a la cual puedes acceder <a href="https://ec.europa.eu/consumers/odr/https://ec.europa.eu/consumers/odr">aquí</a>.
        </p>
        </li>
    </ol>

  EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => null];
$app->generaVista('/plantillas/plantilla.php', $params);