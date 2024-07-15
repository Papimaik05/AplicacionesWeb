<?php

namespace es\ucm\fdi\aw\mostrar;

use es\ucm\fdi\aw\clases\Valoraciones;
use es\ucm\fdi\aw\clases\Producto;

class MostrarCarrito
{
    
    public function gestiona()
    {

        if(isset($_GET['eliminar']) && isset($_GET['id_Prod']) && isset($_GET['talla'])){
            if(count($_SESSION['carro']) > 1){
                $carrito = $_SESSION['carro'];
                foreach($carrito as $keys => $valores){
                    if(($valores["id"] == $_GET['id_Prod']) && ($valores["talla"] == $_GET['talla']) ){
                        unset($_SESSION['carro'][$keys]);
                    }
                } 
            }
            else{
                unset($_SESSION['carro']);
            }
                      
        }

        if(isset($_SESSION['carro'])){
            $carrito = $_SESSION['carro'];
            $precioTotal = 0;

            $htmlTienda = <<<EOF
                <div class="carrito">
             EOF;

            
            foreach($carrito as $keys => $valores){

            $datos  = Producto::getDatosProducto($valores["id"]); // conseguimos toda la info para mostrarla 
        
            $nombre = $datos['nombre'];
            if($datos['precio_oferta'] != null){
                $precio = $datos['precio_oferta'];
            }
            else{
               $precio = $datos['precio']; 
            }
             
            $talla = $valores["talla"];
            $img = $datos['img'];
            $und = $valores["unidades"];
            $precioTotal += ($precio * $und);

            
        
            $html = <<<EOF
            <div class="productoCar">
                

                    <div class="datos">
                    <div class="nombre">
                    <h3>$nombre</h3>
                    </div>
                    <div class="img">
                    <img src='$img' alt='imagen' class='imgProductoCarro'>
                    </div>
                    <div  class="precio">
                    <p>Precio/unidad: $precio €</p>
                    </div>
                    <div  class="talla">
                    <p>Talla: $talla</p>
                    </div>
                    <div  class="und">
                    <p>Unidades: $und</p>
                    </div>
                    </div>
                    <button class='btn'>
                        <a href='carrito.php?id_Prod={$valores["id"]}&talla=$talla&eliminar=1'><img src='img/cancelar.png'></a>
                    </button>
            </div>

        
            EOF;

            $htmlTienda.=$html;

            } 

            $htmlTienda.= <<<EOF

            </div>
            EOF;

            if($_SESSION['saldo'] >= $precioTotal){
                $htmlTienda.= <<<EOF

            
            <div class="hacerPed">
            <h2>Precio total: $precioTotal €</h2>
        
                    <form action='GestionPedido.php' method='POST'>
                    <input type='hidden' name='hidden_precioTot' value='$precioTotal'>
                    <p>Direccion de envio: <input type="text" name="direccion" value="FDI UCM"></p>
                    <input class='boton' type='submit' name='hacerPedido' value='Realizar pedido'>
                    </form>
            </div>
            EOF;
            }
            else{
                $htmlTienda.= <<<EOF
                <div class="sinSaldo">
                <p>No tienes saldo suficiente para la compra</p>
                </div>
            EOF;
            }
            
            return $htmlTienda;
           
        }else{
            return "No tienes ningun producto en el carrito";
        }

    }
}
