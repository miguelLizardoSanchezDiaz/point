<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    public static function findByCodigoOrDescription($term)
    {
        return static::select('*',DB::raw('concat(mar_codigo," | ",mar_descripcion) as name'))
            ->Where(DB::raw('concat(mar_codigo," ",mar_descripcion)'),'LIKE',"%$term%")
            ->Where('mar_estado','!=',0)
            ->limit(50)
            ->get();
    }
}
