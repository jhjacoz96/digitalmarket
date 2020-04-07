const producto= new Vue({
    el:'#producto',
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
        getProducto(){

            if(this.slug){
                let url='/producto/'+this.slug 
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
                ()
            }
        },
        cargarSubCategorias(){
            this.selectedSubCategoria='';
            document.getElementById('subCategoria_id').disabled=false
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
       /*if(document.getElementById('editar').innerHTML){
            this.nombre=document.getElementById('nombretemp').innerHTML
            this.deshabilitarBoton=0
        }*/
        document.getElementById('subCategoria_id').disabled=true


        this.selectedCategoria=document.getElementById('categoria_id').getAttribute('data-old');
        if(this.selectedCategoria!=''){
            this.cargarSubCategorias()
        }
        this.selectedSubCategoria=document.getElementById('subCategoria_id').getAttribute('data-old');
        
        
    }
    

}); 