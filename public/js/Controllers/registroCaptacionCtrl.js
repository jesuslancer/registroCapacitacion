
window.onload = function(){
	var registro = new Vue({
		el: '#captacion',
		created () {
			this.$validator.localize('es')//define vee-validate a español
			this.getEstados();
			this.getNivel();
		},
		mounted(){
			var self = this
		},
		data:{
			existeP:true,
			vista1:true,
			vista2:true,
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
			nivel:'',
			estadoCivil:'',
			comunidad:'',
			estados:[],
			municipios:[],
			parroquias:[],
			niveles:[],

		},
		methods:{
			consulta(){//Consulta inicial de persona con la cedula
				axios.get('consultaCedula/'+ this.nac + '/' + this.cedula)
				.then(r=>{
					if (r.data != 'vacio') {
								//this.loading1 = false
								this.existeP=true;
								this.personaId = r.data.id
								this.nombrePersona = r.data.primer_nombre + ' ' + r.data.segundo_nombre + ' ' + r.data.primer_apellido + ' ' + r.data.segundo_apellido
								this.genero = r.data.sexo
								this.fechaNac = this.formatoVw(r.data.fecha_nacimiento)
								this.telf1 = r.data.telefono_1
								this.telf2 = r.data.telefono_2
								this.telf3 = r.data.telefono_3
								this.correo1 = r.data.correo_principal
								this.correo2 = r.data.correo_opcional
								this.nivel = r.data.nivel_educativo_id == null?'':r.data.nivel_educativo_id //Se hace ternario, debido a que cuando 
								this.estadoCivil = r.data.estado_civil_id == null?'':r.data.estado_civil_id //es null genera un error en los select
								this.urbanizacion = r.data.urbanizacion_sector
								this.avenida = r.data.avenida_calle
								this.edificio = r.data.edificio_casa_quinta
								this.apto = r.data.apartamento
								this.piso = r.data.piso
								this.referencia = r.data.punto_referencia
								this.comunidad = r.data.comunidad
							} else {
								this.existeP=false;
								Swal.fire({
									  title: '¡Atención!',
									  text: 'Estimado(a) Usuario(a), no se consiguen datos',
									  type: 'error',
									  confirmButtonText: 'OK'
									})
								//this.loading1 = false*/

							}
							this.getEstados()
				})
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
					this.parroquias.length = 0
				})				

			},
			getMunicipios() {// Consultas los municipios segun los estados
				axios.post('municipios', {id:this.estado})
				.then(r => {
					this.municipios = r.data
					this.parroquias.length = 0
				})
			},
			getParroquias() {// Consultas las parroquias segun los municipios
				axios.post('parroquias', {id:this.municipio})
				.then(r => {
					this.parroquias = r.data
				})
			},
			limpiar(){//Vacia cada variables del formulario
				this.cedula='';
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
			},
			clean(){// Fncion que inicia la accion de limpiar
				Swal.fire({
				  title: '¿Esta Seguro(a)?',
				  text: "Estimado(a) Usuario(a), esta acción eliminara los datos que no ha guardado",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: '¡Si, Borrar!',
				  cancelButtonText: 'Cancelar'
				}).then((result) => {
				  if (result.value) {
				    Swal.fire(
				      '¡Borrado!',
				      'Los datos se borraron.',
				      'success'
				    )
				    	this.limpiar();
						this.existeP=false;
				  }
				})

			},
			next(){
				axios.post('guardarP',{'idP':this.personaId,'telf1':this.telf1,'telf2':this.telf2,'telf3':this.telf3,'correo1':this.correo1,'correo2':this.correo2,
					'urb':this.urbanizacion,'av':this.avenida,'edf':this.edificio,'piso':this.piso,'apto':this.apto,'ref':this.referencia,'parroquia':
					this.parroquia,'nivel':this.nivel,'estadoCivil':this.estadoCivil,'comunidad':this.comunidad}).then(r =>{
						if (r.data=='guardo') {
							this.existeP=false;
							this.vista1=false;
							this.vista2=true;
							alert('listo')
						}
					})
				
				
			},
			formatoVw(date){// Formatea las fechas segun la vista
				var f2 = date.split('-')
				var fecha = f2[2].length==4? f2[0]+'-'+f2[1]+'-'+f2[2]:f2[2]+'-'+f2[1]+'-'+f2[0]
				return fecha
			},
			formatoDB (date) {// Formatea las fecahs segun la bd
				var f2 = date.split('-')
				var fecha = f2[2].length==4? f2[2]+'-'+f2[1]+'-'+f2[0]:f2[0]+'-'+f2[1]+'-'+f2[2]
				return fecha
			},
		}

	})
}