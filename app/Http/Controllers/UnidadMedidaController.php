<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Umedida;
use Session;

class UnidadMedidaController extends Controller
{
    protected $variable='unidad-medida';
    protected $permiso='8';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$unidades=Umedida::getListaIndex();
    	return view('maestros.unidades.listado',compact('unidades','variable'));
    }

    public function create(){
    	$variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        return view('maestros.unidades.nuevo',compact('variable'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $this->validate($request, 
            ['txt_codigo'=>['required','max:11'], 
            'txt_descripcion'=>['required','max:250']
            ]);

        $unidad=new Umedida;
        $unidad->unm_codigo=$request->txt_codigo;
        $unidad->unm_descripcion=$request->txt_descripcion;
        $unidad->unm_estado=1;
        
        $consulta=Umedida::consultaCodigo($request->txt_codigo);
        if($consulta){
            $r["estado"]="error";
            $r["mensaje"]="Código ya se encuentra registrado, verifique!";
        }
        else{
            if($unidad->save())
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

        $unidad=Umedida::findOrFail($id);
        return view('maestros.unidades.edit', compact('variable','unidad'));
    }

    public function update(Request $request, $id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $unidad=Umedida::findOrFail($id);
        $unidad->unm_descripcion=$request->txt_descripcion;
        $unidad->unm_estado=1;
        if($unidad->save())
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

        $unidad=Umedida::findOrFail($id);
        return view('maestros.unidades.eliminar', compact('variable','unidad'));
    }

    public function destroy($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        try {
            $unidad=Umedida::findOrFail($id);
            Umedida::destroy($id);
            Session::flash('flash_message', 'Registro eliminado correctamente!');
            return Redirect:: to($this->variable);
        }catch (\Illuminate\Database\QueryException $e){
            Session::flash('flash_error', "Acción no válida. El registro ya está relacionado con otras tablas del sistema.");
            return Redirect:: to($this->variable);
        }
    }
}
