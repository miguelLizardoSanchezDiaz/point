<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Categoria extends Model
{
    protected $connection = 'medida';
    protected $table = "categoria";
    public $timestamps = false;

    public static function consultaCodigo($codigo){
        return static::select('*')
        ->where('cat_codigo',$codigo)
        ->where('cat_estado',1)
        ->first();
    }

    public static function getCategorias(){
        return static::select('*')
        ->where('cat_estado',1)
        //->where(DB::raw('CHARACTER_length(cat_codigo)'),2)
        ->orderBy('cat_codigo','asc')
        ->get();
    }

    public static function findByCodigoOrDescription($term)
    {
        return static::select('*',DB::raw('concat(cat_codigo," | ",cat_descripcion) as name'))
            ->Where(DB::raw('concat(cat_codigo," ",cat_descripcion)'),'LIKE',"%$term%")
            ->Where('cat_estado','!=',0)
            ->limit(50)
            ->get();
    }
}
