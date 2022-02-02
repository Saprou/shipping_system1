<template>
  <div>
  <PopUp v-if="addNoteToggler" @close="addNoteValue = '';addNoteToggler = false;">
    <div class="add-note-container">
      <input v-model="addNoteValue" type="text">
      <MyButton @click="addNote()" :label="'Add'" />
    </div>
  </PopUp>
    <PickupView :pickup="viewPickup" v-if="viewPickup" @close="viewPickup =false" />
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
            <label for="">{{__('Hub')}}</label>
            <select v-model="filter.hub">
              <option v-for="hub in hubs" :key="hub.label" :value="hub.value">{{__(hub.label)}}</option>
            </select>
          </section>
        </section>
        <svg class="reload-icon" @click="$store.commit('getItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>
      </header>
      <table class="data-table">
        <thead>
          <tr>
            <td></td>
            <td class="Actions">{{__('Actions')}}</td>
            <td>{{__('AWB')}}</td>
            <td>{{__('Status')}}</td>
            <td>{{__('Hub')}}</td>
            <td>{{__('Location')}}</td>
            <td>{{__('Notes')}}</td>
            <td>{{__('Created at')}}</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pickup in filterdPickups" :key="pickup.awb">
            <td>
              <svg class="action-icon" @click="viewPickup = pickup" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#00a8ff"><path d="M12.015 7c4.751 0 8.063 3.012 9.504 4.636-1.401 1.837-4.713 5.364-9.504 5.364-4.42 0-7.93-3.536-9.478-5.407 1.493-1.647 4.817-4.593 9.478-4.593zm0-2c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 7l-3.36-2.171c-.405.625-.64 1.371-.64 2.171 0 2.209 1.791 4 4 4s4-1.791 4-4-1.791-4-4-4c-.742 0-1.438.202-2.033.554l2.033 3.446z"/></svg>
              <svg @click="addNoteToggler = pickup.id" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M6 12h10v1h-10v-1zm7.816-3h-7.816v1h9.047c-.45-.283-.863-.618-1.231-1zm5.184 1.975v2.569c0 4.106-6 2.456-6 2.456s1.518 6-2.638 6h-7.362v-20h9.5c.312-.749.763-1.424 1.316-2h-12.816v24h10.189c3.163 0 9.811-7.223 9.811-9.614v-3.886c-.623.26-1.297.421-2 .475zm-13-3.975h6.5c-.134-.32-.237-.656-.319-1h-6.181v1zm17-2.5c0 2.485-2.017 4.5-4.5 4.5s-4.5-2.015-4.5-4.5 2.017-4.5 4.5-4.5 4.5 2.015 4.5 4.5zm-2-.5h-2v-2h-1v2h-2v1h2v2h1v-2h2v-1z"/></svg>
            </td>
            <td class="actions">
              <svg  v-if="pickup.selected" class="minus" @click="$store.commit('unPickItem',pickup)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7 14h-14v-4h14v4z"/></svg>
              <button @click="Add(pickup)" v-if="pickup.status == 25">{{__('Add')}}</button>
            </td>
            <td><CopyText :value="pickup.awb" /></td>
            <td><Status :background_color="Status(pickup.old_status).color">{{Status(pickup.old_status).value}}</Status></td>
            <td>{{Hub(pickup.hub)}}</td>
            <td>{{__(pickup.location.city)+' / '+__(pickup.location.area)}}</td>
            <td>{{pickup.notes}}</td>
            <td>{{pickup.created_at}}</td>
          </tr>
        </tbody>
      </table>
  </div>
</template>

<script>
export default {
  data(){
    return{
      addNoteToggler:false,
      addNoteValue:'',
      viewPickup:false,
      searchInput:'',
      filter:{
        status:0,
        hub:0,
      },
      statuses:[
        {value:0,label:'All'},
        {value:1,label:'New'},
        {value:25,label:'Ready'},
        {value:2,label:'CourierOnWay'},
        {value:4,label:'Faild'},
        {value:3,label:'InStock'}
      ],
      hubs:[
        {value:0,label:'All'},
        {value:1,label:'Cairo'},
        {value:2,label:'Giza'},
        {value:3,label:'Qalyubia'},
      ]
    }
  },
  methods:{
    addNote(){
      if(this.addNoteValue.length < 3){this.addNoteToggler = false; return null;}
      this.$genStore.dispatch('pickupNote', {id:this.addNoteToggler,note:this.addNoteValue})
      this.addNoteToggler = false;
      this.addNoteValue = '';
    },
    Add(pickup){
      if(!this.$store.getters.selectedCourier){this.$genStore.commit('redMessage','Select courier');return null;}
      if(this.$store.getters.selectedCourier.status != 1){this.$genStore.commit('redMessage','Courier is out');return null;}
      pickup.status = 2;
      pickup.selected = true;
      this.$store.getters.selectedCourier.items.push(pickup);
    },
    Search(){
      this.$axios({
        method:'post',
        url:'/dashboard/find-pickup',
        data:{awb:this.searchInput}
      }).then(res => {
        if(res.data == 500){console.log('Not Found');return null;}
        let pickup = res.data;
        pickup.old_status = pickup.status;
        pickup.selected = false;
        pickup.kind = 'p';
        this.$store.state.pickups = [];
        this.$store.state.pickups.push(pickup);
      })
    },
    searchTyped(){
      if(this.searchInput.length == 0){
        this.$store.state.pickups = this.$store.state.FPickups;
      }
    },
    Hub(hub){
      switch(hub){
        case 1 :return 'Cairo';
        case 2 :return 'Giza';
        case 3 :return 'Qalyubia';
        default : return 'No Hub';
      }
    },
    Status(status){
      switch(status) {
        case 1:return {value:'New',color:'#00b894'};
        case 2:return {value:'CourierOnWayToPick',color:'#e1b12c'};
        case 3:return {value:'InStock',color:'#487eb0'};
        case 4:return {value:'Faild',color:'#e00'};
        case 25:return {value:'Ready',color:'#353b48'};
        default:return {value:'NoStatus',color:'#000'};
      } 
    },
  },
computed:{
  filterdPickups:function(){
    return this.$store.state.pickups.filter(pickup=>{
      return (pickup.status == this.filter.status||this.filter.status==0)
           &&(pickup.hub == this.filter.hub||this.filter.hub==0)
    });
  }
}
}
</script>

<style>

</style>