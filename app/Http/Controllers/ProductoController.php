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
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $tipoproceso='listar';
        /*Desarrollado por Miguel Sánchez 04/12/2018
        Revisado por LIZARDO*/
        $txt_codigo=$request->txt_codigo;
        $cbo_marca=$request->cbo_marca;
        $txt_descripcion=$request->txt_descripcion;
        $marcas=Marca::getListaIndex();

    	$productos=Producto::getLista($txt_codigo,$cbo_marca,$txt_descripcion);
    	
    	return view('maestros.productos.listado',compact('productos','variable','tipoproceso','txt_codigo','cbo_marca','txt_descripcion','marcas'));
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

        $consulta=Producto::consultaCodigo($request->txt_codigo);
        if($consulta){
            $r["estado"]="error";
            $r["mensaje"]="Código ya se encuentra registrado, verifique!";
        }
        else{
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
        }
        return $r;
    }

    public function edit($id)
    {
        $variable=$this->variable;
        if(valida_privilegio($this->permiso)==0){return view('layouts.no_privilegio',compact('variable'));}

        $producto=Producto::findorfail($id);

        return view('maestros.productos.editar',compact('producto','variable'));
    }

}
