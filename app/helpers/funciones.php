<?php
use App\RolPermiso;

function valida_privilegio($permiso_id){
    $rol_id=obtener_rol_id();
    $resultado=RolPermiso::consulta_privilegio($rol_id,$permiso_id);
    if($resultado){
        return 1;
    }
    else{
        return 0;
    }
}

function obtener_rol_id(){
    if(Auth::guest()){
        $usuario='';
    }
    else{
        $usuario=Auth::user()->rol_id;
    }
    return $usuario;
}