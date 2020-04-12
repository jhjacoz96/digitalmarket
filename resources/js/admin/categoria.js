const categoria= new Vue({
    el:'#categoria',
    data:{
        nombre:'',
        slug:'',
        divMensajeSlug:'',
        divClaseSlug:'',
        divAparecer:false,
        deshabilitarBoton:1,

        selectedCategoria:'',
        selectedSubCategoria:'',
        obtenerSubCategorias:[]

    },
    computed: {
        generarSlug : function(){
            var char={
                "á":"a","é":"e","í":"i","ó":"o","ú":"u",
                "Á":"A","É":"E","Í":"I","Ó":"O","Ú":"U",
                "ñ":"n","Ñ":"n"," ":"-","_":"-"
            }
            var exp= /[áéíóúÁÉÍÓÚ_ ]/g;
            this.slug= this.nombre.trim().replace(exp,function(e){
                return char[e]
            }).toLowerCase()
            return  this.slug;
           //return this.nombre.trim().replace(/ /,'-')
        }
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
        getSubCategoria(){

            if(this.slug){
                let url='/SubCategoria/'+this.slug 
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
                this.divMensajeSlug="Debe ingresar una sub categoria"
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
        cargarSubCategorias(){
            this.selectedSubCategoria='';
            document.getElementById('subCategoria_id').disabled=true
            if(this.selectedCategoria!=''){
                let url='/obtenerCategoria/'+this.selectedCategoria
                axios.get(url).then((res)=>{
                    this.obtenerSubCategorias=res.data;
                    document.getElementById('subCategoria_id').disabled=false
                })
            }
        }
    },
    mounted() {
        if(document.getElementById('editar').innerHTML){
            this.nombre=document.getElementById('nombretemp').innerHTML
            this.deshabilitarBoton=0
        }
        
    }
    

});
