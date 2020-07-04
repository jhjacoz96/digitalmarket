const metodoEnvio= new Vue({
    el:'#metodoEnvio',
    data:{
        precio0kg30kg:0,
        precio31kg50kg:0,
        precio51kg100kg:0,
        precio101kg200kg:0,
        precio201kg:0,
        envioGratisMonto:false,
       envioGratis:false,
       montoMinimo:''



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
                this.precio0kg30kg=data.datos.precio0kg30kg
                this.precio31kg50kg=data.datos.precio31kg50kg
                this.precio51kg100kg=data.datos.precio51kg100kg
                this.precio101kg200kg=data.datos.precio101kg200kg
                this.precio201kg=data.datos.precio201kg
                if(data.datos.envioGratisMonto!=0){
                    this.envioGratisMonto=true
                    this.montoMinimo=data.datos.envioGratisMonto
                }
            }
        }
    }
    

});
