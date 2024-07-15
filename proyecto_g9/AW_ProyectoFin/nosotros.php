<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Acerca de ShopShirt';

  $contenidoPrincipal=<<<EOS
  <h1>Sobre Nosotros</h1>
  <p>ShopShirt es una de las pricipales páginas de compra venta de ropa que existe en el mercado.</p>

  <p>Nuestra gran cantidad de productos así como la capacidad que posee cada uno de los usuarios registrados de valorar cada uno de los articulos que disponemos, hace que Shopirt, no sólo sea una de las principales empresas en cuanto a la compra venta de camisetas, sino que además de esto, podemos airmar con seguridad que la página web de la tienda es una de las mejores del mercado.</p>

  <h3>Colaboradores:</h3>
    <ul>
      <li>Poner los nombres de todos</li>
    </ul>
  <p>contacto: ShopShirtContact@Shopirt.es</p>
  
  EOS;


$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => null];
$app->generaVista('/plantillas/plantilla.php', $params);