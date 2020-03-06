<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Modelo;
use App\Marca;
use Session;

class ModeloController extends Controller
{
    protected $variable='modelos';
    protected $permiso='7';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$modelos=Modelo::getListaIndex();
    	return view('maestros.modelos.listado',compact('modelos','variable'));
    }

    public function create(){
    	$variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $marcas=Marca::getListaIndex();
        return view('maestros.modelos.nuevo',compact('variable','marcas'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $this->validate($request, 
            ['txt_codigo'=>['required','max:11'], 
            'txt_descripcion'=>['required','max:250'],
            'cbo_marca'=>['required']
            ]);

        $modelo=new Modelo;
        $modelo->mod_codigo=$request->txt_codigo;
        $modelo->mod_descripcion=$request->txt_descripcion;
        $modelo->mar_id=$request->cbo_marca;
        $modelo->mod_estado=1;
        $modelo->save();

        Session::flash('flash_message', 'Registro guardado correctamente!');
        return Redirect::to($this->variable);
    }

    public function edit($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $modelo=Modelo::findOrFail($id);
        $marcas=Marca::getListaIndex();
        return view('maestros.modelos.edit', compact('variable','modelo','marcas'));
    }

    public function update(Request $request, $id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $modelo=Modelo::findOrFail($id);
        $modelo->mod_descripcion=$request->txt_descripcion;
        $modelo->mar_id=$request->cbo_marca;
        $modelo->mod_estado=1;
        $modelo->save();

        Session::flash('flash_message', 'Registro editado correctamente!');
        return Redirect::to($this->variable);
    }

    public function show($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $modelo=Modelo::findOrFail($id);
        return view('maestros.modelos.eliminar', compact('variable','modelo'));
    }

    public function destroy($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        try {
            $modelo=Modelo::findOrFail($id);
            Modelo::destroy($id);
            Session::flash('flash_message', 'Registro eliminado correctamente!');
            return Redirect:: to($this->variable);
        }catch (\Illuminate\Database\QueryException $e){
            Session::flash('flash_error', "Acción no válida. El registro ya está relacionado con otras tablas del sistema.");
            return Redirect:: to($this->variable);
        }
    }
}
