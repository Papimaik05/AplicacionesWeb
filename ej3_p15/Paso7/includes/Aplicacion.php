<?php

namespace es\ucm\fdi\aw;

class Aplicacion{
    private static $instancia ;
    private $bdDatosConexion;
    private $inicializada = false;
    private $conn;

    public static function getInstance() {
		if (  !self::$instancia instanceof self) {
			self::$instancia = new static();
		}
		return self::$instancia;
	}

    private function __construct(){

	}

    public function init($bdDatosConexion){
        if(!$this->inicializada){ //si no se ha inicializado
            $this->inicializada = true;
            $this->bdDatosConexion = $bdDatosConexion;
    		session_start();
        }
    }

    private function compruebaInstanciaInicializada()
	{
	    if (! $this->inicializada ) {
	        echo "Aplicacion no inicializa";
	        exit();
	    }
	}

    public function shutdown()
	{
	    $this->compruebaInstanciaInicializada();
	    if ($this->conn !== null && ! $this->conn->connect_errno) {
	        $this->conn->close();
	    }
	}

    public function getConexionBd()
	{
	    $this->compruebaInstanciaInicializada();
		if (! $this->conn ) {
			$bdHost = $this->bdDatosConexion['host'];
            $bd = $this->bdDatosConexion['bd'];
			$bdUser = $this->bdDatosConexion['user'];
			$bdPass = $this->bdDatosConexion['pass'];
			
			$conn = new \mysqli($bdHost, $bdUser, $bdPass, $bd);
			if ( $conn->connect_errno ) {
				echo "Error de conexión a la BD ({$conn->connect_errno}):  {$conn->connect_error}";
				exit();
			}
			if ( ! $conn->set_charset("utf8mb4")) {
				echo "Error al configurar la BD ({$conn->errno}):  {$conn->error}";
				exit();
			}
			$this->conn = $conn;
		}
		return $this->conn;
	}

}
?>