<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Marca;
use Session;

class MarcaController extends Controller
{
    protected $variable='marcas';
    protected $permiso='6';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$marcas=Marca::getListaIndex();
    	return view('maestros.marcas.listado',compact('marcas','variable'));
    }

    public function create(){
    	$variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        return view('maestros.marcas.nuevo',compact('variable'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $this->validate($request, 
            ['txt_codigo'=>['required','max:11'], 
            'txt_descripcion'=>['required','max:250']
            ]);

        $marca=new Marca;
        $marca->mar_codigo=$request->txt_codigo;
        $marca->mar_descripcion=$request->txt_descripcion;
        $marca->mar_estado=1;
        $marca->save();

        Session::flash('flash_message', 'Registro guardado correctamente!');
        return Redirect::to($this->variable);
    }

    public function edit($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $marca=Marca::findOrFail($id);
        return view('maestros.marcas.edit', compact('variable','marca'));
    }

    public function update(Request $request, $id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $marca=Marca::findOrFail($id);
        $marca->mar_descripcion=$request->txt_descripcion;
        $marca->mar_estado=1;
        $marca->save();

        Session::flash('flash_message', 'Registro editado correctamente!');
        return Redirect::to($this->variable);
    }

    public function show($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $marca=Marca::findOrFail($id);
        return view('maestros.marcas.eliminar', compact('variable','marca'));
    }

    public function destroy($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        try {
            $marca=Marca::findOrFail($id);
            Marca::destroy($id);
            Session::flash('flash_message', 'Registro eliminado correctamente!');
            return Redirect:: to($this->variable);
        }catch (\Illuminate\Database\QueryException $e){
            Session::flash('flash_error', "Acción no válida. El registro ya está relacionado con otras tablas del sistema.");
            return Redirect:: to($this->variable);
        }
    }
}
