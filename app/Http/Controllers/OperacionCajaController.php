<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\CajaOperacion;
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

    public function show($id) // este metodo sera usado para la creacion de las aperuras de caja
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $caja=Caja::findOrFail($id);
        $saldoCaja=CajaOperacion::obtenerSaldoCaja($id);
        $resultado = count($saldoCaja);
        if ($resultado>0) {
            foreach ($saldoCaja as $value) {
                $montoSaldo=$value->saldo;
            }
        }
        $fecha_hoy=fecha_hoy();
        return view('tesoreria.operacion_caja.nuevo',compact('variable', 'caja', 'montoSaldo','fecha_hoy'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $CajaOperacion=new CajaOperacion;
        $CajaOperacion->caj_id=$request->txt_caja_id;
        $CajaOperacion->cao_apertura=1;
        $CajaOperacion->cao_monto_apertura=$request->txt_montoapertura;
        if ($request->txt_observaciones!='') {
        	$CajaOperacion->cao_inconsistencia_apertura=$request->txt_observaciones;
        }
        else{
        	$CajaOperacion->cao_inconsistencia_apertura='Ninguna inconsistencia';
        }
        $CajaOperacion->cao_fecha_apertura=fecha_a_ingles($request->txt_fecha);
        $CajaOperacion->cao_usuario_id=obtener_usuario_id();

        if($CajaOperacion->save())
        {
        	$caja = Caja::findOrFail($request->txt_caja_id);
        	$caja->caj_apertura_cierre=1;  // 0 cuando esta cerrada y 1 cuando esta aperturada
        	$caja->save();
            $r["estado"]="ok";
            $r["mensaje"]="Caja Aperturada Correctamente";
        }
        else{
            $r["estado"]="error";
            $r["mensaje"]="Error al Grabar!";
        }
        return $r;
    }
}
