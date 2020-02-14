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

    public function create()
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        return view('configuracion.rol.nuevo',compact('variable'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $this->validate($request, ['txt_descripcion'=>['required','max:250']]);

        $rol=new Rol;
        $rol->rol_codigo='';
        $rol->rol_descripcion=strtoupper($request->txt_descripcion);
        $rol->rol_estado=1;
        $rol->save();

        Session::flash('flash_message', 'Registro guardado correctamente!');
        return Redirect::to($this->variable);
    }


    public function edit($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $rol=Rol::findOrFail($id);
        return view('configuracion.rol.editar', compact('rol', 'variable'));
    }
    public function update(Request $request, $id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $this->validate($request, ['txt_descripcion'=>['required','max:250']]);

        $rol=Rol::findOrFail($id);
        $rol->rol_descripcion=strtoupper($request->txt_descripcion);
        $rol->save();

        Session::flash('flash_message', 'Registro guardado correctamente!');
        return Redirect::to($this->variable);
    }
    public function show($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $rol=Rol::findOrFail($id);
        return view('configuracion.rol.eliminar', compact('rol', 'variable'));
    }

    public function destroy($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        try {
            $rol=Rol::findOrFail($id);
            Rol::destroy($id);
            Session::flash('flash_message', 'Registro eliminado correctamente!');
            return Redirect:: to($this->variable);
        }catch (\Illuminate\Database\QueryException $e){
            Session::flash('flash_error', "Acción no válida. El registro ya está relacionado con otras tablas del sistema.");
            return Redirect:: to($this->variable);
        }
    }
}
