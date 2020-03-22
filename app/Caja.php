<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
	protected $connection = 'medida';
    protected $table = "caja";
    public $timestamps = false;

    public static function consultaCodigo($codigo){
        return static::select('*')
        ->where('caj_codigo',$codigo)
        ->where('caj_estado',1)
        ->first();
    }

    public static function getCajas(){
        return static::select('*')
        //->where('caj_estado',1)
        ->orderBy('caj_codigo','asc')
        ->get();
    }

    public static function anularactivar($id,$parametro)
    {
        return static::where('id',$id)
            ->update(['caj_estado' => $parametro]);
    }
}
