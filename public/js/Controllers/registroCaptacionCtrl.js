
window.onload = function(){
	var registro = new Vue({
		el: '#captacion',
		created () {
			this.$validator.localize('es')//define vee-validate a español
			this.getEstados();
			this.getNivel();
			this.getOcupaciones();
		},
		mounted(){
			var self = this
		},
		data:{
			existeP:false,
			vista1:true,
			vista2:false,			
			vista3:false,			
			cargando:false,
			estatusCarnet:false,
			estatusTitulo:false,
			estatusVegetal:false,
			estatusAnimal:false,
			estatusOcupacion:false,
			estatusEspacio:false,
			banderaEspacio:false,
			cedula:'',
			nac:'V',
			personaId:'',
			nombrePersona:'',
			genero:'',
			fechaNac:'',
			telf1:'',
			telf2:'',
			telf3:'',
			correo1:'',
			correo2:'',
			urbanizacion:'',
			avenida:'',
			edificio:'',
			piso:'',
			apto:'',
			referencia:'',
			estado:'',
			municipio:'',
			parroquia:'',
			estadoE:'',
			municipioE:'',
			parroquiaE:'',
			nivel:'',
			nivelModal:'',
			estadoCivil:'',
			comunidad:'',
			serial:'',
			codigo:'',
			nivel:'',
			categoria:'',
			area:'',
			programa:'',
			titulo:'',
			ocupacion:'',
			comunidadE:'',
			fechaTitulo:new Date(),
			base:'',
			ciudades:'',
			clap:'',
			comunas:'',
			conuqueros:'',
			corredores:'',
			fundos:'',
			institucion:'',
			organizacion:'',
			otros:'',
			urbanismos:'',
			basess:[],
			ciudadess:[],
			claps:[],
			comunass:[],
			conuqueross:[],
			corredoress:[],
			fundoss:[],
			instituciones:[],
			organizaciones:[],
			otross:[],
			urbanismoss:[],
			estados:[],
			municipios:[],
			parroquias:[],
			municipiosE:[],
			parroquiasE:[],
			niveles:[],
			categorias:[],
			areas:[],
			programas:[],
			titulos:[],
			titulosRegistrados:[],
			ocupaciones:[],
			ocupacionesPer:[],
			espacioProductivo:[],
			paginacionTitulo:{
				paginate:{currentPage:1},
				totalItems:null,
				itemsPerPage:5
			},
			paginacionOcupacionesPer:{
				paginate:{currentPage:1},
				totalItems:null,
				itemsPerPage:5
			},
			paginacionEspacioProductivo:{
				paginate:{currentPage:1},
				totalItems:null,
				itemsPerPage:5
			},
		},
		methods:{
			consulta(){//Consulta inicial de persona con la cedula
				this.cargando = true
				axios.get('consultaCedula/'+ this.nac + '/' + this.cedula)
				.then(r=>{
				this.limpiar()
					if (r.data != 'vacio') {
							this.existeP=true;
							this.personaId = r.data['persona'].id
							this.nombrePersona = r.data['persona'].primer_nombre + ' ' + r.data['persona'].segundo_nombre + ' ' + r.data['persona'].primer_apellido + ' ' + r.data['persona'].segundo_apellido
							this.genero = r.data['persona'].sexo
							this.fechaNac = this.formatoVw(r.data['persona'].fecha_nacimiento)
							this.telf1 = r.data['persona'].telefono_1
							this.telf2 = r.data['persona'].telefono_2
							this.telf3 = r.data['persona'].telefono_3
							this.correo1 = r.data['persona'].correo_principal
							this.correo2 = r.data['persona'].correo_opcional
							this.nivel = r.data['persona'].nivel_educativo_id == null?'':r.data['persona'].nivel_educativo_id //Se hace ternario, debido a que cuando 
							this.estadoCivil = r.data['persona'].estado_civil_id == null?'':r.data['persona'].estado_civil_id //es null genera un error en los select
							this.urbanizacion = r.data['persona'].urbanizacion_sector
							this.avenida = r.data['persona'].avenida_calle
							this.edificio = r.data['persona'].edificio_casa_quinta
							this.apto = r.data['persona'].apartamento
							this.piso = r.data['persona'].piso
							this.referencia = r.data['persona'].punto_referencia
							this.comunidad = r.data['persona'].comunidad
							this.estatusAnimal = r.data['persona'].experiencia_agricola_animal
							this.estatusVegetal = r.data['persona'].experiencia_agricola_vegetal
							this.estado = r.data['persona'].parroquia ? r.data['persona'].parroquia.municipio.estado.id : '' 
							if (this.estado) {
								this.getMunicipios(this.estado)
								this.municipio = r.data['persona'].parroquia.municipio.id
								this.getParroquias(this.municipio)
								this.parroquia = r.data['persona'].parroquia_id
							}
							if (r.data['persona'].serial_carnet_patria != null ) {
								this.estatusCarnet = true
								this.serial = r.data['persona'].serial_carnet_patria
								this.codigo = r.data['persona'].codigo_carnet_patria
							}
							if (r.data['titulos'].length > 0) {
								r.data['titulos'].forEach((value)=>{
									this.estatusTitulo=true
									this.titulosRegistrados.push({'nivelDescripcion':value.nivel_educativo.descripcion,'titulo_carrera_id':value.titulo_carrera_id,
										'titulo':value.titulo_carrera.descripcion,'fecha':this.formatoVw(value.fecha_graduacion),
										'nivel_educativo_id':value.nivel_educativo_id})
									this.paginacionTitulo.totalItems=this.titulosRegistrados.length
								})
							}
							if (r.data['ocupaciones'].length > 0) {
								r.data['ocupaciones'].forEach((value)=>{
									this.estatusOcupacion=true
									this.ocupacionesPer.push({'codigo':value.codigo,'denominacion':value.ocupacion_clase.denominacion, 
										'ocupacion_clase_id':value.ocupacion_clase_id})
									this.paginacionOcupacionesPer.totalItems=this.paginacionOcupacionesPer.length
								})
							}
							if (r.data['espacios'].length > 0) {
								r.data['espacios'].forEach((value)=>{
									this.estatusEspacio = true
									this.espacioProductivo.push({'comunidad':value.comunidad,'estadoE':value.parroquia.municipio.estado.denominacion,
									'municipioE':value.parroquia.municipio.denominacion,'parroquiaE':value.parroquia.denominacion,'parroquia_id':value.parroquia.id})
									this.paginacionEspacioProductivo.totalItems=this.paginacionEspacioProductivo.length
								})
							}
							if (r.data['bases'].length > 0) {
								r.data['bases'].forEach((value)=>{
									this.basess.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['ciudades'].length > 0) {
								r.data['ciudades'].forEach((value)=>{
									this.ciudadess.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['claps'].length > 0) {
								r.data['claps'].forEach((value)=>{
									this.claps.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['comunas'].length > 0) {
								r.data['comunas'].forEach((value)=>{
									this.comunass.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['conuqueros'].length > 0) {
								r.data['conuqueros'].forEach((value)=>{
									this.conuqueross.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['corredores'].length > 0) {
								r.data['corredores'].forEach((value)=>{
									this.corredoress.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['fundos'].length > 0) {
								r.data['fundos'].forEach((value)=>{
									this.fundoss.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['instituciones'].length > 0) {
								r.data['instituciones'].forEach((value)=>{
									this.instituciones.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['organizaciones'].length > 0) {
								r.data['organizaciones'].forEach((value)=>{
									this.organizaciones.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['otros'].length > 0) {
								r.data['otros'].forEach((value)=>{
									this.otross.push({'denominacion':value.denominacion})
								})
							}
							if (r.data['urbanismos'].length > 0) {
								r.data['urbanismos'].forEach((value)=>{
									this.urbanismoss.push({'denominacion':value.denominacion})
								})
							}
							this.cargando = false
						} else {
							this.existeP=false;
							Swal.fire({
								  title: '¡Atención!',
								  text: 'Estimado(a) Usuario(a), no se consiguen datos',
								  type: 'error',
								  confirmButtonText: 'OK'
								})
							this.cargando = false
							this.limpiar()
						}
						this.getEstados()
				})
			},
			mostrarCarnet(estatusCarnet){
				this.estatusCarnet = !this.estatusCarnet
				checked == this.estatusCarnet
			},
			getNivel(){//Consulta todos los niveles educativos
				axios.post('nivelInstruccion')
				.then(r =>{

					this.niveles = r.data
				})
			},
			
			getEstados() {//Consulta todos los estados
				axios.post('estados')
				.then(r => {
					this.estados = r.data
				})				

			},
			getMunicipios(e) {// Consultas los municipios segun los estados
				axios.post('municipios', {'id':e})
				.then(r => {
					if (this.banderaEspacio) {
						this.municipiosE = r.data
					}else{
						this.municipios = r.data
					}
				})
			},
			getParroquias(m) {// Consultas las parroquias segun los municipios
				axios.post('parroquias', {'id':m})
				.then(r => {
					if (this.banderaEspacio) {
						this.parroquiasE = r.data
					}else{
						this.parroquias = r.data
					}
				})
			},
			getCategorias(valor) {// Consultas las categorias educativas segun los niveles
				axios.post('categorias', {'id':valor})
				.then(r => {
					this.categorias = r.data
				})
			},
			getAreaConocimiento(valor) {// Consultas las categorias educativas segun los niveles
				axios.post('areasConocimientos', {'id':valor})
				.then(r => {
					this.areas = r.data
				})
			},
			getProgramaEstudio(valor) {// Consultas las categorias educativas segun los niveles
				axios.post('programas', {'id':valor})
				.then(r => {
					this.programas = r.data
				})
			},
			getTituloCarrera(valor) {// Consultas las categorias educativas segun los niveles
				axios.post('titulos', {'id':valor})
				.then(r => {
					this.titulos = r.data
				})
			},
			getOcupaciones (){// Consultar Ocupacion laborales para select2
				axios.post('ocupaciones')
				.then(r => {
					this.ocupaciones = r.data
				})
			},
			limpiar(){//Vacia cada variables del formulario
				this.nac='V';
				this.personaId='';
				this.nombrePersona='';
				this.genero='';
				this.fechaNac='';
				this.telf1='';
				this.telf2='';
				this.telf3='';
				this.correo1='';
				this.correo2='';
				this.urbanizacion='';
				this.avenida='';
				this.edificio='';
				this.piso='';
				this.apto='';
				this.referencia='';
				this.estado='';
				this.municipio='';
				this.parroquia='';
				this.nivel='';
				this.estadoCivil='';
				this.comunidad='';
				this.municipios=[];
				this.parroquias=[];
				this.serial='';
				this.codigo='';
				this.titulosRegistrados=[];
				this.ocupacionesPer=[];
				this.espacioProductivo=[];
				this.basess=[];
				this.ciudadess=[];
				this.claps=[];
				this.comunass=[];
				this.conuqueross=[];
				this.corredoress=[];
				this.fundoss=[];
				this.instituciones=[];
				this.organizaciones=[];
				this.otross=[];
				this.urbanismoss=[];
				this.estatusCarnet =false;
				this.estatusTitulo =false;
				this.estatusOcupacion =false;
				this.estatusAnimal =false;
				this.estatusVegetal =false;
				this.estatusEspacio =false;

			},
			clean(){// Funcion que inicia la accion de limpiar
				Swal.fire({
				  title: '¿Esta Seguro(a)?',
				  text: "Estimado(a) Usuario(a), esta acción LIMPIARA del formulario los datos que no haya guardado",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: '¡Si, Limpiar!',
				  cancelButtonText: 'Cancelar'
				}).then((result) => {
				  if (result.value) {
				    Swal.fire(
				      '¡Limpiado!',
				      'Los datos se Limpiaron.',
				      'success'
				    )
				    	this.limpiar();
						this.existeP=false;
				  }
				})

			},
			limpiarTitulo(){
				this.nivelModal='';
				this.titulo='';
				this.categoria='';
				this.area='';
				this.programa='';
				this.fecha1=null;
			},
			guardarTitulo(){//Funcionn para guardar en un array los titulos academicos
				this.$validator.validateAll('form').
				then(() => {
					if (!this.errors.any('form')) {
						var existeT = false;
						this.titulosRegistrados.forEach((value)=>{
							if (value['titulo_carrera_id']== this.titulo.id) {
								existeT = true;
	 							Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar este estudio.','error')
							}
						})
						if (this.titulosRegistrados.length>=5) {
							existeE = true;
							Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas estudios.','error')
						}
						if (!existeT) {
							var n = ''
							if(this.nivelModal==6){
										n = 'EDUCACIÓN TÉCNICA SUPERIOR'
									}else if (this.nivelModal==7) {
										n = 'EDUCACIÓN PROFESIONAL UNIVERSITARIA'
									}else if (this.nivelModal==4) {
										n = 'DESARROLLO PERSONAL Y LABORAL NO PROFESIONAL'
									}else if (this.nivelModal==5) {
										n = 'EDUCACIÓN MEDIA'
									}
								this.titulosRegistrados.push({'nivelDescripcion':n,'titulo_carrera_id':this.titulo.id,'titulo':this.titulo.descripcion,
									'fecha':this.convertirAnioAFecha(this.fechaTitulo),'nivel_educativo_id':this.nivelModal})
								this.paginacionTitulo.totalItems=this.titulosRegistrados.length
						}
						$('#modalTitulo').modal('hide');
						if ($('.modal-backdrop').is(':visible')) {
						  $('body').removeClass('modal-open'); 
						  $('.modal-backdrop').remove(); 
						};
						this.limpiarTitulo()
					} else {
						Swal.fire('¡Atención!','Estimado(a) usuario(a), tiene campos requeridos por favor verifique','error')
					}
				})
			},
			eliminarTitulo(index){//Funcion para eliminar en vista los titulos registrados
				this.titulosRegistrados.splice(index,1);
			},
			limpiarOcupacion(){
				this.ocupacion = ""
			},
			guardarOcupacion(a){
				var existeO = false;
				this.ocupacionesPer.forEach((value)=>{
					if (value['ocupacion_clase_id']== a.id) {
						existeO = true;
							Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar esta ocupación.','error')
					}
				})	
				if (this.ocupacionesPer.length>=5) {
						existeO = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas ocupaciones.','error')
					}
				if (!existeO) {
					this.ocupacionesPer.push({'codigo':a.codigo,'denominacion':a.denominacion, 'ocupacion_clase_id':a.id})
					this.paginacionOcupacionesPer.totalItems=this.paginacionOcupacionesPer.length
				}
				this.limpiarOcupacion()
				
			},
			eliminarOcupacion(index){//Funcion para eliminar en vista los titulos registrados
				this.ocupacionesPer.splice(index,1);
			},
			limpiarEspacio(){
				this.comunidadE='';
				this.parroquiaE='';
				this.parroquiasE=[];
				this.municipioE='';
				this.municipiosE=[];
				this.estadoE='';
			},
			guardarEspacio(){//Se guarda los espacios productivos
				var existeEs = false;
				this.espacioProductivo.forEach((value)=>{
					if (value['parroquia_id']==this.parroquiaE.id) {
						existeEs = true;
							Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar este espacio productivo.','error')
					}
				})
				if (this.espacioProductivo.length>=5) {
						existeEs = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas espacios productivos.','error')
					}
				if (!existeEs) {
					this.espacioProductivo.push({'comunidad':this.comunidadE,'estadoE':this.estadoE.denominacion, 'municipioE':this.municipioE.denominacion,
						'parroquiaE':this.parroquiaE.denominacion,'parroquia_id':this.parroquiaE.id})
					this.paginacionEspacioProductivo.totalItems=this.paginacionEspacioProductivo.length
					$('#modalEspacio').modal('hide');
					if ($('.modal-backdrop').is(':visible')) {
					  $('body').removeClass('modal-open'); 
					  $('.modal-backdrop').remove(); 
					};
				}
				this.limpiarEspacio()

			},
			eliminarEspacio(index){//Funcion para eliminar en vista los titulos registrados
				this.espacioProductivo.splice(index,1);
			},
			
			guardarItem(i,n){ //se agrega segun el item q se pase
				this.$validator.validateAll('form3').
				then(() => {
				if (n==1) {
					var eb= false
					this.basess.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							eb = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.basess.length>=5) {
						eb = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!eb) {
					this.basess.push({'denominacion':i})
					this.base='';

					}
				}
				if (n==2) {
					var ec= false
					this.ciudadess.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							ec = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.ciudadess.length>=5) {
						ec = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!ec) {
					this.ciudadess.push({'denominacion':i})
					this.ciudades='';
					}
				}
				if (n==3) {
					var ecl= false
					this.claps.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							ecl = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.claps.length>=5) {
						ecl = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!ecl) {
					this.claps.push({'denominacion':i})
					this.clap='';
					}
				}
				if (n==4) {
					var eco= false
					this.comunass.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							eco = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.comunass.length>=5) {
						eco = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!eco) {
					this.comunass.push({'denominacion':i})
					this.comunas='';
					}
				}
				if (n==5) {
					var econ= false
					this.conuqueross.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							econ = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.conuqueross.length>=5) {
						econ = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!econ) {
					this.conuqueross.push({'denominacion':i})
					this.conuqueros='';
					}
				}
				if (n==6) {
					var ecor= false
					this.corredoress.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							ecor = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.corredoress.length>=5) {
						ecor = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!ecor) {
					this.corredoress.push({'denominacion':i})
					this.corredores='';
					}
				}
				if (n==7) {
					var ef= false
					this.fundoss.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							ef = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.fundoss.length>=5) {
						ef = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!ef) {
					this.fundoss.push({'denominacion':i})
					this.fundos='';
					}
				}
				if (n==8) {
					var ei= false
					this.instituciones.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							ei = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.instituciones.length>=5) {
						ei = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!ei) {
					this.instituciones.push({'denominacion':i})
					this.institucion='';
					}
				}
				if (n==9) {
					var eor = false
					this.organizaciones.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							eor = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.organizaciones.length>=5) {
						eor = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!eor) {
					this.organizaciones.push({'denominacion':i})
					this.organizacion='';
					}
				}
				if (n==10) {
					var et = false
					this.otross.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							et = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.otross.length>=5) {
						et = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!et) {
					this.otross.push({'denominacion':i})
					this.otros='';
					}
				}
				if (n==11) {
					var eu = false
					this.urbanismoss.forEach((value)=>{
						if (i=='' || value['denominacion']==i) {
							eu = true;
								Swal.fire('¡Atención!','Estimado usuario(a), no puede volver agregar el mismo.','error')
						}
					})
					if (this.urbanismoss.length>=5) {
						eu = true;
						Swal.fire('¡Atención!','Estimado usuario(a), no puede agregar mas.','error')
					}
					if (!eu) {
					this.urbanismoss.push({'denominacion':i})
					this.urbanismos='';
					}
				}
				})
			},
			eliminarItem(index,n){//Se elimina segun el item q pase
				if (n==1) {
					this.basess.splice(index,1);
				}
				if (n==2) {
					this.ciudadess.splice(index,1);
				}
				if (n==3) {
					this.claps.splice(index,1);
				}
				if (n==4) {
					this.comunass.splice(index,1);
				}
				if (n==5) {
					this.conuqueross.splice(index,1);
				}
				if (n==6) {
					this.corredoress.splice(index,1);
				}
				if (n==7) {
					this.fundoss.splice(index,1);
				}
				if (n==8) {
					this.instituciones.splice(index,1);
				}
				if (n==9) {
					this.organizaciones.splice(index,1);
				}
				if (n==10) {
					this.otross.splice(index,1);
				}
				if (n==11) {
					this.urbanismoss.splice(index,1);
				}
			},
			convertirAnioAFecha(fecha){// Se creo esta funcion como solucion al formato del datepicker
				var dia = fecha.getDate();
				var mes = fecha.getMonth() + 1;
				var anio = fecha.getFullYear();
				return anio+'-'+mes +'-'+dia
			},
	
			next(){// Funcion que guarda la persona y cambia a la vista 2
				axios.post('guardarP',{'idP':this.personaId,'telf1':this.telf1,'telf2':this.telf2,'telf3':this.telf3,'correo1':this.correo1,'correo2':this.correo2,
					'urb':this.urbanizacion,'av':this.avenida,'edf':this.edificio,'piso':this.piso,'apto':this.apto,'ref':this.referencia,'parroquia':
					this.parroquia,'nivel':this.nivel,'estadoCivil':this.estadoCivil,'comunidad':this.comunidad,'serial':this.serial,'codigo':this.codigo}).then(r =>{
						if (r.data=='guardo') {
							this.existeP=false;
							this.vista1=false;
							this.vista2=true;
							this.vista3=false;
						}
					})
				
				
			},
			next2(){// Funcion que guarda la ocupacion y titulo registrados, tambien  cambia a la vista 3
				axios.post('guardarTO',{'idP':this.personaId,'titulo':this.titulosRegistrados,'ocupacion':this.ocupacionesPer, 'espacio':this.espacioProductivo,
				 'animal':this.estatusAnimal,'vegetal':this.estatusVegetal}).then(r =>{
						if (r.data=='guardo') {
							this.existeP=false;
							this.vista1=false;
							this.vista2=false;
							this.vista3=true;
						}
					})
			},
			guardadoFinal(){//Funcion que guarda todos los arreglos de la vista 3
				axios.post('guardadoFinal',{'idP':this.personaId,'bases':this.basess,'ciudades':this.ciudadess,'claps':this.claps,'comunas':this.comunass,
					'conuqueros':this.conuqueross, 'corredores':this.corredoress,'fundos':this.fundoss,'instituciones':this.instituciones,
					'organizaciones':this.organizaciones,'otros':this.otross,'urbanismos':this.urbanismoss}).then(r=>{
						if (r.data=='guardo') {
						Swal.fire('¡Atención!','Estimado usuario(a), Se guardaron sus datos correctamente.','success')
							this.existeP=false;
							this.vista1=true;
							this.vista2=false;
							this.vista3=false;
							this.cedula="";
						}
					})
			},
			atras(){//Funcion para regresar a la vista 1
				this.existeP=true;
				this.vista1=true;
				this.vista2=false;
				this.vista3=false;
			},
			atras2(){//Funcion para regresar a la vista 1
				this.existeP=false;
				this.vista1=false;
				this.vista2=true;
				this.vista3=false;
			},
			formatoVw(date){// Formatea las fechas segun la vista
				var f2 = date.split('-')
				var fecha = f2[2].length==4? f2[0]+'-'+f2[1]+'-'+f2[2]:f2[2]+'-'+f2[1]+'-'+f2[0]
				return fecha
			},
			formatoDB (date) {// Formatea las fechas segun la bd
				var f2 = date.split('-')
				var fecha = f2[2].length==4? f2[2]+'-'+f2[1]+'-'+f2[0]:f2[0]+'-'+f2[1]+'-'+f2[2]
				return fecha
			},
		},
		computed:{
			array () {//Arreglo de los titulos
		    return this.titulosRegistrados
		      	.slice(((this.paginacionTitulo.paginate.currentPage - 1) * this.paginacionTitulo.itemsPerPage),
					(this.paginacionTitulo.paginate.currentPage * this.paginacionTitulo.itemsPerPage));
			},
			array2 () {//Arreglo de los titulos
		    return this.ocupacionesPer
		      	.slice(((this.paginacionOcupacionesPer.paginate.currentPage - 1) * this.paginacionOcupacionesPer.itemsPerPage),
					(this.paginacionOcupacionesPer.paginate.currentPage * this.paginacionOcupacionesPer.itemsPerPage));
			},
			array3 () {//Arreglo de los titulos
		    return this.espacioProductivo
		      	.slice(((this.paginacionEspacioProductivo.paginate.currentPage - 1) * this.paginacionEspacioProductivo.itemsPerPage),
					(this.paginacionEspacioProductivo.paginate.currentPage * this.paginacionEspacioProductivo.itemsPerPage));
			},
		},
		
	})
	var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
	$.fn.modal.Constructor.prototype.enforceFocus = function() {};//Estas dos lineas son para corregir error en firefox donde los date picker no funcionan los eses y años
	$('#modalTitulo').on('hidden.bs.modal', function(e){// se configuran los modales de manera global
			registro.limpiarTitulo()// se ejecuta la funcion llamandolo desde el objeto vue
	});
	$('#modalEspacio').on('hidden.bs.modal', function(e){// se configuran los modales de manera global
			this.banderaEspacio = false
			registro.limpiarEspacio()// se ejecuta la funcion llamandolo desde el objeto vue
	});
}