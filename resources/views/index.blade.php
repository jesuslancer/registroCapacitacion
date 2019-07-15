@extends('template')
@section('content')
<script src="{{ asset('js/Controllers/registroCaptacionCtrl.js') }}"></script>   
    <div id="captacion" v-cloak>  
        <div v-show="vista1">
        <div class="d-md-flex justify-content-center">
            <p>Estimado(a) usuario(a), escriba la Cédula de Identidad y presione buscar. luego complete los datos y continue con el registro</p>      
        </div>  <br>
            <div class="d-md-flex justify-content-center" > {{-- Inicio busqueda --}}
                <form class="form-inline " @submit.prevent="consulta" @keyup.enter="consulta" data-vv-scope="cedula">
                    <label for="">Cédula de Identidad:</label> <br>
                    <div class="input-group mx-2" >
                        <div class="input-group-prepend">
                            <select class="form-control" v-model="nac">
                                <option value="V">V</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                        <div :class="{'has-feedback has-error':errors.has('cedula.cédula')}">
                            <input  v-validate.initial="'required|numeric|min:6|max:8'" data-vv-scope="cedula" maxlength="8" placeholder="Ej:12345678" id="Cedula" v-model="cedula"  data-vv-name="cédula" id="Cedula" type="text" class="form-control solo-numerosCharlie" title="Rellene este campo">
                            </div>
                        <div class="input-group-btn">
                            <button :disabled="errors.has('cedula.cédula')" type="submit" title="Buscar" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                            <img slot="spinner" class="spinner" v-show="cargando" src="img/cargando.gif">
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
                        <select  name="nivel" class="form-control " aria-label="nivel" data-vv-name="nivel de instrucción académica" v-model="nivel" aria-describedby="basic-addon6" v-validate.initial="'required'">
                                <option  value="" disabled selected>Seleccione</option>
                                <option :value="x.id" v-for=" x in niveles"> @{{ x.descripcion }} </option>
                        </select>
                    </div>
                        <span v-show="errors.has('form2.nivel de instrucción académica')" class="text-danger"> @{{ errors.first('form2.nivel de instrucción académica') }} </span>
                </div>
                <div class="col" >
                    <label>Estado Civil</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form2.estado civil')}">
                        <div class="input-group-prepend">
                            <span class="input-group-text fa fa-ring" id="basic-addon7"></span>
                        </div>
                        <select style= name="estadoCivil" :disabled="estadoCivil!=''"  class="form-control row-1 " v-validate.initial="'required'" data-vv-name="estado civil" v-model="estadoCivil" aria-describedby="basic-addon7">
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
                    <select @change="getMunicipios(estado)" name="estado" class="form-control" v-model="estado" data-vv-name="estado" v-validate.initial="'required'">
                        <option value="" disabled selected>Seleccione</option>
                        <option :value="x.id" v-for="x in estados">@{{ x.denominacion }}</option>
                    </select>
                <span v-show="errors.has('form2.estado')" class="text-danger">@{{ errors.first('form2.estado') }}</span>
                </div>
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.municipio')}">
                    <label> Municipio</label>
                    <select @change="getParroquias(municipio)" name="municipio" class="form-control" data-vv-name="municipio" v-model="municipio" v-validate.initial="'required'">
                        <option  value="" disabled selected>Seleccione</option>
                        <option :value="x.id" v-for="x in municipios">@{{ x.denominacion }}</option>
                    </select>
                    <span v-show="errors.has('form2.municipio')" class="text-danger">@{{ errors.first('form2.municipio') }}</span>
                </div>
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.parroquia')}">
                    <label> Parroquia</label>
                    <select  class="form-control" v-model="parroquia" data-vv-name="parroquia" v-validate.initial="'required'">
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
                <div class="col" :class="{'has-feedback has-error':errors.has('form2.Consejo Comunal')}">
                    <label>Nombre Consejo Comunal(*)</label>
                    <input type="text" class="form-control" placeholder="Comunidad. Ejemplo" v-model="comunidad" v-validate.initial="'required|min:2'" data-vv-name="Consejo Comunal">
                    <span v-show="errors.has('form2.Consejo Comunal')" class="text-danger">@{{ errors.first('form2.Consejo Comunal') }}</span>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col"  :class="{'has-feedback has-error':errors.has('form2.punto de referencia')}">
                    <label>Punto de Referencia(*)</label>
                    <textarea rows="2" cols="1" class=" form-control" placeholder="Referencia. Ejemplo" v-model="referencia" aria-label="Correo1" data-vv-name="punto de referencia"  v-validate.initial="'required|min:2|max:250'"></textarea>  
                    <span v-show="errors.has('form2.punto de referencia')" class="text-danger">@{{ errors.first('form2.punto de referencia') }}</span>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col-12">
                    <h5> ¿Poseé carnet de la patria?</h5><p>Si la respuesta es afirmativa, haga click en el cuadro y complete los datos.</p> 
                    <div class="form-check">
                        <input type="radio" class="btn btn-outline-primary" v-model="estatusCarnet" name="" value="1">  
                        <span class="text-success" >SI</span>                      
                        <input type="radio" class="btn btn-outline-danger" v-model="estatusCarnet" name="" value="2">  
                        <span class="text-danger" >NO</span> 
                    </div>
                </div>
            </div>
            <div class="d-md-flex" >
                    <div class="col" v-if="estatusCarnet==1" :class="{'has-feedback has-error':errors.has('form2.serial')}">
                        <label>Serial</label>
                        <input type="text" class="form-control solo-numerosCharlie" data-vv-name="serial" v-model="serial"  v-validate.initial="'required|numeric|min:7|max:7'" maxlength="7" placeholder="Ejemplo: 1234567">
                    <span v-show="errors.has('form2.serial')" class="text-danger">@{{ errors.first('form2.serial') }}</span>
                    </div>
                    <div class="col" v-if="estatusCarnet==1" :class="{'has-feedback has-error':errors.has('form2.código')}">
                        <label>Código</label>
                        <input type="text" class="form-control solo-numerosCharlie" data-vv-name="código" v-model="codigo" v-validate.initial="'required|numeric|min:7|max:7'" maxlength="7" placeholder="Ejemplo: 1234567">
                    <span v-show="errors.has('form2.código')" class="text-danger">@{{ errors.first('form2.código') }}</span>
                    </div>
            </div> <br>
            <div class="d-flex justify-content-between">
                <div>
                    <button type="button" @click="clean" class="btn btn-danger"> <span class="fa fa-stop-circle"></span> Cancelar</button>
                </div>
                <div>
                    <button type="button" @click="next" class="btn btn-primary"  :disabled="errors.any('form2')">Siguiente <span class="fa fa-chevron-right"></span></button>
                </div>
            </div>
            <br>
            </form> 
        </div> {{-- Fin Datos Adicionales --}}
        <div v-show="vista2" class="container-fluid">{{-- Inicio vista2 --}}
            <div class="d-md-flex justify-content-center">
                <p>Estimado(a) usuario(a), complete los datos formativos, de no poseer ninguno, puede continuar.</p>      
            </div>  
                <div class="d-flex justify-content-center">
                    <h2 class="titulo">
                        <small style="color:rgb(73, 129, 56);">Datos Formativos</small>
                    </h2>
                </div> <br>
                <div class="d-md-flex">
                    <div class="col-12" >
                        <h5> ¿Poseé experiencia agrícola?</h5> <p>Si poseé experiencia agrícola, especifique en los siguientes recuadros: </p>
                        <div class="form-check">
                            <input type="checkbox" class="btn btn-outline-primary" v-model="estatusAnimal" name="">  
                            <span class="text-success" v-show="estatusAnimal">Experiencia Agrícola Animal</span>                      
                            <span class="text-danger" v-show="!estatusAnimal">Experiencia Agrícola Animal</span> 
                            <br>
                            <select v-show="estatusAnimal" name="animales" class="form-control" aria-label="animales" data-vv-name="experiencia agricola animal" v-model="animal" aria-describedby="basic-addon6" >
                                <option  value="" disabled selected>Seleccione Animal</option>
                                <option v-if="x.tipo=='ANIMAL'" :value="x" v-for=" x in experienciaAgricola" > @{{ x.denominacion }} </option>
                            </select>  
                            <div v-show="estatusAnimal">
                                <button type="button" :disabled="!animal" class="btn btn-success" @click="guardarExperiencia(animal)">Selección <span class="fa fa-chevron-down"></span></button>
                            </div>   
                            <input type="checkbox" class="btn btn-outline-primary" v-model="estatusVegetal" name="">  
                            <span class="text-success" v-show="estatusVegetal">Experiencia Agrícola Vegetal</span>                      
                            <span class="text-danger" v-show="!estatusVegetal">Experiencia Agrícola Vegetal</span> 
                            <br>
                            <select v-show="estatusVegetal" name="vegetales" class="form-control " aria-label="vegetales" data-vv-name="experiencia agricola vegetal" v-model="vegetal" aria-describedby="basic-addon6" >
                                <option  value="" disabled selected>Seleccione Vegetal</option>
                                <option v-if="x.tipo=='VEGETAL'" :value="x" v-for=" x in experienciaAgricola"> @{{ x.denominacion }} </option>
                            </select>
                            <div v-show="estatusVegetal">
                                <button type="button" :disabled="!vegetal" class="btn btn-success" @click="guardarExperiencia(vegetal)">Selección <span class="fa fa-chevron-down"></span></button>
                            </div>
                        </div>
                        <p v-show="experienciasRegistradas.length > 0">Lista Experiencias Agricolas:</p>
                            <div class="d-md-flex" > {{-- Inicio Tabla Experiencias --}}
                                <div class="col ">
                                    <div class="table table-hover card" v-show="experienciasRegistradas.length > 0" >
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Tipo</th>
                                                    <th>Denominación</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tr class="text-center" v-for="(r, index) in array4">
                                                <td>@{{ r.tipo }}</td>
                                                <td>@{{ r.denominacion.toUpperCase() }}</td>
                                                <td>
                                                    <a class='btn btn-danger' @click="eliminarExperiencia(index)" title="Eliminar" >
                                                        <span class="fa fa-eraser"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div><br>
                            </div> {{-- Fin Experiencias --}}
                                <div v-show="experienciasRegistradas.length > 5" is="uib-pagination" :boundary-links="true" :boundary-link-numbers="true" :max-size="paginacionExperienciasRegistradas.maxSize" :force-ellipses="true" :total-items="paginacionExperienciasRegistradas.totalItems" :items-per-page="paginacionExperienciasRegistradas.itemsPerPage" v-model="paginacionExperienciasRegistradas.paginate" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></div>
                                <div v-show="experienciasRegistradas.length > 5" class="form-inline"><pre>Paginas: @{{ paginacionExperienciasRegistradas.paginate.currentPage }} / @{{ experienciasRegistradas.length / paginacionExperienciasRegistradas.paginate.currentPage }}, total de elementos: @{{ experienciasRegistradas.length }} </pre> </div>
                            <div class="col-md-4">
                                <label>¿Produce Semillas? Especifique:</label>
                                <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.semilla')}">
                                    <input  data-vv-name="semilla" type="text" class="form-control" v-validate="'min:5|max:150'" placeholder="Ej: semilla" minlength="2" maxlength="150"  v-model="semilla" >
                                    <div class="input-group-prepend">
                                        <button  type="button" :disabled="semillas.length >=2  || semilla=='' || errors.has('form3.semilla')" title="Agregar" @click="guardarItem(semilla,50)" class="btn btn-success">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <span v-show="errors.has('form3.semilla')" class="text-danger">@{{ errors.first('form3.semilla') }}</span>
                            </div><br>
                             <div class="col-md-4" >
                                <div v-show="semillas.length > 0">
                                    <li class="list-group-item active">Lista Semillas</li>
                                    <ul class="list-group" v-for="(r, index) in semillas">
                                      <li class="list-group-item">@{{ r.denominacion }}
                                        <button type="button" class="close" @click="eliminarItem(index,50)">
                                              <span aria-hidden="true">&times;</span>
                                        </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <h5> ¿Cuenta con Herramientas?</h5> <p>Si poseé herramientas, especifique en los siguientes recuadros: </p>
                            <input type="checkbox" class="btn btn-outline-primary" v-model="estatusHer" name="">  
                            <span class="text-success" v-show="estatusHer">Cuento con herramientas</span>                      
                            <span class="text-danger" v-show="!estatusHer">Cuento con herramientas</span> 
                            <br>
                            <div class="col-md-4">
                                <select v-show="estatusHer" class="form-control"  data-vv-scope="formH" data-vv-name="herramientas" v-validate.initial="'required'" v-model="herramienta" >
                                    <option disabled selected value="">Seleccione</option>
                                    <option value="MACHETE">MACHETE</option>
                                    <option value="PICO">PICO</option>
                                    <option value="PALA">PALA</option>
                                    <option value="CHÍCORA">CHÍCORA</option>
                                    <option value="ESCARDILLA">ESCARDILLA</option>
                                    <option value="CARRETILLA">CARRETILLA</option>
                                    <option value="BOMBA">BOMBA</option>
                                    <option value="TIJERA">TIJERA</option>
                                    <option value="MAQUINARIAS">MAQUINARIAS</option>
                                </select>                                
                                <div v-show="estatusHer">
                                    <button type="button" :disabled="!herramienta" class="btn btn-success" @click="guardarHerramienta(herramienta)">Selección <span class="fa fa-chevron-down"></span></button>
                                </div>
                            </div><br>
                            <div class="col-md-4" >
                                <div v-show="herramientas.length > 0">
                                    <li class="list-group-item active">Lista herramientas</li>
                                    <ul class="list-group" v-for="(r, index) in herramientas">
                                      <li class="list-group-item">@{{ r.denominacion }}
                                        <button type="button" class="close" @click="eliminarHerramienta(index,50)">
                                              <span aria-hidden="true">&times;</span>
                                        </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
                <br>  

                <div class="d-md-flex">
                    <div class="col-12" v-show="titulosRegistrados.length < 1">
                        <h5> ¿Poseé titulos académicos?</h5> <p>Si la respuesta es afirmativa haga click en el cuadro, luego pulse el botón agregar: "<i class=" fa fa-plus"></i>".</p>
                        <div class="form-check">
                            <input type="radio" class="btn btn-outline-primary" v-model="estatusTitulo" name="" value="1">  
                            <span class="text-success" >SI</span>                      
                            <input type="radio" class="btn btn-outline-danger" v-model="estatusTitulo" name="" value="2">  
                            <span class="text-danger" >NO</span>                      
                        </div>
                    </div>
                </div>
                <br> 
                <div class="d-flex justify-content-start">
                    <h3 class="titulo" v-show="estatusTitulo==1">
                        <small style="color:rgb(73, 129, 56);">Títulos Académicos</small> 
                        <span>
                            <button dis type="button" title="Agregar título academico" v-show="titulosRegistrados.length < 5" data-toggle="modal" data-target="#modalTitulo" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </span>
                    </h3>
                </div>
                <br>
                <p v-show="titulosRegistrados.length > 0">Lista titulos Registrados:</p>
                <div class="d-md-flex" > {{-- Inicio Tabla titulos --}}
                    <div class="col ">
                        <div class="table table-hover card" v-show="titulosRegistrados.length > 0" >
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nivel Educativo</th>
                                        <th>Título Obtenido</th>
                                        <th>Fecha Graduación</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tr class="text-center" v-for="(r, index) in array">
                                    <td>@{{ r.nivelDescripcion.toUpperCase() }}</td>
                                    <td>@{{ r.titulo.toUpperCase() }}</td>
                                    <td>@{{ r.fecha }}</td>
                                    <td>
                                        <a class='btn btn-danger' @click="eliminarTitulo(index)" title="Eliminar" >
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
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.nivel educativo')}">
                                                <label for="nivel">Nivel educativo(*)</label>
                                                <select class="form-control" @change="getCategorias(nivelModal)" data-vv-scope="form" data-vv-name="nivel educativo" v-validate.initial="'required'" v-model="nivelModal" >
                                                    <option disabled selected value="">Seleccione</option>
                                                    <option value="4">DESARROLLO PERSONAL Y LABORAL NO PROFESIONAL</option>
                                                    <option value="5">EDUCACIÓN MEDIA</option>
                                                    <option value="6">EDUCACIÓN TÉCNICA SUPERIOR</option>
                                                    <option value="7">EDUCACIÓN PROFESIONAL UNIVERSITARIA</option>
                                                </select>
                                                <span v-show="errors.has('form.nivel educativo')" class="text-danger">@{{ errors.first('form.nivel educativo') }}</span>
                                            </div>
                                            <div class="col" :class="{'has-feedback has-error':errors.has('form.categoría educación')}">
                                                <label for="Categoria">Categoría de educación(*)</label>
                                                <select :disabled="nivelModal==''" @change="getAreaConocimiento(categoria)" data-vv-scope="form"  class="form-control" data-vv-name="categoría educación" v-validate.initial="'required'" v-model="categoria">
                                                    <option value="" disabled selected>Seleccione</option>
                                                    <option :value="x.id" v-for="x in categorias">@{{ x.descripcion }} </option>
                                                </select>   
                                                <span v-show="errors.has('form.categoría educación')" class="text-danger">@{{ errors.first('form.categoría educación') }}</span>
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
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.título')}">
                                                <label for="Titulo">Título de la carrera(*)</label>
                                                <select :disabled="programa==''" data-vv-scope="form" class="form-control" data-vv-name="título" v-validate.initial="'required'" v-model="titulo">
                                                    <option value="" disabled selected>Seleccione</option>
                                                    <option :value="x" v-for="x in titulos">@{{ x.descripcion }} </option>
                                                </select>
                                                <span v-show="errors.has('form.título')" class="text-danger">@{{ errors.first('form.título') }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('form.fecha graduación')}">
                                                <label for="Fecha Graduacion">Fecha de culminación(*)</label>
                                                <custom-datepicker  v-model="fechaTitulo"></custom-datepicker>
                                                <span v-show="errors.has('form.fecha graduación')" class="text-danger"> @{{ errors.first('form.fecha graduación') }}</span>
                                            </div>
                                        </div>
                                        @{{ errors.any('form') }}
                                        <div class="modal-footer">
                                            <button type="button" @click="limpiarTitulo()"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" :disabled="errors.any('form')"  class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- Fin modal titulos --}}

                <div class="d-md-flex">
                    <div class="col-12" v-show="ocupacionesPer.length < 1">
                        <h5> ¿Poseé ocupación laboral?</h5> <p>Si la respuesta es afirmativa haga click en el cuadro, busque y pulse el botón <span class="text-success">Selección</span>: "<i class=" fa fa-chevron-down"></i>".</p>
                        <div class="form-check">
                              
                            <input type="radio" class="btn btn-outline-primary" v-model="estatusOcupacion" name="" value="1">  
                            <span class="text-success" >SI</span>                      
                            <input type="radio" class="btn btn-outline-danger" v-model="estatusOcupacion" name="" value="2">  
                            <span class="text-danger" >NO</span>                 
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-start">
                    <h3 class="titulo" v-show="estatusOcupacion==1">
                        <small style="color:rgb(73, 129, 56);">Ocupaciónes Laborales</small> 
                    </h3>
                </div>
                <br>
                <form class="form-group" v-show="ocupacionesPer.length <5">
                    <div class="row">
                        <div class=" col-12" v-show="estatusOcupacion==1">
                            <v-select placeholder="Escriba y seleccione..." v-model="ocupacion" label="denominacion"  :options="ocupaciones" >
                                <span slot="no-options">
                                  ¡Disculpe! No se consigue su búsqueda.
                                </span>
                            </v-select>
                        </div>
                    </div>
                        <div v-show="estatusOcupacion==1">
                            <button type="button" :disabled="!ocupacion" class="btn btn-success" @click="guardarOcupacion(ocupacion)">Selección <span class="fa fa-chevron-down"></span></button>
                        </div>
                    <br>
                </form>
                <p v-show="ocupacionesPer.length > 0">Lista Ocupaciones Laborales:</p>
                <div class="d-md-flex" > {{-- Inicio Tabla Ocupaciones Laborales --}}
                    <div class="col ">
                        <div class="table table-hover card" v-show="ocupacionesPer.length > 0" >
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Código</th>
                                        <th>Denominación</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tr class="text-center" v-for="(r, index) in array2">
                                    <td>@{{ r.codigo }}</td>
                                    <td>@{{ r.denominacion.toUpperCase() }}</td>
                                    <td>
                                        <a class='btn btn-danger' @click="eliminarOcupacion(index)" title="Eliminar" >
                                            <span class="fa fa-eraser"></span>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> {{-- Fin Ocupaciones Laborales --}}
                <div class="d-md-flex">
                    <div class="col-12" class="lg-">
                        <h5> ¿Poseé vinculación con algun espacio productivo actualmente?</h5> <p>Si la respuesta es afirmativa haga click en el cuadro, luego pulse el botón agregar: "<i class=" fa fa-plus"></i>":</p>
                        <div class="form-check">
                            <input type="radio" class="btn btn-outline-primary" v-model="estatusEspacio" name="" value="1">  
                            <span class="text-success">SI</span>                      
                            <input type="radio" class="btn btn-outline-danger" v-model="estatusEspacio" name="" value="2">  
                            <span class="text-danger">NO</span>                     
                        </div>
                    </div>
                </div> <br>
                <div class="d-flex justify-content-start">
                    <h3 class="titulo" v-show="estatusEspacio==1">
                        <small style="color:rgb(73, 129, 56);">Espacios Productivos</small> 
                        <span>
                            <button  type="button" @click="banderaEspacio=true" title="Agregar Espacio Productivo" v-show="espacioProductivo.length < 5" data-toggle="modal" data-target="#modalEspacio" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </span>
                    </h3>
                </div> <br>
                <p v-show="espacioProductivo.length > 0">Lista Espacios Productivos:</p>
                <div class="d-md-flex" > {{-- Inicio Tabla titulos --}}
                    <div class="col ">
                        <div class="table table-hover card" v-show="espacioProductivo.length > 0" >
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nombre Consejo Comunal</th>
                                        <th>Metros Totales</th>
                                        <th >Metros Sembrados</th>
                                        <th>Metros Por Sembrar</th>
                                        <th>Modalidad de Siembra</th>
                                        <th>Personas Productoras</th>
                                        <th>Agua Directa</th>
                                        <th>Agua de Manantial</th>
                                        <th>Estado</th>
                                        <th>Municipio</th>
                                        <th>Parroquia</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tr class="text-center" v-for="(r, index) in array3">
                                    <td>@{{ r.comunidad }}</td>
                                    <td>@{{ r.totales }}</td>
                                    <td>@{{ r.sembrados }}</td>
                                    <td>@{{ r.porSembrar }}</td>
                                    <td>@{{ r.modalidad }}</td>
                                    <td>@{{ r.personasProd }}</td>
                                    <td>@{{ r.agua_directa ? 'SI' : 'NO' }}</td>
                                    <td>@{{ r.agua_manantial ? 'SI' : 'NO' }}</td>
                                    <td>@{{ r.estadoE.toUpperCase()}}</td>
                                    <td>@{{ r.municipioE.toUpperCase() }}</td>
                                    <td>@{{ r.parroquiaE.toUpperCase() }}</td>
                                    <td>
                                        <a class='btn btn-danger' @click="eliminarEspacio(index)" title="Eliminar" >
                                            <span class="fa fa-eraser"></span>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> {{-- Fin titulos --}}

                <div class="row"> {{-- Inicio modal titulos --}}
                    <div id="modalEspacio" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title " id="exampleModalLabel">Espacio Productivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="formE" data-vv-scope="formE" @submit.prevent="guardarEspacio()" @keyup.enter="guardarEspacio()">
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('formE.consejo comunal')}">
                                                <label for="nombre comunidad">Nombre Consejo Comunal(*)</label>
                                                <input  data-vv-name="consejo comunal" v-validate.initial="'required|min:2'" type="text" class="form-control" placeholder="Ej: Consejo Comunal" minlength="2" maxlength="150"  v-model="comunidadE" aria-describedby="basic-addon1">
                                                <span v-show="errors.has('formE.consejo comunal')" class="text-danger">@{{ errors.first('formE.consejo comunal') }}</span>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('formE.hectarias')}">
                                                <label for="hectarias">Metros Totales(*)</label>
                                                <select  name="totales" class="form-control " aria-label="totales" data-vv-name="metros totales" v-model="totales" aria-describedby="basic-addon6" v-validate.initial="'required'">
                                                        <option  value="" disabled selected>Seleccione</option>
                                                        <option :value="x.mt2" v-for="x in hectarias"> @{{ x.mt2 }} </option>
                                                </select>
                                                <span v-show="errors.has('formE.metros totales')" class="text-danger">@{{ errors.first('formE.metros totales') }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('formE.sembrados')}">
                                                <label for="sembrados">Metros Sembrados(*)</label>
                                                <select  name="metros sembrados" class="form-control " aria-label="metros sembrados" data-vv-name="metros sembrados" v-model="sembrados" aria-describedby="basic-addon6" v-validate.initial="'required'">
                                                        <option  value="" disabled selected>Seleccione</option>
                                                        <option :value="x.mt2" v-for="x in hectarias"> @{{ x.mt2 }} </option>
                                                </select>
                                                <span v-show="errors.has('formE.metros sembrados')" class="text-danger">@{{ errors.first('formE.metros sembrados') }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('formE.porSembrar')}">
                                                <label for="porSembrar">Metros Por Sembrar(*)</label>
                                                <select  name="porSembrar" class="form-control " aria-label="porSembrar" data-vv-name="porSembrar" v-model="porSembrar" aria-describedby="basic-addon6" v-validate.initial="'required'">
                                                        <option  value="" disabled selected>Seleccione</option>
                                                        <option :value="x.mt2" v-for="x in hectarias"> @{{ x.mt2 }} </option>
                                                </select>
                                                <span v-show="errors.has('formE.metros sembrados')" class="text-danger">@{{ errors.first('formE.metros sembrados') }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('formE.modalidad de siembra')}">
                                                <label for="modalidad de siembra">Modalidad de Siembra(*)</label>
                                                <select  name="modalidad de siembra" class="form-control " aria-label="modalidad de siembra" data-vv-name="modalidad de siembra" v-model="modalidad" aria-describedby="basic-addon6" v-validate.initial="'required'">
                                                        <option  value="" disabled selected>Seleccione</option>
                                                        <option  value="CONUCO" >Conuco</option>
                                                        <option  value="HUERTO ORGANOPONICO" >Huerto Organoponico</option>
                                                        <option  value="PATIO" >Patio</option>
                                                        <option  value="FUNDO" >Fundo</option>
                                                        <option  value="HUERTOS INTENSIVOS" >Huertos Intensivos</option>
                                                </select>
                                                <span v-show="errors.has('formE.modalidad de siembra')" class="text-danger">@{{ errors.first('formE.modalidad de siembra') }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group" :class="{'has-feedback has-error':errors.has('formE.personas productoras')}">
                                                <label for="personas productoras">Personas Productoras(*)</label>
                                                <select  name="personas productoras" class="form-control " aria-label="personas productoras" data-vv-name="personas productoras" v-model="personasProd" aria-describedby="basic-addon6" v-validate.initial="'required'">
                                                        <option  value="" disabled selected>Seleccione</option>                                                    
                                                        <option  value="UNIDAD FAMILIAR" >Unidad Familiar</option>
                                                        <option  value="UNIDAD DE PRODUCCIÓN SOCIAL" >Unidad de Producción Social</option>
                                                        <option  value="GRUPO DE 4 PERSONAS" >Grupo de 4 Personas</option>
                                                        <option  value="GRUPO DE 5 A 10 PERSONAS" >Grupo de 5 a 10 Persona</option>
                                                </select>
                                                <span v-show="errors.has('formE.modalidad de siembra')" class="text-danger">@{{ errors.first('formE.modalidad de siembra') }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group" >
                                                <label for="hectarias">¿Hay agua directa?(*)</label>
                                                <br> 
                                                <input type="checkbox" class="btn btn-outline-primary" v-model="agua_directa" name=""> 
                                                <span class="text-success" v-show="agua_directa">Agua Directa</span>                      
                                                <span class="text-danger" v-show="!agua_directa">Agua Directa</span> 
                                            </div>
                                            <div class="col form-group" >
                                                <label for="hectarias">¿Hay agua de manantial?(*)</label>
                                                <br> 
                                                <input type="checkbox" class="btn btn-outline-primary" v-model="agua_manantial" name=""> 
                                                <span class="text-success" v-show="agua_manantial">Agua de Manantial</span>                      
                                                <span class="text-danger" v-show="!agua_manantial">Agua de Manantial</span> 
                                            </div>
                                        </div>
                                         <div class="d-md-flex">
                                            <div class="col" :class="{'has-feedback has-error':errors.has('formE.estado')}">
                                                <label> Estado</label>
                                                <select @change="getMunicipios(estadoE.id)" name="estado" class="form-control" v-model="estadoE" data-vv-name="estado" v-validate.initial="'required'">
                                                    <option value="" disabled selected>Seleccione</option>
                                                    <option :value="x" v-for="x in estados">@{{ x.denominacion }}</option>
                                                </select>
                                            <span v-show="errors.has('formE.estado')" class="text-danger">@{{ errors.first('formE.estado') }}</span>
                                            </div>
                                            <div class="col" :class="{'has-feedback has-error':errors.has('formE.municipio')}">
                                                <label> Municipio</label>
                                                <select @change="getParroquias(municipioE.id)" name="municipio" class="form-control" data-vv-name="municipio" v-model="municipioE" v-validate.initial="'required'">
                                                    <option  value="" disabled selected>Seleccione</option>
                                                    <option :value="x" v-for="x in municipiosE">@{{ x.denominacion }}</option>
                                                </select>
                                                <span v-show="errors.has('formE.municipio')" class="text-danger">@{{ errors.first('formE.municipio') }}</span>
                                            </div>
                                            <div class="col" :class="{'has-feedback has-error':errors.has('formE.parroquia')}">
                                                <label> Parroquia</label>
                                                <select name="parroquia" class="form-control" v-model="parroquiaE" data-vv-name="parroquia" v-validate.initial="'required'">
                                                    <option value="" disabled selected>Seleccione</option>
                                                    <option :value="x" v-for="x in parroquiasE">@{{ x.denominacion }}</option>
                                                </select> 
                                                <span v-show="errors.has('formE.parroquia')" class="text-danger">@{{ errors.first('formE.parroquia') }}</span>
                                            </div>
                                        </div> <br>
                                        <div class="modal-footer">
                                            <button type="button" @click="limpiarTitulo()"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" :disabled="errors.any('formE')"  class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- Fin modal titulos --}}
                <div class="d-flex justify-content-between"> {{-- botones siguientes --}}
                    <div>
                        <button type="button" @click="atras" class="btn btn-dark "> <span class="fa fa-chevron-left"></span> Atras</button>
                    </div>
                    <div>
                        <button type="button" @click="next2" class="btn btn-primary" :disabled="experienciasRegistradas.length == 0 && semillas.length == 0 && titulosRegistrados.length == 0 && ocupacionesPer.length == 0 && espacioProductivo.length == 0 && herramientas.length == 0">Siguiente <span class="fa fa-chevron-right"></span></button>
                    </div>
                </div> {{-- fin botones --}}
                    <br>
        </div>{{-- Fin vista2 --}}
        <div v-show="vista3"> {{-- Inicio vista3 --}}
            <div class="d-md-flex justify-content-center">
                <p>Estimado(a) usuario(a), si pertenece a organizaciones sociales, escriba en el área correspondiente y pulse el botón "<i class="fa fa-plus"></i>"; Podra agregar un maximo de 5 por cada organizacion social.</p>  
            </div> <br>

           <div class="container-fluid">  {{-- Inicio Datos Adicionales --}}
                <form data-vv-scope="form3">
                    <div class="d-flex justify-content-center">
                        <h2 class="titulo">
                            <small style="color:rgb(73, 129, 56);">Organizaciones Sociales</small>
                        </h2>
                    </div>
                </form>
            </div> <br>
            <form data-vv-scope="form3">
            <div class="d-md-flex"> {{-- Teléfonos --}} 
                <div class="col-md-4">
                    <label>Base Misiones</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.base misiones')}">
                        <input  data-vv-name="base misiones" type="text" class="form-control" v-validate="'min:5|max:150'" placeholder="Ej: Base Misiones" minlength="2" maxlength="150"  v-model="base" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="basess.length >=2  || base=='' || errors.has('form3.base misiones')" title="Agregar" @click="guardarItem(base,1)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <span v-show="errors.has('form3.base misiones')" class="text-danger">@{{ errors.first('form3.base misiones') }}</span>
                </div>
                <div class="col-md-4">
                    <label>Ciudades Priorizadas</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.ciudades priorizadas')}">
                        <input  data-vv-name="ciudades priorizadas" type="text"  v-validate="'min:5|max:150'" class="form-control" placeholder="Ej: Ciudades priorizadas" minlength="2" maxlength="150"  v-model="ciudades" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="ciudadess.length >=2  || ciudades=='' || errors.has('form3.ciudades priorizadas')" title="Agregar" @click="guardarItem(ciudades,2)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                        <span v-show="errors.has('form3.ciudades priorizadas')" class="text-danger"> @{{ errors.first('form3.ciudades priorizadas') }} </span>
                </div>
                <div class="col-md-4">
                    <label>Clap</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.clap')}">
                        <input  data-vv-name="clap" type="text"v-validate="'min:5|max:150'"  class="form-control" placeholder="Ej: Clap" minlength="2" maxlength="150"  v-model="clap">
                        <div class="input-group-prepend" >
                            <button  type="button" :disabled="claps.length >=2  || clap=='' || errors.has('form3.clap')" title="Agregar"  @click="guardarItem(clap,3)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                        <span v-show="errors.has('form3.clap')" class="text-danger"> @{{ errors.first('form3.clap') }} </span>
                </div>
            </div>  <br>
            <div class="d-md-flex">
                <div class="col-md-4" >
                    <div v-show="basess.length > 0">
                        <li class="list-group-item active">Lista Base de Misiones</li>
                        <ul class="list-group" v-for="(r, index) in basess">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,1)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-show="ciudadess.length > 0">
                        <li class="list-group-item active">Lista Ciudades Priorizadas</li>
                        <ul class="list-group" v-for="(r, index) in ciudadess">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,2)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-show="claps.length > 0">
                        <li class="list-group-item active">Lista Claps</li>
                        <ul class="list-group" v-for="(r, index) in claps">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,3)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-md-flex">
               <div class="col-md-4">
                    <label>Comunas</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.comunas')}">
                        <input  data-vv-name="comunas" type="text" class="form-control" v-validate="'min:5|max:150'" placeholder="Ej: Comunas" minlength="2" maxlength="150"  v-model="comunas" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="comunass.length >=2  || comunas=='' || errors.has('form3.comunas')" title="Agregar" @click="guardarItem(comunas,4)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <span v-show="errors.has('form3.comunas')" class="text-danger">@{{ errors.first('form3.comunas') }}</span>
                </div>
                <div class="col-md-4">
                    <label>Conuqueros</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.conuqueros')}">
                        <input  data-vv-name="conuqueros" type="text"  v-validate="'min:5|max:150'" class="form-control" placeholder="Ej: Conuqueros" minlength="2" maxlength="150"  v-model="conuqueros" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="conuqueross.length >=2  || conuqueros=='' || errors.has('form3.conuqueros')" title="Agregar" @click="guardarItem(conuqueros,5)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                        <span v-show="errors.has('form3.conuqueros')" class="text-danger"> @{{ errors.first('form3.conuqueros') }} </span>
                </div>
                <div class="col-md-4">
                    <label>Corredores</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.corredores')}">
                        <input  data-vv-name="corredores" type="text"v-validate="'min:5|max:150'"  class="form-control" placeholder="Ej: Corredores" minlength="2" maxlength="150"  v-model="corredores">
                        <div class="input-group-prepend" >
                            <button  type="button" :disabled="corredoress.length >=2  || corredores=='' || errors.has('form3.corredores')" title="Agregar"  @click="guardarItem(corredores,6)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                        <span v-show="errors.has('form3.corredores')" class="text-danger"> @{{ errors.first('form3.corredores') }} </span>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col-md-4" >
                    <div v-show="comunass.length > 0">
                        <li class="list-group-item active">Lista Comunas</li>
                        <ul class="list-group" v-for="(r, index) in comunass">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,4)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-show="conuqueross.length > 0">
                        <li class="list-group-item active">Lista Conuqueros</li>
                        <ul class="list-group" v-for="(r, index) in conuqueross">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,5)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-show="corredoress.length > 0">
                        <li class="list-group-item active">Lista Corredores</li>
                        <ul class="list-group" v-for="(r, index) in corredoress">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,6)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-md-flex">
               <div class="col-md-4">
                    <label>Fundos/Zamoranos</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.fundos')}">
                        <input  data-vv-name="fundos" type="text" class="form-control" v-validate="'min:5|max:150'" placeholder="Ej: Fundos/Zamoranos" minlength="2" maxlength="150"  v-model="fundos" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="fundoss.length >=2  || fundos=='' || errors.has('form3.fundos')" title="Agregar" @click="guardarItem(fundos,7)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <span v-show="errors.has('form3.fundos')" class="text-danger">@{{ errors.first('form3.fundos') }}</span>
                </div>
                <div class="col-md-4">
                    <label>Instituciones</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.instituciones')}">
                        <input  data-vv-name="instituciones" type="text"  v-validate="'min:5|max:150'" class="form-control" placeholder="Ej: Instituciones" minlength="2" maxlength="150"  v-model="institucion" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="instituciones.length >=2  || institucion=='' || errors.has('form3.instituciones')" title="Agregar" @click="guardarItem(institucion,8)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                        <span v-show="errors.has('form3.instituciones')" class="text-danger"> @{{ errors.first('form3.instituciones') }} </span>
                </div>
                <div class="col-md-4">
                    <label>Organizaciones/Movimientos</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.organizacion')}">
                        <input  data-vv-name="organizacion" type="text"  v-validate="'min:5|max:150'" class="form-control" placeholder="Ej: Organizaciones/Movimientos" minlength="2" maxlength="150"  v-model="organizacion" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="organizaciones.length >=2  || organizacion=='' || errors.has('form3.organizacion')" title="Agregar" @click="guardarItem(organizacion,9)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                        <span v-show="errors.has('form3.organizacion')" class="text-danger"> @{{ errors.first('form3.organizacion') }} </span>
                </div>
            </div> <br>
            <div class="d-md-flex">
                <div class="col-md-4" >
                    <div v-show="fundoss.length > 0">
                        <li class="list-group-item active">Lista Fundos/Zamoranos</li>
                        <ul class="list-group" v-for="(r, index) in fundoss">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,7)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-show="instituciones.length > 0">
                        <li class="list-group-item active">Lista Instituciones</li>
                        <ul class="list-group" v-for="(r, index) in instituciones">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,8)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-show="organizaciones.length > 0">
                        <li class="list-group-item active">Lista Organizaciones/Movimientos</li>
                        <ul class="list-group" v-for="(r, index) in organizaciones">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,9)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="d-md-flex">
               <div class="col-md-4">
                    <label>Otros</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.otros')}">
                        <input  data-vv-name="otros" type="text" class="form-control" v-validate="'min:5|max:150'" placeholder="Ej: Otros" minlength="2" maxlength="150"  v-model="otros" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="otross.length >=2  || otros=='' || errors.has('form3.otros')" title="Agregar" @click="guardarItem(otros,10)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <span v-show="errors.has('form3.otros')" class="text-danger">@{{ errors.first('form3.otros') }}</span>
                </div>
                <div class="col-md-4">
                    <label>Urbanismos</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.urbanismos')}">
                        <input  data-vv-name="urbanismos" type="text"  v-validate="'min:5|max:150'" class="form-control" placeholder="Ej: Urbanismos" minlength="2" maxlength="150"  v-model="urbanismos" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="urbanismoss.length >=2  || urbanismos=='' || errors.has('form3.urbanismos')" title="Agregar" @click="guardarItem(urbanismos,11)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                        <span v-show="errors.has('form3.urbanismos')" class="text-danger"> @{{ errors.first('form3.urbanismos') }} </span>
                </div>
                <div class="col-md-4">
                    <label>Consejos Comunales</label>
                    <div class="input-group" :class="{'has-feedback has-error':errors.has('form3.consejos comunales')}">
                        <input  data-vv-name="consejos comunales" type="text"  v-validate="'min:5|max:150'" class="form-control" placeholder="Ej: Consejos Comunales" minlength="2" maxlength="150"  v-model="consejos" >
                        <div class="input-group-prepend">
                            <button  type="button" :disabled="consejoss.length >=2 ||  consejos=='' || errors.has('form3.consejos')" title="Agregar" @click="guardarItem(consejos,12)" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                        <span v-show="errors.has('form3.consejos comunales')" class="text-danger"> @{{ errors.first('form3.consejos comunales') }} </span>
                </div>                
            </div><br>
            <div class="d-md-flex">
                <div class="col-md-4" >
                    <div v-show="otross.length > 0">
                        <li class="list-group-item active">Lista Otros</li>
                        <ul class="list-group" v-for="(r, index) in otross">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,10)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-show="urbanismoss.length > 0">
                        <li class="list-group-item active">Lista Urbanismos</li>
                        <ul class="list-group" v-for="(r, index) in urbanismoss">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,11)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-show="consejoss.length > 0">
                        <li class="list-group-item active">Lista Consejos Comunales</li>
                        <ul class="list-group" v-for="(r, index) in consejoss">
                          <li class="list-group-item">@{{ r.denominacion }}
                            <button type="button" class="close" @click="eliminarItem(index,12)">
                                  <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    </div>
                </div>
            </div> <br>
            <div class="d-flex justify-content-between"> {{-- botones siguientes --}}
                <div>
                    <button type="button" @click="atras2" class="btn btn-dark "> <span class="fa fa-chevron-left"></span> Atras</button>
                </div>
                <div>
                    <button type="button" @click="guardadoFinal" class="btn btn-success" >Guardar <span class="fa fa-chevron-right"></span></button>
                </div>
            </div> {{-- fin botones --}}
            <br>
            </form>

        </div> {{-- Fin vista3 --}}
    </div>
<style>
[v-cloak]{ /*Permite que cargue las librerias antes que el html*/
    display: none;
}
</style>
@stop

