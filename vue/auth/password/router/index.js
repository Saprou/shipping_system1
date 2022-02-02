import { createWebHistory, createRouter } from "vue-router";
import Password from '../Password.vue';

const routes =[
    {
        path:'/password/reset',
        component:Password,
        name:"Password-Reset"
    },    
]
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;