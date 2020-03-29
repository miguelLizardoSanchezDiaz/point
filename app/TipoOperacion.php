<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoOperacion extends Model
{
    protected $connection = 'medida';
    protected $table = "tipo_operacion";
    public $timestamps = false;
    
    public static function getLista(){
        return static::select('*')
        ->orderBy('tio_codigo','asc')
        ->get();
    }
}
