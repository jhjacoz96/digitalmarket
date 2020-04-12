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
        obtenerSubCategorias:[],
        categorias:[],

        //Variables de precio
        precioAnterior:0,   
        precioActual:0,
        descuento:0,
        porcentajeDescuento:0,
        descuentoMensaje:'0'

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
        },

        generarDescuento:function(){


            if(this.porcentajeDescuento>100){
                 
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se pude poner un valor mayor a 100!'
                })
               
                this.porcentajeDescuento=100
                this.descuento=(this.precioAnterior*this.porcentajeDescuento)/100
                this.precioActual=(this.precioAnterior-this.descuento)
                this.descuentoMensaje='Este producto tiene un 100% de descuento, por ende es gratis'
                return this.descuentoMensaje
            }

            if(this.porcentajeDescuento<0){

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No puedes porner valores negativos!'
                })

                this.porcentajeDescuento=0
                this.descuento=(this.precioAnterior*this.porcentajeDescuento)/100
                this.precioActual=(this.precioAnterior-this.descuento)
                this.descuentoMensaje=''
                return this.descuentoMensaje
            }

            if(this.porcentajeDescuento>0){

                this.descuento=(this.precioAnterior*this.porcentajeDescuento)/100
                this.precioActual=(this.precioAnterior-this.descuento)

                if(this.porcentajeDescuento==100){
                    this.descuentoMensaje='Este producto tiene un 100% de descuento, por ende es gratis'

                }else{
                    this.descuentoMensaje='Hay un descuento de Bs'+this.descuento
                }

                return this.descuentoMensaje
            }else{

                this.descuento=''

              
                this.precioActual=this.precioAnterior

                    this.descuentoMensaje=''

                }

                return this.descuentoMensaje

            }
            

    },
    methods: {
        cagarCategoria(){
            axios.get('/categoria').then(res=>{
                this.categorias=res.data
            })
        },
        eliminarImagen(imagen){
            Swal.fire({
                title: '¿Esta seguro que desea eliminar esta imagen?',
                text: "¡No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, eliminar!'
              }).then((result) => {
                if (result.value) {

                //eliminar la imagen

                let url='/eliminarImagen/'+imagen.id
                axios.delete(url).then(res=>{
                        console.log(res.data)
                })  

                var elemento=document.getElementById('idimagen-'+imagen.id)
                elemento.parentNode.removeChild(elemento)
                

                  Swal.fire(
                    'Eliminado!',
                    'Su archivo se ha elimianda',
                    'success'
                  )
                }
              })

        },
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

                    if(data.datos.nombre){
                        if(data.datos.nombre===this.nombre ){
                            this.deshabilitarBoton=0;
                            this.divMensajeSlug=''
                            this.divClaseSlug=''
                            this.divAparecer=false
                        }
                    }
                    
                })
            }else{
                this.divClaseSlug='badge badge-danger'
                this.divMensajeSlug="Debe ingresar una categoria"
                this.deshabilitarBoton=1 
                this.divAparecer=true
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

    

        if(data.editar=='si'){

            document.getElementById('subCategoria_id').disabled=false

            this.nombre=data.datos.nombre;
            this.precioAnterior=data.datos.precioAnterior
            this.precioActual=data.datos.precioActual
            this.porcentajeDescuento=data.datos.porcentajeDescuento
            this.selectedCategoria=data.datos.selectedCategoria

            this.selectedCategoria=document.getElementById('categoria_id').getAttribute('data-old');
            if(this.selectedCategoria!=''){
                this.cargarSubCategorias()
            }
            this.selectedSubCategoria=document.getElementById('subCategoria_id').getAttribute('data-old');

          
            

        }


       if(data.editar=='no'){

        document.getElementById('subCategoria_id').disabled=true

        this.selectedCategoria=document.getElementById('categoria_id').getAttribute('data-old');
        if(this.selectedCategoria!=''){
            this.cargarSubCategorias()
        }
        this.selectedSubCategoria=document.getElementById('subCategoria_id').getAttribute('data-old');
        

       }

       
        
    }
    

}); 