<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\CajaMovimiento;
use App\CajaOperacion;
use App\TipoOperacion;
use App\FormaPago;
use App\Caja;
use Session;

class MovimientoCajaController extends Controller
{
    protected $variable='movimientos-cajas';
    protected $permiso='11';

    public function create(){
    	$variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        $formasPago=FormaPago::getLista();
        $tiposOperacion=TipoOperacion::getLista();
        $cajas=Caja::getCajasActivasAperturadas();
        $fecha_hoy=fecha_hoy();
        return view('tesoreria.movimiento_caja.nuevo',compact('variable','formasPago','tiposOperacion','cajas','fecha_hoy'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $cajaOp=CajaOperacion::ultimoapertura($request->cbo_caja);
        $tipoOp=TipoOperacion::findOrFail($request->cbo_operacion);

        $movimientoCaja=new CajaMovimiento;
        $movimientoCaja->fop_id=$request->cbo_formapago;
		$movimientoCaja->cao_id=$cajaOp[0]['id'];
        $movimientoCaja->tio_id=$request->cbo_operacion;
        $movimientoCaja->cam_fecha=fecha_a_ingles($request->txt_fecha);
        $movimientoCaja->cam_hora=horaactual();
        $movimientoCaja->cam_automatico=0;
        $movimientoCaja->cam_usuario_id=obtener_usuario_id();
        $movimientoCaja->cam_estado=1;
        if($tipoOp->tio_tipo=='I'){
            $movimientoCaja->cam_monto_entrada=$request->txt_monto;
        }
        else{
            $movimientoCaja->cam_monto_salida=$request->txt_monto;
        }

        if($movimientoCaja->save())
        {
                $r["estado"]="ok";
                $r["mensaje"]="Movimiento grabado Correctamente";
        }
            else{
                $r["estado"]="error";
                $r["mensaje"]="Error al Grabar!";
        }        
        return $r;
    }
}
