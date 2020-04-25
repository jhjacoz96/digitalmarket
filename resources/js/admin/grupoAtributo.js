const grupoAtributo= new Vue({
    el:'#grupoAtributo',
    data:{
        grupo:'',
        atributos:'',
        listaatributo:[],
        listar:true
        

    },
    computed: {
        formatEstado: function(){
            this.grupo= (this.grupo.toLowerCase()).charAt(0).toUpperCase()+(this.grupo.toLowerCase()).slice(1)
            return this.grupo
        }
    },
    methods: {
        eliminarEstado(estados){
            
        },
        agregarGrupo(){
        
            const atr=this.atributos.trim()
            

            if(atr==''){
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Debe llenar este campo!'
                })
            }else{
                
                const listo= (atr.toLowerCase()).charAt(0).toUpperCase()+(atr.toLowerCase()).slice(1)

                const param=this.listaatributo
            
                if(param.length<=0){
                    this.listaatributo.push(listo)
                }else{

                    for (let index = 0; index < param.length; index++) {

                        if(param[index]==listo){

                            this.listar=false

                            alert('Ya ha ingreado un atributos con este nombre')
                            
                        }
    
                     }
                     
                     if(this.listar){
                        this.listaatributo.push(listo)
                    }
                
                }
            }
            this.listar=true
            this.atributos=''
        }
    },
    mounted() {
        
        if(data.editar=='si'){
            this.grupo=data.datos.grupo
        }
        
    }
    

});
