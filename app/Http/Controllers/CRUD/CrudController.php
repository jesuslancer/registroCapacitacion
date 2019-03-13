<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Persona;
use App\DatosFormativos;
use App\DatosOcupacion;

class CrudController extends Controller
{
    public function guardarPersona(Request $request){//Funcion para guardar los datos de las personas 
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
    public function guardarTO(Request $request){//Funcion para guardar los titulos y Ocupaciones de la persona
        DatosFormativos::where('persona_id',$request->idP)->forceDelete();//Se eliminan de la BD para agregar nuevos datos limpiamente
        DatosOcupacion::where('persona_id',$request->idP)->forceDelete();//Se eliminan de la BD para agregar nuevos datos limpiamente
    	if (!empty($request->titulo)) {
            foreach ($request->titulo as  $value) {
                $otrosTi = new DatosFormativos();
                $otrosTi->persona_id = $request->idP;
                $otrosTi->titulo_carrera_id = $value['titulo_carrera_id'];
                $otrosTi->nivel_educativo_id = $value['nivel_educativo_id'];
                $otrosTi->fecha_graducacion = $value['fecha'];
                $otrosTi->save();
            }
        }
        if (!empty($request->ocupacion)) {
            foreach ($request->ocupacion as  $value) {
                $otrosTi = new DatosOcupacion();
                $otrosTi->persona_id = $request->idP;
                $otrosTi->ocupacion_clase_id = $value['ocupacion_clase_id'];
                $otrosTi->codigo = $value['codigo'];
                $otrosTi->save();
            }
        }
    	dd($request->all());

    }
}
	