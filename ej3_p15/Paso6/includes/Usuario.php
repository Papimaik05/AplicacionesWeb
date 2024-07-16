<?php

class Usuario{

    public const ROL_ADMIN= 1; //ESTO LO USAMOS PARA AÑADIR EL ROL A LA HORA DE CREAR

    public const ROL_USUARIO = 2;

    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) { 
            return self::cargaRoles($usuario); //metemos los roles xq puede tener mas de uno
        }
        return false;
    }

    public static function buscaUsuario($nombreUsuario) //busca por nombre de usuario
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario='%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if(isset($fila)){
                $user = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id'],); //son los unicos componentes que puedes sacar de la tabla usuarios
                $rs->free();
                return $user;
            }
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }
    
    public static function crea($nombreUsuario, $password, $nombre, $rol)
    {
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre); //creamos el usuario,debido a que la id es automatica 
        $user->añadeRol($rol); //metemos el rol (usuario)
        return $user->guarda();
    }

    public static function buscaPorId($idUsuario) //En este programa no lo utilizamos pero es necesario debido a que es la clave primaria
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            $user = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id']);
            $rs->free();

            return $user;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    

    private static function cargaRoles($usuario) //carga todos los roles
    {       
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT RU.rol FROM RolesUsuario RU WHERE RU.usuario=%d"
            , $usuario->id
        );
        $rs = $conn->query($query);
        if ($rs) {
            $rolesRows = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();
            $usuario->roles = [];
            foreach($rolesRows as $rol) {
                $usuario->roles[] = $rol['rol']; //Podriamos usar tb la opcion de array_push,pero para meterlos de uno en uno puede sobrecargar
               
            }
            return $usuario;

        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }
   
    private static function inserta($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password) VALUES ('%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
        );
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id; //metemos la id,que se mete con el auto increment
            $result = self::insertaRoles($usuario); //metes los roles que tiene el usuario en la tablaroles
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
   
    private static function insertaRoles($usuario) //metes todos los roles en la tabla usuario
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        foreach($usuario->roles as $rol) { //vas uno por uno
            $query = sprintf("INSERT INTO RolesUsuario(usuario, rol) VALUES (%d, %d)"
                , $usuario->id
                , $rol
            );
            if ( ! $conn->query($query) ) {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        }
        return $usuario;
    }
    
    private static function actualiza($usuario) //No nos hace falta en este programa,pero a la hora de guardar un id si ese id ya esta en nuestra bd tenemos que actualizarlo
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE Usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s' WHERE U.id=%d"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $usuario->id
        );
        if ( $conn->query($query) ) {
            $result = self::borraRoles($usuario); //vaciamos los roles para añadirlos de nuevo
            if ($result) {
                $result = self::insertaRoles($usuario); //los volvemos a meter de forma actualizada
            }
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $result;
    }
   
    private static function borraRoles($usuario) //borra de la tabla rolesusuario
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM RolesUsuario RU WHERE RU.usuario = %d"
            , $usuario->id
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return $usuario;
    }
    
    private static function eliminarUsuario($usuario)
    {
        
        return self::borraPorId($usuario->id) && self::borraRoles($usuario);
    }
    
    private static function borraPorId($idUsuario) //borra de la tabla usuario
    {
        if (!$idUsuario) { //cuando es null
            return false;
        } 
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM Usuarios U WHERE U.id = %d"
            , $idUsuario
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    private $id;

    private $nombreUsuario;

    private $password;

    private $nombre;

    private $roles;

    private function __construct($nombreUsuario, $password, $nombre, $id = null, $roles = [])
    {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->roles = $roles;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function añadeRol($role) //mete en la ult posicion
    {
        $this->roles[] = $role;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function tieneRol($role) 
    {
        if ($this->roles == null) {
            self::cargaRoles($this);
        }
        return array_search($role, $this->roles) !== false;
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }
    
    private static function hashPassword($password) //para hashear
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
    
    public function guarda()
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }
    
    public function borrate() //No lo usamos pero es una funcion necesaria para la edicion de un perfil
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }
}
?>