<?php

namespace es\ucm\fdi\aw\clases;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\MagicProperties;

class Favorito {

	use MagicProperties;

    public static function crea($id_usuario, $id_producto)
    {
        $favorito = new Favorito($id_usuario, $id_producto);

        return $favorito->guarda();
    }

    public static function getFavorito($id_usuario){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $id_us = $conn->real_escape_string($id_usuario);
        $consulta = "SELECT * FROM Favoritos WHERE id_usuario = '$id_us'";
        $result = $conn->query($consulta); 
        $fila = $result->fetch_assoc();
        $result->free();
        return $fila; 
    }

    private static function inserta($favorito)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO Favoritos(id_usuario, id_producto) VALUES ('%s', '%s')"
            , $conn->real_escape_string($favorito->id_usuario)
            , $conn->real_escape_string($favorito->id_producto)
        );
        if ( $conn->query($query) ) {
            $favorito->id_favorito = $conn->insert_id;
            $result = true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private static function actualiza($favorito)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE Favoritos U SET id_usuario = '%s', id_producto='%s' WHERE U.id_favorito=%d"
            , $conn->real_escape_string($favorito->id_usuario)
            , $conn->real_escape_string($favorito->id_producto)
            , $favorito->id_favorito
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
        if ($this->id_favorito !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }

    public static function muestraFavoritos($id_usuario){

        $conn = Aplicacion::getInstance()->getConexionBd();
        $map = []; 
        $id_us = $conn->real_escape_string($id_usuario);
        $consulta = "SELECT * FROM Favoritos WHERE id_usuario = '$id_us'";
        $result = $conn->query($consulta); 
        
        if($result){
            if($result->num_rows > 0){ 
                foreach($result as $fila){
                    $map[] = $fila;
                }
            }
        }
        $result->free();
        return $map;
    }
	
    public static function existeProducto($idU, $idP){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $id_us = $conn->real_escape_string($idU);
        $id_pr = $conn->real_escape_string($idP);
        $consulta = "SELECT * FROM Favoritos WHERE (id_usuario = '$id_us') AND (id_producto = '$id_pr')";
        $result = $conn->query($consulta);

        if($result->num_rows === 0){// no se ha conseguido ninguna coincidencia, no esta resgistrado
            $result->free();
            return false; 
        }
        else{
            $result->free();
            return true; 
        }
    }

    public static function eliminarFav($idFav){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $id_f = $conn->real_escape_string($idFav);
        $consulta = "DELETE  FROM Favoritos WHERE (id_favorito = '$id_f')";
        $result = $conn->query($consulta);

        return $result;
    }

    public static function existePro($idUsu, $idProd){
        return self::existeProducto($idUsu, $idProd);
    }

	// public function borrate($favorito)
    // {
    //     if ($favorito->id_favorito !== null) {
    //         return self::borra($favorito);
    //     }
    //     return false;
    // }
	
	// private static function borra($favorito)
    // {
    //     if (!$id_favorito) {
    //         return false;
    //     } 
    //     $conn = Aplicacion::getInstance()->getConexionBd();
    //     $query = sprintf("DELETE FROM Favoritos P WHERE P.id_favorito = %d"
    //         , $id_favorito
    //     );
    //     if ( !$conn->query($query) ) {
    //         error_log("Error BD ({$conn->errno}): {$conn->error}");
    //         return false;
    //     }
    //     return true;
    // }

    // public static function borraPorUsuario($id_usuario)
    // {
    //     if (!$id_usuario) {
    //         return false;
    //     } 
    //     $conn = Aplicacion::getInstance()->getConexionBd();
    //     $query = sprintf("DELETE FROM Favoritos P WHERE P.id_usuario = %d"
    //         , $id_usuario
    //     );
    //     if ( !$conn->query($query) ) {
    //         error_log("Error BD ({$conn->errno}): {$conn->error}");
    //         return false;
    //     }
    //     return true;
    // }


	
	private $id_favorito;
    private $id_usuario;
	private $id_producto;

     public function __construct($id_usuario, $id_producto, $id_favorito = null) {
        $this->id_favorito = $id_favorito;
		$this->id_usuario = $id_usuario;
		$this->id_producto = $id_producto;
    }

	public function getid_favorito() {
        return $this->id_favorito;
    }

    public function getid_usuario() {
        return $this->id_usuario;
    }
	
	public function getid_producto() {
        return $this->id_producto;
    }

	public function setid_favorito($id_favorito) {
         $this->id_favorito = $id_favorito;
    }
	
    public function setid_usuario($id_usuario) {
         $this->id_usuario = $id_usuario;
    }
	
	public function setid_producto($id_producto) {
         $this->id_producto = $id_producto;
    }
}

?>
