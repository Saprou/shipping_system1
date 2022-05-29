import axios from 'axios';
import { forEach } from 'lodash';
import Vuex from 'vuex';

export default new Vuex.Store({
    state:{
        user:{
            name:'null',
            role:'null',
        },
        users:[],
        FUsers:[],
        orders:[],
        FOrders:[],
        pickups:[],
        FPickups:[],
        couriers:[],
        sellers:[],
        FSellers:[],
        trips:[],
        FTrips:[]
    },
    actions:{
        StartUp:({commit, state , getters})=>{
            commit('getItems')
        },
        setTripCash:({commit, state , getters},trip)=>{
            axios({
                method:'post',
                url:'/dashboard/accountant/set-trip-cash',
                data:{
                    trip:trip
                }
            }).then(res => {
                commit('insertTrip',res.data)
            })
        },
    },
    mutations:{
        getItems:(state)=>{
            axios({
                method:'post',
                url:'/dashboard/admin/get-items'
            }).then(res => {
                state.users = res.data.users;
                state.couriers = res.data.couriers;
                state.orders = state.FOrders = res.data.orders;
                state.pickups = state.FPickups = res.data.pickups;
                state.sellers = state.FSellers = res.data.sellers;
                state.trips = state.FTrips = res.data.trips;
                state.user = res.data.user;
            })
        },
        updateUser:(state , user)=>{
            state.users.forEach(u => {
                if(u.id == user.id)(Object.assign(u,user));
            })
        },
        updateCourier:(state , courier)=>{
            state.couriers.forEach(u => {
                if(u.id == courier.id)(Object.assign(u,courier));
            })
        },
        unshiftUser:(state , user)=>{
            state.users.unshift(user);
        },
        unshiftCourier:(state , courier)=>{
            state.couriers.unshift(courier);
        },
        insertOrder:(state,order) => {
            state.orders.forEach(o => {
                    if(o.id == order.id){Object.assign(o,order)}
            })
        },
        insertPickup:(state,order) => {
            state.pickups.forEach(o => {
                    if(o.id == order.id){Object.assign(o,order)}
            })
        },
        insertSeller:(state,seller) => {
            state.sellers.forEach(s => {
                if(s.id == seller.id){Object.assign(s,seller);}
            })
        },
        insertTrip:(state,trip)=>{
            state.trips.forEach(t => {
                if(t.id == trip.id)(Object.assign(t,trip))
            })
        }
    }
});