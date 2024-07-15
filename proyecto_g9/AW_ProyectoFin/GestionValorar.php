<?php

namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\clases\Valoraciones;

require_once __DIR__.'/includes/config.php';

if(isset($_POST["id_prod"])){
    $idU = $_SESSION['idUsuario'];
    $idP = htmlspecialchars(trim(strip_tags($_POST["id_prod"])));
    $val = htmlspecialchars(trim(strip_tags($_POST["val$idP"])));
    
    
    Valoraciones::nuevaVal($idU, $idP, $val);
    
    $mensajes = ['Producto valorado correctamente!'];
    $app->putAtributoPeticion('mensajes', $mensajes);
}

header('Location:pedidos.php');

?>
