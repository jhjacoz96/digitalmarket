const detalleProducto= new Vue({
    el:'#detalleProducto',
    data:{
        combinacion_id:'',
        tipoProducto:'',
      grupos:[],
        disponibilidad:0,
        cantidad:1,
        atributo_id:'',
        atributo_id2:'',
      combinacion:[],
      grupoCombinacion:[],
      grupoCombinacion3:[],
      grupoCombinacion2:[],
        disabledBoton:true,
        mensaje:'',
        mostrarMensaje:false,
      slug:'',
      imagen:'',
      select:[],
      count:0,
      comun:'dddd'


    },
    created() {
        /*axios.get('/combinacion/create').then(res=>{
            this.grupos=res.data
            console.log(this.grupos)
        }).catch(e=>{
            console.log(e.response)
        })*/

        if(this.tipoProducto=='combinacion'){

            axios.get('/obtenerGrupo/'+data.datos.slug).then(res=>{
                
                this.grupoCombinacion=res.data
                this.count=this.grupoCombinacion.length
                const f=this.grupoCombinacion
                if(this.count>1){
                for (let i = 0; i < f.length; i++) {
                    if(i==0){
                        this.grupoCombinacion2=f[i]
                    
                    }
                    if(i==1){
                        this.grupoCombinacion3=f[i]
                      
                    }

                    
                    
                }
                }
            }).catch(e=>{
                console.log(e.response)
            })
       

    

            axios.get(`/obtenerCombinacion/${data.datos.slug}`).then(res=>{
                    this.combinacion=res.data
                //console.log(this.combinacion)
                }).catch(e=>{
                    console.log(e.response)
                })

        }   



        
    },
    computed: {
        validarCantidad:function(){

            if(parseFloat(this.cantidad)>parseFloat(this.disponibilidad)||this.cantidad=='' ||this.cantidad==0 ){
                this.mensaje='Esta cantidad no esta disponible'
                this.mostrarMensaje=true
                this.disabledBoton=true
            }else{
                
                this.mensaje=''
                this.mostrarMensaje=false
                this.disabledBoton=false
            }
            return ''
        }
    },
    methods: {
        obtenerCombinacion2(){
            
            const g=this.combinacion
            console.log(g)
            const atributo1=''
            const atributo=''
            this.disponibilidad=0
            for (let i = 0; i < g.length; i++) {
                const d =g[i].atributo
                
                if(d[0].id==this.atributo_id && d[1].id===this.atributo_id2 ){
                    this.combinacion_id=g[i].id
                  return  this.disponibilidad=g[i].cantidad
               
                }

                if(d[0].id==this.atributo_id2 && d[1].id===this.atributo_id ){
                    this.combinacion_id=g[i].id
                 return   this.disponibilidad=g[i].cantidad
                }
                this.combinacion_id=''
                this.disponibilidad=0

            }

        },
        obtenerCombinacion(){

            console.log(this.atributo_id)
            
            const g=this.combinacion
            this.disponibilidad=0
            if(this.atributo_id!=''){

                for (let i = 0; i < g.length; i++) {
                    const d =g[i].atributo
                    for (let j = 0; j < d.length; j++) {
                        if(this.atributo_id==d[j].id) {
                            console.log(d[j].nombre)
                            this.disponibilidad=g[i].cantidad
                            this.combinacion_id=g[i].id
                            
                        } 
    
                    }
                }
            }else{
                this.combinacion_id=''
                this.disponibilidad=0
            }
        },
       cambiarImagen(){

           this.imagen=detalleProducto.$refs.altImagen.src
           detalleProducto.$refs.mainImagen.src=this.imagen
         
           this.imagen=''
       }

      

    },
    mounted() {
        this.slug=data.datos.slug
        
        this.tipoProducto=data.datos.tipoProducto
        
        if(this.tipoProducto=='comun'){
            this.disponibilidad=data.datos.cantidad
            if(this.disponibilidad==0){
                this.disabledBoton=true
            }
        }else{

            if(this.disponibilidad==0){
                this.disabledBoton=true
            }
        }

    }

});