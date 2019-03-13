<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Persona;

class CrudController extends Controller
{
    public function guardarPersona(Request $request){
    	//(strtoupper($texto)) para mayusculas
    	$persona = Persona::find($request->idP);
    	$persona->estado_civil_id = $request->estadoCivil;
    	$persona->nivel_educativo_id = $request->nivel;
    	$persona->parroquia_id = $request->parroquia;
    	$persona->telefono_1 = $request->telf1;
    	$persona->telefono_2 = $request->telf2;
    	$persona->telefono_3 = $request->telf3;
    	$persona->correo_principal = $request->correo1;
    	$persona->correo_opcional = $request->correo2;
    	$persona->avenida_calle = $request->av;
    	$persona->edificio_casa_quinta = $request->edf;
    	$persona->piso = $request->piso;
    	$persona->apartamento = $request->apto;
    	$persona->urbanizacion_sector = $request->urb;
    	$persona->punto_referencia = $request->ref;
    	$persona->comunidad = $request->comunidad;
    	$persona->serial_carnet_patria = $request->serial;
    	$persona->codigo_carnet_patria = $request->codigo;
		$persona->save();
		return 'guardo';
    }
}
	