<?php
namespace es\ucm\fdi\aw;

class FormularioRegistro extends Formulario
{
    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos) //FUNCION HEREDADA
    {
        $nombreUsuario = (isset($datos['nombreUsuario']) && !empty($datos['nombreUsuario'])) ? $datos['nombreUsuario'] : ''; //Usamos el nombre de usuario si existe y no está vacio,sino se asigna un espacio en blanco
        $nombre = (isset($datos['nombre']) && !empty($datos['nombre'])) ? $datos['nombre'] : ''; //Usamos el nombre  si existe y no está vacio,sino se asigna un espacio en blanco

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores); //sacado de procesarregistro
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'nombre', 'password', 'password2'], $this->errores, 'span', array('class' => 'error')); //sacado de procesarregistro


        $html = <<<EOS
        $htmlErroresGlobales
        <fieldset>
            <legend>Datos para el registro</legend>
            <div>
                <label for="nombreUsuario">Nombre de usuario:</label>
                <input id="nombreUsuario" type="text" name="nombreUsuario" value="$nombreUsuario" />
                {$erroresCampos['nombreUsuario']}
            </div>
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                {$erroresCampos['nombre']}
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" />
                {$erroresCampos['password']}
            </div>
            <div>
                <label for="password2">Reintroduce el password:</label>
                <input id="password2" type="password" name="password2" />
                {$erroresCampos['password2']}
            </div>
            <div>
                <button type="submit" name="registro">Registrar</button>
            </div>
        </fieldset>
        EOS;
        return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $nombreUsuario = (isset($datos['nombreUsuario']) && !empty($datos['nombreUsuario'])) ? $datos['nombreUsuario'] : ''; //Usamos el nombre de usuario si existe y no está vacio,sino se asigna un espacio en blanco
        $nombre = (isset($datos['nombre']) && !empty($datos['nombre'])) ? $datos['nombre'] : ''; //Usamos el nombre si existe y no está vacio,sino se asigna un espacio en blanco
        $password = (isset($datos['password']) && !empty($datos['password'])) ? $datos['password'] : ''; //Usamos la contraseña si existe y no está vacio,sino se asigna un espacio en blanco
        $password2 = (isset($datos['password2']) && !empty($datos['password2'])) ? $datos['password2'] : ''; //Usamos lka contraseña2 si existe y no está vacio,sino se asigna un espacio en blanco


        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreUsuario || empty($nombreUsuario=trim($nombreUsuario)) || mb_strlen($nombreUsuario) < 5) {
            $this->errores['nombreUsuario'] = 'El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.';
        }

        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre || empty($nombre=trim($nombre)) || mb_strlen($nombre) < 5) {
            $this->errores['nombre'] = 'El nombre tiene que tener una longitud de al menos 5 caracteres.';
        }

        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password=trim($password)) || mb_strlen($password) < 5 ) {
            $this->errores['password'] = 'El password tiene que tener una longitud de al menos 5 caracteres.';
        }

        $password2 = filter_var($password2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password2 || empty($password2=trim($password2)) || $password != $password2 ) {
            $this->errores['password2'] = 'Los passwords deben coincidir';
        }

        if (count($this->errores) === 0) {
            $usuario = Usuario::crea($nombreUsuario, $password, $nombre, Usuario:: ROL_USUARIO);
	
	        if (! $usuario ) {
    	        $this->errores[] = "El usuario ya existe";
	        } else {
		        $_SESSION['login'] = true;
		        $_SESSION['nombre'] = $usuario->getNombre();
		        $_SESSION['esAdmin'] = false;
		        header('Location: index.php');
		        exit();
	        }
        }
    }
}