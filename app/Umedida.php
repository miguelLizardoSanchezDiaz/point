<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Umedida extends Model
{
    protected $connection = 'medida';
    protected $table = "unidad_medida";
    public $timestamps = false;

    public static function findByCodigoOrDescription($term)
    {
        return static::select('*',DB::raw('concat(unm_codigo," | ",unm_descripcion) as name'))
            ->Where(DB::raw('concat(unm_codigo," ",unm_descripcion)'),'LIKE',"%$term%")
            ->Where('unm_estado','!=',0)
            ->limit(50)
            ->get();
    }
}
