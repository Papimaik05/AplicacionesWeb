<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;
use es\ucm\fdi\aw\clases\Usuario;

class FormularioEliminarUsuario extends Formulario
{
    public function __construct() {
        parent::__construct('formeliminarUsuario', ['urlRedireccion' => Aplicacion::getInstance()->resuelve('/perfil.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {

        $app = Aplicacion::getInstance();
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nomUsuario', 'pass'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
            <br>
            <div>
            <h3>Eliminar cuenta de usuario</h3>
            <p>Introduzca su nombre de usuario y su contraseña</p>
            <div class="nombreUs">
                <label for="nombreUsuario">Nombre de usuario:</label>
                <input id="nomUsuario" type="text" name="nomUsuario">
                <p>{$erroresCampos['nomUsuario']}</p>
            </div>
            <div class="passUs">
                <label for="password">Password:</label>
                <input id="pass" type="password" name="pass">
                <p>{$erroresCampos['pass']}</p>
                <h2>$htmlErroresGlobales</h2>
            </div>
                <button type="submit" name="guardar">Eliminar Usuario</button>
            </div>
            <br>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {   
        $this->errores = [];
        $nombreUsuario = trim($datos['nomUsuario'] ?? '');
        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreUsuario || empty($nombreUsuario) ) {
            $this->errores['nomUsuario'] = 'El nombre de usuario no puede estar vacío';
        }
        
        $password = trim($datos['pass'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password) ) {
            $this->errores['pass'] = 'El password no puede estar vacío.';
        }
        
        if (count($this->errores) === 0) {
            $puede = Usuario::puedeEliminar($nombreUsuario, $password);
        
            if (!$puede) {
                $this->errores[] = "El usuario o el password no coinciden";
            } else {
                $app = Aplicacion::getInstance();
                Usuario::borraPorId($_SESSION['idUsuario']);
                $app->logout();
                $mensajes = ['Usuario eliminado!'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
        }
        

       

    }
}
