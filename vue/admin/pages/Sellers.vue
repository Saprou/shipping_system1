<template>
  <div>
      <EditUser v-if="EditUser" :user="User" @close="EditUser = false;User=null;"></EditUser>
      <header>
        <section class="filters-container">
        <MySearch @searchClicked="Search()" @searchTyped="searchTyped()" v-model:modelValue="searchInput" />
          <section class="filter">
            <label for="">{{__('Status')}}</label>
            <select v-model="filter.status">
              <option v-for="status in statuses" :key="status.label" :value="status.value">{{__(status.label)}}</option>
            </select>
          </section>
        </section>
        <svg class="reload-icon" @click="$store.commit('getItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>
      </header>
      <div class="data-table-container">
          <table class="data-table">
              <thead>
                  <tr>
                      <td>{{__('Actions')}}</td>
                      <td>{{__('Ref')}}</td>
                      <td>{{__('Name')}}</td>
                      <td>{{__('Mobiles')}}</td>
                      <td>{{__('E-mail')}}</td>
                      <td>{{__('Status')}}</td>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="seller in filterdSellers" :key="seller.id">
                      <td class="actions">
                          <button @click="User=seller;EditUser=true">Edit</button>
                          <button v-if="seller.status != 2" @click="ban(seller.id)">{{__('Ban')}}</button>
                          <button v-if="seller.status != 1" @click="activate(seller.id)">{{__('Activate')}}</button>
                      </td>
                      <td>{{seller.ref}}</td>
                      <td>{{seller.f_name+' '+seller.l_name}}</td>
                      <td>{{seller.mobile+'/'+seller.sec_mobile}}</td>
                      <td>{{seller.email}}</td>
                      <td><Status :background_color="Status(seller.status).color">{{Status(seller.status).value}}</Status></td>
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
            EditUser:false,
            User:null,
            searchInput:'',
            filter:{
                status:0,
            },
            statuses:[
                {value:0,label:'All'},
                {value:1,label:'Active'},
                {value:2,label:'Banned'},
            ],
        }
    },
    methods:{
        Search(){
            this.$genStore.commit('loading',true);
            this.$store.state.sellers = [];
            this.$axios({
                method:'post',
                url:'/dashboard/admin/find-seller',
                data:{ref:this.searchInput}
            }).then(res => {
                if(res.data == 404){console.log('Not Found');return null;}
                this.$store.state.sellers.push(res.data);
            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        searchTyped(){
            if(this.searchInput.length == 0){
                this.$store.state.sellers = this.$store.state.FSellers;
            }
        },
        activate(id){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/admin/activate-seller',
                data:{id:id}
            }).then(res => {
                this.$store.commit('insertSeller',res.data)
            }).then(()=>{
                this.$genStore.commit('loading',false);
            })
        },
        ban(id){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/admin/ban-seller',
                data:{id:id}
            }).then(res => {
                this.$store.commit('insertSeller',res.data)
            }).then(()=>{
                this.$genStore.commit('loading',false);
            })
        },
        Status(status){
            switch(status) {
                case 1:return {value:'Active',color:'#00b894'};
                case 2:return {value:'Banned',color:'#e1b12c'};
                default:return {value:'NoStatus',color:'#000'};
            } 
        },
    },
    computed:{
        filterdSellers:function(){
            return this.$store.state.sellers.filter(seller => {
                return seller.status == this.filter.status || this.filter.status == 0 ;
            })
        }
    }
}
</script>

<style>

</style>