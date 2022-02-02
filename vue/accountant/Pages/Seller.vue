<template>
  <div>
        <div class="page-selector">
            <section :class="page == 0 ?'selected':null" @click="page = 0">{{__('Orders')}}</section>
            <section :class="page == 1 ?'selected':null" @click="page = 1">{{__('Trips')}}</section>
        </div>
      <div style="padding:0.2em;">
        <div style="text-align:center;">
        <MySearch v-model="searchInput" @searchClicked="search()" />
        <Download @click="$store.commit('exportExcel',Excel())" :title="__('Download excel')"></Download>

        </div>
      </div>
      <div class="data-table-container">
          <Orders :cash="OrdersCash + TripsCash" :seller="seller" :orders="orders" v-if="page == 0" />
          <Trips  :cash="OrdersCash + TripsCash" :seller="seller" :trips="trips" v-if="page == 1" />
      </div>
  </div>
</template>

<script>
import Orders from './seller/orders.vue'
import Trips from './seller/trips.vue'

export default {
    data(){
        return {
            searchInput:'',
            page:0,
            orders:[],
            trips:[],
            seller:{orders:[],trips:[]},
            statuses:this.$genStore.getters.orderStatuses,
        }
    },
    components:{
        Orders,Trips
    },
    methods:{
        search(){
           this.seller = {orders:[],trips:[]};  this.trips = [];    this.orders = [];
            this.$axios({
                method:'post',
                url:'/dashboard/accountant/get-seller',
                data:{
                    ref:this.searchInput
                }
            }).then(res => {
                if(res.data == 404){console.log('not found');return null;}
                this.seller = res.data;
                this.orders = res.data.orders
                this.trips = res.data.trips
            })
        },
        Excel(){
            let Excel = [];

            Excel.push(["Name","Mobile","Sec Mobile","E-mail"]);
            Excel.push([this.seller.f_name+' '+this.seller.l_name,this.seller.mobile,this.seller.sec_mobile,this.seller.email]);
            Excel.push(["--*","--*","--*","--*","--*","--*","--*","--*",]);
            Excel.push(["AWB","Type","Status","Total Cash","Received Date","Delivery Date"]);
            this.filterdOrders.forEach(order => {
                Excel.push([
                    order.awb,
                    this.Type(order.type),
                    this.OrderStatus(order.status).status,
                    order.total_cash,
                    order.received_at,
                    order.deliverd_at,
                ]);
            });
            Excel.push(["--*","--*","--*","--*","--*","--*","--*","--*",]);
            Excel.push(["Item AWB","Trip cash","Status","Description","Ended at","Started at","Collected at","Paid at",]);
            this.filterdTrips.map(trip => {
                    Excel.push([
                    trip.item_ref,
                    trip.trip_cash,
                    this.TripStatus(trip.status).status,
                    trip.desc,
                    trip.started_at,
                    trip.ended_at,
                    trip.collected_at,
                    trip.paid_at,
                ]);
            });
            return Excel;
        },
        Type(type){
            if(type == 1){return 'Deliver'}
            if(type == 2){return 'Return'}
            if(type == 3){return 'Exchange'}
        },
        OrderStatus(status){
            for (let i = 0; i < this.statuses.length; i++) {
            console.log(this.statuses[i])
            if(this.statuses[i].value == status){return this.statuses[i];}
            }
            return {label:"No status",color:"#000"};
        },
        TripStatus(status){
            switch(status){
                case 1: return {status:'Started',color:'#00b894'};
                case 2: return {status:'Ended',color:'#0984e3'};
                case 3: return {status:'Collected',color:'#6c5ce7'};
                case 4: return {status:'Paid',color:'#fab1a0'};
                default: return {status:'No status',color:'#000'}
            }
        }
    },
    computed:{
        filterdOrders:function(){
            return this.orders;
        },
        filterdTrips:function(){
            return this.trips;
        },
        OrdersCash:function(){
            let cash = 0;
            this.orders.forEach(order => {
                cash += order.status == 12 ? order.total_cash: 0;
                cash -= order.status == 24 ? order.total_cash: 0;
            });
            return cash;
        },
        TripsCash:function(){
            let cash = 0;
            this.trips.forEach(trip => {
                cash -= trip.status == 2 ? trip.trip_cash: 0;
            });
            return cash;
        },
    }
}
</script>

<style lang='scss' scoped>
.page-selector{
    display:flex; justify-content:center;   align-items:center;
    margin:0.2em;
    section{
        padding:0.6em;
        border:1px solid rgb(138, 131, 131);
        cursor:pointer;
    }
    .selected{
        background-color:#000;
        color:#fff;
    }
}
</style>