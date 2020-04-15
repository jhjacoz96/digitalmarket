const filtroDireccion= new Vue({
    el:'#filtroDireccion',
    data:{
        estado:'',
        municipio:'',
        listaMunicipio:[],
        listar:true,
        

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
        }
    },
    mounted() {
        
        if(data.editar=='si'){
            this.estado=data.datos.nombre
        }
        
    }
    

});
