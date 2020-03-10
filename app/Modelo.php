<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Modelo extends Model
{
    protected $connection = 'medida';
    protected $table = "modelo";
    public $timestamps = false;

    public static function getListaIndex(){
    	return static::select('*')
    	->where('mod_estado',1)
        ->orderby('mod_descripcion','asc')
        ->get();
    }

    public static function findByCodigoOrDescription($term)
    {
        return static::select('*',DB::raw('concat(mod_codigo," | ",mod_descripcion) as name'))
            ->Where(DB::raw('concat(mod_codigo," ",mod_descripcion)'),'LIKE',"%$term%")
            ->Where('mod_estado','!=',0)
            ->limit(50)
            ->get();
    }
}
