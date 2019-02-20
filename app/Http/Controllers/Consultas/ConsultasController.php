<?php

namespace App\Http\Controllers\Consultas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AreaConocimiento;
use App\Persona;
use App\Estado;

class ConsultasController extends Controller
{
    public function consulta($n,$c)
    {
    	$persona = Persona::with('parroquia')->where('nacionalidad',$n)->where('cedula_identidad',$c)->first();
    	if (empty($persona)) {
    		return 'vacio';
    	}
    	return $persona;
    }
    public function estados(){
    	return Estado::get();
    }
}
