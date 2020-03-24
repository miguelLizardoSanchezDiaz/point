<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\CajaMovimiento;
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
        $CajaOperacion->cao_hora_apertura=horaactual();
        $CajaOperacion->cao_usuario_id_aper=obtener_usuario_id();

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

    public function edit($id)
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
        return view('tesoreria.operacion_caja.edit',compact('variable', 'caja', 'fecha_hoy','montoSaldo'));
    }

    public function update(Request $request, $id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $CajaOperacion_id=CajaOperacion::ultimoapertura($id);


        $CajaOperacion=CajaOperacion::findOrFail($CajaOperacion_id[0]['id']);
        $CajaOperacion->cao_cierre=1;
        $CajaOperacion->cao_monto_cierre=$request->txt_montoapertura;
        if ($request->txt_observaciones!='') {
        	$CajaOperacion->cao_inconsistencia_cierre=$request->txt_observaciones;
        }
        else{
        	$CajaOperacion->cao_inconsistencia_cierre='Ninguna inconsistencia';
        }
        $CajaOperacion->cao_fecha_cierre=fecha_a_ingles($request->txt_fecha);
        $CajaOperacion->cao_hora_cierre=horaactual();
        $CajaOperacion->cao_usuario_id_cier=obtener_usuario_id();

        if($CajaOperacion->save())
        {
        	$caja = Caja::findOrFail($request->txt_caja_id);
        	$caja->caj_apertura_cierre=0;  // 0 cuando esta cerrada y 1 cuando esta aperturada
        	$caja->save();
            $r["estado"]="ok";
            $r["mensaje"]="Caja Cerrada Correctamente";
        }
        else{
            $r["estado"]="error";
            $r["mensaje"]="Error al Grabar!";
        }
        return $r;
    }

    public function detalles($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$CajaOperaciones=CajaOperacion::getCajaOperacion($id);
    	return view('tesoreria.operacion_caja.detalles',compact('CajaOperaciones','variable'));
    }

    public function movimientos($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $montosSaldo=CajaMovimiento::obtenerSaldosCuadreCaja($id);
    	$CajaMovimientos=CajaMovimiento::getCajaOperacionMovimiento($id);
    	return view('tesoreria.operacion_caja.movimientos',compact('CajaMovimientos','variable','montosSaldo'));
    }
}
