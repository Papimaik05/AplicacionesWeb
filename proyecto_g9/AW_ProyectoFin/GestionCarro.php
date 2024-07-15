<?php 

require_once __DIR__.'/includes/config.php';


$id = htmlspecialchars(trim(strip_tags($_POST["hidden_id"]))); 
$talla = htmlspecialchars(trim(strip_tags($_POST["talla"])));
$unidades =  htmlspecialchars(trim(strip_tags($_POST["unidades_compra"])));
$stock = htmlspecialchars(trim(strip_tags($_POST["hidden_stock"])));


if(isset($_POST['add_car'])){//  primero vemos la accion que queremos realizar 
    //vamos a verificar que esta loguada, necesario para añadir al carro
    $datosProducto = array(
        'id' => $id, 
        'talla' => $talla,
        'unidades' => $unidades
    ); 
   

    if($app->tieneRol(es\ucm\fdi\aw\clases\Usuario::USER_ROLE)){
        //vamos a pasar los datos del carrito como una variable de sesiom por lo que tendremos dos opciones, el carrito sera una array 
        // 1. Ya esta creada la variable, asi que añadimos el siguiente item 
        //2. No esta creada, lo creamos 
        if(isset($_SESSION["carro"])){
       
            $existe = in_array($id, array_column($_SESSION["carro"], "id")); // para comprobar si el producto esta en el carro o no
            // existe: De tipo bool 
            //array_column(): $_SESSION["carro"] -> tenemos un array con los productos y sus datos el cual es otro array, lo que hace esta funcion es que a partir de este array nos crea otro pero solo con la columna de id_producto
            //tenemos otro array con todos los id de productos que hay en el carro  
            //in_array(): devuelve un booleano si el $id esta en el array que hemos creado con todos los id de los productos, es decir, true si producto ya esta en el carrito, false en caso contrario
          
            if(!$existe){// no esta agregado 
                $numItems = count($_SESSION["carro"]); //vemos el numero de elementos que hay ya en el carro porque ese valor sera el indice del nuevo producto
                $_SESSION["carro"][$numItems] = $datosProducto;
            }
            else{
                $carrito = $_SESSION['carro'];
                $i = 0;
                foreach($carrito as $keys => $valores){
                    if($valores["id"] == $id){
                        if(($_SESSION["carro"][$i]["unidades"] + $unidades) <= $stock){
                            $_SESSION["carro"][$i]["unidades"] += $unidades;
                            $noStock = false;
                        }
                        else{
                            $noStock = true;
                        }
                    }
                    else{
                        $i++;
                    }
                }
            }
        }
        else{
            $_SESSION["carro"][0] = $datosProducto;
        }

    }
    if($noStock){
        $mensajes = ['¡No hay stock entre lo ya añadido al carrito y lo que quieres añadir!'];
    }
    else{
        $mensajes = ['¡Producto añadido al carrito!'];
    }
    
    $app->putAtributoPeticion('mensajes', $mensajes);
    
}

header('Location:catalogo.php');
