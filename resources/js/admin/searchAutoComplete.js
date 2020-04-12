const searchAutoComplete= new Vue({
    el:'#searchAutoComplete',
    data:{
        palabraBuscar:'',
        resultados:[],

        

    },
    
    methods: {
       autoComplete(){
           this.resultados=[];

            if(this.palabraBuscar.length>2){
                axios.get('/autoComplete/',{params:{palabraBuscar:this.palabraBuscar}}).then(res=>{
                    this.resultados=res.data;
                    console.log(res.data);
                }) 
            }   

       },
       submitForm(){
           this.$refs.submitButtonSearch.click()
           console.log('estyo ejecutando el submit')     

       },

     /*  select(resultado){
        this.palabraBuscar=resultado.nombre
        this.$nextTick(()=>{
            this.submitForm()
        })

        this.submitForm()
       },*/
       async select(resultado){
        this.palabraBuscar=resultado.nombre
        
        await this.$nextTick()
        
        this.submitForm()

       }
    }
    

}); 