import axios from 'axios';
import Vuex from 'Vuex';
import genStore from '../../store/index';

function reshapeOrders(orders){
    orders.forEach(order => {
        order.selected = false;
    });
    return orders;
}
function reshapeTrips(orders){
    orders.forEach(order => {
        order.cash_input = false;
        order.selected = false;
    });
    return orders;
}
export default new Vuex.Store({
    state:{
        user:{
            name:'null',
            name:'null',
        },
        orders:[],
        FOrders:[],
        FTrips:[],
        trips:[],
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
        collectOrders:({commit, state , getters},orders)=>{
            genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/dashboard/accountant/collect-orders',
                data:{orders:orders}
            }).then(res =>{
                commit('insertOrders',res.data);
            }).then(()=>{
                genStore.commit('loading',false);
            })
        },
        payOrders:({commit, state , getters},orders)=>{
            genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/dashboard/accountant/pay-orders',
                data:{orders:orders}
            }).then(res =>{
                commit('insertOrders',res.data);
            }).then(()=>{
                genStore.commit('loading',false);
            })
        }
    },
    mutations:{
        getItems:(state)=>{
            genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/dashboard/accountant/get-data'
            }).then(res => {
                state.trips = state.FTrips = reshapeTrips(res.data.trips);
                state.orders = state.FOrders = res.data.orders;
                console.log(state.trips)
                state.user = res.data.user;
            }).then(()=>{
                genStore.commit('loading',false);
            })
        },
        exportExcel:(state,data)=>{
            axios({
                method:'post',
                url:'/excel/export/store',
                data:{
                data_arr:data
                }
            }).then(res => {
                window.location.href = "/excel/export/download";
            })
        },
        insertTrip:(state,trip)=>{
            trip = reshapeTrips([trip])[0];
            state.trips.forEach(t => {
                if(t.id == trip.id)(Object.assign(t,trip))
            })
        },
        insertOrders:(state,orders)=>{
            orders = reshapeOrders(orders);
            state.FOrders.forEach(o => {
                orders.forEach(order=>{
                    if(order.id == o.id){
                        Object.assign(o,order);
                    }
                })
            })
        },
        insertTrips:(state,trips)=>{
            trips = reshapeTrips(trips)
            state.trips.forEach(trip => {
                trips.forEach(cTrip=> {
                    if(trip.id == cTrip.id){Object.assign(trip,cTrip);}
                })
            })
        }
    }
});