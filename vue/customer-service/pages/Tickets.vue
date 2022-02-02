<template>
  <div>
    <InputWindow v-if="addNoteToggler" @submit="addNote($event)" @close="addNoteToggler = false" :title="'Add note'"/>

     <CreateTicket @close="CreateTicket = false" v-if="CreateTicket" />
      <header>
        <section class="filters-container">
          <section class="filter">
            <label for="">{{__('Status')}}</label>
            <select v-model="filter.status">
              <option v-for="status in statuses" :key="status.label" :value="status.value">{{__(status.label)}}</option>
            </select>
          </section>
            <MyButton @click="CreateTicket = true" :label="'+'" :title="__('Create Ticket')"></MyButton>
        </section>
      </header>
      <div class="data-table-container">
          <table class="data-table">
              <thead>
                  <tr>
                      <td></td>
                      <td class="actions">{{__('Actions')}}</td>
                      <td>{{__('Ticket ID')}}</td>
                      <td>{{__('AWB')}}</td>
                      <td>{{__('Agent name')}}</td>
                      <td>{{__('Agent ref')}}</td>
                      <td>{{__('Subject')}}</td>
                      <td>{{__('Area')}}</td>
                      <td>{{__('Group')}}</td>
                      <td>{{__('Account')}}</td>
                      <td>{{__('Mobile')}}</td>
                      <td>{{__('Description')}}</td>
                      <td>{{__('Created at')}}</td>
                      <td>{{__('Status')}}</td>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="ticket in filterdTickets" :key="ticket.id">
                    <td>
                        <svg v-if="ticket.status == 1" @click="addNoteToggler = ticket.id" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M6 12h10v1h-10v-1zm7.816-3h-7.816v1h9.047c-.45-.283-.863-.618-1.231-1zm5.184 1.975v2.569c0 4.106-6 2.456-6 2.456s1.518 6-2.638 6h-7.362v-20h9.5c.312-.749.763-1.424 1.316-2h-12.816v24h10.189c3.163 0 9.811-7.223 9.811-9.614v-3.886c-.623.26-1.297.421-2 .475zm-13-3.975h6.5c-.134-.32-.237-.656-.319-1h-6.181v1zm17-2.5c0 2.485-2.017 4.5-4.5 4.5s-4.5-2.015-4.5-4.5 2.017-4.5 4.5-4.5 4.5 2.015 4.5 4.5zm-2-.5h-2v-2h-1v2h-2v1h2v2h1v-2h2v-1z"/></svg>
                    </td>
                      <td class="actions">
                          <button v-if="ticket.status == 1" @click="closed(ticket)">{{__('Closed')}}</button>
                      </td>
                      <td>{{ticket.id}}</td>
                      <td>{{ticket.AWB}}</td>
                      <td>{{ticket.agent_name}}</td>
                      <td>{{ticket.agent_ref}}</td>
                      <td>{{ticket.subject}}</td>
                      <td>{{ticket.area}}</td>
                      <td>{{ticket.group}}</td>
                      <td>{{ticket.account}}</td>
                      <td>{{ticket.mobile}}</td>
                      <td>{{ticket.description}}</td>
                      <td>{{ticket.created_at}}</td>
                      <td><Status :background_color="Status(ticket.status).color">{{__(Status(ticket.status).status)}}</Status></td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</template>

<script>
import CreateTicket from '../windows/Create-Ticket.vue';
export default {
    data(){
        return {
            addNoteToggler:false,
            CreateTicket:false,
            filter:{
                status:0
            },
            statuses:[
                {label:'All',value:0},
                {label:'Open',value:1},
                {label:'Closed',value:2},
            ]
        }
    },
    components:{
        CreateTicket
    },
    methods:{
        addNote(v){
            if(v.length < 3){this.addNoteToggler = false; return null;}
            this.$axios({
                method:'post',
                url:'/dashboard/service/add-desc',
                data:{id:this.addNoteToggler,note:v}
            }).then(res=>{
                this.addNoteToggler = false;
            })
        },
        open(ticket){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/service/set-ticket-open',
                data:{ticket:ticket}
            }).then(res => {
                this.$store.commit('insertTicket',res.data);
            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        closed(ticket){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/service/set-ticket-closed',
                data:{ticket:ticket}
            }).then(res => {
                this.$store.commit('insertTicket',res.data);
            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        Status(status){
            switch(status){
                case 1 :return {status:'Open',color:'#e84118'};
                case 2 :return {status:'Closed',color:'#44bd32'};
                default:return {status:'No statyus',color:'#000'};
            }
        }
    },
    computed:{
        filterdTickets:function(){
            return this.$store.state.tickets.filter(ticket => {
                return ticket.status == this.filter.status || this.filter.status == 0
            });
        }
    }
}
</script>

<style>

</style>