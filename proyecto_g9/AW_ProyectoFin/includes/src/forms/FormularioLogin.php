<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;
use es\ucm\fdi\aw\clases\Usuario;

class FormularioLogin extends Formulario
{
    public function __construct($pagina) {
        parent::__construct('formLogin', ['urlRedireccion' => Aplicacion::getInstance()->resuelve($pagina)]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        $app = Aplicacion::getInstance();
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario = $datos['nombreUsuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'password'], $this->errores, 'span', array('class' => 'error'));
        
        $registroUrl = $app->resuelve('/registro.php');
        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        
        <div class="formLogin">
            <h3>Iniciar sesión</h3>
            <p>Introduzca su nombre de usuario y su contraseña</p>
            <div class="nombreUs">
                <label for="nombreUsuario">Nombre de usuario:</label>
                <input id="nombreUsuario" type="text" name="nombreUsuario" value="$nombreUsuario">
                <p>{$erroresCampos['nombreUsuario']}</p>
            </div>
            <div class="passUs">
                <label for="password">Password:</label>
                <input id="password" type="password" name="password">
                <p>{$erroresCampos['password']}</p>
                
            </div>
            <h2>$htmlErroresGlobales</h2>
            <div>
                <button type="submit" name="login">Entrar</button>
            </div>
            <p>¿No tienes cuenta? <a href="{$registroUrl}">Registrate</a></p>
        </div>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $nombreUsuario = trim($datos['nombreUsuario'] ?? '');
        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreUsuario || empty($nombreUsuario) ) {
            $this->errores['nombreUsuario'] = 'El nombre de usuario no puede estar vacío';
        }
        
        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password) ) {
            $this->errores['password'] = 'El password no puede estar vacío.';
        }
        
        if (count($this->errores) === 0) {
            $usuario = Usuario::login($nombreUsuario, $password);
        
            if (!$usuario) {
                $this->errores[] = "El usuario o el password no coinciden";
            } else {
                $app = Aplicacion::getInstance();
                $app->login($usuario);
            }
        }
    }
}
