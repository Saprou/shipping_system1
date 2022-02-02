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
              <td><TimeFilter v-model:from="filter.received_at_from" v-model:to="filter.received_at_to" /></td>
              <td><TimeFilter v-model:from="filter.deliverd_at_from" v-model:to="filter.deliverd_at_to" /></td>
              <td><TimeFilter v-model:from="filter.collected_at_from" v-model:to="filter.collected_at_to" /></td>
              <td><TimeFilter v-model:from="filter.paid_at_from" v-model:to="filter.paid_at_to" /></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
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
              <td>{{trip.item_ref}}</td>
              <td>{{trip.trip_cash}}</td>
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
              url:'/dashboard/operation/find-item-trips',
              data:{awb:this.searchInput}
            }).then(res => {
              if(res.data == 500||res.data.length < 1){this.$genStore.commit('redMessage','Not Found');return null;}
              let trip = res.data;
              this.$store.state.trips = trip;
            })
          }else if(this.searchBy == 2){
            this.$store.state.trips = [];
            axios({
              method:'post',
              url:'/dashboard/operation/find-courier-trips',
              data:{awb:this.searchInput}
            }).then(res => {
              if(!res.data.status){this.$genStore.commit('redMessage',res.data.message);return null;}
              let trips = res.data.data;
              this.$store.state.trips = trips;
            })
          }
        },
        searchTyped(){
          if(this.searchInput.length == 0){
            this.$store.state.trips = this.$store.state.FTrips;
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
    },
}
</script>

<style>

</style>