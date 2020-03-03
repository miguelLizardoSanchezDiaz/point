<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\Categoria;
use App\Marca;
use App\Producto;
use Session;
use Illuminate\Support\Facades\Redirect;


class ProductoController extends Controller
{
    protected $variable='producto';
    protected $permiso='5';

    public function index(Request $request){
        $tipoproceso='listar';
        /*Desarrollado por Miguel Sánchez 04/12/2018
        Revisado por LIZARDO*/
        $txt_codigo=$request->txt_codigo;
    	$cbo_categoria1=$request->cbo_categoria1;
		$cbo_categoria2=$request->cbo_categoria2;
		$cbo_categoria3=$request->cbo_categoria3;
        $cbo_marca=$request->cbo_marca;
        $cbo_web=$request->cbo_web;
        $txt_descripcion=$request->txt_descripcion;

        //$categorias=Categoria::getCategoriasPrincipales();
        $marcas=Marca::getListaIndex();
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$productos=Producto::getListaIntranet($txt_codigo,$cbo_categoria1,$cbo_categoria2,$cbo_categoria3,$cbo_marca,$cbo_web,$txt_descripcion);
    	
    	return view('maestros.productos.listado',compact('productos','variable','tipoproceso','cbo_categoria1','cbo_categoria2','cbo_categoria3','txt_codigo','marcas','cbo_marca','cbo_web','txt_descripcion'));
    }

    public function create()
    {
    	$tipoproceso='crear';
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        //$departamentos=Departamento::listaCombo();
        $marcas=Marca::getListaIndex();
        return view('maestros.productos.nuevo',compact('variable','tipoproceso','marcas'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $this->validate($request, 
            [
                'txt_codigo'=>['required','max:11'],
            ]);

        Session::flash('flash_message', 'Registro guardado correctamente!');
        return Redirect::to($this->variable);
    }

}
