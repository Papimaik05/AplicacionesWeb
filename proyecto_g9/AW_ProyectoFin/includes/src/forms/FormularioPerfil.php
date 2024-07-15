<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;
use es\ucm\fdi\aw\clases\Usuario;

class FormularioPerfil extends Formulario
{
    public function __construct() {
        parent::__construct('formPerfil', ['urlRedireccion' => Aplicacion::getInstance()->resuelve('/perfil.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {

        $app = Aplicacion::getInstance();

        if ($app->usuarioLogueado()) {
          $nombreUsuario = $app->nombreUsuario();
          $nombre = $app->nombre();
          $email = $app->email();
          $telefono = $app->telefono();
          $saldo = $app->saldo();

        }else{

            $nombreUsuario = $datos['nombreUsuario'] ?? '';
            $nombre = $datos['nombre'] ?? '';
            $email = $datos['email'] ?? '';
            $telefono = $datos['telefono'] ?? '';
            $saldo = $datos['saldo'] ?? '';
        }

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'nombre', 'email', 'telefono', 'saldo'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales

            <div class="formPerfil">
            <br>
            <h2>Modificar</h2>
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
                <label for="Saldo">Saldo:</label>
                <input id="saldo" type="text" name="saldo" value="$saldo" />
                <p>{$erroresCampos['saldo']}</p>
            </div>

            <div>
                <button type="submit" name="guardar">Guardar cambios</button>
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
            $this->errores['nombreUsuario'] = 'El nombre de usuario tiene que tener una longitud de al menos 4 caracteres.';
        }

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre || mb_strlen($nombre) < 4) {
            $this->errores['nombre'] = 'El nombre tiene que tener una longitud de al menos 4 caracteres.';
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

        $saldo =  trim($datos['saldo'] ?? '');
        if (filter_var($saldo, FILTER_VALIDATE_INT) === false) {
            $this->errores['saldo'] = 'El saldo tiene que ser válido.';
        }

        $app = Aplicacion::getInstance();


        if (count($this->errores) === 0) {

            Usuario::cambiarbd($nombreUsuario, $nombre, $email, $telefono, $saldo);
            
            $_SESSION['nombreUsuario'] = $nombreUsuario;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['email'] = $email;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['saldo'] = $saldo;
            
            $mensajes = ['¡Cambios guardados!'];
            $app->putAtributoPeticion('mensajes', $mensajes);

        }
    }
}
