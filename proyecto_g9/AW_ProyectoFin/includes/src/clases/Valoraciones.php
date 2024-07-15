<?php

namespace es\ucm\fdi\aw\clases;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\MagicProperties;

class Valoraciones {


    public static function existeValoracion($idU, $idP){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $id_us = $conn->real_escape_string($idU);
        $id_pe = $conn->real_escape_string($idP);
        $consulta = "SELECT * FROM Valoraciones WHERE (id_usuario = '$id_us') AND (id_producto = '$id_pe')";
        $result = $conn->query($consulta);

        if($result->num_rows === 0){// no se ha conseguido ninguna coincidencia, no esta resgistrado
            return false; 
        }
        else{
            return true; 
        }
    }

    public static function agregarVal(Valoraciones $val){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $idU = $val->getId_usuario();
        $idP = $val->getId_producto();
        $punt = $val->getPuntuacion();
        $consulta = sprintf("INSERT INTO Valoraciones (id_usuario, id_producto, puntuacion) VALUES ('%s','%s','%s')"
        , $conn->real_escape_string($idU)
        , $conn->real_escape_string($idP)
        , $conn->real_escape_string($punt)
    );

        $result = $conn->query($consulta);

        if($result === TRUE){
            return true; 
        }
        else{
            return false; 
        }
    }

    public static function valoracionProd($idProd){
        $punt = -1;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $id_pr = $conn->real_escape_string($idProd);
        $consulta = "SELECT SUM(puntuacion) FROM Valoraciones WHERE (id_producto = '$id_pr')";
        $consulta1 = "SELECT COUNT(puntuacion) FROM Valoraciones WHERE (id_producto = '$id_pr')";

        $result = $conn->query($consulta);
        $result1 = $conn->query($consulta1);

        $suma = $result->fetch_assoc();
        $num = $result1->fetch_assoc();

        $numVal = $num['COUNT(puntuacion)'];
        $sum = $suma['SUM(puntuacion)'];

        if($result && $numVal){
           return $punt = round($sum / $numVal);
        }

        return $punt;

    }
    public static function existeVal($idUsu, $idProd){
        return self::existeValoracion($idUsu, $idProd);
    }

    public static function nuevaVal($idUsu, $idProd, $punt){
        $val = new Valoraciones();
        $val->setId_usuario($idUsu);
        $val->setId_producto($idProd);
        $val->setPuntuacion($punt);
        return self::agregarVal($val);
    }

    public function valoracionProducto($idProd){
        return self::valoracionProd($idProd);
    }


    private $id_usuario;
    private $id_producto; 
    private $puntuacion; 

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function getId_producto(){
        return $this->id_producto;
    }

    public function getPuntuacion(){
        return $this->puntuacion;
    } 

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function setId_producto($id_producto){
        $this->id_producto = $id_producto;
    }

    public function setPuntuacion($puntuacion){
        $this->puntuacion = $puntuacion;
    }
}

?>