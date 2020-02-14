<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DocumentoIdentidad;
use App\TipoTercero;
use App\Tercero;
use App\Ubigeo;
use App\User;
use Session;
use Crypt;

class TerceroController extends Controller
{
    protected $variable='tercero';
    protected $permiso='2';
    
    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$terceros=Tercero::getLista();
    	return view('maestros.tercero.listado',compact('terceros','variable'));
    }

    public function create(){
    	$variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $tipostercero=TipoTercero::getLista();
        $documentosidentidad=DocumentoIdentidad::getLista();
        $ubigeos=Ubigeo::getLista();
        return view('maestros.tercero.nuevo',compact('variable','tipostercero','documentosidentidad','ubigeos'));
    }
    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $this->validate($request, 
            ['email'=>['required','unique:users','email','max:250'], 
            'txt_nombre'=>['required','max:250'],
            'txt_contraseña1'=>['required','min:6'],
            'txt_contraseña2'=>['required','min:6','same:txt_contraseña1'],
            ]);

        $usuario=new User;
        $usuario->email=$request->email;
        $usuario->name=strtoupper($request->txt_nombre);
        $usuario->password=bcrypt($request->txt_contraseña2);
        $usuario->rol_id=$request->cbo_rol;
        //$usuario->estado=1;
        $usuario->save();

        Session::flash('flash_message', 'Registro guardado correctamente!');
        return Redirect::to($this->variable);
    }
}
