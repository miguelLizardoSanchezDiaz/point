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

        return view('configuracion.rol_permiso.asignar',compact('variable','permisos','roles'));
    }

    public function ver_permiso_asignado(Request $request){
        $id_rol=$request->cbo_rol;
        $permisos_asignados=RolPermiso::ver_permiso_asignado($id_rol);
        $data=array();

        return view('configuracion.rol_permiso.permisos_asignados',compact('permisos_asignados'));
    }
    public function ver_permiso_no_asignado(Request $request){
        $id_rol=$request->cbo_rol;
        $permisos_asignados=RolPermiso::ver_permiso_asignado($id_rol);

        $valores_permiso = array();

        $i = 1;
        foreach($permisos_asignados as $campo_permiso)
        {
            $valores_permiso[$i] = $campo_permiso->per_id;
            $i++;
        }

        $permiso_oculto = '';

        $permisos_sin_asignar = Permiso::ver_permisos_sin_asignar($valores_permiso,$permiso_oculto);
        
        return view('configuracion.rol_permiso.permisos_no_asignados',compact('permisos_sin_asignar'));
    }
    public function asignar_permiso(Request $request){
        $id_rol=$request->cbo_rol;
        $id_permiso=$request->cbo_permisos_noasigandos;
        $rolPermiso=new RolPermiso;
        $rolPermiso->per_id=$id_permiso;
        $rolPermiso->rol_id=$id_rol;
        $rolPermiso->save();
    }
    public function quitar_permiso(Request $request){
        $id_rol=$request->cbo_rol;
        $id_rol_permiso=$request->cbo_permisos_asigandos;

        RolPermiso::destroy($id_rol_permiso);
    }
}
