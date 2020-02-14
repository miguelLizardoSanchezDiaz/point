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

function ValidarUrl($url) {

    $validar = @fsockopen($url, 80, $errno, $errstr, 15);
    if ($validar) {
        fclose($validar);
        return true;
    }else
    return false;
}

function validar_fecha_espanol($fecha){
    $valores = explode('/', $fecha);
    if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
        return 1;
    }
    return 0;
}

function inicio_perdefecto(){
    $periodo=Periodo::findOrFail(session_periodo_id());
    return fecha_a_espanol($periodo->inicio);
}
function fin_perdefecto(){
    $periodo=Periodo::findOrFail(session_periodo_id());
    return fecha_a_espanol($periodo->final);
}

function fecha_hoy(){

    date_default_timezone_set('America/Lima');
    $fecha=date('d/m/Y');

    return $fecha;
}

function anio_hoy(){

    date_default_timezone_set('America/Lima');
    $fecha=date('Y');

    return $fecha;
}

function fecha_hoy_sin_guion(){

    $cadena=trim(fecha_hoy());
    $tamano=strlen($cadena);

    $anno=substr($cadena,6,$tamano);
    $dia=substr($cadena,0,2);
    $mes=substr($cadena,3,2);

    $valor=$anno.$mes.$dia;

    return $valor;        
}

function horaactual(){

    date_default_timezone_set('America/Lima');
    $fecha=date('h:i:s');
    return $fecha;
}


function fecha_a_ingles($fecha){

    $cadena=trim($fecha);
    $tamano=strlen($cadena);

    $anno=substr($cadena,6,$tamano);
    $dia=substr($cadena,0,2);
    $mes=substr($cadena,3,2);

    $fecha=$anno."-".$mes."-".$dia;
    
    if ($fecha==='//')
    {
        $fecha="";
    }

    return $fecha;        
}

function obtener_fecha_x_3_meses($fecha){
    $date = strtotime(date("Y-m-d", strtotime($fecha)) . " +3 month");
    $date = date("Y-m-d",$date);
    return $date;
}

function obtener_fecha_x_1_mes($fecha){
    $date = strtotime(date("Y-m-d", strtotime($fecha)) . " +1 month");
    $date = date("Y-m-d",$date);
    return $date;
}

function obtener_fecha_x_12_meses($fecha){
    $date = strtotime(date("Y-m-d", strtotime($fecha)) . " +12 month");
    $date = date("Y-m-d",$date);
    return $date;
}

function calcular_dias_restantes($fechainicial, $fechafinal){
    $fechai = new DateTime($fechainicial);
    $fechaf = new DateTime($fechafinal);
    $dif = $fechaf->diff($fechai)->format("%a");
    $dias = intval($dif);
    return $dias;
}


function fecha_sin_guion($fecha){

    $cadena=trim($fecha);
    $tamano=strlen($cadena);

    $anno=substr($cadena,6,$tamano);
    $dia=substr($cadena,0,2);
    $mes=substr($cadena,3,2);

    $valor=$anno.$mes.$dia;

    return $valor;        
}
function fecha_sin_guion_sindia($fecha){

    $cadena=trim($fecha);
    $tamano=strlen($cadena);

    $anno=substr($cadena,6,$tamano);
    $dia=substr($cadena,0,2);
    $mes=substr($cadena,3,2);

    $valor=$anno.$mes;

    return $valor;        
}

function fecha_sin_slash_a_fecha_ingles_con_guion($fecha){
    $anio = substr($fecha,4);
    $mes = substr($fecha,2, 2);
    $dia = substr($fecha,0, 2);

    $fecha_ingles = $anio.'-'.$mes.'-'.$dia;

    return $fecha_ingles;
}

function formato_ceros_numero($numero){
    //longitud 9
    $numero_formateado = sprintf("%09d", $numero);
    return $numero_formateado;
}

function fecha_a_espanol($fecha){

    $cadena=trim($fecha);
    $tamano=strlen($cadena);
    
    if($tamano>9)
    {
        $anno=substr($cadena,0,4);
        $mes=substr($cadena,5,2);
        $dia=substr($cadena,8,2); 
    }
    else
    {
        $anno=substr($cadena,0,2);
        $mes=substr($cadena,3,2);
        $dia=substr($cadena,6,2);
    }
    $fecha=$dia."/".$mes."/".$anno;
    if ($fecha==='//')
    {
        $fecha="";
    }

    return $fecha;    

}

function validachecked($checked)
{
    if($checked==1){
        return 1;
    }
    else{
        return 0;
    }
}

function valida_valor($paremetro){
    if ($paremetro!='') {
        $valor=$paremetro;
    }
    else{
        $valor=NULL;
    }
    return $valor;
}

function validapempresa($nombreParametro,$tipo,$descripcion,$valor){
    $pempresa=Pempresa::where('parametro','=',$nombreParametro)->first();
    if($pempresa){

    }
    else{
        $pempresa=new Pempresa();
        $pempresa->parametro=$nombreParametro;
        $pempresa->valor=$valor;
        $pempresa->descripcion=$descripcion;
        $pempresa->tipo=$tipo;
        $pempresa->usuario='';
        $pempresa->save();
        $pempresa=Pempresa::where('parametro','=',$nombreParametro)->first();
    }
    return $pempresa;
}

function validaFiltroAutocomplete($campo){
    if($campo>=1){
        return $campo;
    }
    else{
        return NULL;
    }
}
function obtener_usuario_id(){
    if(Auth::guest()){
        $usuario='';
    }
    else{
        $usuario=Auth::user()->id;
    }
    return $usuario;
}
function obtener_rol_superadmin(){
    return '3';
}

function obtener_usuario(){
    if(Auth::guest()){
        $usuario='';
    }
    else{
        $usuario=Auth::user()->usu_usuario;
    }
    return $usuario;
}
function obtener_usuario_panel(){
    if(Auth::guest()){
        $usuario='';
    }
    else{
        $usuario=Auth::user()->usu_usuario;
    }
    return $usuario;
}

function ceros_izquierda($texto,$max){
    return str_pad($texto,$max, "0", STR_PAD_LEFT);    
}