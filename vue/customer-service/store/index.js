import axios from 'axios';
import { forEach } from 'lodash';
import Vuex from 'Vuex';
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
            f_name:'0000',
            l_name:'0000',
            ref:'U-000',
        },
        orders:[],
        tickets:[],
        FOrders:[],
        pickups:[],
        FPickups:[],
        FTrips:[],
        trips:[],
    },
    actions:{
        StartUp:({commit, state , getters})=>{
            commit('getItems')
        },
        SetDeliverReady:({commit, state , getters},order)=>{
            genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/dashboard/service/set-deliver-ready',
                data:{order:order}
            }).then(res => {
                genStore.commit('loading',false);
                if(res.data){commit('updateOrder',res.data)}
            })
        },
        SetReturnReady:({commit, state , getters},order)=>{
            axios({
                method:'post',
                url:'/dashboard/service/set-return-ready',
                data:{order:order}
            }).then(res => {
                if(res.data){commit('updateOrder',res.data)}
            })
        },
        SetPickupReady:({commit, state , getters},pickup)=>{
            axios({
                method:'post',
                url:'/dashboard/service/set-pickup-ready',
                data:{pickup:pickup}
            }).then(res => {
                if(res.data){commit('updatePickup',res.data)}
            })
        },
    },
    mutations:{
        getItems:(state)=>{
            axios({
                method:'post',
                url:'/dashboard/service/get-items'
            }).then(res => {
                state.orders = state.FOrders = reshapeOrders(res.data.orders);
                state.pickups = state.FPickups = reshapePickups(res.data.pickups);
                state.trips = state.FTrips = res.data.trips;
                state.tickets = res.data.tickets;
                state.user.f_name = res.data.user.f_name;
                state.user.l_name = res.data.user.l_name;
                state.user.ref = res.data.user.ref;
            })
        },
        updateOrder:(state,order)=>{
            state.FOrders.forEach(o => {
                if(order.id == o.id)(Object.assign(o,order))
            })
            state.orders.forEach(o => {
                if(order.id == o.id)(Object.assign(o,order))
            })
        },
        updatePickup:(state,order)=>{
            state.FPickups.forEach(o => {
                if(order.id == o.id)(Object.assign(o,order))
            })
            state.pickups.forEach(o => {
                if(order.id == o.id)(Object.assign(o,order))
            })
        },
        insertTicket:(state,ticket)=>{
            state.tickets.forEach(t => {
                if(t.id == ticket.id){Object.assign(t,ticket)}
            })
        }
    }
});