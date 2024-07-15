<?php

require_once __DIR__.'/includes/config.php';

$css = "index.css";

$tituloPagina = 'Portada';
$contenidoPrincipal=<<<EOS
<div class="indice">
  <div class="indice1">
  <nav>
  <ul>
    <li><a href="catalogo.php?idCat=ofertas"><img src="img/ofertas.png" id="ofertas" alt='imagen'><h3>Ofertas</h3></a></li>
    <li></li>
  </ul>
  </nav>
  <nav>
  <ul>
    <li></li>
    <li><a href="catalogo.php?idCat=nuevo"><img src="img/nuevo.jpg" id="nuevo" alt='imagen'><h3>Nuevo</h3></a></li>
  </ul>
  </nav>
  </div>
  <div class="indice2">
   <nav>
   <ul>
     <li><a href="catalogo.php?idCat=1"><img src="img/futbol.jpg" alt='imagen'><h2>Futbol</h2></a></li>
     <li><a href="catalogo.php?idCat=2"><img src="img/gimnasio.jpg" alt='imagen'><h2>Gimnasio</h2></a></li>
     <li><a href="catalogo.php?idCat=3"><img src="img/anime.jpg" alt='imagen'><h2>Anime</h2></a></li>
     <li><a href="catalogo.php?idCat=4"><img src="img/nike.jpg" alt='imagen'><h2>Nike</h2></a></li>
   </ul>
   </nav>
  </div>
</div>
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);