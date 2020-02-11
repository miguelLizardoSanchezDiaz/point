<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
use Session;
use Crypt;
use Illuminate\Support\Facades\Redirect;
class UsuarioController extends Controller
{
    protected $variable='usuario';
    protected $permiso='1';

    public function index(){
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$usuarios=User::getLista();
    	return view('usuario.listado',compact('usuarios','variable'));
    }

    public function create(){
    	$variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        $roles=Rol::getLista();
        return view('usuario.nuevo',compact('variable','roles'));
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

    public function edit($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $usuario=User::findOrFail($id);
        $roles=Rol::getLista();
        return view('usuario.editar', compact('usuario', 'variable','roles'));
    }

    public function update(Request $request, $id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $this->validate($request, 
            ['email'=>['required','email','max:250'], 
            'txt_nombre'=>['required','max:250'],
            'txt_contraseña2'=>['same:txt_contraseña1']
            ]);

        $usuario=User::findOrFail($id);
        //$usuario->email=$request->email;
        $usuario->name=strtoupper($request->txt_nombre);
        if($request->txt_contraseña2!='123456' && $request->txt_contraseña2!=''){
        $usuario->password=bcrypt($request->txt_contraseña2);}
        $usuario->rol_id=$request->cbo_rol;
        $usuario->save();

        Session::flash('flash_message', 'Registro guardado correctamente!');
        return Redirect::to($this->variable);
    }

    public function show($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $usuario=User::findOrFail($id);
        return view('usuario.eliminar', compact('usuario', 'variable'));
    }

    public function destroy($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        try {
            $usuario=User::findOrFail($id);
            User::destroy($id);
            Session::flash('flash_message', 'Registro eliminado correctamente!');
            return Redirect:: to($this->variable);
        }catch (\Illuminate\Database\QueryException $e){
            Session::flash('flash_error', "Acción no válida. El registro ya está relacionado con otras tablas del sistema.");
            return Redirect:: to($this->variable);
        }
    }

}
