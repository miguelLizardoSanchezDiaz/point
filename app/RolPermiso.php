<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    protected $connection = 'medida';
    protected $table = "rol_permiso";
    public $timestamps = false;

    public function rol(){
        return $this->belongsTo(Rol::class,'rol_id');
    }

    public function permiso(){
        return $this->belongsTo(Permiso::class,'per_id');
    }

    public static function ver_permiso_asignado($id_rol){
    	return static::select('rol_permiso.id as permiso_rol_id' ,'rol_permiso.*','p.*')
    	->leftJoin('rol as r','r.id','=','rol_permiso.rol_id')
    	->leftJoin('permiso as p','p.id','=','rol_permiso.per_id')
    	->where('rol_permiso.rol_id',$id_rol)
    	->orderBy('p.per_descripcion','asc')
        ->get();
    }
    public static function consulta_privilegio($rol_id,$permiso_id){
        return static::select('*')
        ->where('rol_id',$rol_id)
        ->where('per_id',$permiso_id)
        ->first();
    }

}
