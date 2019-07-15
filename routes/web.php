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

Route::get('/', function () {// Instancia la primera vista
    return view('index');
});
//Consultas
Route::get('consultaCedula/{nac}/{cedula}','Consultas\ConsultasController@consulta');
Route::post('estados','Consultas\ConsultasController@estados');
Route::post('municipios','Consultas\ConsultasController@municipios');
Route::post('parroquias','Consultas\ConsultasController@parroquias');
Route::post('nivelInstruccion','Consultas\ConsultasController@nivelInstruccion');
Route::post('instituciones','Consultas\ConsultasController@instituciones');
Route::post('categorias','Consultas\ConsultasController@categorias');
Route::post('areasConocimientos','Consultas\ConsultasController@areasConocimientos');
Route::post('programas','Consultas\ConsultasController@programas');
Route::post('titulos','Consultas\ConsultasController@titulos');
Route::post('ocupaciones','Consultas\ConsultasController@ocupaciones');
Route::post('experienciaAgricola','Consultas\ConsultasController@experienciaAgricola');
Route::post('hectarias','Consultas\ConsultasController@hectarias');

//Acciones
Route::post('guardarP','CRUD\CrudController@guardarPersona');
Route::post('guardarTO','CRUD\CrudController@guardarTO');
Route::post('guardadoFinal','CRUD\CrudController@guardadoFinal');
