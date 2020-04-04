window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);


if(document.getElementById('app')){
    const app= new Vue({
        el:'#app',
        
    });

}

if(document.getElementById('categoria')){
    require('./admin/categoria'); 

}








