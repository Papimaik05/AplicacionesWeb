<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;
use es\ucm\fdi\aw\clases\Producto;
use es\ucm\fdi\aw\clases\Categorias;

class FormularioCategoria extends Formulario
{
    public function __construct() {
        parent::__construct('formCategoria', ['urlRedireccion' => Aplicacion::getInstance()->resuelve('/admin.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        $nombreC = $datos['nombreC'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreC'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <div class="formCat">
            <h2>Añadir categoria</h2>
            <div>
                <label for="nombreC">Nombre de la categoria:</label>
                <input id="nombreC" type="text" name="nombreC" value="$nombreC" />
                <p>{$erroresCampos['nombreC']}</p>
            </div>
            
            <div>
                <button type="submit" name="registro">Registrar</button>
            </div>
        </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombreC = trim($datos['nombreC'] ?? '');
        $nombreC = filter_var($nombreC, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreC || mb_strlen($nombreC) < 3) {
            $this->errores['nombreC'] = 'El nombre de categoria tiene que tener una longitud de al menos 3 caracteres.';
        }
        

        if (count($this->errores) === 0) {
            
            $categoria = Categorias::crea($nombreC);

            if (!$categoria) {
                $this->errores[] = "La categoria ya existe";
            } else {
                $app = Aplicacion::getInstance();
                $mensajes = ['Categoria añadida!'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            
        }
    }
}