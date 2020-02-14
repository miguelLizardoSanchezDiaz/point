<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Categoria extends Model
{
    protected $connection = 'medida';
    protected $table = "categoria";
    public $timestamps = false;

    public static function getCategoriasPrincipales(){
        return static::select('*')
        ->where('cat_estado',1)
        ->where(DB::raw('CHARACTER_length(cat_codigo)'),4)
        ->orderBy('cat_codigo','asc')
        ->get();
    }
}
