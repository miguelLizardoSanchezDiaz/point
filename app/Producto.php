<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $connection = 'medida';
    protected $table = "producto";
    public $timestamps = false;
    
    public static function getLista(){
        return static::select('*')
        ->where('pro_estado',1)
        ->orderby('pro_descripcion','asc')
        ->get();
    }

    public function unidadmedida(){
        return $this->belongsTo(Umedida::class,'unm_id');
    }
    public function marca(){
        return $this->belongsTo(Marca::class,'mar_id');
    }
    public function modelo(){
        return $this->belongsTo(Modelo::class,'mod_id');
    }
    public function categoria(){
        return $this->belongsTo(Categoria::class,'cat_id');
    }

    public static function consultaCodigo($codigo){
        return static::select('*')
        ->where('pro_codigo',$codigo)
        ->where('pro_estado',1)
        ->first();
    }

}
