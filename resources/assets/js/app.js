
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

Vue.component('categoriaplatillo', require('./components/CategoriaPlatillo.vue'));
Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('articulo', require('./components/Articulo.vue'));
Vue.component('mesa', require('./components/Mesa.vue'));
Vue.component('platillo', require('./components/Platillo.vue'));
Vue.component('cliente', require('./components/Cliente.vue'));
Vue.component('empleado', require('./components/Empleado.vue'));
Vue.component('proveedor', require('./components/Proveedor.vue'));
Vue.component('rol', require('./components/Roles.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('ingreso', require('./components/Ingreso.vue'));
//Vue.component('pedido', require('./components/Pedido.vue'));
const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});