import { createWebHistory, createRouter } from "vue-router";
import Welcome from '../pages/Welcome.vue';
import Users from '../pages/Users.vue';
import Couriers from '../pages/Couriers.vue';
import Orders from '../pages/Orders.vue';
import Pickups from '../pages/Pickups.vue';
import Sellers from '../pages/Sellers.vue';
import Profile from '../../pages/Profile.vue';
import Trips from '../pages/Trips.vue';
import Actions from '../pages/Actions.vue';
import Settings from '../pages/Settings.vue';


const routes =[
    {
        path:'/dashboard',
        component:Welcome,
        name:"Welcome"
    },
    {
        path:'/dashboard/profile',
        component:Profile,
        name:"Profile"
    }, 
    {
        path:'/dashboard/users',
        component:Users,
        name:"Users"
    },
    {
        path:'/dashboard/couriers',
        component:Couriers,
        name:"Couriers"
    },
    {
        path:'/dashboard/trips',
        component:Trips,
        name:"Trips"
    },
    {
        path:'/dashboard/sellers',
        component:Sellers,
        name:"Sellers"
    },
    {
        path:'/dashboard/pickups',
        component:Pickups,
        name:"Pickups"
    },
    {
        path:'/dashboard/orders',
        component:Orders,
        name:"Orders"
    },
    {
        path:'/dashboard/actions',
        component:Actions,
        name:"Actions"
    },
    {
        path:'/dashboard/settings',
        component:Settings,
        name:"Settings"
    },
]
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;