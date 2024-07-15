<?php

namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\clases\Favorito;

require_once __DIR__.'/includes/config.php';

if(isset($_POST["add_fav"])){
    $idU = $_SESSION['idUsuario'];
    Favorito::crea($idU, $_POST["hidden_id"]);
    
    $mensajes = ['¡Producto añadido a favoritos!'];
    $app->putAtributoPeticion('mensajes', $mensajes);
}

if(isset($_POST["eli_fav"])){
    Favorito::eliminarFav($_POST["hidden_id"]);
    
    $mensajes = ['¡Producto eliminado de favoritos!'];
    $app->putAtributoPeticion('mensajes', $mensajes);
}

header('Location:catalogo.php');

?>

