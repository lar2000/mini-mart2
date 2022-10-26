import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import axios from "axios";
import Cleave from 'vue-cleave-component';

import StoreWidget from "./components/StoreWidget.vue"

require('./bootstrap');

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.component('storewedgit',StoreWidget);
app.use(router);
app.use(Cleave);
app.mount("#app-vue");