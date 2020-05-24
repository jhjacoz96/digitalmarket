const direccion= new Vue({
    el:'#direccion',
    data:{
        correo:'',
        nombre:'',
        apellido:'',

        
        divMensajeSlug:'',
        divClaseSlug:'',
        divAparecer:false,
        deshabilitarBoton:1,
        hola:'dddd',
        estados:[],
        estado_id:'',
        municipios:[],
        municipio_id:'',
        parroquias:[],
        parroquia_id:'',
        zonas:[],
        zona_id:'',
        codigoPostal:''


        
       




    },
   created() {
       axios.get('/getEstado').then(res=>{
        this.estados=res.data
        console.log(this.estados)
       }).catch(e=>{
            console.log(e.reponse)
       })
   },
    methods: {
        getCategoria(){

            if(this.slug){
                let url='/categoria/'+this.slug 
                axios.get(url).then(res=>{
                    this.divMensajeSlug=res.data
                    
                    if(this.divMensajeSlug=="Slug disponible"){
                        this.divClaseSlug='badge badge-success'
                        this.deshabilitarBoton=0
                    }else{
                        this.divClaseSlug='badge badge-danger'
                        this.deshabilitarBoton=1
                    }
                    this.divAparecer=true

                    
                    
                })
            }else{
                this.divClaseSlug='badge badge-danger'
                this.divMensajeSlug="Debe ingresar una categoria"
                this.deshabilitarBoton=1 
                this.divAparecer=true
                
            }

            if(document.getElementById('editar').innerHTML){
                if(document.getElementById('nombretemp').innerHTML===this.nombre ){
                    this.deshabilitarBoton=0;
                    this.divMensajeSlug=''
                    this.divClaseSlug=''
                    this.divAparecer=false
                }
            }

        },
        getEstado(){

        },
        getComprador(){
            if(this.correo){
                let url='/getComprador/'+this.correo
                axios.get(url).then(res=>{
                    if(res.data=='No hay registro de este comprador'){
                        this.nombre=''
                        this.apellido=''
                        this.divMensajeSlug=res.data
                        this.divClaseSlug='badge badge-danger'
                        this.divAparecer=true
                        this.deshabilitarBoton=1
                    }else{
                        this.divAparecer=false
                        this.nombre=res.data.nombre
                        this.apellido=res.data.apellido
                        this.deshabilitarBoton=0
                    }
                }).catch(e=>{
                    console.log(e.response)
                })
            }else{
                this.nombre=''
                this.apellido=''
                this.divClaseSlug='badge badge-danger'
                this.divMensajeSlug="Debe ingresar  un correo válido"
                this.deshabilitarBoton=1 
                this.divAparecer=true
                this.deshabilitarBoton=1
                
            }
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
                }).catch(e=>{s
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
            
        }




    },
    mounted() {

        if(data.editar=='si'){

            document.getElementById('municipio_id').disabled = false
            document.getElementById('parroquia_id').disabled = false
            document.getElementById('zona_id').disabled = false
            this.estado_id=data.datos.estado_id
            this.getMunicipio()
            this.municipio_id=data.datos.municipio_id
            this.getParroquia()
            this.parroquia_id=data.datos.parroquia_id
            this.getZona()
            this.zona_id=data.datos.zona_id
            this.codigoPostal=data.datos.codigoPostal
        }
        if(data.editar=='no'){

            document.getElementById('municipio_id').disabled = true
            document.getElementById('parroquia_id').disabled = true
            document.getElementById('zona_id').disabled = true
      
            if (this.estado_id != '') {
                this.getMunicipio()
            }
      
            if (this.estado_id != '' && this.municipio_id != '') {
                this.getParroquia()
            }
    
            if (this.estado_id != '' && this.municipio_id != '' && this.parroquia_id!='') {
                this.getZona()
            }

        }

        
    }
    
    

});
