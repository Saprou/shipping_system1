<template>
  <div>
    <header>
    <section class="filters-container">
        <MySearch @searchClicked="Search()" @searchTyped="searchTyped()" v-model:modelValue="searchInput" />
        <section class="filter">
        <label for="">{{__('Status')}}</label>
        <select v-model="filter.status">
            <option v-for="status in statuses" :key="status.label" :value="status.value">{{__(status.label)}}</option>
        </select>
        </section>
        <Download @click="$store.commit('exportExcel',excelTrips)" :title="__('Download excel')"></Download>
    </section>
    <svg class="reload-icon" @click="$store.commit('getItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>
    </header>
      <div class="data-table-container">
        <table class="data-table">
        <thead>
            <tr>
                <td>{{__('ItemAWB')}}</td>
                <td>{{__('TripCash')}}</td>
                <td>{{__('Status')}}</td>
                <td>{{__('Description')}}</td>
                <td>{{__('EndedAt')}}</td>
                <td>{{__('StartedAt')}}</td>
                <td>{{__('CollectedAt')}}</td>
                <td>{{__('PaidAt')}}</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="trip in filterdTrips" :key="trip.item_ref">
                <td>{{trip.item_ref}}</td>
                <td>
                  <p v-if="trip.trip_cash">{{trip.trip_cash}}</p>
                  <button v-if="trip.trip_cash == null && !trip.cash_input" class="def-button" @click="trip.cash_input = true">{{__('CollectCash')}}</button>
                  <input @keydown.enter="setTripCash(trip)" @blur="trip.cash_input = false" v-if="trip.cash_input" type="text" v-model="trip.trip_cash">
                </td>
                <td><Status :background_color="Status(trip.status).color">{{__(Status(trip.status).status)}}</Status></td>
                <td>{{trip.desc}}</td>
                <td>{{trip.started_at}}</td>
                <td>{{trip.ended_at}}</td>
                <td>{{trip.collected_at}}</td>
                <td>{{trip.paid_at}}</td>
            </tr>
        </tbody>
        </table>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            filter:{
                status:0
            }
        }
    },
    methods:{
      Search(){
          this.$store.state.trips = [];
          this.$axios({
            method:'post',
            url:'/dashboard/accountant/find-item-trips',
            data:{awb:this.searchInput}
          }).then(res => {
            if(res.data == 500||res.data.length < 1){console.log('Not Found');return null;}
            console.log(res.data)
            this.$store.state.trips = res.data;
          })
        },
        searchTyped(){
          if(this.searchInput.length == 0){
            this.$store.state.trips = this.$store.state.FTrips;
          }
        },
        setTripCash(trip){
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
    },
    computed:{
        filterdTrips:function(){
            return this.$store.state.trips
        }
    }
}
</script>

<style>

</style>