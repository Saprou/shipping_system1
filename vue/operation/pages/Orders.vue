<template>
<div>
  <PopUp v-if="addNoteToggler" @close="addNoteValue = '';addNoteToggler = false;">
    <div class="add-note-container">
      <input v-model="addNoteValue" type="text">
      <MyButton @click="addNote()" :label="'Add'" />
    </div>
  </PopUp>
  <ViewOrder :order="viewOrder" v-if="viewOrderSwitch" @close="viewOrderSwitch =false" />
  <header>
    <section class="filters-container">
    <MySearch @searchClicked="Search()" @searchTyped="searchTyped()" v-model:modelValue="searchInput" />
      <section class="filter">
        <label for="">{{__('Status')}}</label>
        <select v-model="filter.status">
          <option v-for="status in statuses" :key="status.label" :value="status.value">{{__(status.label)}}</option>
        </select>
      </section>
      <section class="filter">
        <label for="">{{__('Type')}}</label>
        <select v-model="filter.type">
          <option v-for="type in types" :key="type.label" :value="type.value">{{__(type.label)}}</option>
        </select>
      </section>
      <section class="filter">
        <label for="">{{__('City')}}</label>
        <select v-model="filter.city">
          <option v-for="city in cities" :key="city" :value="city">{{__(city)}}</option>
        </select>
      </section>
      <section class="filter">
        <label for="">{{__('Area')}}</label>
        <select v-model="filter.area">
          <option value="All">{{__('All')}}</option>
          <option v-for="area in Areas" :key="area.value" :value="area.value">{{__(area.value)}}</option>
        </select>
      </section>
    </section>
    <svg class="reload-icon" @click="$store.commit('getItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>
  </header>
  <div class="data-table-container">
  <table class="data-table">
    <thead>
      <tr>
        <td></td>
        <td class="actions">{{__('Actions')}}</td>
        <td>{{__('AWB')}}</td>
        <td>{{__('Status')}}</td>
        <td>{{__('Type')}}</td>
        <td>{{__('Cash')+'+'+__('Shipping')}}</td>
        <td>{{__('Location')}}</td>
        <td>{{__('Attempts')}}</td>
        <td>{{__('Notes')}}</td>
      </tr>
    </thead>
    <tbody>
      <tr v-for="order in filterdOrders" :key="order.awb">
        <td>
            <svg class="action-icon" @click="View(order)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#00a8ff"><path d="M12.015 7c4.751 0 8.063 3.012 9.504 4.636-1.401 1.837-4.713 5.364-9.504 5.364-4.42 0-7.93-3.536-9.478-5.407 1.493-1.647 4.817-4.593 9.478-4.593zm0-2c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 7l-3.36-2.171c-.405.625-.64 1.371-.64 2.171 0 2.209 1.791 4 4 4s4-1.791 4-4-1.791-4-4-4c-.742 0-1.438.202-2.033.554l2.033 3.446z"/></svg>

            <svg @click="addNoteToggler = order.id" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M6 12h10v1h-10v-1zm7.816-3h-7.816v1h9.047c-.45-.283-.863-.618-1.231-1zm5.184 1.975v2.569c0 4.106-6 2.456-6 2.456s1.518 6-2.638 6h-7.362v-20h9.5c.312-.749.763-1.424 1.316-2h-12.816v24h10.189c3.163 0 9.811-7.223 9.811-9.614v-3.886c-.623.26-1.297.421-2 .475zm-13-3.975h6.5c-.134-.32-.237-.656-.319-1h-6.181v1zm17-2.5c0 2.485-2.017 4.5-4.5 4.5s-4.5-2.015-4.5-4.5 2.017-4.5 4.5-4.5 4.5 2.015 4.5 4.5zm-2-.5h-2v-2h-1v2h-2v1h2v2h1v-2h2v-1z"/></svg>
        </td>
        <td class="actions">
          <div>
            <svg  v-if="order.selected" class="minus" @click="$store.commit('unPickItem',order)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7 14h-14v-4h14v4z"/></svg>
            <button @click="setStatus(order,6,'set out for deliver')" v-if="!order.selected && (order.old_status == 25 || order.old_status == 9)">{{__('Deliver')}}</button>
            <button @click="setStatus(order,10,'set to return')" v-if="!order.selected && (order.old_status == 8 || order.old_status == 9)">{{__('Return')}}</button>
            <button @click="setStatus(order,21,'set courier on way to customer to customer')" v-if="!order.selected && order.old_status == 26">{{__('Pick from customer')}}</button>
            <button @click="setStatus(order,23,'set courier on way to customer to seller')" v-if="!order.selected && order.old_status == 22">{{__('Return')}}</button>
          </div>
        </td>
        <td><CopyText :value="order.awb" /></td>
        <td><Status :background_color="Status(order.old_status).color" >{{__(Status(order.old_status).label)}}</Status></td>
        <td>
          <p :style="'color:'+Type(order.type).color">{{Type(order.type).type}}</p>
          <p v-if="order.type == 3">(({{order.order_awb}}))</p>
        </td>
        <td>{{order.total_cash}}</td>
        <td>{{__(order.city)+' / '+__(order.area)}}</td>
        <td>{{order.attempts}}</td>
        <td>{{order.notes}}</td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</template>

