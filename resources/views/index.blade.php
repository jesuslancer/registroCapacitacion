@extends('template')
@section('content')

<script src="{{ asset('js/Controllers/registroCaptacionCtrl.js') }}"></script>   



    <div id="captacion" v-cloak>
        <div v-show="vista1">
            <div class="d-md-flex justify-content-center" > {{-- Inicio busqueda --}}
                <form class="form-inline " @submit.prevent="consulta()" data-vv-scope="cedula">
                    <label for="">Cédula de Identidad:</label> <br>
                        
                    <div class="input-group mx-2" >
                        <div class="input-group-prepend">
                            <select class="form-control" v-model="nac">
                                <option value="V">V</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <input  v-validate.initial="'required|numeric|min:6|max:8'" maxlength="8" placeholder="Ej:12345678" id="Cedula" v-model="cedula"  data-vv-name="cédula" id="Cedula" type="text" class="form-control solo-numerosCharlie" title="Rellene este campo">
                        <div class="input-group-btn">
                            <button :disabled="errors.has('cedula.cédula')" type="submit" title="Buscar" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> 
            </div>
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
            <form data-vv-scope="form2">
            <div class="d-flex justify-content-center">
                <h2 class="titulo">
                    <small style="color:rgb(73, 129, 56);">Datos Adicionales</small>
                </h2>
            </div>
            <br>
            <div class="d-md-flex"> {{-- Teléfonos --}} 
                <div class="col">
                    <label>Celular(*)</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form2.celular')}">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-phone" id="basic-addon1"></span>
                        </div>
                        <input  data-vv-name="celular" v-validate.initial="{required:true,numeric:true,min:11,regex:/^(0412|0414|0416|0424|0426)[0-9]/i}" type="text" class="form-control solo-numerosCharlie" placeholder="Ej:04121234567" minlength="11" maxlength="11"  v-model="telf1" aria-label="Telefono1" aria-describedby="basic-addon1">
                    </div>
                        <span v-show="errors.has('form2.celular')" class="text-danger"> @{{ errors.first('form2.celular') }} </span>

                </div>
                <div class="col">
                    <label>Habitación</label>
                    <div class="input-group">
                        <div class="input-group-prepend" :class="{'has-feedback has-error':errors.has('form2.habitación')}">
                            <span class="input-group-text fa fa-phone" id="basic-addon2"></span>
                        </div>
                        <input  data-vv-name="habitación" v-validate="{required:false,numeric:true,min:11,regex:/^(0)[0-9]/i}" type="text" class="form-control solo-numerosCharlie" minlength="11" maxlength="11"  v-model="telf2" placeholder="Ej:02121234567" aria-label="Telefono2" aria-describedby="basic-addon2">
                </div>
                        <span v-show="errors.has('form2.habitación')" class="text-danger"> @{{ errors.first('form2.habitación') }} </span>

                </div>
                <div class="col">
                    <label>Otro Teléfono</label>
                    <div class="input-group">
                        <div class="input-group-prepend" :class="{'has-feedback has-error':errors.has('form2.otro telefóno')}">
                            <span class="input-group-text fa fa-phone" id="basic-addon3"></span>
                        </div>
                        <input data-vv-name="otro telefóno" v-validate="{required:false,numeric:true,min:11,regex:/^(0)[0-9]/i}" type="text" class="form-control solo-numerosCharlie" minlength="11" maxlength="11"  v-model="telf3" aria-label="Telefono3" placeholder="Ej:02121234567" aria-describedby="basic-addon3">
                    </div>
                    <span v-show="errors.has('form2.otro telefóno')" class="text-danger"> @{{ errors.first('form2.otro telefóno') }} </span>

                </div>
            </div>
            <div class="d-md-flex">{{-- Correos --}}
                <div class="col">
                    <label>Correo Principal(*)</label>
                    <div class="input-group">
                        <div class="input-group-prepend" :class="{'has-feedback has-error':errors.has('form2.correo principal')}">
                            <span class="input-group-text fa fa-mail-bulk" id="basic-addon4"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="user@gmail.com" data-vv-name="correo principal" v-model="correo1" aria-label="Correo1" aria-describedby="basic-addon4" v-validate.initial="{required:true, email:true,regex:/^[a-z0-9]+[a-z0-9.-_]/i}">
                    </div>
                    <span v-show="errors.has('form2.correo principal')" class="text-danger">@{{ errors.first('form2.correo principal') }}</span>

                </div>
                <div class="col">
                    <label>Correo Opcional</label>
                    <div class="input-group">
                        <div class="input-group-prepend" :class="{'has-feedback has-error':errors.has('form2.correo opcional')}">
                            <span class="input-group-text fa fa-mail-bulk" id="basic-addon5"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="user@gmail.com" v-model="correo2" data-vv-name="correo opcional" aria-label="Correo2" aria-describedby="basic-addon5" v-validate="{required:false,email:true,regex:/^[a-z0-9]+[a-z0-9.-_]/i}">
                    </div>
                    <span v-show="errors.has('form2.correo opcional')" class="text-danger">@{{ errors.first('form2.correo opcional') }}</span>

                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col">
                    <label>Nivel de Instrucción Académica(*)</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form2.nivel de instrucción académica')}">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-book" id="basic-addon6"></span>
                        </div>
                        <select name="nivel" class="form-control " aria-label="nivel" data-vv-name="nivel de instrucción académica" v-model="nivel" aria-describedby="basic-addon6" v-validate.initial="'required'">
                                <option  value="" disabled selected>Seleccione</option>
                                <option :value="x.id" v-for=" x in niveles"> @{{ x.descripcion }} </option>
                        </select>
                    </div>
                        <span v-show="errors.has('form2.nivel de instrucción académica')" class="text-danger"> @{{ errors.first('form2.nivel de instrucción académica') }} </span>
                </div>
                <div class="col">
                    <label>Estado Civil</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form2.estado civil')}">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-ring" id="basic-addon7"></span>
                        </div>
                        <select style= name="estadoCivil" class="form-control row-1 " v-validate.initial="'required'" data-vv-name="estado civil" v-model="estadoCivil" aria-describedby="basic-addon7">
                            <option value="" disabled selected>Seleccione</option>
                            <option value="1">SOLTERO(A)</option>
                            <option value="2">UNIDO(A)</option>
                            <option value="3">CASADO(A)</option>
                            <option value="4">VIUDO(A)</option>
                            <option value="5">DIVORCIADO(A)</option>
                            <option value="6">SEPARADO(A)</option>
                        </select>
                    </div>
                     <span v-show="errors.has('form2.estado civil')" class="text-danger"> @{{ errors.first('form2.estado civil') }} </span>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.estado')}">
                    <label> Estado</label>
                    <select @change="getMunicipios" name="estado" class="form-control" v-model="estado" data-vv-name="estado" v-validate.initial="'required'">
                        <option value="" disabled selected>Seleccione</option>
                        <option :value="x.id" v-for="x in estados">@{{ x.denominacion }}</option>
                    </select>
                <span v-show="errors.has('form2.estado')" class="text-danger">@{{ errors.first('form2.estado') }}</span>
                </div>
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.municipio')}">
                    <label> Municipio</label>
                    <select @change="getParroquias" name="municipio" class="form-control" data-vv-name="municipio" v-model="municipio" v-validate.initial="'required'">
                        <option  value="" disabled selected>Seleccione</option>
                        <option :value="x.id" v-for="x in municipios">@{{ x.denominacion }}</option>
                    </select>
                    <span v-show="errors.has('form2.municipio')" class="text-danger">@{{ errors.first('form2.municipio') }}</span>
                </div>
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.parroquia')}">
                    <label> Parroquia</label>
                    <select name="parroquia" class="form-control" v-model="parroquia" data-vv-name="parroquia" v-validate.initial="'required'">
                        <option value="" disabled selected>Seleccione</option>
                        <option :value="x.id" v-for="x in parroquias">@{{ x.denominacion }}</option>
                    </select> 
                    <span v-show="errors.has('form2.parroquia')" class="text-danger">@{{ errors.first('form2.parroquia') }}</span>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col":class="{'has-feedback has-error':errors.has('form2.urbanización/sector')}">
                    <label>Urbanización/Sector(*)</label>
                        <input  type="text" class="form-control" placeholder="Urb. Ejemplo" v-model="urbanizacion" v-validate.initial="'required|min:2'" data-vv-name="urbanización/sector">
                        <span v-show="errors.has('form2.urbanización/sector')" class="text-danger">@{{ errors.first('form2.urbanización/sector') }}</span>
                </div>
                <div class="col":class="{'has-feedback has-error':errors.has('form2.avenida/calle')}">
                    <label>Avenida/Calle(*)</label>
                        <input type="text" class="form-control" placeholder="Avenida. Ejemplo" v-model="avenida" aria-label="Correo1" v-validate.initial="'required|min:2'" data-vv-name="avenida/calle">
                        <span v-show="errors.has('form2.avenida/calle')" class="text-danger">@{{ errors.first('form2.avenida/calle') }}</span>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.edificio/casa/quinta')}">
                    <label>Edificio/Casa/Quinta(*)</label>
                        <input type="text" class="form-control" placeholder="Edif. Ejemplo" v-model="edificio" v-validate.initial="'required|min:2|max:250'"  data-vv-name="edificio/casa/quinta"> 
                        <span v-show="errors.has('form2.edificio/casa/quinta')" class="text-danger">@{{ errors.first('form2.edificio/casa/quinta') }}</span>
                </div>
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.piso')}">
                    <label>Piso</label>
                        <input type="text" class="form-control" placeholder="Piso. Ejemplo" v-model="piso" aria-label="Correo1" v-validate="'min:2|max:250'"  data-vv-name="piso"> 
                        <span v-show="errors.has('form2.piso')" class="text-danger">@{{ errors.first('form2.piso') }}</span>
                </div>
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.apto')}">
                    <label>Apto</label>
                        <input type="text" class="form-control" placeholder="Apto. Ejemplo" v-model="apto" aria-label="Correo1" v-validate="'min:2|max:250'"  data-vv-name="apto"> 
                        <span v-show="errors.has('form2.apto')" class="text-danger">@{{ errors.first('form2.apto') }}</span>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.comunidad')}">
                    <label>Nombre Comunidad(*)</label>
                    <input type="text" class="form-control" placeholder="Comunidad. Ejemplo" v-model="comunidad" v-validate.initial="'required|min:2'" data-vv-name="comunidad">
                    <span v-show="errors.has('form2.comunidad')" class="text-danger">@{{ errors.first('form2.comunidad') }}</span>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col"  :class="{'has-feedback has-error':errors.has('form2.punto de referencia')}">
                    <label>Punto de Referencia(*)</label>
                    <textarea rows="2" cols="1" class=" form-control" placeholder="Referencia. Ejemplo" v-model="referencia" aria-label="Correo1" data-vv-name="punto de referencia"  v-validate.initial="'required|min:2|max:250'"></textarea>  
                    <span v-show="errors.has('form2.punto de referencia')" class="text-danger">@{{ errors.first('form2.punto de referencia') }}</span>
                </div>
            </div> <br>
            <div class="d-flex justify-content-between">
                <div>
                    <button type="button" @click="clean" class="btn btn-dark "> <span class="fa fa-stop-circle"></span> Cancelar</button>
                </div>
                <div>
                    <button type="button" @click="next" class="btn btn-success" :disabled="errors.any('form2')">Siguiente <span class="fa fa-chevron-right"></span></button>
                </div>
            </div>
            </form> 
        </div> {{-- Fin Datos Adicionales --}}
        <div v-show="vista2" class="container-fluid">{{-- Inicio vista2 --}}
                <div class="d-flex justify-content-center">
                    <h2 class="titulo">
                        <small style="color:rgb(73, 129, 56);">Datos Formativos</small>
                    </h2>
                </div>
                <br> 
                <div class="d-flex justify-content-start">
                    <h3 class="titulo">
                        <small style="color:rgb(73, 129, 56);">Títulos Académicos</small> 
                        <span>
                            <button  type="button" title="Agregar título academico" data-toggle="modal" data-target="#modalTitulo" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </span>
                    </h3>
                </div>
                <br>
                <div class="d-md-flex"> {{-- Inicio Tabla titulos --}}
                    <div class="col">
                        <div class=" table table-hover" >
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nivel Educativo</th>
                                        <th>Título Obtenido</th>
                                        <th>Colegio, Instituto o Universidad</th>
                                        <th>Fecha Graduación</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tr class="text-center">
                                    <td>UNIVERSITARIO</td>
                                    <td>INGENIERO</td>
                                    <td>CUC</td>
                                    <td>25-08-1990</td>
                                    <td>
                                        <a class='btn btn-danger' @click="" title="Eliminar" >
                                            <span class="fa fa-eraser"></span>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> {{-- Fin titulos --}}
                <div class="row"> {{-- Inicio modal titulos --}}
                    <div id="modalTitulo" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title " id="exampleModalLabel">Título Académico Obtenido</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="form" data-vv-scope="form" @submit.prevent="guardarTitulo()" @keyup.enter="guardarTitulo()">
                                    <div class="row ">
                                        <span class="col">Colegio, Instituto o Universidad </span>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.tipo instituciones')}">
                                            <label for="TipoI">Tipo de Institucion(*)</label>
                                            <select class="form-control"  @change="getInstituciones(tipoI)" v-validate.initial="'required'" data-vv-name="tipo instituciones" v-model="tipoI" >
                                                <option disabled selected value="">Seleccione</option>
                                                <option value="1">COLEGIO UNIVERSITARIO</option>
                                                <option value="2">INSTITUTO UNIVERSITARIO</option>
                                                <option value="3">UNIVERSIDAD</option>
                                                <option value="4">UNIVERSIDAD EN EL EXTERIOR</option>
                                            </select>
                                            <span v-show="errors.has('form.tipo instituciones')" class="text-danger">@{{ errors.first('form.tipo instituciones') }}</span>
                                        </div>
                                        <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.instituciones educativas')}">
                                            <label for="Institucion">Instituciones Educativas(*)</label>
                                            <select :disabled="tipoI==''"  class="form-control" v-validate.initial="'required'" data-vv-name="instituciones educativas"  v-model="institucion">
                                                <option value="" disabled selected>Seleccione</option>
                                                <option :value="x" v-for="x in instituciones">@{{ x.denominacion_institucion }} </option>
                                            </select>
                                            <span v-show="errors.has('form.instituciones educativas')" class="text-danger">@{{ errors.first('form.instituciones educativas') }}</span>
                                        </div>
                                    </div>
                                    <div class="row ">
                                            <span class="col">Titulo Universitario </span>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.nivel educativo')}">
                                                <label for="nivel">Nivel Educativo(*)</label>
                                                <select class="form-control" @change="getCategorias(nivel)" data-vv-scope="form" data-vv-name="nivel educativo" v-validate.initial="'required'" v-model="nivel" >
                                                    <option disabled selected value="">Seleccione</option>
                                                    <option value="6">EDUCACIÓN TÉCNICA SUPERIOR</option>
                                                    <option value="7">EDUCACIÓN PROFESIONAL UNIVERSITARIA</option>
                                                </select>
                                                <span v-show="errors.has('form.nivel educativo')" class="text-danger">@{{ errors.first('form.nivel educativo') }}</span>
                                            </div>
                                            <div class="col" :class="{'has-feedback has-error':errors.has('form.categoria educación')}">
                                                <label for="Categoria">Categoria de educación(*)</label>
                                                <select :disabled="nivel==''" @change="getAreaConocimiento(categoria)" data-vv-scope="form"  class="form-control" data-vv-name="categoria educación" v-validate.initial="'required'" v-model="categoria">
                                                    <option value="" disabled selected>Seleccione</option>
                                                    <option :value="x.id" v-for="x in categorias">@{{ x.descripcion }} </option>
                                                </select>   
                                                <span v-show="errors.has('form.categoria educación')" class="text-danger">@{{ errors.first('form.categoria educación') }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.área de conocimiento')}">
                                                <label for="Area">Área de conocimiento(*)</label>
                                                <select :disabled="categoria==''" @change="getProgramaEstudio(area)" data-vv-scope="form" name="Area" id="Area" class="form-control" data-vv-name="área de conocimiento" v-validate.initial="'required'" v-model="area">
                                                    <option value="" disabled selected>Seleccione</option>
                                                    <option :value="x.id" v-for="x in areas">@{{ x.descripcion }} </option>
                                                </select>
                                                <span v-show="errors.has('form.área de conocimiento')" class="text-danger">@{{ errors.first('form.área de conocimiento') }}</span>
                                            </div>
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.programa estudio')}">
                                                <label for="Programa">Programa de estudio(*)</label>
                                                <select :disabled="area==''" @change="getTituloCarrera(programa)" data-vv-scope="form" name="Programa" id="Programa" class="form-control" data-vv-name="programa estudio" v-validate.initial="'required'" v-model="programa">
                                                    <option value="" disabled selected>Seleccione</option>
                                                    <option :value="x.id" v-for="x in programas">@{{ x.descripcion }} </option>
                                                </select>
                                                <span v-show="errors.has('form.programa estudio')" class="text-danger">@{{ errors.first('form.programa estudio') }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.titulo')}">
                                                <label for="Titulo">Titulos de la carrera(*)</label>
                                                <select :disabled="programa==''" name="Titulo" id="Titulo" data-vv-scope="form" class="form-control" data-vv-name="titulo" v-validate.initial="'required'" v-model="titulo">
                                                    <option value="" disabled selected>Seleccione</option>
                                                    <option :value="x" v-for="x in titulos">@{{ x.descripcion }} </option>
                                                </select>
                                                <span v-show="errors.has('form.titulo')" class="text-danger">@{{ errors.first('form.titulo') }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.fecha graduación')}">
                                                <label for="Fecha Graduacion">Fecha de culminación(*)</label>
                                                {{-- AQUI VA EL DATEPICKER --}}
                                                <span v-show="errors.has('form.fecha graduación')" class="text-danger"> @{{ errors.first('form.fecha graduación') }}</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" @click="limpiarTitulo()"  class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" :disabled="errors.any('form')" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div> {{-- Fin modal titulos --}}
        </div>{{-- Fin vista2 --}}
    </div>
<style>
[v-cloak]{ /*Permite que cargue las librerias antes que el html*/
    display: none;
}
</style>
@stop

