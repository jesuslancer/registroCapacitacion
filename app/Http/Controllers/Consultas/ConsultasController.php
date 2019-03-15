<?php

namespace App\Http\Controllers\Consultas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Carbon\Carbon;
use App\Persona;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\NivelEducativo;
use App\CategoriaEducacion;
use App\AreaConocimiento;
use App\ProgramaEstudio;
use App\TituloCarrera;
use App\OcupacionClase;
use App\OcupacionDivision;
use App\OcupacionGrupo;
use App\OcupacionSeccion;
use App\DatosFormativos;
use App\DatosOcupacion;

class ConsultasController extends Controller
{
    public function consulta($n,$c){// Funcion para consultar la persona
    	$persona = Persona::with('parroquia.municipio.estado')->where('nacionalidad',$n)->where('cedula_identidad',$c)->first();
    	if (empty($persona)) {
    		return 'vacio';
    	}
    	$titulos = DatosFormativos::with('nivelEducativo','tituloCarrera')->where('persona_id',$persona->id)->get();
    	$ocupaciones = DatosOcupacion::with('ocupacionClase')->where('persona_id',$persona->id)->get();
		//$edad = Carbon::createFromDate($persona->fecha_nacimiento)->age;// Se saca la edad de la persona, en espera para validar
    	return ['persona'=>$persona,'titulos'=>$titulos,'ocupaciones'=>$ocupaciones];
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
    public function nivelInstruccion(){//Trae los niveles de instruccion
    	return NivelEducativo::get();
    }	
    public function categorias(Request $request){//Trae las categorias segun el nivel 
    	return CategoriaEducacion::where('nivel_educativo_id',$request->id)->get();
    }
    public function areasConocimientos(Request $request){//Trae las areas segun la categoria 
    	return AreaConocimiento::where('categoria_educacion_id',$request->id)->get();
    }
    public function programas(Request $request){//Trae los programas segun la el area 
    	return ProgramaEstudio::where('area_conocimiento_id',$request->id)->get();
    }
    public function titulos(Request $request){//Trae los programas segun la el area 
    	return TituloCarrera::where('programa_estudio_id',$request->id)->get();
    }
    public function ocupaciones (){//Consultas las ocupaciones clases, para el select2
    	return OcupacionClase::all();
    }
}
