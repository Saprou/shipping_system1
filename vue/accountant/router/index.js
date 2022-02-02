import { createWebHistory, createRouter } from "vue-router";
import Welcome from '../pages/Welcome.vue';
import Profile from '../../pages/Profile.vue';
import Seller from '../pages/Seller.vue';
import Trips from '../pages/Trips.vue';
import Orders from '../pages/Orders.vue';
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