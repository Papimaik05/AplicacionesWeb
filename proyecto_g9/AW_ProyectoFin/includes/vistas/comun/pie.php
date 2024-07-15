<footer class="main-footer">

<?php
use es\ucm\fdi\aw\Aplicacion;

$app = Aplicacion::getInstance();
?>
    <div class="cont-footer">
        <div class="column-footer">
            <h2 class="column-titulo">¿Porqué debes visitarnos?</h2>
                <p class="column-subtitulo"> ShopShirt es una de las pricipales páginas de compra venta de ropa que existe en el mercado.</p>
                <p class="column-subtitulo"><a href="<?= $app->resuelve('/nosotros.php')?>">Más sobre nosotros</a></p>
                <p class="column-subtitulo"><a href="<?= $app->resuelve('/condiciones.php')?>">Condiciones de Uso y Venta</a>
		            <a href="<?= $app->resuelve('/privacidad.php')?>">Aviso de Privacidad</a></p>
		        <p class="column-subtitulo"><a href="<?= $app->resuelve('/cookies.php')?>">Cookies</a>
		            <a href="<?= $app->resuelve('/publicidad.php')?>">Publicidad basada en los intereses</a></p>
        </div>
        <div class="column-footer">
            <h2 class="column-titulo">Contacta con nosotros</h2>
            <p class="column-subtitulo">C/ Profesor José García Santesmases, 9. Ciudad Universitaria 28040 - MADRID</p>
            <p class="column-subtitulo">Teléfono: 91-999-99-99</p>
            <p class="column-subtitulo">contacto: ShopShirtContact@Shopirt.es</p>
        </div>
        <div class="column-footer">
            <h2 class="column-titulo">Sigue nuestras redes sociales</h2>
            <p class="column-subtitulo"><a href="index.php"><img id='icono_pie1' src="img/icono_facebook.png"  alt="img1">  Síguenos en Facebook</a></p>
            <p class="column-subtitulo"><a href="index.php"><img id='icono_pie2' src="img/icono_twitter.png"  alt="img1">  Síguenos en Twitter</a></p>
            <p class="column-subtitulo"><a href="index.php"><img id='icono_pie3' src="img/icono_youtube.png"  alt="img1">  Visita nuestro canal</a></p>
            <p class="column-subtitulo"><a href="index.php"><img id='icono_pie4' src="img/icono_instagram.png"  alt="img1">  Síguenos en Instagram</a></p>
        </div>
        <p class="copy">© 1996-2022, ShopShirt.com, Inc. o sus afiliados</p>
    </div>

</footer>