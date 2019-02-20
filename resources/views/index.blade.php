@extends('template')
@section('content')

<script src="{{ asset('js/Controllers/registroCaptacionCtrl.js') }}"></script>         
    <div id="captacion" v-cloak>
        <div class="d-md-flex justify-content-center"> {{-- Inicio busqueda --}}
            <form class="form-inline " @submit.prevent="consulta" >
                <label for="">Cédula de Identidad:</label> <br>
                    
                <div class="input-group mx-2" >
                    <div class="input-group-prepend">
                            <select class="form-control" v-model="nac">
                                <option value="V">V</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                    <input  maxlength="8" placeholder="Ej:12345678" id="Cedula" v-model="cedula"  name="Cedula" type="text" class="form-control solo-numerosCharlie" title="Rellene este campo">
                    <div class="input-group-btn">
                        <button  type="submit" title="Buscar" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div><br>
            </form> 
        </div>
            <br>
        <div v-if="existeP" class="d-md-flex justify-content-center">
            <div class="row">
                <div class="col-12  form-group">
                    <label>Nombres y Apellidos:</label>
                    <input type="text"  class="form-control" v-model="nombrePersona" disabled>
                </div>
                <div class="col form-group">
                    <label for="">Género:</label>
                    <input type="text" class="form-control" v-model="genero" disabled>
                </div>
                <div class="col form-group">
                    <label for="">Fecha de Nacimiento:</label>
                    <input type="text" class="form-control" v-model="fechaNac" disabled>
                </div>
            </div>
        </div> {{-- Fin busqueda --}}
        <br>
        <div v-show="existeP" class="container-fluid">  {{-- Inicio Datos Adicionales --}}
            <form>
            <div class="d-flex justify-content-center">
                <h2 class="titulo">
                    <small style="color:rgb(73, 129, 56);">Datos Adicioneles</small>
                </h2>
            </div>
            <br>
            <div class="d-md-flex  mb-3"> {{-- Teléfonos --}} 
                <div class="col">
                    <label>Celular(*)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-phone" id="basic-addon1"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Ej:04121234567" minlength="11" maxlength="11"  v-model="telf1" aria-label="Telefono1" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col">
                    <label>Habitación</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-phone" id="basic-addon2"></span>
                        </div>
                        <input type="text" class="form-control" minlength="11" maxlength="11"  v-model="telf2" placeholder="Ej:02121234567" aria-label="Telefono2" aria-describedby="basic-addon2">
                </div>
                </div>
                <div class="col">
                    <label>Otro</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-phone" id="basic-addon3"></span>
                        </div>
                        <input type="text" class="form-control" minlength="11" maxlength="11"  v-model="telf3" aria-label="Telefono3" placeholder="Ej:02121234567" aria-describedby="basic-addon3">
                    </div>
                </div>
            </div>
            <div class="d-md-flex">{{-- Correos --}}
                <div class="col">
                    <label>Correo Principal(*)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-mail-bulk" id="basic-addon4"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="user@gmail.com" v-model="correo1" aria-label="Correo1" aria-describedby="basic-addon4">
                    </div>
                </div>
                <div class="col">
                    <label>Correo Opcional</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-mail-bulk" id="basic-addon5"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="user@gmail.com" v-model="correo2" aria-label="Correo2" aria-describedby="basic-addon5">
                    </div>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col">
                    <label>Nivel de Instrucción Académica(*)</label>
                    <select name="nivel" class="form-control " >
                            <option  disabled selected>Seleccione</option>
                            <option > prueba </option>
                    </select>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col">
                    <label> Estado</label>
                    <select name="estado" class="form-control" >
                        <option value=""></option>
                        <option  disabled selected>Seleccione</option>
                            <option > prueba </option>
                    </select>
                </div>
                <div class="col">
                    <label> Municipio</label>
                    <select name="municipio" class="form-control" >
                        <option value=""></option>
                        <option  disabled selected>Seleccione</option>
                            <option > prueba </option>
                    </select>
                </div>
                <div class="col">
                    <label> Parroquia</label>
                    <select name="parroquia" class="form-control" >
                        <option value=""></option>
                        <option  disabled selected>Seleccione</option>
                            <option > prueba </option>
                    </select>
                </div>
            </div>
            </form> 
        </div>
    </div>
@stop

