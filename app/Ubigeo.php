<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    protected $connection = 'medida';
    protected $table = "ubigeo";
    public $timestamps = false;
    
    public static function getLista(){
        return static::select('*')
        ->orderBy('id','desc')
        ->get();
    }
}
