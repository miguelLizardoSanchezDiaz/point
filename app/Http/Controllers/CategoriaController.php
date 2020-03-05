<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Categoria;
use Session;

class CategoriaController extends Controller
{
    protected $variable='categorias';
    protected $permiso='4';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$categorias=Categoria::getCategorias();
    	return view('maestros.categorias.listado',compact('categorias','variable'));
    }

    public function create(){
    	$variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        return view('maestros.categorias.nuevo',compact('variable'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $this->validate($request, 
            ['txt_codigo'=>['required','max:11'], 
            'txt_descripcion'=>['required','max:250']
            ]);

        $categoria=new Categoria;
        $categoria->cat_codigo=$request->txt_codigo;
        $categoria->cat_descripcion=$request->txt_descripcion;
        $categoria->cat_estado=1;
        $categoria->save();

        Session::flash('flash_message', 'Registro guardado correctamente!');
        return Redirect::to($this->variable);
    }

    public function edit($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $categoria=Categoria::findOrFail($id);
        return view('maestros.categorias.edit', compact('variable','categoria'));
    }

    public function update(Request $request, $id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $tipoDocumento=$request->cbo_documento;

        $categoria=Categoria::findOrFail($id);
        $categoria->cat_descripcion=$request->txt_descripcion;
        $categoria->cat_estado=1;
        $categoria->save();

        Session::flash('flash_message', 'Registro editado correctamente!');
        return Redirect::to($this->variable);
    }

    public function show($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $categoria=Categoria::findOrFail($id);
        return view('maestros.categorias.eliminar', compact('variable','categoria'));
    }

    public function destroy($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        try {
            $categoria=Categoria::findOrFail($id);
            Categoria::destroy($id);
            Session::flash('flash_message', 'Registro eliminado correctamente!');
            return Redirect:: to($this->variable);
        }catch (\Illuminate\Database\QueryException $e){
            Session::flash('flash_error', "Acción no válida. El registro ya está relacionado con otras tablas del sistema.");
            return Redirect:: to($this->variable);
        }
    }
}
