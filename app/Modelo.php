<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $connection = 'medida';
    protected $table = "modelo";
    public $timestamps = false;

    public static function consultaCodigo($codigo){
        return static::select('*')
        ->where('mod_codigo',$codigo)
        ->where('mod_estado',1)
        ->first();
    }

    public static function getListaIndex(){
    	return static::select('*')
    	->where('mod_estado',1)
        ->orderby('mod_descripcion','asc')
        ->get();
    }
}
