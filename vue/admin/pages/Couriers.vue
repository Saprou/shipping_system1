<template>
  <div>
      <CreateCourier v-if="createCourierswitch" @close="createCourierswitch = false"></CreateCourier>
      <header>
          <div class="filters-container">
            <section class="filter">
                <label for="">{{__('Status')}}</label>
                <select v-model="filter.status">
                <option value=0>{{__('All')}}</option>
                <option value=1>{{__('Active')}}</option>
                <option value=2>{{__('Banned')}}</option>
                </select>
            </section>
          </div>
          <MyButton @click="createCourierswitch = true" :label="'+'"></MyButton>
        <svg class="reload-icon" @click="$store.commit('getItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>
      
      </header>
      <div class="data-table-container">
          <table class="data-table">
              <thead>
                  <tr>
                      <td class="actions">{{__('Actions')}}</td>
                      <td>{{__('Ref')}}</td>
                      <td>{{__('Name')}}</td>
                      <td>{{__('Mobile')}}</td>
                      <td>{{__('Second Mobile')}}</td>
                      <td>{{__('ID')}}</td>
                      <td>{{__('Status')}}</td>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="courier in filterdCouriers" :key="courier.ref">
                      <td class="actions">
                          <div>
                              <button v-if="courier.status != 3" @click="ban(courier)">{{__('Ban')}}</button>
                              <button v-if="courier.status == 3" @click="active(courier)">{{__('Activate')}}</button>
                          </div>
                      </td>
                      <td>{{courier.ref}}</td>
                      <td><UInput v-model="courier.name" @update:modelValue="Update(courier)"/></td>
                      <td><UInput v-model="courier.mobile" @update:modelValue="Update(courier)"/></td>
                      <td><UInput v-model="courier.sec_mobile" @update:modelValue="Update(courier)"/></td>
                      <td><UInput v-model="courier.personal_id" @update:modelValue="Update(courier)"/></td>
                      <td><Status :background_color="Status(courier.status).color">{{__(Status(courier.status).status)}}</Status></td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</template>

<script>
import CreateCourier from '../windows/Create-Courier.vue'
import UInput from '../../components/UpdateableInput.vue'
export default {
    data(){
        return{
            createCourierswitch:false,
            filter:{
                status:0,
                role:0
            }
        }
    },
    components:{CreateCourier,UInput},
    methods:{
        Status(status){
            switch(status){
                case 1 : return {status:'Active',color:'Green'};
                case 3 : return {status:'Banned',color:'red'};
                case 2 : return {status:'Out',color:'orange'};
                case 5 : return {status:'Holded',color:'yellow'};
                default : return {status:'No status',color:'black'};
            }
        },
        ban(courier){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/admin/ban-courier',
                data:{
                    courier:courier
                }
            }).then(res => {
                this.$store.commit('updateCourier',res.data);
            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        active(courier){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/admin/active-courier',
                data:{
                    courier:courier
                }
            }).then(res => {
                this.$store.commit('updateCourier',res.data);
            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        Update(v){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/admin/update-courier',
                data:{courier:v}
            }).then(res => {
                this.$genStore.commit('greenMessage','updated');
            }).then(()=>{
                this.$genStore.commit('loading',false);
            })
        }
    },
    computed:{
        filterdCouriers:function(){
            return this.$store.state.couriers.filter(courier => {
                return (courier.status == this.filter.status || this.filter.status==0)&&(courier.role == this.filter.role || this.filter.role==0)
            });
        }
    }
}
</script>

<style>

</style>