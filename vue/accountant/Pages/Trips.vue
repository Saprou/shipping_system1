<template>
  <div>
    <header>
      <section class="filters-container">
        <select name="" v-model="searchBy" id="">
            <option value=1>by order</option>
            <option value=2>by courier</option>
        </select>
        <MySearch @searchClicked="Search()" @searchTyped="searchTyped()" v-model:modelValue="searchInput" />
        <section class="filter">
          <label for="">{{__('Status')}}</label>
          <select v-model="filter.status">
            <option v-for="status in statuses" :key="status.label" :value="status.value">{{__(status.label)}}</option>
          </select>
        </section>
          <Download @click="$store.commit('exportExcel',excelTrips)" :title="__('Download excel')"></Download>
          <ReloadData />
      </section>
    </header>
    <div class="data-table-container">
      <table class="data-table">
        <thead>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><TimeFilter v-model:from="filter.received_at_from" v-model:to="filter.received_at_to" /></td>
              <td><TimeFilter v-model:from="filter.deliverd_at_from" v-model:to="filter.deliverd_at_to" /></td>
              <td><TimeFilter v-model:from="filter.collected_at_from" v-model:to="filter.collected_at_to" /></td>
              <td><TimeFilter v-model:from="filter.paid_at_from" v-model:to="filter.paid_at_to" /></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
                <td>
                  <button v-if="payable" @click="PayTrips()">Pay</button>
                </td>
                <td>{{__('ItemAWB')}}</td>
                <td>{{__('TripCash')}}</td>
                <td>{{__('Status')}}</td>
                <td>{{__('Description')}}</td>
                <td>{{__('EndedAt')}}</td>
                <td>{{__('StartedAt')}}</td>
                <td>{{__('CollectedAt')}}</td>
                <td>{{__('PaidAt')}}</td>
                <td>{{__('Courier ref')}}</td>
                <td>{{__('Courier name')}}</td>
                <td>{{__('Order Location')}}</td>
            </tr>
        </thead>
        <tbody>
          <tr v-for="trip in filterdTrips" :key="trip.item_ref">
              <td>
                  <svg class="select-box" v-if="trip.selected"  @click="trip.selected =! trip.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 5c0-2.761-2.238-5-5-5h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14z"/></svg>
                  <svg class="select-box" v-if="!trip.selected" @click="trip.selected =! trip.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 2c1.654 0 3 1.346 3 3v14c0 1.654-1.346 3-3 3h-14c-1.654 0-3-1.346-3-3v-14c0-1.654 1.346-3 3-3h14zm0-2h-14c-2.762 0-5 2.239-5 5v14c0 2.761 2.238 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5z"/></svg>
              </td>
              <td>{{trip.item_ref}}</td>
              <td>
                <p v-if="trip.trip_cash != null">{{trip.trip_cash}}</p>
                <MyButton v-if="trip.trip_cash == null && !trip.cash_input" @click="trip.cash_input = true" :label="'Collect'" />
                <input @keydown.enter="setTripCash(trip)" @blur="trip.cash_input = false" v-if="trip.cash_input" type="text" v-model="trip.trip_cash">
              </td>
              <td><Status :background_color="Status(trip.status).color">{{__(Status(trip.status).status)}}</Status></td>
              <td>{{trip.desc}}</td>
              <td>{{trip.started_at}}</td>
              <td>{{trip.ended_at}}</td>
              <td>{{trip.collected_at}}</td>
              <td>{{trip.paid_at}}</td>
              <td>{{trip.courier.ref}}</td>
              <td>{{trip.courier.name}}</td>
              <td>{{trip.item.city}}/{{trip.item.area}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    data(){
      return{
        searchBy:1,
        searchInput:'',
        cashInput:false,
        filter:{
          deliverd_at_from:'2021-01-01',
          received_at_from:'2021-01-01',
          collected_at_from:'2021-01-01',
          paid_at_from:'2021-01-01',
          deliverd_at_to:'2050-01-01',
          received_at_to:'2050-01-01',
          collected_at_to:'2050-01-01',
          paid_at_to:'2050-01-01',
          status:0
          },
        statuses:[
            {label:'All',value:0},
            {label:'Started',value:1},
            {label:'Ended',value:2},
            {label:'Collected',value:3},
            {label:'Paid',value:4},
        ],
      }
    },
    methods:{
        Search(){
          if(this.searchBy == 1){
            this.$store.state.trips = [];
            axios({
              method:'post',
              url:'/dashboard/accountant/find-item-trips',
              data:{awb:this.searchInput}
            }).then(res => {
              if(res.data == 500||res.data.length < 1){console.log('Not Found');return null;}
              let trip = res.data;
              trip.cash_input = false;
              this.$store.state.trips = trip;
            })
          }else if(this.searchBy == 2){
            this.$store.state.trips = [];
            axios({
              method:'post',
              url:'/dashboard/accountant/find-courier-trips',
              data:{awb:this.searchInput}
            }).then(res => {
              if(!res.data.status){this.$genStore.commit('redMessage',res.data.message);return null;}
              let trips = res.data.data;
              trips.forEach(trip =>{ 
                trip.cash_input = false;
              })
              this.$store.state.trips = trips;
            })
          }
        },
        searchTyped(){
          if(this.searchInput.length == 0){
            this.$store.state.trips = this.$store.state.FTrips;
          }
        },
        setTripCash(trip){
          this.cashInput = false;
          if(trip.trip_cash != null || trip.trip_cash.length != 0){
            this.$store.dispatch('setTripCash',trip);
          }
        },
        Status(status){
            switch(status){
                case 1: return {status:'Started',color:'#00b894'};
                case 2: return {status:'Ended',color:'#0984e3'};
                case 3: return {status:'Collected',color:'#6c5ce7'};
                case 4: return {status:'Paid',color:'#fab1a0'};
                default: return {status:'No status',color:'#000'}
            }
        },
        PayTrips(){
            this.$genStore.commit('loading',true);
            this.$axios({
              method:'post',
              url:'/dashboard/accountant/pay-trips',
              data:{trips:this.selectedTrips}
            }).then(res => {
              this.$store.commit('insertTrips',res.data.data);
              if(res.data.errors.length > 0){
                this.$genStore.commit('redMessage',res.data.errors[0].message)
              }
            }).then(()=>{
              this.$genStore.commit('loading',false);
            })
        }
    },
    computed:{
        filterdTrips:function(){
            return this.$store.state.trips.filter(trip => {
                return (trip.status == this.filter.status || this.filter.status ==0)
                       &&((this.filter.deliverd_at_from <= trip.started_at&&this.filter.deliverd_at_to >= trip.started_at)||trip.started_at == null)
                       &&((this.filter.received_at_from <= trip.ended_at&&this.filter.received_at_to >= trip.ended_at)||trip.ended_at==null)
                       &&((this.filter.collected_at_from <= trip.collected_at&&this.filter.collected_at_to >= trip.collected_at)||trip.collected_at == null)
                       &&((this.filter.paid_at_from <= trip.paid_at&&this.filter.paid_at_to >= trip.paid_at)||trip.paid_at == null)
                       ;
            });
        },
        selectedTrips:function(){
          return this.filterdTrips.filter(trip =>{
            return trip.selected;
          })
        },
        payable:function(){
          let re = false;
          if(this.selectedTrips.length == 0){return false;}
          re = true;
          this.selectedTrips.forEach(trip => {
            re = trip.status != 3 ? false : re ;
          });
          return re;
        },
        excelTrips:function(){
        let Trips =[[
            "Item AWB",
            "Trip cash",
            "Status",
            "Description",
            "Ended at",
            "Started at",
            "Collected at",
            "Paid at",
            "Courier ref",
            "Courier name"
        ]];
        this.filterdTrips.map(trip => {
            Trips.push([
            trip.item_ref,
            trip.trip_cash,
            this.Status(trip.status).status,
            trip.desc,
            trip.started_at,
            trip.ended_at,
            trip.collected_at,
            trip.paid_at,
            trip.courier.ref,
            trip.courier.name
        ]);
        });
        return Trips;
        }
    },
}
</script>

<style>

</style>