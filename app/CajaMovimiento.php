<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CajaMovimiento extends Model
{
    protected $connection = 'medida';
    protected $table = "caja_movimientos";
    public $timestamps = false;

    public static function getCajaOperacionMovimiento($id){
        return static::select('*')
        ->where('cao_id',$id)
        ->get();
    }

    public static function obtenerSaldosCuadreCaja($id){
        return \DB::select('call obtenerSaldosCuadreCaja(?)',array($id));
    }

    public function formapago(){
        return $this->belongsTo(FormaPago::class,'fop_id');
    }
    public function tipooperacion(){
        return $this->belongsTo(TipoOperacion::class,'tio_id');
    }
}
