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
    return view('index');
});
Route::get('consultaCedula/{nac}/{cedula}','Consultas\ConsultasController@consulta');
Route::post('estados','Consultas\ConsultasController@estados');
Route::post('municipios','Consultas\ConsultasController@municipios');
Route::post('parroquias','Consultas\ConsultasController@parroquias');
Route::post('nivelInstruccion','Consultas\ConsultasController@nivelInstruccion');
Route::post('guardarP','CRUD\CrudController@guardarPersona');
