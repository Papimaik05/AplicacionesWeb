<?php

namespace es\ucm\fdi\aw\mostrar;
use es\ucm\fdi\aw\clases\Valoraciones;
use es\ucm\fdi\aw\clases\Pedido;
use es\ucm\fdi\aw\clases\Producto;


class MostrarPedido
{
    
    public function gestiona()
    {   

        if(isset($_GET['id_Ped']) && isset($_GET['id_Prod']) && isset($_GET['num']) && isset($_GET['talla']) && isset($_GET['und']) ){
            Producto::añadirStock($_GET["id_Prod"], $_GET["und"]);
            Pedido::borrarArticulosPedido($_GET['id_Ped'], $_GET['id_Prod'], $_GET['talla']);
            if($_GET['num'] <= 1){
                Pedido::eliminarPedido($_GET['id_Ped']);
            }
        }

        if(isset($_SESSION['login'])){
            if(Pedido::contarPedidosUsuario($_SESSION['idUsuario']) > 0){
                $result = Pedido::obtenerPed($_SESSION['idUsuario']);
                
                $htmlArray = <<<EOF
                EOF;

                foreach($result as $fila){
                    $id = $fila['id_pedido'];
                    $precioTotal = $fila['precioTotal'];
                    $direccion = $fila['direccion'];
                    $articulos = Pedido::obtenerArticulosPedido($id);
                    $isempty = empty($articulos);
                    if($isempty){
                    $htmlA = "<p>Se han eliminado del catalogo los productos de este pedido</p>";
                    }
                    else{
                        $htmlA = "";
                    }
                    $htmlArray .= <<<EOF
                    <div class="pedido">
                    <h2 class="loc">Localizador: $id</h2>
                    $htmlA
                    EOF;
                        
                    
                    foreach($articulos as $prod){
                        $idProd = $prod['id_producto'];
                        $datos = Producto::getDatosProducto($idProd);
                        $num = sizeof($articulos);
                        if($datos['precio_oferta'] != null){
                            $precio = $datos['precio_oferta'];
                        }
                        else{
                           $precio = $datos['precio']; 
                        }

                        $nombre = $datos['nombre'];
                        $img = $datos['img'];
                        $und = $prod['unidades'];
                        $talla = $datos['talla'];

                        
                        $htmlArray .= <<<EOF
                        <div class="prodPedido">
                            <div class="imagenPed">
                                <img src='$img' alt='imagen'>
                            </div>

                            <div class="datos">
                            <h3>$nombre</h3> 
                            <p>Talla: $talla </p>
                            <p>Precio/unidad: $precio €</p>
                            <p>Unidades: $und</p>
                            </div>

                            <div class="devolverProd">
                                <button class='btn'>
                                <a href='pedidos.php?id_Ped={$id}&id_Prod={$idProd}&num={$num}&talla={$talla}&und={$und}'>Devolver producto</a>
                                </button>
                            </div>
                        
                            <div class="valoracion">
                        EOF;

                        if(!valoraciones::existeVal($_SESSION['idUsuario'],$idProd) && array_search(1,$_SESSION['roles']) === false){
                            
                            $htmlArray .= <<<EOF
                            
                            <div class="estrellas">
                            <form id="val" action='GestionValorar.php' method='POST'>
                            <input type='hidden' name='id_prod' value='$idProd'>
                            <p class="valorar">
                            <input onchange='this.form.submit();' id="estrella5$idProd" type='radio' name='val$idProd' value="5">
                            <label for="estrella5$idProd">&#9733</label>
                            <input onchange='this.form.submit();' id="estrella4$idProd" type='radio' name='val$idProd' value="4">
                            <label for="estrella4$idProd">&#9733</label>
                            <input onchange='this.form.submit();' id="estrella3$idProd" type='radio' name='val$idProd' value="3">
                            <label for="estrella3$idProd">&#9733</label>
                            <input onchange='this.form.submit();' id="estrella2$idProd" type='radio' name='val$idProd' value="2">
                            <label for="estrella2$idProd">&#9733</label>
                            <input onchange='this.form.submit();' id="estrella1$idProd" type="radio" name="val$idProd" value="1">
                            <label for="estrella1$idProd">&#9733</label>
                            </p>
                            </form>
                            </div>
                            EOF;
                            
                        }
                        else if(array_search(1,$_SESSION['roles']) === false){
                            $htmlArray .= <<<EOF
                                <p>Producto ya valorado por el usuario</p>
                            EOF;
                        }
                        else{
                            $htmlArray .= <<<EOF
                                <p>Un administrador no puede valorar</p>
                            EOF;
                        }
                        $htmlArray .= <<<EOF
                    </div>           
                    </div>
                                    
                    EOF;
                    }   
                    $htmlArray .= <<<EOF
                    <div class="precioTotal">
                    <p class="direccion">Direccion de envio: $direccion</p>
                    <p>Precio total: $precioTotal €</p></div>       
                    </div>
                                    
                    EOF;
                }

                
                

                return  $htmlArray;
            }
            else{
                    return  "<h1>No tiene ningun pedido realizado</h1>";
            }
        
        }
        else{
            return "<h1>No ha iniciado sesión, es necesario para tener pedidos</h1>";
        }

    }
}