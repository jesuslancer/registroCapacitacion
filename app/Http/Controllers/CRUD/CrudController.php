<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Persona;
use App\DatosFormativos;
use App\EspaciosProductivos;
use App\DatosOcupacion;
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
    	$persona->avenida_calle = strtoupper($request->av);
    	$persona->edificio_casa_quinta = strtoupper($request->edf);
    	$persona->piso = strtoupper($request->piso);
    	$persona->apartamento = strtoupper($request->apto);
    	$persona->urbanizacion_sector = strtoupper($request->urb);
    	$persona->punto_referencia = strtoupper($request->ref);
    	$persona->comunidad = strtoupper($request->comunidad);
    	$persona->serial_carnet_patria = $request->serial;
    	$persona->codigo_carnet_patria = $request->codigo;
		$persona->save();
		return 'guardo';
    }

    public function guardarTO(Request $request){//Funcion para guardar los titulos y Ocupaciones de la persona
        DatosFormativos::where('persona_id',$request->idP)->forceDelete();//Se eliminan de la BD para agregar nuevos datos limpiamente
        DatosOcupacion::where('persona_id',$request->idP)->forceDelete();//Se eliminan de la BD para agregar nuevos datos limpiamente
        EspaciosProductivos::where('persona_id',$request->idP)->forceDelete();//Se eliminan de la BD para agregar nuevos datos limpiamente
        Experiencias::where('persona_id',$request->idP)->forceDelete();//Se eliminan de la BD para agregar nuevos datos limpiamente
        Semillas::where('persona_id',$request->idP)->forceDelete();//Se eliminan de la BD para agregar nuevos datos limpiamente
        Herramientas::where('persona_id',$request->idP)->forceDelete();//Se eliminan de la BD para agregar nuevos datos limpiamente
    	if (!empty($request->titulo)) {
            foreach ($request->titulo as  $value) {
                $otrosTi = new DatosFormativos();
                $otrosTi->persona_id = $request->idP;
                $otrosTi->titulo_carrera_id = $value['titulo_carrera_id'];
                $otrosTi->nivel_educativo_id = $value['nivel_educativo_id'];
                $otrosTi->fecha_graduacion = $value['fecha'];
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
        if (!empty($request->espacio)) {
            foreach ($request->espacio as  $value) {
                $otrosTi = new EspaciosProductivos();
                $otrosTi->persona_id = $request->idP;
                $otrosTi->parroquia_id = $value['parroquia_id'];
                $otrosTi->comunidad = strtoupper($value['comunidad']);
                $otrosTi->mts2totales = $value['totales'];
                $otrosTi->mts2sembrados = $value['sembrados'];
                $otrosTi->mts2porsembrar = $value['porSembrar'];
                $otrosTi->modalidad = $value['modalidad'];
                $otrosTi->personas = $value['personasProd'];
                $otrosTi->agua_directa = $value['agua_directa'];
                $otrosTi->agua_manantial = $value['agua_manantial'];
                $otrosTi->save();
            }
        }
        if (!empty($request->experiencias)) {
            foreach ($request->experiencias as  $value) {
                $otrosTi = new Experiencias();
                $otrosTi->persona_id = $request->idP;
                $otrosTi->experiencia_agricola_id = strtoupper($value['id']);
                $otrosTi->tipo = strtoupper($value['tipo']);
                $otrosTi->save();
            }
        }
        if (!empty($request->semillas)) {
            foreach ($request->semillas as  $value) {
                $otrosTi = new Semillas();
                $otrosTi->persona_id = $request->idP;
                $otrosTi->denominacion = strtoupper($value['denominacion']);
                $otrosTi->save();
            }
        } 
        if (!empty($request->herramientas)) {
            foreach ($request->herramientas as  $value) {
                $otrosTi = new Herramientas();
                $otrosTi->persona_id = $request->idP;
                $otrosTi->denominacion = strtoupper($value['denominacion']);
                $otrosTi->save();
            }
        }
        $persona = Persona::find($request->idP);
        $persona->id_user_updated = $request->idP;
        $persona->save();		
        return 'guardo';
    }
    public function guardadoFinal(Request $request){//Funcion que guarda los datos finales, de organizaciones sociales
    	BaseMisiones::where('persona_id',$request->idP)->forceDelete();
		CiudadesPriorizadas::where('persona_id',$request->idP)->forceDelete();
		Clap::where('persona_id',$request->idP)->forceDelete();
		Comunas::where('persona_id',$request->idP)->forceDelete();
		Conuqueros::where('persona_id',$request->idP)->forceDelete();
		Corredores::where('persona_id',$request->idP)->forceDelete();
		FundosZamoranos::where('persona_id',$request->idP)->forceDelete();
		Instituciones::where('persona_id',$request->idP)->forceDelete();
		OrganizacionesMovimientos::where('persona_id',$request->idP)->forceDelete();
        Otros::where('persona_id',$request->idP)->forceDelete();
		Consejos::where('persona_id',$request->idP)->forceDelete();
		Urbanismos::where('persona_id',$request->idP)->forceDelete();//---> se eliminan todos antes de guardar 
		if (!empty($request->bases)) {
        	foreach ($request->bases as  $value) {
	            $item = new BaseMisiones();
	        	$item->denominacion = $value['denominacion'];
	        	$item->persona_id = $request->idP;
	        	$item->save();
        	}
        }
        if (!empty($request->ciudades)) {
        	foreach ($request->ciudades as  $value) {
	            $item = new CiudadesPriorizadas();
	        	$item->denominacion = $value['denominacion'];
	        	$item->persona_id = $request->idP;
	        	$item->save();
        	}
        }
        if (!empty($request->claps)) {
        	foreach ($request->ciudades as  $value) {
	            $item = new Clap();
	        	$item->denominacion = $value['denominacion'];
        		$item->persona_id = $request->idP;
        		$item->save();
        	}
        }
        if (!empty($request->comunas)) {
        	foreach ($request->ciudades as  $value) {
	            $item = new Comunas();
	        	$item->denominacion = $value['denominacion'];
        		$item->persona_id = $request->idP;
        		$item->save();
        	}
        }
        if (!empty($request->conuqueros)) {
        	foreach ($request->ciudades as  $value) {
	            $item = new Conuqueros();
	        	$item->denominacion = $value['denominacion'];
	        	$item->persona_id = $request->idP;
	        	$item->save();
        	}
        }
        if (!empty($request->corredores)) {
        	foreach ($request->ciudades as  $value) {
	            $item = new Corredores();
	        	$item->denominacion = $value['denominacion'];
	        	$item->persona_id = $request->idP;
        		$item->save();
        	}
        }
        if (!empty($request->fundos)) {
            foreach ($request->ciudades as  $value) {
                $item = new FundosZamoranos();
            	$item->denominacion = $value['denominacion'];
            	$item->persona_id = $request->idP;
           		$item->save();
            }
        }
        if (!empty($request->instituciones)) {
        	foreach ($request->ciudades as  $value) {
	            $item = new Instituciones();
	        	$item->denominacion = $value['denominacion'];
	        	$item->persona_id = $request->idP;
        		$item->save();
        	}
        }
        if (!empty($request->organizaciones)) {
        	foreach ($request->ciudades as  $value) {
	            $item = new OrganizacionesMovimientos();
	        	$item->denominacion = $value['denominacion'];
	        	$item->persona_id = $request->idP;
        		$item->save();
        	}
        }
        if (!empty($request->otros)) {
        	foreach ($request->ciudades as  $value) {
	            $item = new Otros();
	        	$item->denominacion = $value['denominacion'];
	        	$item->persona_id = $request->idP;
        		$item->save();
        	}
        }
        if (!empty($request->urbanismos)) {
            foreach ($request->ciudades as  $value) {
                $item = new Urbanismos();
                $item->denominacion = $value['denominacion'];
                $item->persona_id = $request->idP;
                $item->save();
            }
        }
        if (!empty($request->consejos)) {
        	foreach ($request->consejos as  $value) {
	            $item = new Consejos();
	        	$item->denominacion = $value['denominacion'];
	        	$item->persona_id = $request->idP;
        		$item->save();
        	}
        }
        return 'guardo';
    }
}
	