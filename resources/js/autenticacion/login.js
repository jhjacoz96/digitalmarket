const login= new Vue({
    el:'#login',
    data:{
        rol_id:1,
        nombre:'',
        apellido:'',
        email:'',
        password:'',
        password_confirmation:'',
        tipoRegister:'comprador',
        tipo:''
    },
    methods: {
        cambiarRegister(){
            console.log('click')
        }
      
    }

})
