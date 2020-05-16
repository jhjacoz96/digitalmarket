const cupon= new Vue({
    el:'#cupon',
    data:{
       codigo:'',
        tipoCupon:'',
        tipoCantidad:'',
        cantidad:''
    },
    computed: {
        generarCantidad: function(){
            if(this.tipoCupon=='Porcentaje'){

                if(this.cantidad>100){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'No se pude poner un valor mayor a 100!'
                    })    
                    this.cantidad=100
                    
                }
                if(this.cantidad<0){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'No se pude poner un valor menor a 0!'
                    })    
                    this.cantidad=0
                }
            }
           return ''
        }
    },
    methods: {
        generarCodigo(){
            this.codigo=''
            this.codigo= Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            return this.codigo

        },
        obtenerTipoCupon(){
            if(this.tipoCupon=='Porcentaje'){
               this.tipoCantidad='Porcentaje'
                this.cantidad=0



            }else{
                this.tipoCantidad='Monto fijo'
                this.cantidad=0
            }
            console.log(this.tipoCupon)
        }
       
    },
    mounted(){
        if(data.editar=='si'){
            this.cantidad=data.datos.cantidad
            this.tipoCupon=data.datos.tipoCupon
            console.log(this.tipoCupon)
            if(this.tipoCupon=='Porcentaje'){
                this.tipoCantidad='Porcentaje'
            }else{
                this.tipoCantidad='Monto fijo'
            }
        }
    }
});