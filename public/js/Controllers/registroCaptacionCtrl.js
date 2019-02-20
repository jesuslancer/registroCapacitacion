
window.onload = function(){
	var registro = new Vue({
		el: '#captacion',
		created () {
			this.getEstados();

		},
		mounted(){
			var self = this
		},
		data:{
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
			estado:'',
			municipio:'',
			parroquia:'',
			existeP:true,
			estados:[],
			municipios:[],
			parroquias:[],

		},
		methods:{
			consulta(){//Consulta inicial de persona con la cedula
				axios.get('consultaCedula/'+ this.nac + '/' + this.cedula)
				.then(r=>{
					if (r.data != 'vacio') {
								/*if (r.data[0]['correo_principal'] == null) {
									this.sinCorreo = true
								} else {
									this.sinCorreo = false
								}
								if (r.data[0]['parroquia_id'] == null) {
									this.sinParroquia = true
								} else {
									this.sinParroquia = false
								}*/
								//this.loading1 = false
								this.existeP=true;
								this.personaId = r.data.id
								this.nombrePersona = r.data.primer_nombre + ' ' + r.data.segundo_nombre + ' ' + r.data.primer_apellido + ' ' + r.data.segundo_apellido
								this.genero = r.data.sexo
								this.fechaNac = this.formatoVw(r.data.fecha_nacimiento)
							} else {
								this.existeP=false;
								alert('NO CONSIGUÓ! ')
								swal('¡Atención!','Estimado(a) usuario(a), por favor coloque una cédula valida','error')
								/*this.sinCorreo = false
								this.sinParroquia = false
								this.loading1 = false*/

							}
							this.getEstados()
				})
			},
			getEstados() {//Consulta todos los estados
				axios.post('estados')
				.then(r => {
					this.estados = r.data
					this.parroquias.length = 0
				})
			},
			getMunicipios() {
				axios.post('municipios', {id:this.estado})
				.then(r => {
					this.municipios = r.data
					this.parroquias.length = 0
				})
			},
			getParroquias() {
				axios.post('parroquias', {id:this.municipio})
				.then(r => {
					this.parroquias = r.data
				})
			},
			formatoVw(date){
				var f2 = date.split('-')
				var fecha = f2[2].length==4? f2[0]+'-'+f2[1]+'-'+f2[2]:f2[2]+'-'+f2[1]+'-'+f2[0]
				return fecha
			},
			formatoDB (date) {
				var f2 = date.split('-')
				var fecha = f2[2].length==4? f2[2]+'-'+f2[1]+'-'+f2[0]:f2[0]+'-'+f2[1]+'-'+f2[2]
				return fecha
			},
		}

	})
}