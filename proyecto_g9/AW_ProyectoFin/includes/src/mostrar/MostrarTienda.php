<?php

namespace es\ucm\fdi\aw\mostrar;
use es\ucm\fdi\aw\clases\Valoraciones;
use es\ucm\fdi\aw\clases\Producto;
use es\ucm\fdi\aw\clases\Categorias;
use es\ucm\fdi\aw\clases\Favorito;


class MostrarTienda
{
    
    public function gestiona($idCat)
    {   
        if(isset($_SESSION['login']) && ($_SESSION['login'] === true)){
            $sePuede = 'enabled';
        }
        else{
            $sePuede = 'disabled';
        }

        if(isset($_GET['id_Prod'])){
            $prod = Producto::getDatosProducto($_GET['id_Prod']);
            $img = $prod['img'];
            unlink($img);
            Producto::eliminarProducto($_GET['id_Prod']);
        }


        $htmlTienda = <<<EOF
        <div class="catalogo">
        EOF;

           $tienda = Producto::muestraTienda($idCat); 
        

        foreach($tienda as $fila){ //falta corchete fin 
            
            $valoracion = self::valoracion($fila["id_producto"]);

            $precios = "<p>Precio: $fila[precio] €</p>";

            if($fila["precio_oferta"] != null){
                $precios = "<p>Precio: <strike>$fila[precio] €</strike> $fila[precio_oferta] €</p>";
            }

            $html = <<<EOF
                <div class="productoCatalogo">
                <a href="producto.php?id=$fila[id_producto]"><div class="datosProd">
                <h2>$fila[nombre]</h2>
                <img src='$fila[img]' width="200" height="200" alt='imagen'>
                $precios
                <p>Stock: $fila[stock]</p>
                <p>$valoracion</p>
                </div>
                </a>
                EOF;
                
                if(isset($_SESSION['login']) && ($_SESSION['login'] === true)){
                    if(!Favorito::existePro($_SESSION["idUsuario"],$fila['id_producto'])){
                        $html .= <<<EOF
                        <div class="fav">
                        <form action='GestionFavorito.php' method='POST'>
                        <input type='hidden' name='hidden_id' value='$fila[id_producto]'>
                        <input type='submit' id='fav' name='add_fav' value='Añadir a favoritos' $sePuede></p>
                        </form>
                        </div>
                        EOF;
                    }else{
                    $html .= <<<EOF
                        <div class="fav">
                        <br>
                        </div>
                        EOF;
                    }
                }
                

                if(isset($_SESSION['login']) && ($_SESSION['login'] === true)){
                    if(array_search(1,$_SESSION['roles']) !== false){
                        $formOferta = new \es\ucm\fdi\aw\forms\FormularioOferta($fila['id_producto'], $fila['precio']);
                        $formOferta = $formOferta->gestiona();
                        
                        $html .=  $formOferta;

                        $html .= <<<EOF

                        <div class="eliminarProd">
                                <button class='btn'>
                                <a href='catalogo.php?id_Prod=$fila[id_producto]'>Eliminar producto</a>
                                </button>
                            </div>

                        EOF;
                    }
                }
                
                $html .= <<<EOF
                </div>
                EOF;

            $htmlTienda.= $html;
        
        }

        $html1 = <<<EOF
        </div>
        EOF;

        $htmlTienda.= $html1;

            return $htmlTienda;

    }

    public function valoracion($idP){
        $valoracion = Valoraciones::valoracionProd($idP);
        if($valoracion > -1){
            $html = $valoracion .'/5 <span class="estrella">&#9733</span>' ;
        }
        else{
            $html =  'No hay valoraciones de este producto';
        }
        return $html;
    }

}
