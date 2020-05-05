const filtroDireccion= new Vue({
    el:'#filtroDireccion',
    data:{
        estado:'',
        municipio:'',
        
        listaMunicipio:[],
        listar:true,

        //editar parroquia
        zona:{nombre:'',codigo:''},
        listaZona:[],
        listaZonaFormat:[],

    },
    computed: {
        formatEstado: function(){
            this.estado= (this.estado.toLowerCase()).charAt(0).toUpperCase()+(this.estado.toLowerCase()).slice(1)
            return this.estado
        }
    },
    methods: {
        eliminarEstado(estados){
            
        },
        agregarMunicipio(){
        
            const muni=this.municipio.trim()
            

            if(muni==''){
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Debe llenar este campo!'
                })
            }else{
                
                const listo= (muni.toLowerCase()).charAt(0).toUpperCase()+(muni.toLowerCase()).slice(1)

                const param=this.listaMunicipio
                
                if(param.length<=0){
                    this.listaMunicipio.push(listo)
                }else{

                    for (let index = 0; index < param.length; index++) {

                        if(param[index]==listo){

                            this.listar=false

                            alert('Ya ha ingreado un municipio con este nombre')
                            
                        }
    
                     }
                     
                     if(this.listar){
                        this.listaMunicipio.push(listo)
                    }
                
                }
            }
            this.listar=true
            this.municipio=''
        },

        agregarZona(){
        
            const nombre=this.zona.nombre.trim()
            

            if(this.zona.nombre.trim()==''||this.zona.codigo==''){
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Debe indicar la el nombre de la zona y el código postal!'
                })
            }else{
                
                const listo= (nombre.toLowerCase()).charAt(0).toUpperCase()+(nombre.toLowerCase()).slice(1)
                const params={nombre:listo,codigo:this.zona.codigo}
                
                if(this.listaZona.length<=0){
                    this.listaZona.push(params)
                    
                    this.listaZonaFormat=JSON.stringify( this.listaZona)
                    console.log(this.listaZonaFormat)
                }else{

                    for (let index = 0; index < this.listaZona.length; index++) {

                        if(this.listaZona[index].nombre==listo){

                            this.listar=false

                            alert('Ya ha ingreado una zona con este nombre')
                            
                        }
    
                     }
                     
                     if(this.listar){
                        this.listaZona.push(params)
                        this.listaZonaFormat=JSON.stringify( this.listaZona)
                        console.log(this.listaZonaFormat)
                    }
                
                }
            }
            this.listar=true
            this.zona.nombre=''
            this.zona.codigo=''
        }
    },
    mounted() {
        
        if(data.editar=='si'){
            this.estado=data.datos.nombre
        }
        
    }
    

});
