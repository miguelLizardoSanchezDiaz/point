<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permiso;
use App\Rol;
use App\RolPermiso;
class RolPermisoController extends Controller
{
    protected $variable='permisos-por-rol';
    protected $permiso='3';
    public function index()
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $permisos=Permiso::getLista();
        $roles=Rol::getLista();

        return view('rol_permiso.asignar',compact('variable','permisos','roles'));
    }
}
