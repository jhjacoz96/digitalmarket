const detalleProducto= new Vue({
    el:'#detalleProducto',
    data:{
        tipoProducto:'',
      grupos:[],
        disponibilidad:0,
        cantidad:1,
      combinacion:[],
      grupoCombinacion:[],
        disabledBoton:false,
        mensaje:'',
        mostrarMensaje:false,
      slug:'',
      imagen:'',
      select:[]


    },
    created() {
        axios.get('/combinacion/create').then(res=>{
            this.grupos=res.data
            console.log(this.grupos)
        }).catch(e=>{
            console.log(e.response)
        })

        axios.get('/obtenerGrupo/'+data.datos.slug).then(res=>{
            
            this.grupoCombinacion=res.data
            console.log(this.grupoCombinacion)
        }).catch(e=>{
            console.log(e.response)
        })

       /* axios.get('obtenerCombinacion/'+this.slug).then(res=>{
            this.combinacion=res.data
           // console.log(this.combinacion)
        }).catch(e=>{
            console.log(e.response)
        })*/

        



        
    },
    computed: {
        
    },
    methods: {
       cambiarImagen(){

           this.imagen=detalleProducto.$refs.altImagen.src
           detalleProducto.$refs.mainImagen.src=this.imagen
           console.log(this.imagen)
           this.imagen=''
       },

       validarCantidad(){
        if(this.cantidad>this.disponibilidad){
            this.mensaje='Esta cantidad no esta disponible'
            this.mostrarMensaje=true
        }

       }

    },
    mounted() {
        this.slug=data.datos.slug
        this.disponibilidad=data.datos.cantidad
        this.tipoProducto=data.datos.tipoProducto

        if(this.tipoProducto=='comun'){
            if(this.disponibilidad==0){
                this.disabledBoton=true
            }
        }

    }

});