<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Persona;

class CrudController extends Controller
{
    public function guardarPersona(Request $request){
    	dd($request->all());
    }
}
	