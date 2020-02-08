<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $connection = 'medida';
    protected $table = "rol";
    public $timestamps = false;

    public static function getLista(){
    	return static::select('*')
    	->where('rol_estado',1)
    	->orderBy('rol_descripcion','asc')
    	->get();
    }
}
