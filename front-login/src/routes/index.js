
import { createRouter, createWebHashHistory } from "vue-router";

import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import Home from "../components/Home.vue";
import Dashboard from "../components/Dashboard.vue";

const routes = [{
    
    path: '/register',
    name: 'register',
    component: Register,
}, 
{
    path: '/login',
    name: 'login',   
    component: Login,
    
},
 {
    path: '/',
    name: 'home',   
    component: Home,
 },
 {
    path: '/dashboard',
    name: 'dashboard',   
    component: Dashboard,
 }
];
const router = createRouter({
    history: createWebHashHistory(),
    routes,
  });
  export default router;