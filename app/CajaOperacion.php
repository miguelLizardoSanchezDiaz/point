<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CajaOperacion extends Model
{
    protected $connection = 'medida';
    protected $table = "caja_operacion";
    public $timestamps = false;

    public static function getCajaOperacion($id){
        return static::select('*')
        ->where('caj_id',$id)
        ->get();
    }

    public static function ultimoapertura(){
        return static::select('id')
        ->orderBy('id','desc')
        ->limit(1)
        ->get();
    }

    public static function obtenerSaldoCaja($caja_id){
        return \DB::select('call obtenerSaldoCaja(?)',array($caja_id));
    }
}
