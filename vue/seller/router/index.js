import { createWebHistory, createRouter } from "vue-router";
import Welcome from '../pages/Welcome.vue';
import Orders from '../pages/Orders.vue';
import Pickups from '../pages/Pickups.vue';
import Profile from '../../pages/Profile.vue';
import Complain from '../pages/Complain.vue';
import CreateOrder from '../pages/Create Order/Create-Order.vue';
import Deliver from '../pages/Create Order/Deliver.vue';
import Return from '../pages/Create Order/Return.vue';
import Exchange from '../pages/Create Order/Exchange.vue';
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
        path:'/dashboard/complain',
        component:Complain,
        name:"Complain"
    },  
    {
        path:'/dashboard/create-order',
        component:CreateOrder,
        name:"",
        children:[
            {
                path:'/dashboard/create-order',
                redirect:'/dashboard/create-order/deliver'
            },
            {
                path:'/dashboard/create-order/deliver',
                component:Deliver,
                name:"Create Deliver"
            },
            {
                path:'/dashboard/create-order/exchange',
                component:Exchange,
                name:"Create Exchange"
            },
            {
                path:'/dashboard/create-order/return',
                component:Return,
                name:"Create Return"
            },
        ]
    },  
]
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;