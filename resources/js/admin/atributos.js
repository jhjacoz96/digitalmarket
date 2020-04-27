      var atributos= new Vue({
    
        el:'#atributos',
        data:{
            hola:'fff',
            grupos:[],
            grupo:{
                nombre:'',
                selectAtributos:[]
            },
            atributo:'',
            
            com:{
                id:'',
                nombre:''
            },
            
            selected:null,
            value:[],
            
            //combinaciones
            aparecer:false,
            select:[],
            item:[],
            combinacion:{
                cantidad:0,
                atributo:[]
            },
            atributos:[],
            listaCombinacion:[]

        },
       
        created() {
            axios.get('/combinacion/create').then(res=>{
                this.grupos=res.data
                //console.log(this.grupos)
            }).catch(e=>{
                console.log(e.respose)
            })

            axios.get('/atributo/create').then(res=>{
                this.listaCombinacion=res.data
                
            }).catch(e=>{
                console.log(e.respose)
            })

            
            
        },
        mounted() {
            if(data.editar=='si'){
                this.aparecer=true
                
            }
        },
        computed: {
           reset:function(){
               this.aparecer=false
               this.listaCombinacion=[]
               return this.listaCombinacion
  
            }
           
            
        },
        methods: {
            convertir:function(){
                this.value=JSON.stringify(this.listaCombinacion)
                console.log(this.value)
                return this.value
            },
            eliminarCombinacion(items,index){
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
                        
                        if(data.editar=='no'){
                            this.listaCombinacion.splice(index,1)
                        }
                        
                        if(data.editar=='si'){
                            axios.delete(`/combinacion/${item.id}`).then(()=>{
                
                                this.grupos.splice(index,1)
                                
                                
            
                            }).catch(e=>{
                                console.log(e.respose)
                            })
            
                           this.generarLista()
                        }
    
                      Swal.fire(
                        'Eliminado!',
                        'Su combinación  se ha elimiando',
                        'success'
                      )
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
            agregar(){
                
                
                const param={nombre:this.grupo.nombre,atributos:this.grupo.selectAtributos}
                    
                axios.post('/combinacion',param).then((res)=>{
                    console.log(res.data)
                    this.grupos.push(res.data)

                    this.grupo.nombre=''
                     this.grupo.selectAtributos=[]
                
                     this.generarLista()

                }).catch(e=>{
                    console.log(e.response)
                })

                
                
                
                
                
            },
            eliminarGrupo(item,index){
                
                axios.delete(`/combinacion/${item.id}`).then(()=>{
                
                    this.grupos.splice(index,1)
                    
                    

                }).catch(e=>{
                    console.log(e.respose)
                })

               this.generarLista()

            },
            agregarAtributo(){
                var atributo=this.atributo

                this.grupo.selectAtributos.push(atributo)
                this.atributo=''

            },
            generarLista(){
                
                const f=this.select
                if(f.length==0){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Debe seleccionar almenos un atributo!'
                    })
                }else
                    {

                    

                        
                        
                        this.aparecer=true
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

                    var r = [], elem=this.combinacion, arg = this.atributos, max = arg.length - 1,o=this.listaCombinacion
                    
                    function helper(arr, i) {

                            
                    
                        for (var j = 0, l = arg[i].length; j < l; j++) {
                            var a = arr.slice(0); // clone arr
                            
                            a.push(arg[i][j]); 
                            
                            if (i == max){
                                elem.atributo=a
                                const param={cantidad:elem.cantidad,atributo:elem.atributo}
                                r.push(param)
                                
                                elem.atributo=[]

                            }
                            else{

                                helper(a, i + 1)
                                
                            }
                        }
                    }
                helper([], 0);
               
                    this.listaCombinacion=r
                
                
                console.log(this.listaCombinacion)                
                
                }  
            },

            guardar(){
                axios.post('/combinacion/atributos',this.listaCombinacion).then(res=>{
                    console.log(res)
                }).catch(e=>{
                    console.log(e)
                })
            } 
            
        }
    })

