<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
	protected $connection = 'medida';
    protected $table = "permiso";
    public $timestamps = false;

    public static function getLista(){
    	return static::select('*')
    	->where('per_estado',1)
    	->orderBy('per_descripcion','asc')
    	->get();
    }

    public static function ver_permisos_sin_asignar($permisos_asignados,$permiso_oculto_sin_asignar=''){
        return static::select('*')
        ->orderBy('per_descripcion','asc')
        ->whereNotIn('id', $permisos_asignados)
        //->whereNotIn('per_id', $permiso_oculto_sin_asignar)
        ->get();
    }
}
