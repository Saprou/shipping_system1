import { createWebHistory, createRouter } from "vue-router";
import Welcome from '../pages/Welcome.vue';
import Profile from '../../pages/Profile.vue';
import Orders from '../pages/Orders.vue';
import Pickups from '../pages/Pickups.vue';
import Trips from '../pages/Trips.vue';
import Tickets from '../pages/Tickets.vue';
const routes =[
    {
        path:'/dashboard',
        component:Welcome,
        name:"Welcome"
    },  
    {
        path:'/dashboard/trips',
        component:Trips,
        name:"Trips"
    },  
    {
        path:'/dashboard/profile',
        component:Profile,
        name:"Profile"
    },  
    {
        path:'/dashboard/tickets',
        component:Tickets,
        name:"Tickets"
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
]
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;