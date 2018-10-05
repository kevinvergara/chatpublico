
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    created(){
        Echo.channel('channel-chatpublico')
            .listen('.newMessage', (e) => {
                var user = e["user"];
                var message = e["message"];
                var mensaje_mostrar = "el usuario "+user+" comento el post #"+message;
                var toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });
                  
                toast({
                    type: 'success',
                    title: mensaje_mostrar
                });
            });
    }
});
