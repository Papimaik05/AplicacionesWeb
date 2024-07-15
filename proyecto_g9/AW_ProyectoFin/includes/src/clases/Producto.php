<?php

namespace es\ucm\fdi\aw\clases;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\MagicProperties;

class Producto
{
    use MagicProperties;

    public static function crea($nombreProducto, $descripcion, $precio, $precio_oferta, $id_categoria, $talla, $stock, $img)
    {
        $existe = self::buscaProducto($nombreProducto);
        if(!$existe){
            $producto = new Producto($nombreProducto, $descripcion, $precio, $precio_oferta, $id_categoria, $talla, $stock, $img);
            return $producto->guarda();
        }
        else{
            return false;
        }    
    }

    public static function getProducto($id){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $idxx = $conn->real_escape_string($id);
        $consulta = "SELECT * FROM Productos WHERE id_producto = '$idxx'";
        $result = $conn->query($consulta); 
        $fila = $result->fetch_assoc();
        $result->free();

        return $fila; 
    }

    public static function eliminarProducto($idProd){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $idp = $conn->real_escape_string($idProd);
        $consulta = "DELETE FROM Productos WHERE id_producto = '$idp'";
        $result = $conn->query($consulta); 
        
        return $result;
    }

    public static function cambiarStock($id, $und){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $un = $conn->real_escape_string($und);
        $idx = $conn->real_escape_string($id);
        $actualizar = "UPDATE Productos SET stock = stock - '$un' WHERE id_producto = '$idx'";
        $conn->query($actualizar);
    }

    public static function ponerEnOferta($idP, $precio_oferta){
        $conn = Aplicacion::getInstance()->getConexionBd();
        if($precio_oferta == null){
            $idx = $conn->real_escape_string($idP);
            $actualizar = "UPDATE Productos SET precio_oferta = NULL WHERE id_producto = '$idx'";
        }
        else{
            $idy = $conn->real_escape_string($idP);
            $actualizar = "UPDATE Productos SET precio_oferta = '$precio_oferta' WHERE id_producto = '$idy'";
        }
        
        $conn->query($actualizar);
    }

    public static function buscaProducto($nombreProducto)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Productos WHERE nombre='%s'", $conn->real_escape_string($nombreProducto));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = true;
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private static function inserta($producto)
    {   
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO Productos(nombre, descripcion, id_categoria, precio, precio_oferta, talla, stock, img, fecha) VALUES ('%s', '%s', '%s', '%s', NULLIF('%s', ''), '%s', '%s', '%s', CURDATE())"
            , $conn->real_escape_string($producto->nombreProducto)
            , $conn->real_escape_string($producto->descripcion)
            , $conn->real_escape_string($producto->id_categoria)
            , $conn->real_escape_string($producto->precio)
            , $conn->real_escape_string($producto->precio_oferta)
            , $conn->real_escape_string($producto->talla)
            , $conn->real_escape_string($producto->stock)
            , $conn->real_escape_string($producto->img)
        );
        if ( $conn->query($query) ) {
            $producto->id = $conn->insert_id;
            $result = true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private static function actualiza($producto)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE Productos U SET nombre = '%s', descripcion='%s', id_categoria='%s', precio='%s', precio_oferta='%s', talla='%s' stock='%s',img='%s'   WHERE U.id_producto=%d"
            , $conn->real_escape_string($producto->nombreProducto)
            , $conn->real_escape_string($producto->descripcion)
            , $conn->real_escape_string($producto->id_categoria)
            , $conn->real_escape_string($producto->precio)
            , $conn->real_escape_string($producto->precio_oferta)
            , $conn->real_escape_string($producto->talla)
            , $conn->real_escape_string($producto->stock)
            , $conn->real_escape_string($producto->img)
            , $producto->id
        );
        if ( $conn->query($query) ) {
            $result = true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public function guarda()
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }

    public static function muestraTienda($idCat){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $map = [];
        if($idCat == 0){
            $consulta = "SELECT * FROM Productos"; //hacemos la consulta para todos los productos
        }
        else if($idCat === 'nuevo'){
            $consulta = "SELECT * FROM Productos WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
        }
        else if($idCat === 'ofertas'){
            $consulta = "SELECT * FROM Productos WHERE precio_oferta IS NOT NULL";
        }
        else{
            $id_c = $conn->real_escape_string($idCat);
            $consulta = "SELECT * FROM Productos WHERE id_categoria = '$id_c'"; //hacemos la consulta para todos los productos
        }
        $result = $conn->query($consulta); 

        if($result){ // no hay problema en la consulta realizada 
            if($result->num_rows > 0){//comprobamos que hay mas de una fila 
                foreach($result as $fila){
                    $map[] = $fila;
                }
            }
        }
        $result->free();
        return  $map;
    }

    public static function getDatosProducto($id){
        $producto = self::getProducto($id);
        return $producto; 
    }

    public static function reducirStock($id,$und){
        self::cambiarStock($id, $und);
    }

    public static function añadirStock($id,$und){
       self::cambiarStock($id, -$und);
    }
    
    private $id;
    private $nombreProducto;
    private $descripcion;
    private $id_categoria;
    private $id_estado;
    private $precio;
    private $precio_oferta;
    private $talla;
    private $stock;
    private $img;

    private function __construct($nombreProducto, $descripcion, $precio, $precio_oferta, $id_categoria, $talla, $stock, $img)
    {
        $this->id = null;
        $this->nombreProducto = $nombreProducto;
        $this->descripcion = $descripcion;
        $this->id_categoria = $id_categoria;
        $this->precio = $precio;
        $this->talla = $talla;
        $this->precio_oferta = $precio_oferta;
        $this->stock = $stock;
        $this->img = $img;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getnombreProducto()
    {
        return $this->nombreProducto;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getId_categoria()
    {
        return $this->id_categoria;
    }

    public function getId_estado()
    {
        return $this->id_estado;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setNombreProductoe($nombreProducto) {
         $this->nombre = $nombreProducto;
    }
	
    public function setDescripcion($descripcion) {
         $this->descripcion = $descripcion;
    }
  
    public function setId_categoria($idCategoria) {
         $this->id_categoria = $idCategoria;
    }
	
	public function setId_estado($idEstado) {
         $this->id_estado = $idEstado;
    }
	
	public function setPrecio($precio) {
         $this->precio = $precio;
    }
	
	public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }
}
