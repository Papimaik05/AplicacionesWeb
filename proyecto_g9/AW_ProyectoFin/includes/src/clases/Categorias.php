<?php

namespace es\ucm\fdi\aw\clases;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\MagicProperties;

class Categorias{

    use MagicProperties;

    public static function crea($nombreCategoria)
    {   
        $existe = self::buscaCat($nombreCategoria);
        if($existe){
            return false;
        }
        else{
        $categoria = new Categorias($nombreCategoria);
        }
        return $categoria->guarda();
    }
    
    public static function getCategorias(){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $map = [];
        $consulta = "SELECT * FROM Categorias"; //hacemos la consulta para todos los productos
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

    public static function buscaCat($nombreC)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Categorias WHERE nombre='%s'", 
        $conn->real_escape_string($nombreC));
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

    private static function inserta($categoria)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO Categorias(nombre) VALUES ('%s')"
            , $conn->real_escape_string($categoria->nombre)
        );
        if ( $conn->query($query) ) {
            $categoria->id_categoria = $conn->insert_id;
            $result = true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public function guarda()
    {

        if ($this->id_categoria !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }


    
    private $id_categoria;

    private $nombre;

    private function __construct($nom)
    {
        $this->id_categoria = null;
        $this->nombre = $nom;
    }

    public function getIdCat()
    {
        return $this->id_categoria;
    }

    public function getNombreCat()
    {
        return $this->nombre;
    }

}