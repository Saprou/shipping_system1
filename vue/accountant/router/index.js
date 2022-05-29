import { createWebHistory, createRouter } from "vue-router";
import Welcome from '../Pages/Welcome.vue';
import Profile from '../../pages/Profile.vue';
import Seller from '../Pages/Seller.vue';
import Trips from '../Pages/Orders.vue';
import Orders from '../Pages/Orders.vue';
const routes =[
    {
        path:'/dashboard',
        component:Welcome,
        name:""
    },  
    {
        path:'/dashboard/profile',
        component:Profile,
        name:"Profile"
    },  
    {
        path:'/dashboard/sellers',
        component:Seller,
        name:"Seller",
    },  
    {
        path:'/dashboard/trips',
        component:Trips,
        name:"Trips"
    },    
    {
        path:'/dashboard/orders',
        component:Orders,
        name:"Orders"
    },    
]
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;