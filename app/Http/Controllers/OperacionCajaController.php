<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\PuntoVenta;
use App\Caja;
use Session;

class OperacionCajaController extends Controller
{
    protected $variable='operaciones-caja';
    protected $permiso='10';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$cajas=Caja::getCajasActivas();
    	return view('tesoreria.operacion_caja.listado',compact('cajas','variable'));
    }

    public function aperturar_caja($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $caja=Caja::findOrFail($id);
        $puntoVentas=PuntoVenta::getLista();
        return view('tesoreria.cajas.edit',compact('variable', 'caja', 'puntoVentas'));
    }
}
