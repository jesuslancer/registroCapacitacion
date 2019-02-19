@extends('template')
@section('content')
<script src="{{ asset('js/Controllers/registroCaptacionCtrl.js') }}"></script>         
    <div id="captacion" v-cloak>
        <div class="d-flex justify-content-center"> {{-- Inicio busqueda --}}
            <form class="form-inline " @submit.prevent="consulta" >
                <label for="">Cédula de Identidad:</label>
                <div class="form-group mx-0">
                    <select class="form-control" v-model="nac">
                        <option value="V">V</option>
                        <option value="E">E</option>
                    </select>
                </div>
                <div class="input-group mx-0" >
                    <input  maxlength="8" placeholder="Ej:12345678" id="Cedula" v-model="cedula"  name="Cedula" type="text" class="form-control solo-numerosCharlie" title="Rellene este campo">
                    <div class="input-group-btn">
                        <button  type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div><br>
            </form> 
        </div>
            <br>
        <div v-if="existeP" class="d-flex justify-content-center">
            <div class="row">
                <div class="col-12  form-group">
                    <label>Nombres y Apellidos:</label>
                    <input type="text"  class="form-control" v-model="nombrePersona" disabled>
                </div>
                <div class="col col-lg-push-2 form-group">
                    <label for="">Género:</label>
                    <input type="text" class="form-control" v-model="genero" disabled>
                </div>
                <div class="col col-lg-push-2 form-group">
                    <label for="">Fecha de Nacimiento:</label>
                    <input type="text" class="form-control" v-model="fechaNac" disabled>
                </div>
            </div>
        </div> {{-- Fin busqueda --}}
        <br>
        <div v-show="existeP" class="container-fluid">  {{-- Inicio Datos Adicionales --}}
            <div class="d-flex justify-content-center">
                <h2 class="titulo">
                    <small style="color:rgb(73, 129, 56);">Datos Adicioneles</small>
                </h2>
            </div>
            <br>
            <div class="d-flex  mb-3">  
                <div class="col-4">
                    <label>Celular</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Ej:04121234567" v-model="telf1" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    
                </div>
                <div class="col-4">
                    <label>Habitación</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" v-model="telf2" placeholder="Ej:02121234567" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                </div>
                <div class="col-4">
                    <label>Otro</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" v-model="telf3" aria-label="Username" placeholder="Ej:02121234567" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

