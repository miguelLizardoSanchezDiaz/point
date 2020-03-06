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
    /*public static function getListaIntranet($codigo,$cbo_categoria1,$cbo_categoria2,$cbo_categoria3,$marca,$cbo_web,$txt_descripcion){
        return Producto::filtroCategoria1($codigo,$cbo_categoria1,$cbo_categoria2,$cbo_categoria3,$marca,$txt_descripcion)

        //->filtroCategoria2($cbo_categoria2)
        //->filtroCategoria3($cbo_categoria3)
        //->filtroPrecio($precio_min,$precio_max)
        //->where('pro_precio_despues','>=',$precio_min)
        //->where('pro_precio_despues','<=',$precio_max)
        ->where('pro_estado',1)
        //->where('pro_web',$cbo_web)

        //->where('pro_codigo',$codigo)

        //->where('pro_precio_despues','>',0)

        //->paginate(25);
        ->get();
    }*/


    /*public function scopeFiltroCategoria1($query,$codigo,$cbo_categoria1,$cbo_categoria2,$cbo_categoria3,$marca_id,$txt_descripcion){
        if(empty($marca_id) && $codigo=='' && empty($cbo_categoria1) && empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('producto.*','m.mar_nombre')
            //->where('m.id',$marca_id)
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('marca as m','m.id','=','producto.pro_marca');
        }

        if(!empty($marca_id) && $codigo=='' && empty($cbo_categoria1) && empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('producto.*','m.mar_nombre')
            ->where('m.id',$marca_id)
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('marca as m','m.id','=','producto.pro_marca');
        }
        if(empty($marca_id) && $codigo!='' && empty($cbo_categoria1) && empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->where('pro_codigo','like','%'.$codigo.'%');
        }
        if(!empty($marca_id) && $codigo!='' && empty($cbo_categoria1) && empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('producto.*','m.mar_nombre')
            ->where('m.id',$marca_id)
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('marca as m','m.id','=','producto.pro_marca');
        }

        if(!empty($marca_id) && $codigo=='' && !empty($cbo_categoria2) && !empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria3.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(empty($marca_id) && $codigo!='' && !empty($cbo_categoria2) && !empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->where('c.cat_codigo','LIKE',$cbo_categoria3.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(!empty($marca_id) && $codigo!='' && !empty($cbo_categoria2) && !empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria3.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }

        if(!empty($marca_id) && $codigo=='' && !empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria2.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(empty($marca_id) && $codigo!='' && !empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->where('c.cat_codigo','LIKE',$cbo_categoria2.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(!empty($marca_id) && $codigo!='' && !empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria2.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }

        if(!empty($marca_id) && $codigo=='' && empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria1.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(empty($marca_id) && $codigo!='' && empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->where('c.cat_codigo','LIKE',$cbo_categoria1.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(!empty($marca_id) && $codigo!='' && empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria1.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }

        if(empty($marca_id) && $codigo=='' && !empty($cbo_categoria1) && !empty($cbo_categoria2) && !empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('c.cat_codigo','LIKE',$cbo_categoria3.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');   
            
        } 
        if(empty($marca_id) && $codigo=='' && !empty($cbo_categoria1) && !empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('c.cat_codigo','LIKE',$cbo_categoria2.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
            
        } 
        if(empty($marca_id) && $codigo=='' && !empty($cbo_categoria1) && empty($cbo_categoria2) && empty($cbo_categoria3) && $txt_descripcion!=''){
            return $query->select('*')
            ->where('c.cat_codigo','LIKE',$cbo_categoria1.'%')
            ->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }






        if(!empty($marca_id) && $codigo=='' && empty($cbo_categoria1) && empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('producto.*','m.mar_nombre')
            ->where('m.id',$marca_id)
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('marca as m','m.id','=','producto.pro_marca');
        }
        if(empty($marca_id) && $codigo!='' && empty($cbo_categoria1) && empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->where('pro_codigo','like','%'.$codigo.'%');
        }
        if(!empty($marca_id) && $codigo!='' && empty($cbo_categoria1) && empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('producto.*','m.mar_nombre')
            ->where('m.id',$marca_id)
            ->where('pro_codigo','like','%'.$codigo.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('marca as m','m.id','=','producto.pro_marca');
        }

        if(!empty($marca_id) && $codigo=='' && !empty($cbo_categoria2) && !empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria3.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(empty($marca_id) && $codigo!='' && !empty($cbo_categoria2) && !empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->where('c.cat_codigo','LIKE',$cbo_categoria3.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(!empty($marca_id) && $codigo!='' && !empty($cbo_categoria2) && !empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria3.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }

        if(!empty($marca_id) && $codigo=='' && !empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria2.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(empty($marca_id) && $codigo!='' && !empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->where('c.cat_codigo','LIKE',$cbo_categoria2.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(!empty($marca_id) && $codigo!='' && !empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria2.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }

        if(!empty($marca_id) && $codigo=='' && empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria1.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(empty($marca_id) && $codigo!='' && empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->where('c.cat_codigo','LIKE',$cbo_categoria1.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }
        if(!empty($marca_id) && $codigo!='' && empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('m.id',$marca_id)
            ->where('pro_codigo','like','%'.$codigo.'%')
            ->join('marca as m','m.id','=','producto.pro_marca')
            ->where('c.cat_codigo','LIKE',$cbo_categoria1.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }

        if(empty($marca_id) && $codigo=='' && !empty($cbo_categoria1) && !empty($cbo_categoria2) && !empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('c.cat_codigo','LIKE',$cbo_categoria3.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');   
            
        } 
        if(empty($marca_id) && $codigo=='' && !empty($cbo_categoria1) && !empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('c.cat_codigo','LIKE',$cbo_categoria2.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
            
        } 
        if(empty($marca_id) && $codigo=='' && !empty($cbo_categoria1) && empty($cbo_categoria2) && empty($cbo_categoria3) && empty($txt_descripcion)){
            return $query->select('*')
            ->where('c.cat_codigo','LIKE',$cbo_categoria1.'%')
            //->where('producto.pro_descripcion','like','%'.$txt_descripcion.'%')
            ->join('categoria as c','c.id','=','producto.cat_id');
        }  
    }*/

    public function unidadmedida(){
        return $this->belongsTo(Umedida::class,'unm_id');
    }
    public function marca(){
        return $this->belongsTo(Marca::class,'mar_id');
    }
    public function modelo(){
        return $this->belongsTo(Marca::class,'mod_id');
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
