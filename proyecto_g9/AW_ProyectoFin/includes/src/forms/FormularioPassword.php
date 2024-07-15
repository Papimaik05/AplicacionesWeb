<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;
use es\ucm\fdi\aw\clases\Usuario;

class FormularioPassword extends Formulario
{
    public function __construct() {
        parent::__construct('FormularioPassword', ['urlRedireccion' => Aplicacion::getInstance()->resuelve('/perfil.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {


        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['password', 'password2', 'password3'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales

        <div class="formContra">
            <h2>Mi contraseña</h2>
           <div>
                <label for="password">Introduzca la contraseña:</label>
                <input id="password" type="password" name="password" />
                <p>{$erroresCampos['password']}</p>
            </div>
            <div>
                <label for="password2">Introduzca la nueva contraseña:</label>
                <input id="password2" type="password" name="password2" />
                <p>{$erroresCampos['password2']}</p>
            </div>
            <div>
                <label for="password3"> Reintroduzca la contraseña:</label>
                <input id="password3" type="password" name="password3" />
                <p>{$erroresCampos['password3']}</p>
            </div>
            <p></p>
            <div>
                <button type="submit" name="guardar">Guardar contraseña</button>
            </div>
        </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password) ) {
            $this->errores['password'] = 'El password no puede estar vacío.';
        }

        $password2 = trim($datos['password2'] ?? '');
        $password2 = filter_var($password2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password2 || mb_strlen($password2) < 5 ) {
            $this->errores['password2'] = 'El password tiene que tener una longitud de al menos 5 caracteres.';
        }

        $password3 = trim($datos['password3'] ?? '');
        $password3 = filter_var($password3, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password3 || $password2 != $password3 ) {
            $this->errores['password3'] = 'Los passwords deben coincidir';
        }

        $app = Aplicacion::getInstance();

        if ($app->usuarioLogueado()) {
          $nombreUsuario = $app->nombreUsuario();
        }

        if (count($this->errores) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);
        
            if (!$usuario) {
                $this->errores[] = "El usuario o el password no coinciden";
            } else {
                Usuario::cambiarpasswordbd($password2);

                $mensajes = ['¡Contraseña guardada!'];
                $app->putAtributoPeticion('mensajes', $mensajes);
    
            }
        }

    }
}
