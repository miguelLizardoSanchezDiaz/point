<?php

namespace App\Http\Controllers;

use Request;

use App\Categoria;
use App\Umedida;
use App\Marca;
use App\Modelo;

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
        return Umedida::findByCodigoOrDescription($term);
    }
    public function BuscarMarca()
    {
        $term=Request::get('query');
        return Marca::findByCodigoOrDescription($term);
    }
    public function BuscarModelo()
    {
        $term=Request::get('query');
        return Modelo::findByCodigoOrDescription($term);
    }

}
