<?php

namespace App\Http\Controllers;

use Request;

use App\Categoria;

class AutocompleteController extends Controller
{
    public function BuscarCategoria()
    {
        $term=Request::get('query');
        return Categoria::findByCodigoOrDescription($term);
    }
    
    public function BuscarUmedida()
    {
        $term=Request::get('query');
        return Categoria::findByCodigoOrDescription($term);
    }

}
