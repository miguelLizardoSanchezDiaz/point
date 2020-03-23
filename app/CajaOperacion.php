<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CajaOperacion extends Model
{
    protected $connection = 'medida';
    protected $table = "caja_operacion";
    public $timestamps = false;

    public static function obtenerSaldoCaja($caja_id){
        return \DB::select('call obtenerSaldoCaja(?)',array($caja_id));
    }
}
