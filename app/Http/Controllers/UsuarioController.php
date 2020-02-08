<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
class UsuarioController extends Controller
{
    protected $variable='usuario';
    protected $permiso='1';

    public function index(){
        $variable=$this->variable;
        //if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$usuarios=User::getLista();
    	return view('usuario.listado',compact('usuarios','variable'));
    }

    public function create(){
    	$variable=$this->variable;
        //if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $roles=Rol::getLista();
        return view('usuario.nuevo',compact('variable','roles'));
    }
}
