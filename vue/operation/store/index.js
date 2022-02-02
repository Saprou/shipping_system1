import axios from 'axios';
import Vuex from 'Vuex';
import genStore from '../../store/index';

function reshapeOrders(orders){
    orders.forEach(order => {
        order.selected = false;
        order.desc = null;
        order.old_status = order.status;
        order.kind = 'o';
    });
    return orders;
}
function reshapePickups(orders){
    orders.forEach(order => {
        order.selected = false;
        order.desc = null;
        order.old_status = order.status;
        order.kind = 'p';
    });
    return orders;
}
function reshapeCouriers(couriers){
    couriers.forEach(courier => {
        courier.selected = false;
        courier.items = [] ;
        reshapeOrders(courier.orders).forEach(item=>{courier.items.push(item)})
        reshapePickups(courier.pickups).forEach(item=>{courier.items.push(item)})

    });
    return couriers;
}

export default new Vuex.Store({
    state:{
        user:{
            f_name:'0000',
            l_name:'0000',
            ref:'U-000',
        },
        printPageToggler:false,
        orders:[],
        FOrders:[],
        pickups:[],
        FPickups:[],
        couriers:[],
        FTrips:[],
        trips:[],
    },
    getters:{
        /* COURIER */
        selectedCourier:state =>{
            return state.couriers.find(courier => {
                return courier.selected;
            })
        },
        outCouriers:(state) =>{
            return state.couriers.filter(courier => {
                return courier.status == 2;
            })
        },
        availCouriers:(state) =>{
            return state.couriers.filter(courier => {
                return courier.status == 1;
            })
        },
        courierOrders:(state,getters) => {
            return getters.selectedCourier.items.filter(item => {
                return item.kind == 'o'
            })
        },
        courierPickups:(state,getters) => {
            return getters.selectedCourier.items.filter(item => {
                return item.kind == 'p'
            })
        },
    },
    actions:{
        StartUp:({commit, state , getters})=>{
            commit('getItems')
        },
        sendCourier:({dispatch ,commit, state , getters})=>{
            if(getters.selectedCourier.items.length == 0){
                genStore.commit('redMessage','Courier have no items');
                return null;
            }
            genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/dashboard/operation/send-courier',
                data:{
                    orders:getters.courierOrders,
                    pickups:getters.courierPickups,
                    courier:getters.selectedCourier,
                }
            }).then(res => {
                getters.selectedCourier.status = 2;
                console.log(res.data.pickups)
                commit('insertOrders',res.data.orders);
                dispatch('insertPickups',res.data.pickups);
                getters.courierPickups.map(order => {order.selected = false;order.old_status = order.status;})
            }).then(() => {
                genStore.commit('loading',false);
            })
        },
        arrCourier:({dispatch ,commit, state , getters})=>{
            let err = false;
            getters.courierOrders.forEach(order => {
                if(order.status == order.old_status){genStore.commit('redMessage','Select Status for '+order.awb);err = true;}
            })
            if(err == true){return null;}
            getters.courierPickups.forEach(order => {
                if(order.status == order.old_status){genStore.commit('redMessage','Select Status for '+order.awb);err = true;}
            })
            if(err == true){return null;}
            genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/dashboard/operation/arr-courier',
                data:{
                    orders:getters.courierOrders,
                    pickups:getters.courierPickups,
                    courier:getters.selectedCourier,
                }
            }).then(res => {
                getters.selectedCourier.status = 1;
                console.log(res.data.pickups)
                commit('insertOrders',res.data.orders);
                dispatch('insertPickups',res.data.pickups);
                getters.selectedCourier.items = [];
            }).then(() => {
                genStore.commit('loading',false);
            })
        },
        insertPickups:({commit, state , getters},pickups)=>{
            pickups = reshapePickups(pickups);
            state.pickups.forEach(pickup => {
                pickups.forEach(p => {
                    if(p.id == pickup.id){Object.assign(pickup,p)}
                    commit('insertOrders',p.norders)
                })
            })  
        }
    },
    mutations:{
        getItems:(state)=>{
            genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/dashboard/operation/get-items'
            }).then(res => {
                state.orders = state.FOrders = reshapeOrders(res.data.orders);
                state.pickups = state.FPickups = reshapePickups(res.data.pickups);
                state.trips = state.FTrips = res.data.trips;
                state.couriers = reshapeCouriers(res.data.couriers);
                state.user.f_name = res.data.user.f_name;
                state.user.l_name = res.data.user.l_name;
                state.user.ref = res.data.user.ref;
            }).then(() => {
                genStore.commit('loading',false);
            });
        },
        unPickItem:(state,item) => {
            state.couriers.forEach(courier =>{
                if(courier.selected){
                    courier.items.splice(courier.items.indexOf(item),1);
                }
            });
            item.selected = false;
            item.situation = null;
            item.status = item.old_status;
        },
        printItems:(state) => {
            state.printPageToggler =true;
            let w = window.open();
            w.document.write('<!DOCTYPE html>');
            w.document.write('<html><head><title>Print it!</title><link rel="stylesheet" type="text/css" href="/css/print-paper.css"></head><body>');
            w.document.write(document.getElementById('print-items').innerHTML);
            w.document.write('</body></html>');
            setTimeout(() => {
                w.print();
                w.close();
                state.printPageToggler =false;
            }, 500);

        },
        insertOrders:(state,orders) => {
            orders = reshapeOrders(orders);
            state.orders.forEach(order => {
                orders.forEach(o => {
                    if(o.id == order.id){Object.assign(order,o)}
                })
            })
        }
    }
});