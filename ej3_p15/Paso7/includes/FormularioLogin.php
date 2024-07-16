<?php
namespace es\ucm\fdi\aw;


class FormularioLogin extends Formulario
{
    public function __construct() {
        parent::__construct('formLogin', ['urlRedireccion' => 'index.php']);
    }
    
    protected function generaCamposFormulario(&$datos) //FUNCION HEREDADA
    {
        
        $nombreUsuario = (isset($datos['nombreUsuario']) && !empty($datos['nombreUsuario'])) ? $datos['nombreUsuario'] : ''; //Usamos el nombre de usuario si existe y no está vacio,sino se asigna un espacio en blanco


        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores); //sacado de procesar login
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'password'], $this->errores, 'span', array('class' => 'error')); //sacado de procesar login y viendo parametros de generaErroresCampos de Clas FOrmulario

        //sacado de login, añade las variables de los errores
        $html = <<<EOS
        $htmlErroresGlobales
        <fieldset>
            <legend>Usuario y contraseña</legend>
            <div>
                <label for="nombreUsuario">Nombre de usuario:</label>
                <input id="nombreUsuario" type="text" name="nombreUsuario" value="$nombreUsuario" />
                {$erroresCampos['nombreUsuario']}
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" />
                {$erroresCampos['password']}
            </div>
            <div>
                <button type="submit" name="login">Entrar</button>
            </div>
        </fieldset>
        EOS;
        return $html;
    }

    protected function procesaFormulario(&$datos)//FUNCION HEREDADA ,esta funcion es la misma que procesar login 
    {
        $this->errores = [];
        $nombreUsuario = (isset($datos['nombreUsuario']) && !empty($datos['nombreUsuario'])) ? $datos['nombreUsuario'] : ''; //Usamos el nombre de usuario si existe y no está vacio,sino se asigna un espacio en blanco
        $password = (isset($datos['password']) && !empty($datos['password'])) ? $datos['password'] : ''; //Usamos la contyraseña si existe y no está vacio,sino se asigna un espacio en blanco

        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS); //FILTRAMOS PARA QUE NO TENGA CARACTERES ESPECIALES
        if ( ! $nombreUsuario || empty($nombreUsuario=trim($nombreUsuario)) ) {
	        $this->errores['nombreUsuario'] = 'El nombre de usuario no puede estar vacío';
        }

        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password=trim($password)) ) {
	    $this->errores['password'] = 'El password no puede estar vacío.';
        }

        if (count($this->errores) === 0) {
	        $usuario =Usuario::login($nombreUsuario, $password);
	
	        if (!$usuario) {
		    $this->errores[] = "El usuario o el password no coinciden";
	        } else {
		    $_SESSION['login'] = true;
		    $_SESSION['nombre'] = $usuario->getNombre();
		    $_SESSION['esAdmin'] = $usuario->tieneRol(Usuario::ROL_ADMIN); //comprueba si es admin
		    header('Location: index.php');
		    exit();
	        }
        }   
    }
}
