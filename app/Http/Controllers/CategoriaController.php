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

        $tercero=Tercero::findOrFail($id);
        $tercero->ter_codigo=$request->txt_codigo;
        if($tipoDocumento==1){
            $tercero->ter_descripcion=strtoupper($request->txt_razonsocial);
            $tercero->ter_nombre_comercial=strtoupper($request->txt_nombreComercial);
            $tercero->ter_ruc=$request->txt_codigo;
            $tercero->ter_web=$request->txt_web;
        }
        else{
            $tercero->ter_fecha_nacimiento=fecha_a_ingles($request->txt_nacimiento);
            $tercero->ter_apellido_paterno=strtoupper($request->txt_apellidopaterno);
            $tercero->ter_apellido_materno=strtoupper($request->txt_apellidomaterno);
            $tercero->ter_nombres=strtoupper($request->txt_nombre);
            $tercero->ter_dni=$request->txt_codigo;
        }
        $tercero->ter_telefono1=$request->txt_telefono;
        $tercero->ter_direccion=$request->txt_direccion;
        $tercero->ter_email=$request->txt_mail;
        $tercero->doi_id=$tipoDocumento;
        $tercero->ubi_id=$request->cbo_ubigeo;
        $tercero->tit_id=$request->cbo_tipo;
        $tercero->ter_estado=1;
        $tercero->save();

        Session::flash('flash_message', 'Registro editado correctamente!');
        return Redirect::to($this->variable);
    }
}
