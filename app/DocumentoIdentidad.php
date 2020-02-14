<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoIdentidad extends Model
{
    protected $connection = 'medida';
    protected $table = "documento_identidad";
    public $timestamps = false;

    public static function getLista(){
    	return static::select('*')
    	->where('doi_estado',1)
    	->get();
    }
}
