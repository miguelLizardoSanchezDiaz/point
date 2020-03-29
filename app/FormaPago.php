<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    protected $connection = 'medida';
    protected $table = "forma_pago";
    public $timestamps = false;
    
    public static function getLista(){
        return static::select('*')
        ->orderBy('fop_codigo','asc')
        ->get();
    }
}
