<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    protected $connection = 'medida';
    protected $table = "rol_permiso";
    public $timestamps = false;

    public static function consulta_privilegio($rol_id,$permiso_id){
        return static::select('*')
        ->where('rol_id',$rol_id)
        ->where('per_id',$permiso_id)
        ->first();
    }
}
