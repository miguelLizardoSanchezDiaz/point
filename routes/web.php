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

    
    Route::resource('tercero','TerceroController');
});