<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTercero extends Model
{
    protected $connection = 'medida';
    protected $table = "tipo_tercero";
    public $timestamps = false;

    public static function getLista(){
    	return static::select('*')
    	->where('tit_estado',1)
    	->get();
    }
}
