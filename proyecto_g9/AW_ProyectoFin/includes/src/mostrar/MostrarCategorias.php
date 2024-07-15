<?php

namespace es\ucm\fdi\aw\mostrar;
use es\ucm\fdi\aw\clases\Categorias;

class MostrarCategorias
{
    
    public function gestiona()
    {

        $htmlTienda = <<<EOF
        <div class="listaCat">
        <ul>
        <li><a class="categoria" href="catalogo.php">Todos</a></li>
        EOF;

        $categorias = Categorias::getCategorias();

        foreach($categorias as $cat){
            $html1 = <<<EOF
            <li><a class="categoria" href="catalogo.php?idCat=$cat[id_categoria]">$cat[nombre]</a></li>

            EOF; 
            
            $htmlTienda .= $html1;
        }

        $htmlTienda .= <<<EOF
        </ul>
        </div>
        EOF;

       return $htmlTienda;
    }

}
