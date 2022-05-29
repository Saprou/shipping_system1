import axios from 'axios';
import { forEach } from 'lodash';
import Vuex from 'vuex';
import genStore from '../../store/index';


function reshapeOrders(orders){
    orders.forEach(order => {
        order.selected = false;
    });
    return orders;
}
function reshapePickups(orders){
    orders.forEach(order => {
        order.selected = false;
    });
    return orders;
}
export default new Vuex.Store({
    state:{
        user:{
            f_name:'null',
            l_name:'null',
            mobile:'null',
            sec_mobile:'null',
            ref:'null',
            email:'null',
            locations:[],
            contacts:[],
            role:'seller',
        },
        orders:[],
        FOrders:[],
        pickups:[],
        FPickups:[],
    },
    actions:{
        StartUp:({commit, state , getters})=>{
            commit('getItems')
        }
    },
    mutations:{
        getItems:(state)=>{
            genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/dashboard/seller/get-items'
            }).then(res => {
                state.orders = state.FOrders =reshapeOrders(res.data.orders);
                state.pickups = state.FPickups =reshapePickups(res.data.pickups);
                state.user.locations =res.data.locations;
                state.user.contacts =res.data.contacts;
                state.user.f_name = res.data.user.f_name;
                state.user.l_name = res.data.user.l_name;
                state.user.email = res.data.user.email;
                state.user.mobile = res.data.user.mobile;
                state.user.sec_mobile = res.data.user.sec_mobile;
                state.user.ref = res.data.user.ref;
            }).then(()=>{
                genStore.commit('loading',false);
            })
        },
        unshiftOrder:(state,order)=>{
            order.selected = false;
            state.FOrders.unshift(order);
        },
        unshiftPickup:(state,pickup)=>{
            pickup.selected = false;
            state.pickups.unshift(pickup);
        },
        updateOrder:(state,order)=>{
            state.FOrders.forEach(o => {
                if(order.id == o.id)(Object.assign(o,order))
            })
            state.orders.forEach(o => {
                if(order.id == o.id)(Object.assign(o,order))
            })
        },
        updateOrders:(state,orders)=>{
            orders = reshapeOrders(orders)
            state.FOrders.forEach(o => {
                orders.forEach(order => {
                    if(order.id == o.id)(Object.assign(o,order))
                })
            })
            state.orders.forEach(o => {
                orders.forEach(order => {
                    if(order.id == o.id)(Object.assign(o,order))
                })
            })
        },
        unshiftLocation:(state,location)=>{
            state.user.locations.unshift(location)
        },
        unshiftContact:(state,contact)=>{
            state.user.contacts.unshift(contact)
        }

        
    }
});