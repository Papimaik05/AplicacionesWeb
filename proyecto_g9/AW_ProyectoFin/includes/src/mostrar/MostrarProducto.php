<?php

namespace es\ucm\fdi\aw\mostrar;
use es\ucm\fdi\aw\clases\Producto;
use es\ucm\fdi\aw\clases\Favorito;

class MostrarProducto
{
    
    public function gestiona($id)
    {
        $datos = Producto::getProducto($id);

        if(isset($_SESSION['login']) && ($_SESSION['login'] === true) && $datos['stock'] > 0){
            $sePuede = 'enabled';
        }
        else{
            $sePuede = 'disabled';
        }

        $precios = "<p>Precio: <strong>$datos[precio] €</strong></p>";

            if($datos["precio_oferta"] != null){
                $precios = "<strike><p>Precio: $datos[precio] €</p></strike>
                <p>Precio en oferta: <strong>$datos[precio_oferta] €</strong></p>";
            }
        
        $htmlArray = <<<EOF
        
        <h2>$datos[nombre]</h2>

        <div class="producto">
            <img src='$datos[img]' alt='imagen'>
            <p>Descripción: <strong>$datos[descripcion]</strong></p>
            $precios
            <p>Talla: <strong>$datos[talla]</strong></p>
            <p>Stock: <strong>$datos[stock]</strong> </p>
            
            <form action='GestionCarro.php' method='POST'>
                <input type='hidden' name='hidden_id' value='$id'>
                <p>Unidades: 
                <input type='hidden' name='hidden_stock' value='$datos[stock]'>
                <input type='hidden' name='talla' value='$datos[talla]'>
                <input type='number' name='unidades_compra' min='1' max='$datos[stock]' value="1"></p>
                <div class="sub">
                <input type='submit' id='add' name='add_car' value='Añadir al carrito' $sePuede>
            </form>

        EOF;

        if(isset($_SESSION['login']) && ($_SESSION['login'] === true)){
            if(!Favorito::existePro($_SESSION["idUsuario"],$id)){
                $html = <<<EOF
                <form action='GestionFavorito.php' method='POST'>
                <input type='hidden' name='hidden_id' value='$id'>
                <input type='submit' id='fav' name='add_fav' value='Añadir a favoritos' $sePuede></p>
                </form>
                </div>
                EOF;

                $htmlArray .= $html;
            }
        }

        $htmlArray .= <<<EOF
        </div>
        EOF;

        return $htmlArray;
    
    }

}
