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

use Peru\Http\ContextClient;
use Peru\Jne\{Dni, DniParser};

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

        $tipoDocumento=$request->cbo_documento;

        if($tipoDocumento==1){
            $this->validate($request, 
            ['txt_codigo'=>['required','max:11'], 
            'txt_razonsocial'=>['required','max:250'],
            'txt_nombreComercial'=>['required','max:250'],
            'txt_direccion'=>['required','max:250']
            ]);
        }
        else{
            $this->validate($request, 
            ['txt_codigo'=>['required','max:11'],
            'txt_nombre'=>['required','max:250'],
            'txt_apellidopaterno'=>['required','max:250'],
            'txt_apellidomaterno'=>['required','max:250'],
            'txt_nacimiento'=>['required'],
            'txt_direccion'=>['required','max:250']
            ]);
        }

        $tercero=new Tercero;
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

        Session::flash('flash_message', 'Registro guardado correctamente!');
        return Redirect::to($this->variable);
    }

    public function edit($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $tercero=Tercero::findOrFail($id);
        $tipostercero=TipoTercero::getLista();
        $documentosidentidad=DocumentoIdentidad::getLista();
        $ubigeos=Ubigeo::getLista();
        return view('maestros.tercero.edit', compact('variable','tercero','tipostercero','documentosidentidad','ubigeos'));
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

    public function show($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $tercero=Tercero::findOrFail($id);
        return view('maestros.tercero.eliminar', compact('variable','tercero'));
    }

    public function destroy($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        try {
            $tercero=Tercero::findOrFail($id);
            Tercero::destroy($id);
            Session::flash('flash_message', 'Registro eliminado correctamente!');
            return Redirect:: to($this->variable);
        }catch (\Illuminate\Database\QueryException $e){
            Session::flash('flash_error', "Acción no válida. El registro ya está relacionado con otras tablas del sistema.");
            return Redirect:: to($this->variable);
        }
    }

    public function valida_codigo(Request $request){
        $codigo=$request->codigo;
        $resultado=Tercero::where('ter_codigo','=',$codigo)->first();
        if($resultado){
            $r['estado']='si';
        }
        else{
            $r['estado']='no';
        }
        return $r;
    }

    public function consultar_ruc_contribuyente(Request $request)
    {
        
        $nro_ruc=$request->nro_ruc;

        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,'http://demosprinter.anikamagroup.com/consulta_ruc/'.$nro_ruc);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Punto venta, Medida SAC');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $query;

    }

    public function consultar_dni(Request $request){
        $dni=$request->nro_dni;
        /*$curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,'http://py-devs.com/api/dni/'.$dni.'/?format=json');
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_HEADER, 'Content-Type: application/html');
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Punto Venta, Medida SAC');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $query;*/
        $cs = new Dni(new ContextClient(), new DniParser());

        $person = $cs->get($dni);
        if (!$person) {
            return 'Not found';
            exit();
        }

        return json_encode($person);
    }
}
