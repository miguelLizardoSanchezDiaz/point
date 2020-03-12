<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PuntoController extends Controller
{
    protected $variable='punto';
    protected $permiso='6';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	//$marcas=Marca::getListaIndex();
    	return view('ventas.transacciones.punto_venta',compact('variable'));
    }

}
