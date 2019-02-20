<?php

namespace App\Http\Controllers\Consultas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AreaConocimiento;
use App\Persona;
use App\Estado;
use App\Municipio;
use App\Parroquia;

class ConsultasController extends Controller
{
    public function consulta($n,$c){// Funcion para consultar la persona
    	$persona = Persona::with('parroquia')->where('nacionalidad',$n)->where('cedula_identidad',$c)->first();
    	if (empty($persona)) {
    		return 'vacio';
    	}
    	return $persona;
    }
    public function estados(){// Funcion q trae todos los estados
    	return Estado::get();
    }
    public function municipios(Request $request){// Funcion q trae los municipios segun se seleccione estado
    	return Municipio::where('estado_id',$request->id)->get();
    }
    public function parroquias(Request $request){// Funcion q trae las parroquias segun se seleccione municipio
    	return Parroquia::where('municipio_id',$request->id)->get();
    }
}
