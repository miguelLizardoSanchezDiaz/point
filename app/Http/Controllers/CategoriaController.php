<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Categoria;

class CategoriaController extends Controller
{
    protected $variable='categorias';
    protected $permiso='4';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$terceros=Categoria::getLista();
    	return view('maestros.tercero.listado',compact('terceros','variable'));
    }

    public function create(){
    	$variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $tipostercero=TipoTercero::getLista();
        $documentosidentidad=DocumentoIdentidad::getLista();
        $ubigeos=Ubigeo::getLista();
        return view('maestros.tercero.nuevo',compact('variable','tipostercero','documentosidentidad','ubigeos'));
    }
}
