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
          <section class="filter">
            <label for="">{{__('Hub')}}</label>
            <select v-model="filter.hub">
              <option v-for="hub in hubs" :key="hub.label" :value="hub.value">{{__(hub.label)}}</option>
            </select>
          </section>
        </section>
        <svg class="reload-icon" @click="$store.commit('getItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>
      </header>

      <div class="data-table-container">
          <table class="data-table">
              <thead>
                  <tr>
                      <td>{{__('Length')}}</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>{{filterdPickups.length}}</td>
                  </tr>
              </tbody>
            <thead>
                <tr>
                    <td class="Actions">{{__('Actions')}}</td>
                    <td>{{__('AWB')}}</td>
                    <td>{{__('Status')}}</td>
                    <td>{{__('Hub')}}</td>
                    <td>{{__('Location')}}</td>
                    <td>{{__('Created at')}}</td>
                 </tr>
              </thead>
              <tbody>
                  <tr v-for="pickup in filterdPickups" :key="pickup.id">
                      <td class="actions">
                          <select @input="changeStatus(pickup.id,$event.target.value)">
                              <option value=0>{{__('Change status')}}</option>
                              <option value=1>{{__('New')}}</option>
                              <option value=25>{{__('Ready')}}</option>
                              <option value=2>{{__('Courier on way to pick')}}</option>
                              <option value=3>{{__('In stock')}}</option>
                              <option value=4>{{__('Faild to pick')}}</option>
                              <option value=26>{{__('Holded')}}</option>
                          </select>
                      </td>
                      <td><CopyText :value="pickup.awb" /></td>
                      <td><Status :background_color="Status(pickup.status).color">{{Status(pickup.status).value}}</Status></td>
                      <td>{{Hub(pickup.hub)}}</td>
                      <td>{{pickup.location.city}}/{{pickup.location.area}}</td>
                      <td>{{pickup.created_at}}</td>
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
        changeStatus(id,status){
            if(status == 0){return null;}
            status = parseInt(status);
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/admin/update-pickup-status',
                data:{id:id , status:status}
            }).then(res => {
                console.log(res.data)
                this.$store.commit('insertPickup',res.data);
            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        Search(){
            this.$axios({
                method:'post',
                url:'/dashboard/find-pickup',
                data:{awb:this.searchInput}
            }).then(res => {
                if(res.data == 500){console.log('Not Found');return null;}
                let pickup = res.data;
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
                &&(pickup.hub == this.filter.hub||this.filter.hub==0);
            });
        }
    }
}
</script>

<style>

</style>