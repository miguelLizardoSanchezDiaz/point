<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
    
Route::group(['middleware'=>'auth'],function()
{
	Route::get('/home', 'HomeController@index')->name('home');

	//CONFIGURACION
    route::resource('usuario','UsuarioController');
    route::resource('rol','RolController');
    route::resource('permisos-por-rol','RolPermisoController');
    //ASIGNACION DE PERMISOS
    Route::post('/permiso/ver_permiso_asignado','RolPermisoController@ver_permiso_asignado');
    Route::post('/permiso/ver_permiso_no_asignado','RolPermisoController@ver_permiso_no_asignado');
    Route::post('/permiso/asignar_permiso','RolPermisoController@asignar_permiso');
    Route::post('/permiso/quitar_permiso','RolPermisoController@quitar_permiso');

    //MAESTROS
    route::resource('producto','ProductoController');
    Route::post('productos.guarda_fotos', [
        'uses'=>'productoController@guarda_fotos',
        'as'=>'productos.guarda_fotos'
    ]);
    Route::post('elimina_detalle_producto', [
        'uses'=>'productoController@elimina_detalle_producto',
        'as'=>'elimina_detalle_producto'
    ]);
    
    Route::resource('tercero','TerceroController');
    Route::group(['prefix' => 'tercero'], function() {
        Route::post('/valida_codigo',[
           'as' =>'valida_codigo',
           'uses'=>'TerceroController@valida_codigo']);
        Route::post('/consultar_ruc_contribuyente',[
            'as' =>'consultar_ruc_contribuyente',
            'uses'=>'TerceroController@consultar_ruc_contribuyente']);
        Route::post('/consultar_dni',[
            'as' =>'consultar_dni',
            'uses'=>'TerceroController@consultar_dni']);
    });

    Route::resource('categorias','CategoriaController');
    Route::resource('marcas','MarcaController');
    Route::resource('unidad-medida','UnidadMedidaController');
    Route::resource('modelos','ModeloController');
    Route::group(['prefix' => 'autocomplete'], function() {
        Route::get('/filtrarCategoria','AutocompleteController@BuscarCategoria');
        Route::get('/filtrarUnidadMedida','AutocompleteController@BuscarUmedida');
        Route::get('/filtrarMarca','AutocompleteController@BuscarMarca');
    });

    
});