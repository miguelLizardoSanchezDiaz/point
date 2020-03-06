<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\Categoria;
use App\Marca;
use App\Producto;
use Session;
use Illuminate\Support\Facades\Redirect;


class ProductoController extends Controller
{
    protected $variable='producto';
    protected $permiso='5';

    public function index(Request $request){
        $tipoproceso='listar';
        /*Desarrollado por Miguel Sánchez 04/12/2018
        Revisado por LIZARDO*/
        $txt_codigo=$request->txt_codigo;
    	$cbo_categoria1=$request->cbo_categoria1;
		$cbo_categoria2=$request->cbo_categoria2;
		$cbo_categoria3=$request->cbo_categoria3;
        $cbo_marca=$request->cbo_marca;
        $cbo_web=$request->cbo_web;
        $txt_descripcion=$request->txt_descripcion;

        //$categorias=Categoria::getCategoriasPrincipales();
        $marcas=Marca::getListaIndex();
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

    	$productos=Producto::getListaIntranet($txt_codigo,$cbo_categoria1,$cbo_categoria2,$cbo_categoria3,$cbo_marca,$cbo_web,$txt_descripcion);
    	
    	return view('maestros.productos.listado',compact('productos','variable','tipoproceso','cbo_categoria1','cbo_categoria2','cbo_categoria3','txt_codigo','marcas','cbo_marca','cbo_web','txt_descripcion'));
    }

    public function create()
    {
    	$tipoproceso='crear';
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        //$departamentos=Departamento::listaCombo();
        $marcas=Marca::getListaIndex();
        return view('maestros.productos.nuevo',compact('variable','tipoproceso','marcas'));
    }

    public function store(Request $request)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}
        
        $operacion='insertar';

        $producto=new Producto;
        $producto->pro_codigo= $request->txt_codigo;
        $producto->pro_descripcion= $request->txt_descripcion;
        $producto->cat_id=validaFiltroAutocomplete($request->txt_id_categoria);
        $producto->pro_tipo_producto= $request->cbo_tipo_producto;
        $producto->pro_precio= $request->txt_precio_venta;
        $producto->pro_peso= $request->txt_precio;
        $producto->pro_volumen= $request->txt_volumen;
        $producto->unm_id= validaFiltroAutocomplete($request->txt_id_umedida);
        $producto->mar_id= validaFiltroAutocomplete($request->txt_id_marca);
        $producto->mod_id= validaFiltroAutocomplete($request->txt_id_modelo);
        $producto->pro_caracteristicas= $request->txt_caracteristicas;
        $producto->pro_estado=1;
        $producto->pro_usuario=obtener_usuario();
        switch ($operacion) {
            case "insertar":
                if($producto->save())
                {
                    $r["estado"]="ok";
                    $r["mensaje"]="Grabado Correctamente";
                }
                else{
                    $r["estado"]="error";
                    $r["mensaje"]="Error al Grabar!";
                }
                break;

            default:
                $r["estado"]="error";
                $r["mensaje"] = "Datos no válidos";
                break;
        }
        return $r;
    }

}
