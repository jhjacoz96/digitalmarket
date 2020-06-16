const producto = new Vue({
    el: '#producto',
    data: {
        rol:'',
        tiendas:[],
        tienda:'',
        nombre: '',
        slug: '',
        tipoProducto:'',
        divMensajeSlug: '',
        divClaseSlug: '',
        divAparecer: false,
        deshabilitarBoton: 1,
        selectedCategoria: '',
        selectedSubCategoria: '',
        obtenerSubCategorias: [],
        categorias: [],
    
        //Variables de precio
        precioAnterior: 0,
        precioActual: 0,
        descuento: 0,
        porcentajeDescuento: 0,
        descuentoMensaje: '0',

        

        //convinaciones
        grupos:[],
        value: [],
        aparecer: false,
        select: [],
        item: [],
        combinacion: {
            
            cantidad: 0,
            elemento: []
        },
        atributos: [],
        listaCombinacion: [],
        listaCombinacion2: [],

        tipoProducto:'',
        disableCantidad:false,

        //diarCombinacion
        editarActivo:false,


        //TIENDa
        divMensajeTienda: '',
        divClaseTienda: '',
        divAparecerTienda: false

    },
    created() {

        axios.get('/producto/categoria').then(res=>{
            this.categorias=res.data
           
        }).catch(e=>{
            console.log(e.respose)
        })
        
        if(data.datos.tienda_id){
            
            axios.get(`/buscarGrupos/${data.datos.tienda_id}`).then(res => {

                this.grupos = res.data

            }).catch(e => {
                console.log(e.respose)
            })
        }
        
        if(data.editar=='si'){

            if(data.datos.tipoCliente=='combinacion'){
                axios.get(`/combinacion/${data.datos.id}/edit`).then(res=>{
                    this.listaCombinacion2=res.data
                    //console.log(this.listaCombinacion2)
                }).catch(e=>{
                    console.log(e.respose)
                })
            }

        }
        
    
        
        
    },
    computed: {
        generarSlug: function () {
            var char = {
                "á": "a", "é": "e", "í": "i", "ó": "o", "ú": "u",
                "Á": "A", "É": "E", "Í": "I", "Ó": "O", "Ú": "U",
                "ñ": "n", "Ñ": "n", " ": "-", "_": "-"
            }
            var exp = /[áéíóúÁÉÍÓÚ_ ]/g;
            this.slug = this.nombre.trim().replace(exp, function (e) {
                return char[e]
            }).toLowerCase()
            return this.slug;
            //return this.nombre.trim().replace(/ /,'-')
        },

        generarDescuento: function () {


            if (this.porcentajeDescuento > 100) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'No se pude poner un valor mayor a 100!'
                })

                this.porcentajeDescuento = 100
                this.descuento = (this.precioAnterior * this.porcentajeDescuento) / 100
                this.precioActual = (this.precioAnterior - this.descuento)
                this.descuentoMensaje = 'Este producto tiene un 100% de descuento, por ende es gratis'
                return this.descuentoMensaje
            }

            if (this.porcentajeDescuento < 0) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No puedes porner valores negativos!'
                })

                this.porcentajeDescuento = 0
                this.descuento = (this.precioAnterior * this.porcentajeDescuento) / 100
                this.precioActual = (this.precioAnterior - this.descuento)
                this.descuentoMensaje = ''
                return this.descuentoMensaje
            }

            if (this.porcentajeDescuento > 0) {

                this.descuento = (this.precioAnterior * this.porcentajeDescuento) / 100
                this.precioActual = (this.precioAnterior - this.descuento)

                if (this.porcentajeDescuento == 100) {
                    this.descuentoMensaje = 'Este producto tiene un 100% de descuento, por ende es gratis'

                } else {
                    this.descuentoMensaje = 'Hay un descuento de Bs' + this.descuento
                }

                return this.descuentoMensaje
            } else {

                this.descuento = ''


                this.precioActual = this.precioAnterior

                this.descuentoMensaje = ''

            }

            return this.descuentoMensaje

        }

        //combinaciones
        


    },
    methods: {
        reset: function () {
            this.aparecer = false
            this.listaCombinacion = []
            this.atributos=[]
            return this.listaCombinacion

        },
        tipoProd: function(){
            if(document.getElementById('customRadio1').checked){
                document.getElementById('customRadio1').checked=true
                this.tipoProducto='comun'
                this.disableCantidad=false
                
                return this.tipoProducto
            }

            if( document.getElementById('customRadio2').checked){
                document.getElementById('customRadio2').checked=true
                this.tipoProducto='combinacion'
                this.disableCantidad=true
                return this.tipoProducto
            }
        },
        eliminarImagen(imagen) {
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

                    let url = '/eliminarImagen/' + imagen.id
                    axios.delete(url).then(res => {
                        console.log(res.data)
                    })

                    var elemento = document.getElementById('idimagen-' + imagen.id)
                    elemento.parentNode.removeChild(elemento)


                    Swal.fire(
                        'Eliminado!',
                        'Su archivo se ha elimianda',
                        'success'
                    )
                }
            })

        },
        getProducto() {

            if (this.slug) {
                let url = '/producto/' + this.slug
                axios.get(url).then(res => {
                    this.divMensajeSlug = res.data

                    if (this.divMensajeSlug == "Slug disponible") {
                        this.divClaseSlug = 'badge badge-success'
                        this.deshabilitarBoton = 0
                    } else {
                        this.divClaseSlug = 'badge badge-danger'
                        this.deshabilitarBoton = 1
                    }
                    this.divAparecer = true

                    if(data.editar=='si'){
                        if (data.datos.slug) {
                            if (data.datos.slug === this.slug) {
                                this.deshabilitarBoton = 0;
                                this.divMensajeSlug = ''
                                this.divClaseSlug = ''
                                this.divAparecer = false
                            }
                        }
                    }

                })
            } else {
                this.divClaseSlug = 'badge badge-danger'
                this.divMensajeSlug = "Debe ingresar un nombre de producto"
                this.deshabilitarBoton = 1
                this.divAparecer = true
            }


        },
        cargarSubCategorias() {

            this.selectedSubCategoria = '';
            document.getElementById('subCategoria_id').disabled = true
            if (this.selectedCategoria != '') {
                let url = '/obtenerCategoria/' + this.selectedCategoria
                axios.get(url).then((res) => {
                    this.obtenerSubCategorias = res.data;

                    if(data.editar=='si'){
                        this.selectedSubCategoria=data.datos.selectedSubCategoria
                    }

                    document.getElementById('subCategoria_id').disabled = false
                })
            }

        },

        //combinaciones
        convertir: function () {
            this.value = JSON.stringify(this.listaCombinacion)
            console.log(this.value)
            return this.value
        },
        eliminarCombinacion(items, index) {
            Swal.fire({
                title: '¿Esta seguro que desea eliminar esta combinación?',
                text: "¡No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.value) {

                    this.listaCombinacion.splice(index, 1)
                   
                    

                    Swal.fire(
                        'Eliminado!',
                        'Su combinación  se ha elimiando',
                        'success'
                    )
                }
            })

        },
        eliminarCombinacionDB(item, index) {
            Swal.fire({
                title: '¿Esta seguro que desea eliminar esta combinación?',
                text: "¡Se eliminará de sus registros!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.value) {

                    //this.listaCombinacion2.splice(index, 1)
                    axios.delete(`/combinacion/${item.id}`).then((res)=>{
                        if(res.data=='activo'){

                            Swal.fire(
                                'No puede eliminar una combinacion de un producto activo',
                                'Su combinación no se ha elimiando',
                                'warning'
                            )

                        }else{

                            Swal.fire(
                                'Eliminado!',
                                'Su combinación  se ha elimiando',
                                'success'
                            )

                        }
                    }).catch(e=>{
                        console.log(es.respose)
                    })

                    
                }
            })

        },
         
        addTag(newTag) {
            const tag={
                name:newTag,
                id:newTag,
                
            }
            this.options.push(tag)
            this.select.push(tag)
        },

        generarLista() {


            const f = this.select
            if (f.length == 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Debe seleccionar almenos un atributo!'
                })
            } else {
                
                if(this.atributos.length!=0){
                    for (let i = 0; i < this.atributos.length; i++) {
                         if(this.atributos[i]==this.select){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Ya ha seleccionado estos atributos!'
                            })
                         }
                        
                    }
                    
                }


                /* var result=this.select.reduce((h,grupo)=>Object.assign(h,{[grupo.grupoAtributo_id]:(h[grupo.gruAtributo_id]|| []).concat({id:grupo.id,nombre:grupo.nombre,grupoAtributo_id:grupo.grupoAtributo_id})}),{})
                console.log(JSON.stringify(result))*/
                

                this.select.sort(function (a, b) {
                    return (a.grupoAtributo_id - b.grupoAtributo_id)
                })
                
                this.atributos=[]


                const t=this.select
                for (i = 0; i < t.length; i++) {
                    select = t[i];
                    var grupoAct;
                    var grupo = [];

                    if (grupoAct !== select.grupoAtributo_id) {
                        grupoAct = select.grupoAtributo_id;
                        grupo = t.filter(grupo => grupo.grupoAtributo_id === grupoAct);
                        this.atributos.push(grupo);
                    }
                }


                this.aparecer = true
                //this.atributos=[]

                

                //console.log(this.grupos)
                //esta funcionalidad recorre todos los grupos y exrae los aatrbutos de cada grupo
                /*var d=this.grupos, items=[], para={id:'',nombre:''} 
            
                for (let i = 0; i < d.length; i++) {

                    var r=d[i].atributo
                    for (let f = 0; f < r.length; f++) {
                        //const element = array[index];
                        para={id:r[f].id,
                        nombre:r[f].nombre}
                        
                        items.push(para)
                        para=para={id:'',nombre:''}
                    }
                    //console.log(items)
                    
                    this.atributos.push(items)
                    items=[]
                    
                }*/
                // console.log(this.atributos)


                /*this.atributos.push(this.grupo.selectAtributos)
                console.log(this.grupos)
                this.grupo.nombre=''
                this.grupo.selectAtributos=[]*/


                //this.atributos.push(this.select)
                //this.select=[]
                console.log(this.atributos)
                var r = [], elem = this.combinacion, arg = this.atributos, max = arg.length - 1,o=this.listaCombinacion

                function helper(arr, i) {



                    for (var j = 0, l = arg[i].length; j < l; j++) {
                        var a = arr.slice(0); // clone arr

                        a.push(arg[i][j]);

                        if (i == max) {
                            elem.elemento = a
                            const param = { cantidad: elem.cantidad, elemento: elem.elemento }
                            o.push(param)
                            elem.elemento = []

                        }
                        else {

                            helper(a, i + 1)

                        }
                    }
                }
                helper([], 0);
                this.combinacion.elemento = []
                //this.listaCombinacion = JSON.stringify(r)
                //this.listaCombinacion=r
                this.select=[]

                
               

            }
        },
        editarCombinacion(items){
            this.editarActivo=true
            this.combinacion.cantidad=items.cantidad
            this.combinacion.id=items.id
            console.log(this.combinacion)
        },

        actualizarCombinacion(combinacion){
             const param={cantidad:combinacion.cantidad}
            axios.put(`/combinacion/${combinacion.id}`,param).then(res=>{
                console.log(res.data)
                if(res.data==9569) {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Exede el stock maximo que le ofrece el plan de afiliación al que esta afiliado!'
                    })

                }else{

                    const index=this.listaCombinacion2.findIndex(combinacionBuscar=>combinacionBuscar.id===res.data.id )
                    this.listaCombinacion2[index].cantidad = res.data.cantidad
                    this.combinacion={cantidad:''}
    
                    axios.get(`/combinacion/${data.datos.id}/edit`).then(res=>{
                        this.listaCombinacion2=res.data
                        console.log(this.listaCombinacion2)
                    }).catch(e=>{
                        console.log(e.respose)
                    })
                } 


            }).catch(e=>{
                console.log(e)
            })
        },

        obtenerTienda(){
            if(this.tienda!=''){
                axios.get('/obtenerTienda/'+this.tienda).then(res=>{
                   
                    
                    if(res.data=='No hay registros de esta tienda'){
                        
                        this.divMensajeTienda='No hay registros de esta tienda'
                        this.divClaseTienda='badge badge-danger'
                        this.aparecerTienda==true
                        this.deshabilitarBoton=1
                        this.grupos=[]
                        this.listaCombinacion=[]
                        this.value=[]
                    }else{
                        this.divMensajeTienda=res.data.nombreTienda
                        this.divClaseTienda='badge badge-info'
                        this.aparecerTienda==true
                        this.deshabilitarBoton=0
                        this.tiendas=res.data

                       
                        
                       this.grupos=[]
                        this.listaCombinacion=[]
                        this.value=[]
                        axios.get(`/buscarGrupos/${this.tiendas.id}`).then(res => {

                            this.grupos = res.data
                            
                        }).catch(e => {
                            console.log(e.respose)
                        })


                    }
                    
                }).catch(e=>{
                    console.log(e.response)
                })

                

            }else{
                this.divMensajeTienda='Debe indicar un código valido'
                this.divClaseTienda='badge badge-danger'
                this.aparecerTienda=true
                this.deshabilitarBoton=1

               this.grupos=[]
                        this.listaCombinacion=[]
                        this.value=[]
            }


        }

    },
    mounted() {

        

        if (data.editar == 'si') {

          

            this.nombre = data.datos.nombre;
            this.precioAnterior = data.datos.precioAnterior
            this.precioActual = data.datos.precioActual
            this.porcentajeDescuento = data.datos.porcentajeDescuento
            
            
            this.selectedCategoria=data.datos.selectedCategoria
            
            
          
            if (this.selectedCategoria != '') {
                this.cargarSubCategorias()
            }

          
            if(data.datos.tipoCliente=='combinacion'){
                document.getElementById('customRadio2').checked=true
                
                this.tipoProducto='combinacion'
            
            }else{
                
                document.getElementById('customRadio1').checked=true
                this.tipoProducto='comun'
            }
            

           //this.selectedCategoria = document.getElementById('categoria_id').getAttribute('data-old');
            
        this.selectedSubCategoria = document.getElementById('subCategoria_id').getAttribute('data-old');




        }


        if (data.editar == 'no') {
            
            document.getElementById('subCategoria_id').disabled = true

            //this.selectedCategoria = document.getElementById('categoria_id').getAttribute('data-old');
            if (this.selectedCategoria != '') {
                this.cargarSubCategorias()
            }
            this.selectedSubCategoria = document.getElementById('subCategoria_id').getAttribute('data-old');


        }



    }


}); 