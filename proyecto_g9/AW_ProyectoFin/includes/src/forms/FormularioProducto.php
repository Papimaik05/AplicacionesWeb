<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;
use es\ucm\fdi\aw\clases\Producto;
use es\ucm\fdi\aw\clases\Categorias;

class FormularioProducto extends Formulario
{
    public function __construct() {
        parent::__construct('formProducto', ['enctype' => 'multipart/form-data','urlRedireccion' => Aplicacion::getInstance()->resuelve('/admin.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        $nombreP = $datos['nombreP'] ?? '';
        $descripcion = $datos['descripcion'] ?? '';
        $precio = $datos['precio'] ?? '';
        $precio_oferta = $datos['precio_oferta'] ?? '';
        $stock = $datos['stock'] ?? '';
        $talla = $datos['talla'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreP', 'descripcion', 'precio', 'precio_oferta', 'stock', 'imagen'], $this->errores, 'span', array('class' => 'error'));

        $categorias = Categorias::getCategorias();
        $htmlCategorias = <<<EOF
        EOF;
        foreach($categorias as $cat){
            $htmlCat = <<<EOF
            <option value="$cat[id_categoria]">$cat[nombre]</option>
            EOF; 
            $htmlCategorias .= $htmlCat;
        }

        $html = <<<EOF
        $htmlErroresGlobales
        <div class="formProd">
            <h2>Crear producto</h2>
            <div>
                <label for="nombreP">Nombre del producto:</label>
                <input id="nombreP" type="text" name="nombreP" value="$nombreP" />
                <p>{$erroresCampos['nombreP']}</p>
            </div>
            <div>
                <label for="descripcion">Descripcion:</label>
                <input id="descripcion" type="text" name="descripcion" value="$descripcion" />
                <p>{$erroresCampos['descripcion']}</p>
            </div>
            <div>
                <label for="precio">Precio:</label>
                <input id="precio" type="text" name="precio" value="$precio" />
                <p>{$erroresCampos['precio']}</p>
            </div>
            <div>
                <label for="precio_oferta">Precio en oferta</label>
                <label for="precio_oferta">(si el producto no esta en oferta dejar vacio):</label>
                <input id="precio_oferta" type="text" name="precio_oferta" value="$precio_oferta" />
                <p>{$erroresCampos['precio_oferta']}</p>
            </div>
            <div>
                <label for="stock">Stock:</label>
                <input id="stock" type="text" name="stock" value="$stock" />
                <p>{$erroresCampos['stock']}</p>
           </div>

           <div>
                <label for="talla">Talla:</label>
                <select name='talla' id='talla'>
                    <option value='XS'>XS</option>
                    <option value='S'>S</option>
                    <option value='M'>M</option>
                    <option value='L'>L</option>
                    <option value='XL'>XL</option>
                </select>
           </div>

            <div>
                <label for="cat">Categoria:</label>
                <select id="cat" name="cat">
                $htmlCategorias
                </select>
            </div>

            <div>
                <label for="img">Subir imagen:</label>
                <input id="imagen" name="imagen" type="file" />
                <p>{$erroresCampos['imagen']}</p>
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

        $nombreP = trim($datos['nombreP'] ?? '');
        $nombreP = filter_var($nombreP, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreP || mb_strlen($nombreP) < 4) {
            $this->errores['nombreP'] = 'El nombre del producto tiene que tener una longitud de al menos 4 caracteres.';
        }

        $descripcion = trim($datos['descripcion'] ?? '');
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $descripcion || mb_strlen($descripcion) < 4) {
            $this->errores['descripcion'] = 'La descripción del producto tiene que tener una longitud de al menos 4 caracteres.';
        }

        $precio = trim($datos['precio'] ?? '');
        $precio = filter_var($precio, FILTER_VALIDATE_FLOAT);
        if (filter_var($precio, FILTER_VALIDATE_FLOAT) === false) {
            $this->errores['precio'] = 'El precio tiene que ser válido';
        }

        $precio_oferta = trim($datos['precio_oferta'] ?? '');
        if ($precio_oferta !== '') {
            if(filter_var($precio_oferta, FILTER_VALIDATE_FLOAT) === false){
                $this->errores['precio_oferta'] = 'El precio en oferta tiene que ser válido';
            }
        }

        $stock = trim($datos['stock'] ?? '');
        $stock = filter_var($stock, FILTER_VALIDATE_INT);
        if (!$stock) {
            $this->errores['stock'] = 'El stock tiene que ser válido.';
        }

        $talla = trim($datos['talla'] ?? '');
        $cat = trim($datos['cat'] ?? '');

        $path  = "C:/xampp/htdocs/github/AW_ProyectoFinal/AW_ProyectoFinal-main/estructura-proyecto/img/"; 
        $todasImagenes = array_diff(scandir($path), array('.', '..'));

        if ($_FILES['imagen']['size'] > 200000){
            $this->errores['imagen'] = "El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo";
        }

        if (!($_FILES['imagen']['type'] === "image/jpeg" OR $_FILES['imagen']['type'] === "image/png")){
            $this->errores['imagen'] = " Tu archivo tiene que ser JPG o PNG. Otros archivos no son permitidos";
        }else if(in_array(basename( $_FILES['imagen']['name']), $todasImagenes)){
            $this->errores['imagen'] = "Existe una imagen con ese nombre";
        }
        

        if (count($this->errores) === 0) {

            $target_path = "C:/xampp/htdocs/github/AW_ProyectoFinal/AW_ProyectoFinal-main/estructura-proyecto/img/";
            $target_path = $target_path . basename( $_FILES['imagen']['name']);
            $imagen = "img/" . basename( $_FILES['imagen']['name']);
            move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path);
            
            $producto = Producto::crea($nombreP, $descripcion, $precio, $precio_oferta, $cat, $talla, $stock, $imagen);

           if (!$producto) {
                $this->errores[] = "Ya existe un producto con ese nombre";
            } else {
                $app = Aplicacion::getInstance();
                $mensajes = ['Producto añadido con exito'];
                $app->putAtributoPeticion('mensajes', $mensajes);
            }
            
        }
    }
}
