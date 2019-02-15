<?php

namespace App\Http\Controllers\Consultas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AreaConocimiento;
use App\Persona;

class ConsultasController extends Controller
{
    public function consulta($n,$c)
    {
    	$persona = Persona::with('parroquia')->where('nacionalidad',$n)->where('cedula_identidad',$c)->get();
    	dd($persona);
    }
}
