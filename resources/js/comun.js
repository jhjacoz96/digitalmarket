window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('vue-multiselect', window.VueMultiselect.default)


if(document.getElementById('app')){
    const app= new Vue({
        el:'#app',
        
        
    });

}

if(document.getElementById('categoria')){
    require('./admin/categoria'); 

}

if(document.getElementById('subCategoria')){
    require('./admin/subCategoria'); 

}

if(document.getElementById('producto')){
    require('./admin/producto'); 

}

if(document.getElementById('searchAutoComplete')){
    require('./admin/searchAutoComplete'); 

}

if(document.getElementById('filtroDireccion')){
    require('./admin/filtroDireccion'); 

}

if(document.getElementById('atributos')){
    require('./admin/atributos'); 

}

if(document.getElementById('grupoAtributo')){
    require('./admin/grupoAtributo'); 

}
if(document.getElementById('login')){
    require('./autenticacion/login'); 

}

if(document.getElementById('direccion')){
    require('./admin/direccion'); 

}

if(document.getElementById('metodoEnvio')){
    require('./admin/metodoEnvio'); 

}
if(document.getElementById('metodoPago')){
    require('./admin/metodoPago'); 

}
if(document.getElementById('cupon')){
    require('./admin/cupon'); 

}


//tienda

if(document.getElementById('detalleProducto')){
    require('./shop/detalleProducto'); 

}

if(document.getElementById('checkout')){
    require('./shop/checkout'); 

}

if(document.getElementById('calificar')){
    require('./shop/calificar'); 

}