<script>
import ViewOrder from '../windows/View-Order.vue'
export default {
  data(){
    return{
      viewOrder:{},
      viewOrderSwitch:false,
      addNoteValue:'',
      addNoteToggler:false,
      searchInput:'',
      statuses:this.$genStore.getters.orderStatuses,
      types:[
        {value:0,label:'All'},
        {value:1,label:'Deliver'},
        {value:2,label:'Return'},
        {value:3,label:'Exchange'}
      ],
      filter:{
        status:0,
        type:0,
        city:'All',
        area:'All',
      },
      cities:[
          'All',
          'Cairo',
          'Giza',
          'Qalubeya',
          'Alexandria',
      ],
      areas:this.$genStore.getters.Areas
    }
  },
  components:{
    ViewOrder
  },
  methods:{
    View(order){
      this.viewOrder = order;
      this.viewOrderSwitch = true;
    },
    addNote(){
      if(this.addNoteValue.length < 3){this.addNoteToggler = false; return null;}
      this.$genStore.dispatch('orderNote', {id:this.addNoteToggler,note:this.addNoteValue})
      this.addNoteToggler = false;
      this.addNoteValue = '';
    },
    Search(){
      this.$axios({
        method:'post',
        url:'/dashboard/find-order',
        data:{awb:this.searchInput}
      }).then(res => {
        if(res.data == 500){this.$genStore.commit('redMessage','Not found');return null;}
        let order = res.data;
        order.old_status = order.status;
        order.selected = false;
        order.kind = 'o';
        this.$store.state.orders = [];
        this.$store.state.orders.push(order);
      })
    },
    searchTyped(){
      if(this.searchInput.length == 0){
        this.$store.state.orders = this.$store.state.FOrders;
      }
    },
    setStatus(order,status,desc){
      if(!this.$store.getters.selectedCourier){this.$genStore.commit('redMessage','Select courier');return null;}
      if(this.$store.getters.selectedCourier.status != 1){this.$genStore.commit('redMessage','Courier is out');return null;}
      order.status = status;
      order.desc = desc;
      order.selected = true;
      this.$store.getters.selectedCourier.items.push(order);
    },
    Type(type){

      switch(type) {
        case 1:
          return {type:'Deliver',color:'green'};
        case 2:
          return {type:'Return',color:'orange'};
        case 3:
          return {type:'Exchange',color:'red'};
        default:
          return {type:'no type',color:'#000'};
      }
    },
    Status(status){
        for (let i = 0; i < this.statuses.length; i++) {
          if(this.statuses[i].value == status){return this.statuses[i];}
        }
        return {label:"No status",color:"#000"};
    } 
    },
  computed:{
    filterdOrders:function(){
      return this.$store.state.orders.filter(order => {
        return (order.old_status == this.filter.status || this.filter.status==0 )
               && (order.type == this.filter.type || this.filter.type==0)
               && (order.city == this.filter.city || this.filter.city=='All')
               && (order.area.match(this.filter.area) || this.filter.area=='All');
      });
    },
    Areas:function(){
        return this.areas.filter(area => {
            return area.city == this.filter.city
        })
    },
  }
}
</script>

<style>

</style>