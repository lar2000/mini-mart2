import {createWebHistory, createRouter} from "vue-router";

import Store from "../Pages/Store.vue"
import Pos from "../Pages/Pos.vue"
import Home from "../Pages/Home.vue"

export const routes = [
    {
        name: "store",
        path: "/store",
        component: Store
    },
    {
        name: "pos",
        path: "/pos",
        component: Pos
    },
    {
        name: "Home",
        path: "/",
        component: Home
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior(){
        window.scrollTo(0,0);
    }
});

export default router;