<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\PuntoVenta;
use App\Caja;
use Session;

class CajaController extends Controller
{
    protected $variable='cajas';
    protected $permiso='9';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$cajas=Caja::getCajas();
    	return view('tesoreria.cajas.listado',compact('cajas','variable'));
    }

    public function create(){
    	$variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $puntoVentas=PuntoVenta::getLista();
        return view('tesoreria.cajas.nuevo',compact('variable','puntoVentas'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $caja=new Caja;
        $caja->caj_codigo=$request->txt_codigo;
        $caja->caj_descripcion=strtoupper($request->txt_descripcion);
        $caja->pto_id=$request->cbo_punto;
        $caja->caj_estado=1;

        $consulta=Caja::consultaCodigo($request->txt_codigo);
        if($consulta){
            $r["estado"]="error";
            $r["mensaje"]="Código ya se encuentra registrado, verifique!";
        }
        else{
            if($caja->save())
            {
                $r["estado"]="ok";
                $r["mensaje"]="Grabado Correctamente";
            }
            else{
                $r["estado"]="error";
                $r["mensaje"]="Error al Grabar!";
            }        
        }
        return $r;
    }

    public function edit($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $caja=Caja::findOrFail($id);
        $puntoVentas=PuntoVenta::getLista();
        return view('tesoreria.cajas.edit',compact('variable', 'caja', 'puntoVentas'));
    }

    public function update(Request $request, $id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $caja=Caja::findOrFail($id);
        $caja->caj_descripcion=strtoupper($request->txt_descripcion);
        $caja->pto_id=$request->cbo_punto;
        $caja->caj_estado=1;
        if($caja->save())
        {
            $r["estado"]="ok";
            $r["mensaje"]="Grabado Correctamente";
        }
        else{
            $r["estado"]="error";
            $r["mensaje"]="Error al Grabar!";
        }
        return $r;
    }

    public function show($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $caja=Caja::findOrFail($id);
        return view('tesoreria.cajas.eliminar', compact('variable','caja'));
    }

    public function destroy($id)
    {
    
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $caja=Caja::findOrFail($id);
        if ($caja->caj_estado==1) {
        	$parametro=0;
        }
        else{
        	$parametro=1;
        }
        
        $respuesta=Caja::anularactivar($id,$parametro);
        if($respuesta){
            return Redirect:: to($this->variable);
        }
        else{
            return Redirect:: to($this->variable);
        }
    }
}
