<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use Session;
use Illuminate\Support\Facades\Redirect;

class RolController extends Controller
{

	protected $variable='rol';
    protected $permiso='5';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$roles=Rol::getLista();
    	return view('configuracion.rol.listado',compact('roles','variable'));
    }
}
