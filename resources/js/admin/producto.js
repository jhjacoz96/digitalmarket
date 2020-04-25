const producto = new Vue({
    el: '#producto',
    data: {
        nombre: '',
        slug: '',
        divMensajeSlug: '',
        divClaseSlug: '',
        divAparecer: false,
        deshabilitarBoton: 1,
        selectedCategoria: '',
        selectedCategoriaa: '',
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

        tipoProducto:'comun',
        disableCantidad:false

    },
    created() {
        axios.get('/combinacion/create').then(res => {
            this.grupos = res.data
            console.log(this.grupos)
        }).catch(e => {
            console.log(e.respose)
        })
        /*axios.get('/producto/categoria').then(res=>{
            this.categorias=res.data
        })*/
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

        },

        //combinaciones
        reset: function () {
            this.aparecer = false
            this.listaCombinacion = []
            this.atributos=[]
            return this.listaCombinacion

        }


    },
    methods: {
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

                    if (data.datos.nombre) {
                        if (data.datos.nombre === this.nombre) {
                            this.deshabilitarBoton = 0;
                            this.divMensajeSlug = ''
                            this.divClaseSlug = ''
                            this.divAparecer = false
                        }
                    }

                })
            } else {
                this.divClaseSlug = 'badge badge-danger'
                this.divMensajeSlug = "Debe ingresar una categoria"
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


                this.atributos.push(this.select)

                var r = [], elem = this.combinacion, arg = this.atributos, max = arg.length - 1

                function helper(arr, i) {



                    for (var j = 0, l = arg[i].length; j < l; j++) {
                        var a = arr.slice(0); // clone arr

                        a.push(arg[i][j]);

                        if (i == max) {
                            elem.elemento = a
                            const param = { cantidad: elem.cantidad, elemento: elem.elemento }
                            r.push(param)
                            elem.elemento = []

                        }
                        else {

                            helper(a, i + 1)

                        }
                    }
                }
                helper([], 0);
                this.combinacion.elemento = []
                this.listaCombinacion = r
                console.log(this.listaCombinacion)

            }
        }



    },
    mounted() {



        if (data.editar == 'si') {

            document.getElementById('subCategoria_id').disabled = false

            this.nombre = data.datos.nombre;
            this.precioAnterior = data.datos.precioAnterior
            this.precioActual = data.datos.precioActual
            this.porcentajeDescuento = data.datos.porcentajeDescuento
            this.selectedCategoria = data.datos.selectedCategoria

            this.selectedCategoria = document.getElementById('categoria_id').getAttribute('data-old');
            if (this.selectedCategoria != '') {
                this.cargarSubCategorias()
            }
            this.selectedSubCategoria = document.getElementById('subCategoria_id').getAttribute('data-old');




        }


        if (data.editar == 'no') {

            document.getElementById('subCategoria_id').disabled = true

            this.selectedCategoria = document.getElementById('categoria_id').getAttribute('data-old');
            if (this.selectedCategoria != '') {
                this.cargarSubCategorias()
            }
            this.selectedSubCategoria = document.getElementById('subCategoria_id').getAttribute('data-old');


        }



    }


}); 