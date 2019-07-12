<?php

namespace App\Http\Controllers\Consultas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
use App\ExperienciaAgricola;
use App\EspaciosProductivos;
use App\OrganizacionesSociales;
use App\BaseMisiones;
use App\CiudadesPriorizadas;
use App\Clap;
use App\Comunas;
use App\Conuqueros;
use App\Corredores;
use App\FundosZamoranos;
use App\Instituciones;
use App\OrganizacionesMovimientos;
use App\Otros;
use App\Urbanismos;
use App\Consejos;
use App\Experiencias;
use App\Semillas;
use App\Herramientas;

class ConsultasController extends Controller
{
    public function consulta($n,$c){// Funcion para consultar la persona
    	$persona = Persona::with('parroquia.municipio.estado')->where('nacionalidad',$n)->where('cedula_identidad',$c)->first();
    	if (empty($persona)) {
    		return 'vacio';
    	}
    	$titulos = DatosFormativos::with('nivelEducativo','tituloCarrera')->where('persona_id',$persona->id)->get();
    	$ocupaciones = DatosOcupacion::with('ocupacionClase')->where('persona_id',$persona->id)->get();
    	$espacios = EspaciosProductivos::with('parroquia.municipio.estado')->where('persona_id',$persona->id)->get();
    	$bases = BaseMisiones::where('persona_id',$persona->id)->get();
    	$claps = Clap::where('persona_id',$persona->id)->get();
    	$comunas = Comunas::where('persona_id',$persona->id)->get();
    	$conuqueros = Conuqueros::where('persona_id',$persona->id)->get();
    	$corredores = Corredores::where('persona_id',$persona->id)->get();
    	$fundos = FundosZamoranos::where('persona_id',$persona->id)->get();
    	$instituciones = Instituciones::where('persona_id',$persona->id)->get();
    	$organizaciones = OrganizacionesMovimientos::where('persona_id',$persona->id)->get();
    	$otros = Otros::where('persona_id',$persona->id)->get();
        $urbanismos = Urbanismos::where('persona_id',$persona->id)->get();
        $ciudades = CiudadesPriorizadas::where('persona_id',$persona->id)->get();
    	$consejos = Consejos::where('persona_id',$persona->id)->get();
        $experiencia = Experiencias::with('ExperienciaAgricola')->where('persona_id',$persona->id)->get();
        $semillas = Semillas::where('persona_id',$persona->id)->get();
        $herramientas = Herramientas::where('persona_id',$persona->id)->get();
		$edad = Carbon::createFromDate($persona->fecha_nacimiento)->age;// Se saca la edad de la persona, solo entre 15 - 35
        /*if ($edad < 15 || $edad > 35) {//Validacion de edades
            return 'edades';
        }*/
    	return ['persona'=>$persona,'titulos'=>$titulos,'ocupaciones'=>$ocupaciones,'espacios'=>$espacios,'bases'=>$bases,'ciudades'=>$ciudades,'claps'=>$claps,'comunas'=>$comunas,'conuqueros'=>$conuqueros,'corredores'=>$corredores,'fundos'=>$fundos,'instituciones'=>$instituciones,'organizaciones'=>$organizaciones,'otros'=>$otros,'urbanismos'=>$urbanismos,'consejos'=>$consejos,'experiencias'=>$experiencia,'semillas'=>$semillas,'herramientas'=>$herramientas];
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
    public function experienciaAgricola (){//Consultas las Experiencias agricolas
    	return ExperienciaAgricola::all();
    }
}
