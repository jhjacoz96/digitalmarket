const metodoEnvio= new Vue({
    el:'#metodoEnvio',
    data:{
       precioEnvio:0,
       envioGratis:false


    },
    computed: {
        
    },
    methods: {
       
    },
    mounted() {
        if(data.editar=='si'){
            if(data.datos.envioGratis=='A'){
                this.envioGratis=true
            }else{
                this.envioGratis=false
               
            }
            this.precioEnvio=data.datos.precioEnvio
        }
    }
    

});
