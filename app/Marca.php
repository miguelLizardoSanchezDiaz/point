<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $connection = 'medida';
    protected $table = "marca";
    public $timestamps = false;

    public static function getListaIndex(){
    	return static::select('*')
    	->where('mar_estado',1)
        ->orderby('mar_descripcion','asc')
        ->get();
    }
}
