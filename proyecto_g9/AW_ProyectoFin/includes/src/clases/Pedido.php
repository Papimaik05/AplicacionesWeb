<?php

namespace es\ucm\fdi\aw\clases;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\MagicProperties;

class Pedido {


    public static function registrarPedidoBd(Pedido $ped){
        $conn = Aplicacion::getInstance()->getConexionBd(); 

        $idPed = $ped->getPedidoId(); 
        $idUsu = $ped->getIdUsu();
        $direccion = $ped->getDireccion();
        $precioTotal = $ped->getPrecioTotal();

        $consulta = sprintf("INSERT INTO Pedidos (id_pedido, id_usuario, direccion, precioTotal) VALUES ('%d','%s','%s','%s')"
        , $idPed
        , $conn->real_escape_string($idUsu)
        , $conn->real_escape_string($direccion)
        , $conn->real_escape_string($precioTotal)
    );

        $result = $conn->query($consulta);

        if($result === TRUE){
            return true; 
        }
        else{
            return false; 
        }
    }

    public static function registrarArticulosPedido($producto, $idPed){
        $conn = Aplicacion::getInstance()->getConexionBd();

        $consulta = "INSERT INTO ArticulosPedido (id_pedido, id_producto, unidades) VALUES ('$idPed','$producto[id]','$producto[unidades]')";

        $result = $conn->query($consulta);

        if($result === TRUE){
            return true; 
        }
        else{
            return false; 
        }
    }

    public static function obtenerArticulosPedido($idPed){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $map = []; 
        $id_p = $conn->real_escape_string($idPed);
        $consulta = "SELECT * FROM ArticulosPedido WHERE id_pedido = '$id_p'"; 
        $result = $conn->query($consulta); 

        if($result){ // no hay problema en la consulta realizada 
            if($result->num_rows > 0){//comprobamos que hay mas de una fila 
                foreach($result as $fila){
                    $map[] = $fila; 
                }
            }
        }
        $result->free();
        return $map;
    }

    public static function borrarArticulosPedido($idPed, $idProd, $talla){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $id_p = $conn->real_escape_string($idPed);
        $id_pr = $conn->real_escape_string($idProd);
        $tal = $conn->real_escape_string($talla);
        $consulta = "DELETE  FROM ArticulosPedido WHERE id_pedido = '$id_p' AND id_producto = '$id_pr'";
        $result = $conn->query($consulta);

        return $result;
    }

    public static function contarPedidosUsu($idUsu){
        if(self::contarPedidos() > 0){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $id_u = $conn->real_escape_string($idUsu);
        $consulta = "SELECT COUNT(*) FROM Pedidos WHERE id_usuario = '$id_u'" ;
        $result = $conn->query($consulta);
        $numPed = $result->fetch_assoc();
        $result->free();

        return $numPed['COUNT(*)'];  
        }
        
    }

    public static function obtenerPedIdP($idP){
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $id_p = $conn->real_escape_string($idP);
        $consulta = "SELECT * FROM Pedidos WHERE id_pedido = '$id_p'"; //hacemos la consulta para todos los productos
        $result = $conn->query($consulta);
        $fila = $result->fetch_assoc();
        $result->free();
        if($fila){
            $ped = new Pedido();
            $ped->setPedidoID($fila['id_pedido']);
            $ped->setIdUsu($fila['id_usuario']);
            $ped->setArticulos($fila['articulos']);
            $ped->setDireccion($fila['direccion']);
            $ped->setPrecioTotal($fila['precioTotal']);
            $ped->setNumArticulos($fila['numArticulos']);
            return $ped; 
        }
        return false;

    }

    public static function obtenerPedidos($idUsu){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $map = []; 
        $id_u = $conn->real_escape_string($idUsu);
        $consulta = "SELECT * FROM Pedidos WHERE id_usuario = '$id_u'"; 
        $result = $conn->query($consulta); 

        if($result){ // no hay problema en la consulta realizada 
            if($result->num_rows > 0){//comprobamos que hay mas de una fila 
                foreach($result as $fila){
                    $map[] = $fila; 
                }
            }
        }
        $result->free();
        return $map;
    }

    public static function contarPedidos(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $consulta = "SELECT COUNT(*) FROM Pedidos";
        $result = $conn->query($consulta);
        $numPed = $result->fetch_assoc();
        $result->free();

        return $numPed['COUNT(*)'];
    }

    public static function eliminarPed($idPed){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $id_p = $conn->real_escape_string($idPed);
        $consulta = "DELETE FROM Pedidos WHERE id_pedido = '$id_p'";
        $result = $conn->query($consulta);

        return $result;
    }

    public static function contarPedidosUsuario($idUsu){
        return self::contarPedidosUsu($idUsu);
    }

    public static function obtenerPed($idUsu){
        return self::obtenerPedidos($idUsu);
    }

    public static function registrarPedido($idPed, $idUsu, $direccion, $precioTotal){
        $ped = new Pedido(); 
        $id = $idPed;
        $ped->setPedidoId($id); 
        $ped->setIdUsu($idUsu);
        $ped->setDireccion($direccion);
        $ped->setPrecioTotal($precioTotal);

        return self::registrarPedidoBd($ped);
    }

    public static function obtenerPedidoConId($idP){
        return self::obtenerPedIdP($idP);
    }

    public static function eliminarPedido($idPed){
        return self::eliminarPed($idPed);
    }


    private $id_Pedido;
    private $id_Usuario;
    private $articulos; 
    private $direccion; 
    private $precioTotal;
    private $numArt;

    public function __construct(){}

    public function getPedidoID(){
        return $this->id_Pedido;
    }

    public function getIdUsu(){
        return $this->id_Usuario;
    }

    public function getArticulos(){
        return $this->articulos;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getPrecioTotal(){
        return $this->precioTotal;
    }

    public function getNumArticulos(){
        return $this->numArt;
    }

    public function setPedidoID($id){
        $this->id_Pedido = $id;
    }

    public function setIdUsu($idUsuario){
        $this->id_Usuario = $idUsuario;
    }

    public function setArticulos($productos){
        $this->articulos = $productos;
    }

    public function setDireccion($dir){
        $this->direccion = $dir;
    }

    public function setPrecioTotal($precioTot){
        $this->precioTotal = $precioTot;
    }

    public function setNumArticulos($numA){
        $this->numArt = $numA;
    }
}

?>