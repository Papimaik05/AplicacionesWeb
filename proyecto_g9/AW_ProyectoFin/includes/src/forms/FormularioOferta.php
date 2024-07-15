<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;
use es\ucm\fdi\aw\clases\Producto;

class FormularioOferta extends Formulario
{   
    private $idP;
    private $pA;
    public function __construct($idProd, $precioA) {
        parent::__construct('formOferta', ['urlRedireccion' => Aplicacion::getInstance()->resuelve('/catalogo.php')]);
        $this->idP = $idProd;
        $this->pA = $precioA;
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        $precio_oferta = $datos['precio_oferta'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['precio_oferta'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        $htmlErroresGlobales
        <div class="formOferta">
            <h4>Poner producto en oferta</h4>
                <input type='hidden' name='hidden_idP' value='$this->idP'>
                <input type='hidden' name='hidden_precioA' value='$this->pA'>
            <div>
                <p class="precioOf">Precio de oferta:</p>
                <input id="precio_oferta" type="text" name="precio_oferta" value="$precio_oferta" />
                <p>{$erroresCampos['precio_oferta']}</p>
            </div>
            <div>
                <button type="submit" name="rebaja">Rebajar</button>
                <input type="submit" value="Quitar oferta" id="quitarOferta" name="quitarOferta">
            </div>
        </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];
        $precio_anterior = trim($datos['hidden_precioA'] ?? '');
        $eliminar = null;

        if(isset($_POST['quitarOferta'])){
            $eliminar = $_POST['quitarOferta'];
        }
        
        if($eliminar != null){
            $precio_oferta = null;
        }
        else{
            $precio_oferta = trim($datos['precio_oferta'] ?? '');
            $precio_oferta = filter_var($precio_oferta, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ( ! $precio_oferta || empty($precio_oferta) ) {
                    $this->errores['precio_oferta'] = 'El precio de la oferta no puede estar vacío';
                }else if( $precio_oferta >= $precio_anterior ){
                    $this->errores['precio_oferta'] = 'El precio de la oferta no puede ser mayor que el precio del producto';
                }
        }

        $idP = trim($datos['hidden_idP'] ?? '');

        if (count($this->errores) === 0) {
	        Producto::ponerEnOferta($idP, $precio_oferta);
            $app = Aplicacion::getInstance();
            $mensajes = ['Oferta añadida/eliminada con exito'];
            $app->putAtributoPeticion('mensajes', $mensajes);
        }
    }
}