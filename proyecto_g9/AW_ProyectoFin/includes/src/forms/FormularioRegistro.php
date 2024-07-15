<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;
use es\ucm\fdi\aw\clases\Usuario;

class FormularioRegistro extends Formulario
{
    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => Aplicacion::getInstance()->resuelve('/index.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        $nombreUsuario = $datos['nombreUsuario'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $email = $datos['email'] ?? '';
        $telefono = $datos['telefono'] ?? '';
        $app = Aplicacion::getInstance();
        $loginUrl = $app->resuelve('/login.php');

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'nombre', 'password', 'password2', 'email', 'telefono'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <div class="formReg">
            <p>Datos para el registro</p>
            <div>
                <label for="nombreUsuario">Nombre de usuario:</label>
                <input id="nombreUsuario" type="text" name="nombreUsuario" value="$nombreUsuario" />
                <p>{$erroresCampos['nombreUsuario']}</p>
            </div>
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                <p>{$erroresCampos['nombre']}</p>
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" />
                <p>{$erroresCampos['password']}</p>
            </div>
            <div>
                <label for="password2">Reintroduce el password:</label>
                <input id="password2" type="password" name="password2" />
                <p>{$erroresCampos['password2']}</p>
            </div>
            <div>
                <label for="Email">Email:</label>
                <input id="email" type="text" name="email" value="$email" />
                <p>{$erroresCampos['email']}</p>
            </div>
            <div>
                <label for="Telefono">Telefono:</label>
                <input id="telefono" type="text" name="telefono" value="$telefono" />
                <p>{$erroresCampos['telefono']}</p>
           </div>
            
            <div>
                <button type="submit" name="registro">Registrar</button>
            </div>

            <div>
            <h4>¿Ya tienes una cuenta? <a href="{$loginUrl}">Iniciar sesión</a></h4>
            </div>
        </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombreUsuario = trim($datos['nombreUsuario'] ?? '');
        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreUsuario || mb_strlen($nombreUsuario) < 4) {
            $this->errores['nombreUsuario'] = 'El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.';
        }

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre || mb_strlen($nombre) < 4) {
            $this->errores['nombre'] = 'El nombre tiene que tener una longitud de al menos 5 caracteres.';
        }

        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || mb_strlen($password) < 5 ) {
            $this->errores['password'] = 'El password tiene que tener una longitud de al menos 5 caracteres.';
        }

        $password2 = trim($datos['password2'] ?? '');
        $password2 = filter_var($password2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password2 || $password != $password2 ) {
            $this->errores['password2'] = 'Los passwords deben coincidir';
        }

        $email = trim($datos['email'] ?? '');
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $this->errores['email'] = 'El email tiene que ser válido.';
        }

        $telefono = trim($datos['telefono'] ?? '');
        $telefono = filter_var($telefono, FILTER_VALIDATE_INT);
        if ( ! $telefono || mb_strlen($telefono) != 9) {
            $this->errores['telefono'] = 'El teléfono tiene que ser válido.';
        }

        if (count($this->errores) === 0) {
            $usuario = Usuario::buscaUsuario($nombreUsuario);
	
            if ($usuario) {
                $this->errores[] = "El usuario ya existe";
            } else {
                $usuario = Usuario::crea($nombreUsuario, $password, $nombre, $email, $telefono, 0, Usuario::USER_ROLE);
                $app = Aplicacion::getInstance();
                $app->login($usuario);
            }
        }
    }
}
