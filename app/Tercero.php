<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tercero extends Model
{
    protected $connection = 'medida';
    protected $table = "tercero";
    public $timestamps = false;
    
    public static function consultaCodigo($codigo){
        return static::select('*')
        ->where('ter_codigo',$codigo)
        ->where('ter_estado',1)
        ->first();
    }

    public static function getLista(){
        /*return static::select('*')
        ->orderBy('id','desc')
        ->get();*/
        return \DB::select('call listarTerceros');
    }
}
