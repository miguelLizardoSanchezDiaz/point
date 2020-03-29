<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntoVenta extends Model
{
    protected $connection = 'medida';
    protected $table = "punto_venta";
    public $timestamps = false;
    
    public static function getLista(){
        return static::select('*')
        ->orderBy('id','desc')
        ->get();
    }
}
