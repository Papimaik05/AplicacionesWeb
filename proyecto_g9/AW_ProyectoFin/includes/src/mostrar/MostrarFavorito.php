<?php

namespace es\ucm\fdi\aw\mostrar;
use es\ucm\fdi\aw\clases\Favorito;
use es\ucm\fdi\aw\clases\Valoraciones;
use es\ucm\fdi\aw\clases\Producto;

class MostrarFavorito
{

    public function gestiona()
    {
        $htmlTienda = <<<EOF
        <div class="favoritos">
        EOF;
        $fav = Favorito::muestraFavoritos($_SESSION["idUsuario"]);
        foreach($fav as $fila){
            $producto = Producto::getProducto($fila["id_producto"]);
            $valoracion = self::valoracion($fila["id_producto"]);

            $precios = "<p>Precio: $producto[precio] €</p>";

            if($producto["precio_oferta"] != null){
                $precios = "<p>Precio: <strike>$producto[precio] €</strike> $producto[precio_oferta] €</p>";
            }
            
            $html = <<<EOF
            <div class="productoFav">
            <h3>$producto[nombre]</h3>
                <div class="datosFav">
                <a href="producto.php?id=$producto[id_producto]"><img src='$producto[img]' alt='imagen'></a>
                $precios
                <p>Stock: $producto[stock]</p>
                <p>$valoracion</p>
                </div>
                <div class="eliminarFav">
                <form action='GestionFavorito.php' method='POST'>
                <input type='hidden' name='hidden_id' value=$fila[id_favorito]>
                <input type='submit' id='fav' name='eli_fav' value='Eliminar de favoritos'></p>
                </form>
                </div>
            </div>
            EOF;

            $htmlTienda.= $html;
        
        }

        $htmlTienda .= "</div>";

        return $htmlTienda;
    }

    public function valoracion($idP){
        $valoracion = Valoraciones::valoracionProd($idP);
        if($valoracion > -1){
            $html = $valoracion .'/5 <span class="estrella">&#9733</span>' ;
        }
        else{
            $html =  'Sin valoraciones';
        }
        return $html;
    }
}
