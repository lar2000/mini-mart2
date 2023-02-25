 import { createApp } from "vue";
 import App from "./App.vue";
 import router from "./router";
 import axios from "axios";
 import Cleave from 'vue-cleave-component';

 import StoreWidget from "./components/StoreWidget.vue";
 import Pagination from "./components/Pagination.vue";

 import VueSweetalert2 from 'vue-sweetalert2';
 import 'sweetalert2/dist/sweetalert2.min.css';

 require('./bootstrap');

 const app = createApp(App);
 app.config.globalProperties.$axios = axios;
 app.component('storewedgit',StoreWidget);
 app.component('pagination',Pagination);
 app.use(router);
 app.use(Cleave);
 app.use(VueSweetalert2);
 app.mount("#app-vue");