import { createWebHistory, createRouter } from "vue-router";
import Welcome from '../pages/Welcome.vue';
import Profile from '../../pages/Profile.vue';
import Orders from '../pages/Orders.vue';
import Pickups from '../pages/Pickups.vue';
import Complain from '../pages/Complain.vue';
import Trips from '../pages/Trips.vue';
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
        path:'/dashboard/orders',
        component:Orders,
        name:"Orders" 
    }, 
    {
        path:'/dashboard/pickups',
        component:Pickups,
        name:"Pickups" 
    }, 
    {
        path:'/dashboard/trips',
        component:Trips,
        name:"Trips"
    }, 
    {
        path:'/dashboard/tickets',
        component:Complain,
        name:"Tickets" 
    }, 
]
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;