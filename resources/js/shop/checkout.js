const checkout= new Vue({
    el:'#checkout',
    data:{
        estados:[],
        estado_id:'',
        municipios:[],
        municipio_id:'',
        parroquias:[],
        parroquia_id:'',
        zonas:[],
        zona_id:'',
        codigoPostal:'',
        abrir1:true,
        abrir2:false,
        abrir3:false,
        agregarDireccion:false,
        mostrarDirecciones:true,
        montoPagar:0,
        aparecerDetalleMetodo:false,

        metodoPagoNacional:[],
        metodoPagoInternacional:[],
        seletedMetodoPago:[],
      
        arrayNacional:[],
        arrayInternacional:[],
        dolarToday:200000,
        totalBs:0,
        totalDolar:0,
        totallBs:0,
        totallDolar:0,
        cantidadBs:0,
        cantidadDolar:0,
        metodoEnvio:[],
        selectEnvio:'',
        direcciones:[],
        direccionEnvio:'',
        direccionFactura:'',
        envioFree:'',
        precioFijoBs:'',
        precioFijoDolar:'',
        metodoPagos:[],
        metodoEnvios:[],
        totalPeso:0

    },
    created() {

        axios.get('/moneda/'+data.datos.totalBs).then(res=>{

            this.moneda=res.data

        }).catch(e=>{
             console.log(e.reponse)
        })

        axios.get('/getEstado').then(res=>{
         this.estados=res.data
        
        }).catch(e=>{
             console.log(e.reponse)
        })

        axios.get('/obtenerMetodoPagoNacional').then(res=>{
            
            this.metodoPagoNacional=res.data
           
            
            const a=this.metodoPagoNacional
            const o=this.arrayNacional
           
            const d={id:'',nombre:'',tipoPago:'nacional',cantidad:0}
             for (let i = 0; i < a.length; i++) {
                const d={id:a[i].id,nombre:a[i].nombre,tipoPago:'nacional',cantidad:0}
                  
                    o.push(d)
                    
                 
             }
            
        
        }).catch(e=>{
            console.log(e.response)
        })

        axios.get('/obtenerMetodoPagoInternacional').then(res=>{
            this.metodoPagoInternacional=res.data
            console.log(res.data)
            const a=this.metodoPagoInternacional

            const o=this.arrayInternacional
           
            const d={id:'',nombre:'',tipoPago:'internacional',cantidad:0}
             for (let i = 0; i < a.length; i++) {
                const d={id:a[i].id,nombre:a[i].nombre,tipoPago:'internacional',cantidad:0}
                    
                    o.push(d)
                    
                 
             }


        }).catch(e=>{
            console.log(e.response)
        })

        axios.get('/obtenerDireccion').then(res=>{
            this.direcciones=res.data
           

        }).catch(e=>{
            console.log(e.response)
        })




        /*axios.get('https://s3.amazonaws.com/dolartoday/data.json').then(res=>{
            console.log(res.data)
        }).catch(e=>{
            console.log(e.response)
        })*/

    },
    computed: {
       
    },
    methods: {

        seleccionEnvio:function(envio){
            
            this.selectEnvio=envio
            console.log(this.selectEnvio)
            if(this.envioFree==0){
                const f=this.selectEnvio
                if(f!=''){
                    this.totalBs=parseFloat(this.totallBs) + parseFloat(f.precioEnvio)
                    this.totalDolar=this.totalBs/this.dolarToday
                    this.precioFijoBs= this.totalBs
                    this.precioFijoDolar= this.totalDolar
                    
                }
            }else{
                this.selectEnvio.precioEnvio=0
            }
          
        },

        calcularRestante(){
           
            const total=this.seletedMetodoPago
            this.cantidadBs=0
            this.cantidadDolar=0

            for (let i = 0; i < total.length; i++) {

                if(total[i].tipoPago=='nacional'){
                   
                 this.cantidadBs= parseFloat(this.cantidadBs) + parseFloat(total[i].cantidad)
                    
                }

                if(total[i].tipoPago=='internacional'){
                    this.cantidadDolar=parseFloat(this.cantidadDolar)+parseFloat(total[i].cantidad)
                }
                
            }
            
            this.totalBs=this.precioFijoBs-this.cantidadBs-(this.cantidadDolar*this.dolarToday)
            this.totalDolar=this.totalBs/this.dolarToday
            this.cantidadBs=0
            this.cantidadDolar=0

            this.metodoPagos=JSON.stringify(this.seletedMetodoPago)
            this.metodoEnvios=JSON.stringify(this.selectEnvio)

        },


    
        getMunicipio(){
            this.municipio_id='';
            document.getElementById('municipio_id').disabled=true

            this.parroquia_id='';
            document.getElementById('parroquia_id').disabled=true

            this.zona_id='';
            this.codigoPostal=''
            document.getElementById('zona_id').disabled=true

            if(this.estado_id!=''){
                axios.get('/getMunicipio/'+this.estado_id).then(res=>{
                    this.municipios=res.data
                    document.getElementById('municipio_id').disabled=false
                    console.log(this.municipios)
                }).catch(e=>{
                    console.log(e.response)
                })
            }
        },
        getParroquia(){

            this.parroquia_id='';
            document.getElementById('parroquia_id').disabled=true

            this.zona_id='';
            this.codigoPostal=''
            document.getElementById('zona_id').disabled=true

            if(this.municipio_id !='' && this.estado_id !=''  ){
                axios.get('/getParroquia/'+this.municipio_id).then(res=>{
                    this.parroquias=res.data
                    document.getElementById('parroquia_id').disabled=false
                    console.log(this.parroquias)
                }).catch(e=>{
                    console.log(e.response)
                })
            }
        },
        getZona(){
            this.zona_id='';
            this.codigoPostal=''
            document.getElementById('zona_id').disabled=true
            if(this.municipio_id !='' && this.estado_id !='' && this.parroquia_id!=''){

                axios.get('/getZona/'+this.parroquia_id).then(res=>{
                    this.zonas=res.data
                    document.getElementById('zona_id').disabled=false
                    console.log(this.zonas)
                }).catch(e=>{
                    console.log(e.response)
                })

            }
        },
        getCodigo(){
        
            if(this.zona_id!=''){
                
                for (let i = 0; i < this.zonas.length; i++) {
                    if(this.zonas[i].id==this.zona_id){
                      
                        return this.codigoPostal=this.zonas[i].codigoPostal
                        
                    }
                }
            }else{
                
                this.codigoPostal=''
            }
            
        },

        aparecerDireccion:function(){
        this.abrir1=!this.abrir1
        this.abrir2=false
        this.abrir3=false      
        },
        aparacerMetodoEnvio(){
            this.abrir2=!this.abrir2
             this.abrir1=false
             this.abrir3=false
        },
        aparacerMetodoPago(){
            this.abrir3=!this.abrir3
             this.abrir1=false
             this.abrir2=false

        },

        medioEnvio(direccion){
            this.direccionEnvio=direccion.id

            axios.get('/rangoEnvio/'+direccion.id).then(res=>{

                axios.get(`/obtenerMetodoEnvio/${res.data.nombre}`).then(res=>{

                    this.metodoEnvio=res.data
                    const metodoEnvio=this.metodoEnvio
                    console.log(this.metodoEnvio)
                
                    if(this.totalPeso>0){
                        if(this.totalPeso>0 && this.totalPeso<=30){

                            metodoEnvio.forEach(medio => {
                                if(medio.envioGratisApartir!=0){
                                    if(parseFloat(this.totalBs)>=parseFloat(medio.envioGratisApartir)){
                                        medio.precioEnvio=0
                                    }else{

                                        medio.precioEnvio=medio['0kgA30kg']

                                    }
                                }else{

                                    medio.precioEnvio=medio['0kgA30kg']

                                }
                              
                            });

                        }else if(this.totalPeso>30 && this.totalPeso<=50){

                            metodoEnvio.forEach(medio => {

                                if(medio.envioGratisApartir!=0){
                                    
                                    if(parseFloat(this.totalBs)>=parseFloat(medio.envioGratisApartir)){
                                        
                                        medio.precioEnvio=0
                                    }else{
                                        
                                        medio.precioEnvio=medio['31kgA50kg']

                                    }
                                }else{
                                    
                                    medio.precioEnvio=medio['31kgA50kg']

                                }

                            });

                        }else if(this.totalPeso>50 && this.totalPeso<=100){

                            metodoEnvio.forEach(medio => {

                                if(medio.envioGratisApartir!=0){
                                    if(parseFloat(this.totalBs)>=parseFloat(medio.envioGratisApartir)){
                                        medio.precioEnvio=0
                                    }else{

                                        medio.precioEnvio=medio['50kgA100kg']

                                    }
                                }else{

                                    medio.precioEnvio=medio['50kgA100kg']

                                }

                            });

                        }else if(this.totalPeso>100 && this.totalPeso<=200){

                            metodoEnvio.forEach(medio => {

                                if(medio.envioGratisApartir!=0){
                                    if(parseFloat(this.totalBs)>=parseFloat(medio.envioGratisApartir)){
                                        medio.precioEnvio=0
                                    }else{

                                        medio.precioEnvio=medio['101kgA200kg']

                                    }
                                }else{

                                    medio.precioEnvio=medio['101kgA200kg']
                                }

                            });

                        }else if(this.totalPeso>200){

                            metodoEnvio.forEach(medio => {

                                if(medio.envioGratisApartir!=0){
                                    if(parseFloat(this.totalBs)>=parseFloat(medio.envioGratisApartir)){
                                        medio.precioEnvio=0
                                    }else{

                                        medio.precioEnvio=medio['mayorA201kg']

                                    }
                                }else{

                                    medio.precioEnvio=medio['mayorA201kg']
                                }

                              
                            });

                        }
                    }


                }).catch(e=>{
                    console.log(e.response)
                })

            }).catch(e=>{
                console.log(e.response)
            })
           
            
            
        }
       
    },
    mounted() {
        console.log(this.metodoPagoInternacional)
        console.log(this.metodoPagoNacional)
        console.log(this.arrayNacional)

        this.totalPeso=data.datos.totalPeso

        this.envioFree=data.datos.envioFree
      
        this.totalBs=data.datos.totalBs
        this.totalDolar=this.totalBs/this.dolarToday

        this.totallBs=data.datos.totalBs
        this.totallDolar=this.totalBs/this.dolarToday

        this.precioFijoBs=this.totalBs
        //this.dolar
        this.precioFijoDolar=this.totalDolar
        
            
           /* document.getElementById('municipio_id').disabled = true
            document.getElementById('parroquia_id').disabled = true
            document.getElementById('zona_id').disabled = true*/
         
          
    }
});