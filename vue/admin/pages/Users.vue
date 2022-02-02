<template>
  <div>
      <CreateUser v-if="createUserSwitch" @close="createUserSwitch = false"></CreateUser>
      <EditUser v-if="EditUser" :user="User" @close="EditUser = false;User=null;"></EditUser>
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
            <section class="filter">
                <label for="">{{__('Role')}}</label>
                <select v-model="filter.role">
                <option value=0>{{__('All')}}</option>
                <option value='accountant'>{{__('accountant')}}</option>
                <option value='service'>{{__('service')}}</option>
                <option value='operation'>{{__('operation')}}</option>
                </select>
            </section>
          </div>
          <MyButton @click="createUserSwitch = true" :label="'+'"></MyButton>
        <svg class="reload-icon" @click="$store.commit('getItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>

      </header>
      <div class="data-table-container">
          <table class="data-table">
              <thead>
                  <tr>
                      <td class="actions">{{__('Actions')}}</td>
                      <td>{{__('Ref')}}</td>
                      <td>{{__('Role')}}</td>
                      <td>{{__('Name')}}</td>
                      <td>{{__('Mobiles')}}</td>
                      <td>{{__('E-mail')}}</td>
                      <td>{{__('Status')}}</td>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="user in filterdUsers" :key="user.ref">
                      <td class="actions">
                          <div>
                              <button @click="User=user;EditUser=true">Edit</button>
                              <button v-if="user.status == 1" @click="ban(user)">{{__('Ban')}}</button>
                              <button v-if="user.status == 2" @click="active(user)">{{__('Activate')}}</button>
                          </div>
                      </td>
                      <td>{{user.ref}}</td>
                      <td>{{user.role}}</td>
                      <td>{{user.f_name}} {{user.l_name}}</td>
                      <td>{{user.mobile}} /{{user.sec_mobile}}</td>
                      <td>{{user.email}}</td>
                      <td><Status :background_color="Status(user.status).color">{{__(Status(user.status).status)}}</Status></td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</template>

<script>
import CreateUser from '../windows/Create-User.vue'
export default {
    data(){
        return{
            createUserSwitch:false,
            EditUser:false,
            User:null,
            filter:{
                status:0,
                role:0
            }
        }
    },
    components:{CreateUser},
    methods:{
        Status(status){
            switch(status){
                case 1 : return {status:'Active',color:'Green'};
                case 2 : return {status:'Banned',color:'red'};
                default : return {status:'No status',color:'black'};
            }
        },
        ban(user){
            this.$axios({
                method:'post',
                url:'/dashboard/admin/ban',
                data:{
                    user:user
                }
            }).then(res => {
                this.$store.commit('updateUser',res.data);
            })
        },
        active(user){
            this.$axios({
                method:'post',
                url:'/dashboard/admin/active',
                data:{
                    user:user
                }
            }).then(res => {
                this.$store.commit('updateUser',res.data);
            })
        },
    },
    computed:{
        filterdUsers:function(){
            return this.$store.state.users.filter(user => {
                return (user.status == this.filter.status || this.filter.status==0)&&(user.role == this.filter.role || this.filter.role==0)
            });
        }
    }
}
</script>

<style>

</style>