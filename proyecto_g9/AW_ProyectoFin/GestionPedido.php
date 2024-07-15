<?php 

use es\ucm\fdi\aw\clases\Producto;
use es\ucm\fdi\aw\clases\Pedido;

require_once __DIR__.'/includes/config.php';

$precioTotal = htmlspecialchars(trim(strip_tags($_POST["hidden_precioTot"])));
$direccion = htmlspecialchars(trim(strip_tags($_POST["direccion"])));

    $carrito = $_SESSION['carro'];
    $numArt = 0;
    $idPed = Pedido::contarPedidos() + 1;
    
    Pedido::registrarPedido($idPed, $_SESSION["idUsuario"], $direccion, $precioTotal);
    foreach($carrito as $keys => $valores){
        Pedido::registrarArticulosPedido($valores, $idPed);
        Producto::reducirStock($valores["id"], $valores["unidades"]);
    }
    unset($_SESSION['carro']);

    $mensajes = ['¡Pedido realizado!'];
    $app->putAtributoPeticion('mensajes', $mensajes);

    header('Location:pedidos.php');
?>
